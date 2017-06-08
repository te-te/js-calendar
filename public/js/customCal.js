function delCal(num){
  $.ajax({
    url:"./db.php",
    type:"POST",
    dataType:"json",
    data:{
      "mode":"del",
      "num":num
    }
  });
  
  window.location.replace("./");
}
function viewCal(num){
  $.ajax({
    url:"./db.php",
    type:"POST",
    dataType:"json",
    data:{
      "mode":"view",
      "num":num
    },
    success:function(data){
      var button = '<button onclick=delCal(' +
      num + ')>' + '일정 지우기'	+ '</button>';

      $("#cal_title").html(data['title']);
      $("#del_cal").attr('onclick', 'delCal(' + num + ')');
    }
  });

  $("#viewModal").modal("show");
}

$(document).ready(function() {
  $.ajax({
    url:"./db.php",
    type:"POST",
    dataType:"json",
    data:{
      "mode":"output"
    },
    success:function(data){
      // 캘린더 DB가 null 이 아닐때 작동
      if(data != "1"){
        var schedule = [];
        var arr_index = 0;

        // DB의 각 일정들을 한 배열에 저장
        for (var i in data) {
          var temp_arr = {
            num: data[i]['num'],
            title: data[i]['title'],
            start: new Date(data[i]['start_year'],
            data[i]['start_month']-1, data[i]['start_day']),
            end: new Date(data[i]['end_year'],
            data[i]['end_month']-1, data[i]['end_day'])
          };

          schedule[arr_index] = temp_arr;
          arr_index = arr_index + 1;
        }
      }

      $('#calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,basicWeek,basicDay'
        },
        editable: false,
        events: schedule
        // dummy data
        // events: [
        // 	{
        // 		title: 'Birthday Party',
        // 		start: new Date(y, m, d+1, 19, 0),
        // 		end: new Date(y, m, d+1, 22, 30),
        // 		allDay: false
        // 	},
        // 	{
        // 		title: 'Click for Google',
        // 		start: new Date(y, m, 28),
        // 		end: new Date(y, m, 29),
        // 		url: 'http://google.com/'
        // 	}
        // ]
      });
    }
  });
});
