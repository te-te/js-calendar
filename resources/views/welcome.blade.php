<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<!-- 캘린더 api css -->
<link rel='stylesheet' type='text/css' href='./css/fullcalendar.css' />

<!-- 제이쿼리 -->
<script type='text/javascript' src='./js/jquery-1.12.4.min.js'></script>
<script type='text/javascript' src='./js/jquery-ui.min.js'></script>
<!-- 캘린더 api -->
<script type='text/javascript' src='./js/fullcalendar.js'></script>

<!-- 부트스트랩 -->
<!-- 합쳐지고 최소화된 최신 CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

<script type='text/javascript' src='./js/customCal.js'></script>
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
		<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addModal">
			일정 추가
		</button>
	</div>

	<br><br>

	<!-- 일정추가 Modal -->
	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

	<!-- 일정보기 Modal -->
	<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">일정 상세보기</h4>
				</div>
				<div class="modal-body">
					<div id="cal_title"></div>
					<br>
					<button id="del_cal">일정 지우기</button>
				</div>
				<div class="modal-footer">
					<!-- <button type="button" class="btn btn-primary">확인</button> -->
					<!-- <button type="button" class="btn btn-default" data-dismiss="modal">취소</button> -->
				</div>
			</div>
		</div>
	</div>
</body>
</html>
