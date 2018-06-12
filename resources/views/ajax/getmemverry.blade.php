<div class="box">
  <div class="box-header">
    @foreach($very as $v)
    <h3 class="box-title">Yêu cầu sác minh: @if($v->code == 'gt') Gatekeeper @elseif($v->code == 'sv') Sinh viên @elseif($v->code == 'dn') Doanh nghiệp @endif </h3>
    @endforeach
  </div>
  <style type="text/css">
    address {
      margin-bottom: 10px;
    }
    a:hover {
      text-decoration: none;
    }
  </style>
  <!-- /.box-header -->

  <div class="box-body ">
    <div class="row">
      <div class="col-md-12"> 
        <div class="row invoice-info" >
          <div class="col-md-12" id="boxaddpro">
            @foreach($user as $u)
            <div class="col-sm-4 invoice-col">
              <address>
                <strong>{{$u->name}}</strong>
              </address>
              <img src="{{url('public/avatar/'.$u->avatar)}}" style="width: 100px;"><br>
              <a href="{{url('m/yesmem/'.$v->id)}}">
                <button type="button" class="btn btn-success">Đồng ý</button>
              </a>
              <a href="{{url('m/nomem/'.$v->id)}}">
                <button type="button" class="btn btn-danger" style="margin: 5px 0;">Từ chối</button>
              </a>
            </div>
            <div class="col-sm-4 invoice-col">
              Email
              <address>
                <strong>{{$u->email}}</strong>
              </address>
              Ngày sinh
              <address>
                <strong>{{$u->birthday}}</strong>
              </address>
              Số điện thoại
              <address>
                <strong>{{$u->phone}}</strong>
              </address>
            </div>
            <div class="col-sm-4 invoice-col">
              Địa chỉ
              <address>
                <strong>{{$u->address}}</strong>
              </address>
              Số chứng minh thư
              <address>
                <strong>{{$u->cmt}}</strong>
              </address>
              Giới tính
              <address>
                <strong>@if($u->gender == 1) Nam @else Nũ @endif</strong>
              </address>
            </div>
            @endforeach
          </div>
          <!-- /.col -->
        </div>
        @foreach($very as $v)
        @if($v->thesv != '')
        <div style="margin-top: 20px" class="col-sm-4">
          <span style="font-weight: bold;font-size: 18px;">Thẻ sinh viên </span><br>
          <img style="width: 100%" src="{{url('public/filevery/'.$v->thesv)}}"><br>
        </div>
        @endif
        @if($v->hdld != '')
        <div style="margin-top: 20px" class="col-sm-4">
          <span style="font-weight: bold;font-size: 18px;">Hợp đồng lao động </span><br>
          <img style="width: 100%" src="{{url('public/filevery/'.$v->hdld)}}"><br>
        </div>
        @endif
        @if($v->mattruoccmt != '')
        <div style="margin-top: 20px" class="col-sm-4">
          <span style="font-weight: bold;font-size: 18px;">Mặt trước chứng minh thư </span><br>
          <img style="width: 100%" src="{{url('public/filevery/'.$v->mattruoccmt)}}"><br>
        </div>
        @endif
        @if($v->matsaucmt != '')
        <div style="margin-top: 20px" class="col-sm-4">
          <span style="font-weight: bold;font-size: 18px;">Mặt sau chứng minh thư </span><br>
          <img style="width: 100%" src="{{url('public/filevery/'.$v->matsaucmt)}}"><br>
        </div>
        @endif
        @if($v->masothue != '')
        <div style="margin-top: 20px" class="col-sm-4">
          <span style="font-weight: bold;font-size: 18px;">Mã số thuế </span><br>
          <img style="width: 100%" src="{{url('public/filevery/'.$v->masothue)}}"><br>
        </div>
        @endif
        @if($v->giayphepdkkd != '')
        <div style="margin-top: 20px" class="col-sm-4">
          <span style="font-weight: bold;font-size: 18px;">Giấu phép đăng ký kinh doanh </span><br>
          <img style="width: 100%" src="{{url('public/filevery/'.$v->giayphepdkkd)}}"><br>
        </div>
        @endif
        @endforeach
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>