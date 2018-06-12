@include('admin.teamplate.header')
@include('admin.teamplate.slidebar')
<style type="text/css">
  .direct-chat-messages {
    height: 365px;
  }
  .callout.callout-success {
    background-color: #00a65a !important;
  }
  .profile-user-img {
    margin: 0 auto;
    width: 100%;
    max-width: 150px;
    border:  #fff;
    border-radius: 5%;
  }
  .panel{
    display: block;
  }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Thông tin cá nhân
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      @if ( session()->has('message') )
      <div class="callout callout-success" id="taban">
        <h4>Thông báo!</h4>
        <p> {{ session()->get('message') }}</p>
      </div>
      @endif
      @if ( session()->has('message2') )
      <div class="callout callout-danger" id="taban">
        <h4>Thông báo!</h4>
        <p> {{ session()->get('message2') }}</p>
      </div>
      @endif
      <div class="row">
        @foreach($user as $user)
        <?php $idprofile = $user->id; ?>
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive " src="{{url('public/avatar')}}/{{$user->avatar}}" alt="User profile picture">

              <h3 class="profile-username text-center">{{$user->name}}</h3>

              <p class="text-muted text-center">
                @foreach($chucvu as $chucvu)
                @if($user->rule == $chucvu->id)
                {{$chucvu->name}}
                @endif
                @endforeach
              </p>
            </div>
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Số điện thoại</strong>

              <p class="text-muted">
                {{$user->phone}}
              </p>

              <hr>

              <strong><i class="fa fa-google margin-r-5"></i> Email</strong>

              <p class="text-muted">
                {{$user->email}}
              </p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- xxx -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              @if(Auth::user()->id == $user->id && Auth::user()->rule != 7)
              <li class="active"><a href="#settings" data-toggle="tab" aria-expanded="true">Cài đặt</a></li>
              @endif
            </ul>
            <div class="tab-content">
              @if(Auth::user()->id == $user->id)
              <div class="tab-pane active" id="settings">
                <div class="box-body">
                  <div class="box-group" id="accordion">
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" class="">
                            Ảnh đại diện
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true" style="">
                        <div class="box-body">
                          <form role="form" method="post" action="{{route('thayavatarmember')}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="exampleInputFile">File ảnh</label>
                                <input type="file" id="exampleInputFile" name="myfile">
                                <p class="help-block">Giới hạn dung lượng file 2mb</p>
                                <input type="hidden" name="id" value="{{Auth::user()->id}}">
                              </div>
                            </div>

                            <div class="box-footer">
                              <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-success">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
                            Thông tin cá nhân
                          </a>
                        </h4>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        <div class="box-body">
                          <form role="form" method="POST" action="{{route('suathongtinmember')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="box-body">
                              <div class="form-group">
                                <label >Họ tên</label>
                                <input type="text" name="hoten" class="form-control" value="{{$user->name}}">
                              </div>
                              <div class="form-group">
                                <label >Số điện thoại</label>
                                <input type="text" class="form-control" name="sdt" value="{{$user->phone}}">
                              </div>
                              <div class="form-group">
                                <label >Email</label>
                                <input type="text" class="form-control" disabled="" value="{{$user->email}}">
                              </div>
                            </div>
                            <div class="box-footer">
                              <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="panel box box-danger">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">
                            Mật khẩu
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        <div class="box-body">
                          <form role="form" action="{{route('editpass')}}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="box-body">
                              <input type="hidden" name="id" value="{{$user->id}}">
                              <div class="form-group">
                                <label for="exampleInputPassword1">Mật khẩu</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password1">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Nhập lại mật khẩu</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password2">
                              </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                              <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endif
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        @endforeach
      </div>
    </section>
    <!-- /.content -->
  </div>
<script type="text/javascript">
setTimeout(function() {
    $('#taban').fadeOut('fast');
}, 2000);
</script>
@include('admin.teamplate.footer')
