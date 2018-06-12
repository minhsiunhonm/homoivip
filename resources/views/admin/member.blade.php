@include('admin.teamplate.header')
  <!-- DataTables -->
  <!-- Left side column. contains the logo and sidebar -->
@include('admin.teamplate.slidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Thành viên
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Ban quản trị</h3>
              <div class="box-tools">
                <a href="{{url('m/member/create')}}">
                  <button class="btn btn-success" style="height: 50px;font-size: 18px;">Thêm thành viên</button>
                </a>
              <form action="{{route('timkiemthanhvienadmin')}}" method="post" style="float: right;">
                @csrf
                <button type="button" class="nuttimkiemadmin">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
                <input type="text" placeholder="Tìm kiếm" name="value" class="form-control timkiemadmin">
              </form>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body ">
              @foreach($userqt as $uqt)
              <div class="col-md-2 memberbox">
                <div>
                  <div class="imgbgmem" style="background: url('http://localhost/homoi9999/public/avatar/{{$uqt->avatar}}') no-repeat;">
                    <div class="adminmemtit">{{$uqt->name}}
                      <p style="width: 100%">
                        <a href="{{url('m/member/'.$uqt->id.'/edit')}}">
                          <button class="btn btn-default" style="float: left;margin: 0px;" >Sửa</button>
                        </a>
                        <!-- <button style="float: right" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$uqt->id}}">Xóa</button> -->
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div id="myModal{{$uqt->id}}" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Cảnh báo</h4>
                    </div>
                    <div class="modal-body">
                      <p>Bạn thực sự muốn xóa tài khoản: {{$uqt->email}}</p>
                    </div>
                    <form action="{{ route('member.destroy' , $uqt->id)}}" method="POST">
                        <input name="_method" type="hidden" value="DELETE">
                        @csrf
                        <div class="modal-footer no-border">
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-danger">Yes</button>
                        </div>
                    </form>
                  </div>

                </div>
              </div>
              @endforeach
            </div>
            <div class="box-header">
              <h3 class="box-title">Doanh nghiệp</h3>
            </div>
            <div class="box-body ">
              @foreach($doanhnghiep as $doanhnghiep)
              <div class="col-md-2 memberbox">
                <div>
                  <div class="imgbgmem" style="background: url('http://localhost/homoi9999/public/avatar/{{$doanhnghiep->avatar}}') no-repeat ;background-size: 100%">
                    <div class="adminmemtit">{{$doanhnghiep->name}}
                      <p style="width: 100%">
                        <a href="{{url('m/member/'.$doanhnghiep->id.'/edit')}}">
                          <button class="btn btn-default" style="float: left;margin: 0px;" >Sửa</button>
                        </a>
                        <button style="float: right" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$doanhnghiep->id}}">Xóa</button>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div id="myModal{{$doanhnghiep->id}}" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Cảnh báo</h4>
                    </div>
                    <div class="modal-body">
                      <p>Bạn thực sự muốn xóa tài khoản: {{$doanhnghiep->email}}</p>
                    </div>
                    <form action="{{ route('member.destroy' , $doanhnghiep->id)}}" method="POST">
                        <input name="_method" type="hidden" value="DELETE">
                        @csrf
                        <div class="modal-footer no-border">
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-danger">Yes</button>
                        </div>
                    </form>
                  </div>

                </div>
              </div>
              @endforeach
            </div>
            <!-- /.box-header -->
            <div class="box-body ">
            </div>
            <div class="box-header">
              <h3 class="box-title">Gatekeeper</h3>
            </div>
            <div class="box-body ">
              @foreach($gatekeeper as $gatekeeper)
              <div class="col-md-2 memberbox">
                <div>
                  <div class="imgbgmem" style="background: url('http://localhost/homoi9999/public/avatar/{{$gatekeeper->avatar}}') no-repeat ;background-size: 100%">
                    <div class="adminmemtit">{{$gatekeeper->name}}
                      <p style="width: 100%">
                        <a href="{{url('m/member/'.$gatekeeper->id.'/edit')}}">
                          <button class="btn btn-default" style="float: left;margin: 0px;" >Sửa</button>
                        </a>
                        <button style="float: right" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$gatekeeper->id}}">Xóa</button>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div id="myModal{{$gatekeeper->id}}" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Cảnh báo</h4>
                    </div>
                    <div class="modal-body">
                      <p>Bạn thực sự muốn xóa tài khoản: {{$gatekeeper->email}}</p>
                    </div>
                    <form action="{{ route('member.destroy' , $gatekeeper->id)}}" method="POST">
                        <input name="_method" type="hidden" value="DELETE">
                        @csrf
                        <div class="modal-footer no-border">
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-danger">Yes</button>
                        </div>
                    </form>
                  </div>

                </div>
              </div>
              @endforeach
            </div>
            <!-- /.box-header -->
            <div class="box-body ">
            </div>
            <div class="box-header">
              <h3 class="box-title">Sinh viên</h3>
            </div>
            <div class="box-body ">
              @foreach($sinhvien as $sinhvien)
              <div class="col-md-2 memberbox">
                <div>
                  <div class="imgbgmem" style="background: url('http://localhost/homoi9999/public/avatar/{{$sinhvien->avatar}}') no-repeat ;background-size: 100%">
                    <div class="adminmemtit">{{$sinhvien->name}}
                      <p style="width: 100%">
                        <a href="{{url('m/member/'.$sinhvien->id.'/edit')}}">
                          <button class="btn btn-default" style="float: left;margin: 0px;" >Sửa</button>
                        </a>
                        <button style="float: right" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$sinhvien->id}}">Xóa</button>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div id="myModal{{$sinhvien->id}}" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Cảnh báo</h4>
                    </div>
                    <div class="modal-body">
                      <p>Bạn thực sự muốn xóa tài khoản: {{$sinhvien->email}}</p>
                    </div>
                    <form action="{{ route('member.destroy' , $sinhvien->id)}}" method="POST">
                        <input name="_method" type="hidden" value="DELETE">
                        @csrf
                        <div class="modal-footer no-border">
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-danger">Yes</button>
                        </div>
                    </form>
                  </div>

                </div>
              </div>
              @endforeach
            </div>
            <!-- /.box-header -->
            <div class="box-body ">
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </section>
  </div>
@include('admin.teamplate.footer')
