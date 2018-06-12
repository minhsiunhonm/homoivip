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
    <div class="col-md-12">
    @if ( session()->has('suc') )
      <div id="delay3s" class="alert alert-success alert-dismissible" style="    background-color: #00a65a !important;">
        <b><i class="icon fa fa-check"></i> Thông báo!</b> {{ session()->get('suc') }}
      </div>
    @endif
    @if ( session()->has('error') )
      <div id="delay3s" class="alert alert-danger alert-dismissible">
        <b><i class="icon fa fa-check"></i> Thông báo!</b> {{ session()->get('error') }}
      </div>
    @endif
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-4">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Yêu cầu sác minh</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body ">
              <div class="row">
                <div class="col-md-12">
                  <table class="table">
                    <thead>
                      <th>Tên</th>
                      <th>Ngày</th>
                      <th>Chức vụ</th>
                      <th></th>
                    </thead>
                    <tbody>
                      @foreach($very as $ve)
                          <tr>
                            <td>{{$ve->users['name']}}</td>
                            <td>{{$ve->created_at}}</td>
                            <td>@if($ve->code == 'sv') Sinh viên @elseif($ve->code == 'gt') Gatekeeper @elseif($ve->code == 'dn') Doanh nghiệp @endif</td>
                            <td><button class="btn btn-default" onclick="loadmem({{$ve->id}})"><span class="glyphicon glyphicon-forward"></span></button></td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <div style="float: right;">
                    {{ $very->links() }}
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-8" id="idhienthianh">

        </div>
    </section>
  </div>
<script type="text/javascript">
  function loadmem(n) {
    demaajaxlert = 0;
    if (demaajaxlert == 0) {
      demaajaxlert = 1; 
      veryid = n; 
      $.ajax({
          url : "{{url('m/loadmem')}}",
          type : "GET",
          dataType:"text",
          data : { veryid },
          success : function (result){
              $('#idhienthianh').html(result);
          }
      });
    }
  } 
</script>
@include('admin.teamplate.footer')