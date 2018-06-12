<script type="text/javascript">
	var ok = {{$ok}};
	if(ok == '1'){
		var gettb = $('#alerttb').html();
		var alerttb = gettb+'<div id="a{{$gettime}}" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Thành công!</h4>Mời thành công thành viên, hãy đợi họ chấp nhận.</div>';
		$('#alerttb').html(alerttb);
	}else{
		var gettb = $('#alerttb').html();
		var alerttb = gettb+'<div id="a{{$gettime}}" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> Lỗi!</h4>Tài khoản này đang bận.</div>';
		$('#alerttb').html(alerttb);
	}
    setTimeout(function() {
        $('#a{{$gettime}}').fadeOut('fast');
    }, 3000);
</script>
