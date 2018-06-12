@foreach($kpi as $kk)
<div class="col-md-2 w12 hoverdele{{$kk->id}}">
    @if($kk->code == 2)
    <img src="{{url('public/fileweb/icon/006-businessman-1.png')}}">
    @elseif($kk->code == 3)
    <img src="{{url('public/fileweb/icon/015-business-man.png')}}">
    @elseif($kk->code == 4)
    <img src="{{url('public/fileweb/icon/006-presentation.png')}}">
    @elseif($kk->code == 5)
    <img src="{{url('public/fileweb/icon/002-tools.png')}}">
    @endif
    <p style="margin-bottom: 0;font-weight: 500">{{$kk->giatri}}</p>
    @if($kk->code == 2)
    <p>Người tham gia</p>
    @elseif($kk->code == 3)
    <p>Sinh viên</p>
    @elseif($kk->code == 4)
    <p>Buổi đào tạo</p>
    @elseif($kk->code == 5)
    <p>{{$kk->tengoi}}</p>
    @endif
    <button class="btn btn-danger btn-xs" onmouseover="$('.hoverdele{{$kk->id}}').css('background-color','#ccc');" onmouseout="$('.hoverdele{{$kk->id}}').css('background-color','#fff');" type="button" onclick="delekpi('{{$kk->id}}')"><span class="glyphicon glyphicon-trash"></span></button>
</div>
@endforeach