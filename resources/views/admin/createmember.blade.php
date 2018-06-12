@include('admin.teamplate.header')
  <!-- DataTables -->
  <style type="text/css">
    #example1_filter {
      float: right;
    }
    #example1_paginate {
      text-align: right;
    }
    #example1_paginate .pagination {
      margin: 0px;
    }
    td {
      width: 50%;
    }
    #avatar {
      border: solid 4px #ecf0f5;
      border-style: solid;
    }
  </style>
  <!-- Left side column. contains the logo and sidebar -->
@include('admin.teamplate.slidebar') 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Đơn xin vay
        <small>Chúc mừng năm mới</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Thông tin user: </h3>
              <div class="box-tools pull-right">
                <a href="{{url('m/member')}}">
                  <button type="button" class="btn-box-tool btn"><i class="fa fa-chevron-left"></i> Thành viên</button>
                </a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive ">
              <form class="form-horizontal" role="form" id="taban2" style="display: block;" method="post" action="{{url('m/member')}}">
                @csrf
                <div class="box-body">
                  @if ( session()->has('message') )
                  <div id="delay3s" class="alert alert-danger alert-dismissible" style="">
                    <b>Thông báo!</b> {{ session()->get('message') }}
                  </div>
                  @endif
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">
                      Mật khẩu
                    </label>
                      <div class="col-sm-8">
                      <input type="password" onclick="(this.type='text')" onfocusout="(this.type='password')" class="form-control" name="password" placeholder="" value="" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">
                      Họ tên
                    </label>
                      <div class="col-sm-8">
                      <input type="text" class="form-control"  placeholder="" value="" name="hoten">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">
                      Số điện thoại
                    </label>
                      <div class="col-sm-8">
                      <input type="number" class="form-control"  placeholder="" value="" name="sdt">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">
                      Email
                    </label>
                      <div class="col-sm-8">
                      <input type="email" class="form-control"  placeholder="" value="" name="email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">
                      Giới tính
                    </label>
                    <div class="col-sm-8">
                      <select class="form-control" name="gioitinh">
                        <option value="1"
                        >Nam</option>
                        <option value="2" 
                        >Nữ</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">
                      Chức vụ
                    </label>
                    <div class="col-sm-8">
                      <select class="form-control" name="chucvu">
                        @foreach($chucvu as $chucvu)
                        <option value="{{$chucvu->id}}"
                        >{{$chucvu->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary" style="float: right;">Hoàn thành</button>
                </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
<script type="text/javascript">
setTimeout(function() {
    $('#delay3s').fadeOut('fast');
}, 2000);
</script>
@include('admin.teamplate.footer')