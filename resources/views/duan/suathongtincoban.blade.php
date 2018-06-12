@include('layouts.headermini')
<style type="text/css">
  .tablist li a {
    color:#333;
  }
</style>
<article class="duan" style="height: auto;background-color: #F2F2F0">
    <div class="container" id="companybox" style="padding-top: 50px;">
        <div class="row">
            @foreach($project as $pr)
            <h2 style="margin-bottom: 20px;"><b>{{$pr->name}}</b></h2>
            @endforeach
            <div>
              <!-- Nav tabs -->
              <ul class="nav nav-tabs tablist" role="tablist">
                <li role="presentation" id="suathongtincobanduan" onclick="suathongtincobanduan()"><a href="#caidat" aria-controls="caidat" role="tab" data-toggle="tab">Thông tin cơ bản của dự án</a></li>
                <li role="presentation" id="tiendoduandera" onclick="tiendoduandera()"><a href="#caidat" aria-controls="caidat" role="tab" data-toggle="tab">Tiến độ dự án đề ra</a></li>
                <li role="presentation" id="bangdutoan" onclick="bangdutoan()"><a href="#caidat" aria-controls="caidat" role="tab" data-toggle="tab">Bảng dự toán</a></li>
                <li role="presentation" id="modulgioithieu" onclick="modulgioithieu()"><a href="#caidat" aria-controls="caidat" role="tab" data-toggle="tab">Modul giới thiệu</a></li>
                <li role="presentation"  id="tabrolthanhvien" onclick="thanhvien()" ><a href="#caidat"aria-controls="caidat" role="tab" data-toggle="tab">Thành viên</a></li>
                <li role="presentation"  id="tabrolyeucauthamgia" onclick="thanhvienyeucau()"><a href="#caidat"aria-controls="caidat" role="tab" data-toggle="tab">Yêu cầu tham gia @if($demyctg != 0)(<span style="color: red">{{$demyctg}}</span>) @endif</a></li>
                <li role="presentation" id="tablorldautu" onclick="dautu()"><a href="#caidat" aria-controls="caidat" role="tab" data-toggle="tab">Nhà đầu tư</a></li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content"> 
                <div role="tabpanel" class="tab-pane fade in active" id="caidat">
                  <div class="col-md-12 boxaddpro" id="boxaddpro" style="min-height: 600px;">
                      <!-- dữ liệu trả về -->
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    <div class="container" id="companybox">
        <div class="row"> 
        </div>
    </div>
</article>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cảnh báo</h4>
      </div>
      <div class="modal-body thongbaomodal">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
        <button type="button" class="btn btn-danger" onclick="guixoacauhoi()">Đồng ý</button>
      </div>
    </div>
  </div>
</div>
<input type="hidden" name="id" id="idxoacauhoi">
<div id="alerttb">
</div>
<footer>
    <div class="container">
        <a href="#">Made by: Dương Văn Minh</a>
    </div>
