<div class="col-md-12">
	<div class="checkbox">
	  <label>
	    <input type="checkbox" value="" id="chophepsvthamgia">
	    Cho phép sinh viên gửi yêu cầu tham gia.
	  </label>
	</div>
</div>
<!-- else -->
<div class="col-md-3">
</div>
<div class="col-md-6">
	<form id="datacauhoi" style="display: none" action="{{route('themcauhoi')}}" method="post">
	  @csrf
	  <input type="hidden" class="form-control" name="chophep" id="chophepinput">
	  <input type="hidden" class="form-control" name="id" value="{{$id}}">
	  <div id="cauhoi">
	  	@foreach($question as $que)
	  		<div class="form-group">
	  			<label style="width: 100%">Câu hỏi {{$que->stt}}<span class="glyphicon glyphicon-trash nuttrash" onclick="xoacauhoi({{$que->stt}})"></span></label>
	  			<input type="text" name="cauhoi{{$que->stt}}" value="{{$que->question}}" class="form-control" placeholder="">
	  		</div>
	  	@endforeach
	  </div>
      <div style="cursor: pointer;float: left;padding: 10px;border:1px dashed #4080ff;color: #4080ff;width: 100%;margin: 10px 0px;" id="nutthemcauhoi" onclick="themcauhoi()">
        <span class="glyphicon glyphicon-plus" style="font-size: 11px;padding: 0 5px 5px 5px;top: 0px;"></span>
        Thêm câu hỏi.
      </div>
	</form>
</div>
<div class="col-md-6"></div>
<div class="col-md-12" style="position: unset;">
	<button type="button" id="subdatacauhoi" class="btn btn-primary">Lưu</button>
</div>
<script src="{{url('public')}}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url('public')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{url('public')}}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script type="text/javascript">
var demcauhoi = {{count($question)}}+0;
var demchophepsv = {{$thamgia}};
if (demcauhoi == 10) {
    $('#nutthemcauhoi').css('display','none');
}
$(document).ready(function(){
	if(demchophepsv == 1){
		$('#chophepsvthamgia').prop('checked', true);
        $('#datacauhoi').css('display','block');
        $('#chophepinput').val(1);
        demchophepsv = 1;
	}
    $('#subdatacauhoi').click(function(){
        $('#datacauhoi').submit();
    });
    $('#chophepsvthamgia').change(function(){
    	if(demchophepsv == 0){
	        $('#datacauhoi').css('display','block');
	        $('#chophepinput').val(1);
	        demchophepsv = 1;
    	}else{
	        $('#datacauhoi').css('display','none');
	        $('#chophepinput').val(0);
	        demchophepsv = 0;
    	}
    });
});
function themcauhoi(n) {
    demcauhoi++;
    if (demcauhoi == 10) {
        $('#nutthemcauhoi').css('display','none');
    }
    var getcauhoi = $('#cauhoi').html();
    var formcauhoi = '<div class="form-group"><label>Câu hỏi '+demcauhoi+'</label><input type="text" name="cauhoi'+demcauhoi+'" class="form-control" placeholder=""></div>'
    $('#cauhoi').html(getcauhoi+formcauhoi);
}
</script>