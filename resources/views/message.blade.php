<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{url('public')}}/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('public')}}/style.css">
</head>
<body>
	<h2>Tìm kiếm</h2>
	<input type="text" id="noidung" onkeyup="clicknut()" name="">
	<button class="btn btn-danger" id="result" type="button">Get requet</button>
	<div id="opdata"></div>
	<div id="ras">
		Nội dung ajax sẽ được load ở đây
	</div>
<script src="{{url('public')}}/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#result').click(function () {
			var getdata = $('#noidung').val();
			$.ajax({
                url : "getRequest",
                type : "GET",
                dataType:"text",
                data : { getdata },
                success : function (result){
                    $('#ras').html(result);
                }
            });
		});
	});
	function clicknut(){
		var dem = document.getElementById("noidung").value;
		document.getElementById("result").click();
	}
</script>
</body>
</html>