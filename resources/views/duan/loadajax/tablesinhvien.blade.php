@foreach($teamsv as $team)
<div class="col-md-2 w9" >
  <a href="{{url($team->users['linkprofile'])}}" target="blank">
    <img src="{{url('public/avatar/'.$team->users['avatar'])}}" >
    <p>{{$team->users['name']}}</p>
  </a>
  @if($team->agree == 0)
  <button class="btn btn-default" disabled="" type="button">Đã mời</button>
  <a onclick="huymoi('{{$team->id_user}}','{{$id}}')" class='w9x3'>Hủy mời</a>
  @endif
</div>
@endforeach
@if(count($teamsv) != 0)
<div class="col-md-2 w9x2" >
  <a href="#">Xem thêm</a>
</div>
@else
<span class="help-span col-md-12">
  Chưa có thành viên nào
</span>
@endif
@if($ok == 1)
<script type="text/javascript">
    var gettb = $('#alerttb').html();
    var alerttb = gettb+'<div id="a{{$gettime}}" class="alert alert-success alert-dismissible" style="background-color: #00a65a !important"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Thành công!</h4>Mời thành công thành viên, hãy đợi họ chấp nhận.</div>';
    $('#alerttb').html(alerttb);
    setTimeout(function() {
        $('#a{{$gettime}}').fadeOut('fast');
    }, 3000);
</script>
@endif