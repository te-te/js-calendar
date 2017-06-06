<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<!-- 캘린더 api css -->
<link rel='stylesheet' type='text/css' href='./css/fullcalendar.css' />

<!-- 제이쿼리 -->
<script type='text/javascript' src='./js/jquery-1.12.4.min.js'></script>
<script type='text/javascript' src='./js/jquery-ui.min.js'></script>
<!-- 캘린더 api -->
<script type='text/javascript' src='./js/fullcalendar.min.js'></script>

<!-- 부트스트랩 -->
<!-- 합쳐지고 최소화된 최신 CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

<script type='text/javascript'>

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

</script>
<style type='text/css'>

	body {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		}

	#calendar {
		width: 900px;
		margin: 0 auto;
		}

	.open_modal{
		text-align: right;
		margin-right: 15%;
	}

</style>
</head>
<body>
	<div class="open_modal">
		<!-- Open Modal Button -->
		<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
			일정 추가
		</button>
	</div>

	<br><br>

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">일정 추가하기</h4>
				</div>
				<div class="modal-body">
					<form class="" action="./db.php" method="post">
						<input type="hidden" name="mode" value="input">
						<h4>일정 이름</h4>
						<input type="text" name="title" value=""><br><br>
						<h4>시작일</h4>
						<input type="date" name="start"><br><br>
						<h4>종료일</h4>
						<input type="date" name="end"><br><br>
						<input type="submit" value="만들기">
					</form>
				</div>
				<div class="modal-footer">
					<!-- <button type="button" class="btn btn-primary">확인</button> -->
					<!-- <button type="button" class="btn btn-default" data-dismiss="modal">취소</button> -->
				</div>
			</div>
		</div>
	</div>

	<!-- Calendar -->
	<div id='calendar'></div>
	<br>
</body>
</html>