</footer>
</body>
<script src="{{url('public')}}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url('public')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="{{url('public')}}/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{url('public')}}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('public')}}/dist/js/demo.js"></script>
<script type="text/javascript">
  if (window.location.hash == '#tiendoduandera') {
    $('#tiendoduandera').addClass('active');
    $('#tiendoduandera').click();
  }else if (window.location.hash == '#bangdutoan') {
    $('#bangdutoan').addClass('active');
    $('#bangdutoan').click();
  }else if (window.location.hash == '#modulgioithieu') {
    $('#modulgioithieu').addClass('active');
    $('#modulgioithieu').click();
  }else if (window.location.hash == '#tabrolyeucauthamgia') {
    $('#tabrolyeucauthamgia').addClass('active');
    $('#tabrolyeucauthamgia').click();
  }else if (window.location.hash == '#tablorldautu') {
    $('#tablorldautu').addClass('active');
    $('#tablorldautu').click();
  }else if (window.location.hash == '#thanhvien') {
    $('#tabrolthanhvien').addClass('active');
    $('#tabrolthanhvien').click();
  }else{
    suathongtincobanduan();
    $('#suathongtincobanduan').addClass('active');
  }
  function suathongtincobanduan() {
    document.getElementById('boxaddpro').innerHTML = '<div class="col-md-4"></div><div class="col-md-4"><img style="width: 100%" src="{{url("public/image/loadding.gif")}}">';
    $.ajax({
        url : "{{url('suathongtincobanduan/'.$id)}}",
        type : "GET",
        dataType:"text",
        success : function (result){
            $('#boxaddpro').html(result);
        }
    });
  }
  function modulgioithieu() {
    document.getElementById('boxaddpro').innerHTML = '<div class="col-md-4"></div><div class="col-md-4"><img style="width: 100%" src="{{url("public/image/loadding.gif")}}">';
    $.ajax({
        url : "{{url('modulgioithieu/'.$id)}}",
        type : "GET",
        dataType:"text",
        success : function (result){
            $('#boxaddpro').html(result);
        }
    });
  }
  function editmoney(el) {
      ted = el.value;
      for (var i = 0; i < 10; i++) {
          ted = ted.replace(' ','');
      }
      el.value = ted.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ");
  }
  function editmoney2() {
      el = document.getElementById('money');
      ted = el.value;
      for (var i = 0; i < 10; i++) {
          ted = ted.replace(' ','');
      }
      el.value = ted.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ");
  }
  function bangdutoan() {
    document.getElementById('boxaddpro').innerHTML = '<div class="col-md-4"></div><div class="col-md-4"><img style="width: 100%" src="{{url("public/image/loadding.gif")}}">';
    $.ajax({
        url : "{{url('bangdutoan/'.$id)}}",
        type : "GET",
        dataType:"text",
        success : function (result){
            $('#boxaddpro').html(result);
        }
    });
  }
  function thanhvien() {
      document.getElementById('boxaddpro').innerHTML = '<div class="col-md-4"></div><div class="col-md-4"><img style="width: 100%" src="{{url("public/image/loadding.gif")}}">';
      $.ajax({
          url : "{{url('thanhvien/'.$id)}}",
          type : "GET",
          dataType:"text",
          success : function (result){
              $('#boxaddpro').html(result);
          }
      });
  }
  function xoacauhoi(n) {
      $('#idxoacauhoi').val(n);
      var getcauhoi = $("input[name=cauhoi"+n+"]").val();
      $('.thongbaomodal').html('<b>Bạn có thực sự muốn xóa câu hỏi '+n+'</b><br>"'+getcauhoi+'"');
      $('#myModal').modal('show')
  }
  function guixoacauhoi() {
    $('#myModal').modal('hide')
    var idcauhoi =($('#idxoacauhoi').val());
    var idproject =({{$id}});
    $.ajax({
        url : "{{url('xoacauhoi')}}",
        type : "GET",
        dataType:"text",
        data : { idcauhoi,idproject },
        success : function (result){
            yeucauthamgia();
        }
    });
  }
  function yeucauthamgia() {
    document.getElementById('boxaddpro').innerHTML = '<div class="col-md-4"></div><div class="col-md-4"><img style="width: 100%" src="{{url("public/image/loadding.gif")}}">';
    $.ajax({
        url : "{{url('yeucauthamgia/'.$id)}}",
        type : "GET",
        dataType:"text",
        success : function (result){
            $('#boxaddpro').html(result);
        }
    });
  }
  function thanhvienyeucau() {
    document.getElementById('boxaddpro').innerHTML = '<div class="col-md-4"></div><div class="col-md-4"><img style="width: 100%" src="{{url("public/image/loadding.gif")}}">';
    $.ajax({
        url : "{{url('thanhvienyeucau/'.$id)}}",
        type : "GET",
        dataType:"text",
        success : function (result){
            $('#boxaddpro').html(result);
        }
    });
  }
  function tiendoduandera() {
    document.getElementById('boxaddpro').innerHTML = '<div class="col-md-4"></div><div class="col-md-4"><img style="width: 100%" src="{{url("public/image/loadding.gif")}}">';
    $.ajax({
        url : "{{url('tiendoduandera/'.$id)}}",
        type : "GET",
        dataType:"text",
        success : function (result){
            $('#boxaddpro').html(result);
        }
    });
  }
  function dautu() {
    document.getElementById('boxaddpro').innerHTML = '<div class="col-md-4"></div><div class="col-md-4"><img style="width: 100%" src="{{url("public/image/loadding.gif")}}">';
    $.ajax({
        url : "{{url('dautu/'.$id)}}",
        type : "GET",
        dataType:"text",
        success : function (result){
            $('#boxaddpro').html(result);
        }
    });
  }
</script>
</html>