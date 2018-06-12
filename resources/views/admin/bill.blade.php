@include('admin.teamplate.header') 
@include('admin.teamplate.slidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Hóa đơn thanh toán
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Hóa đơn</h3>
              <div class="box-tools">
                <form class="form-inline" style="float: right;">
                  <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputName2" placeholder="Mã hóa đơn">
                  </div>
                  <button type="submit" class="btn btn-default" onclick="timkiem()">Tìm kiếm</button>
                </form>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body ">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-xs-12">
                      <h2 class="page-header">
                        <i class="fa fa-globe"></i> Homoi.com
                        <small class="pull-right">Date: 15/4/2018</small>
                      </h2>
                    </div>
                    <!-- /.col -->
                  </div>
                  <div class="row invoice-info" >
                    <div class="col-md-12" id="boxaddpro">
                      <div class="col-sm-4 invoice-col">
                        From
                        <address>
                          <strong>Admin, Inc.</strong><br>
                          795 Folsom Ave, Suite 600<br>
                          San Francisco, CA 94107<br>
                          Phone: (804) 123-5432<br>
                          Email: info@almasaeedstudio.com
                        </address>
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-4 invoice-col">
                        To
                        <address>
                          <strong>John Doe</strong><br>
                          795 Folsom Ave, Suite 600<br>
                          San Francisco, CA 94107<br>
                          Phone: (555) 539-1037<br>
                          Email: john.doe@example.com
                        </address>
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-4 invoice-col">
                        <b>Invoice #007612</b><br>
                        <br>
                        <b>Order ID:</b> 4F3S8J<br>
                        <b>Payment Due:</b> 2/22/2014<br>
                        <b>Account:</b> 968-34567
                      </div>
                    </div>
                    <!-- /.col -->
                  </div>
                  <a  target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Hóa đơn gần đây</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body ">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <thead>
                      <th>Mã hóa đơn</th>
                      <th>Khác hàng</th>
                      <th>Dự án</th>
                      <th>Số tiền</th>
                      <th>Phương thức thanh toán</th>
                      <th>Thời gian</th>
                      <th>Tình trạng</th>
                      <th></th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>#010001</td>
                        <td>Dương Minh</td>
                        <td>Đạp xe</td>
                        <td>100,000,000đ</td>
                        <td>Chuyển khoản</td>
                        <td>15-4-2018 7:59</td>
                        <td><span class="label bg-green" style="background: #00a65a !important">Hoàn thành</span></td>
                        <td><a href="#" style="color: #3c8dbc">Chi tiết</a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </section>
  </div>
<script type="text/javascript">
function timkiem() {
    var data = $('#exampleInputName2').val();
    $.ajax({
        url : "{{url('m/timkiembill')}}",
        type : "GET",
        dataType:"text",
        data : { data },
        success : function (result){
            $('#boxaddpro').html(result);
        }
    });
}
</script>
@include('admin.teamplate.footer')