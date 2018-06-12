@include('layouts.headermini')
<link rel="stylesheet" href="{{ asset('public/plugins/pace/pace-theme-center-atom.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/responpro.css') }}">
<div id="placecss"></div>
<script src="{{ asset('public/bower_components/PACE/pace.min.js') }}"></script>
<script type="text/javascript">
  var checkaj = 0;
  $(document).ajaxStart(function () {
    Pace.restart()
  })
  $(function() {
      Pace.on("done", function(){ 
        $("#placecss").fadeOut();
      });
  });
</script>
<link rel="stylesheet" href="{{url('public')}}/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="{{url('public')}}/dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="{{url('public')}}/dist/bootstrap-tagsinput.css">

<article class="duan" style="height: auto;">
    <div class="container" >
        <div class="wer1" style="padding: 0px;position: relative;">
          <div class="wer1 w3" id="w3">
            <a href="{{$id}}#thongtin" data-panel-url="{{$id}}#thongtin">
              <div class="col-md-4 w4 " id="thongtinx" onclick="thongtin()">Thông tin</div>
            </a>
            <a href="{{$id}}#hoso" data-panel-url="{{$id}}#hoso">
              <div class="col-md-4 w4 " id="hosox" onclick="hoso()">Hồ sơ</div>
            </a>
            <a href="{{$id}}#chitiet" data-panel-url="{{$id}}#chitiet">
              <div class="col-md-4 w4 " id="chitietx" onclick="chitiet()" style="border-right: 0px;">Chi tiết</div>
            </a>
            <div class="col-md-12 w5" id="slidebar">
              <div class="col-md-8">
                <ul class="w6">
                  <li style="padding-left: 0px;margin-top: 0px;cursor: default;"><b>Yêu cầu</b></li>
                  <li class="w6active"><span>Chi tiết số tiền kêu gọi <span></li>
                  <li ><span>Sác nhận điều khoản <span></li>
                  <li style="padding-left: 0px;margin-top: 0px;cursor: default;"><b>Đề nghị thêm</b></li>
                  <li ><span>File tài liệu <span></li>
                  <li ><span>Quyền lợi nhà tài trợ <span></li>
                </ul>
              </div>
              <div class="col-md-4" style="padding: 0px;">
                <div class=" w7">
                  45%
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="wer2 w2" id="boxaddpro">
          
        </div>
    </div>
</article> 
<footer>
    <div class="container">
        <a href="#">Made by: Dương Văn Minh</a>
    </div>
</footer>
<script type="text/javascript">
  if (window.location.hash == '#hoso') {
    $('#hosox').click();
  }else if (window.location.hash == '#chitiet') {
    $('#chitietx').click();
  }else{
    thongtin();
  }
  window.onscroll = function() {myFunction()};
  var header = document.getElementById("w3");
  var sticky = $("#w3").offset();
  function myFunction() {
    var width = $( window ).width();
    if (window.pageYOffset >= sticky.top && width > 992) {
      header.classList.add("stick2");
    } else {
      header.classList.remove("stick2");
    }
  }
  function thongtin() {
    if (checkaj != 1) {
      // checkaj =1;
      $('#thongtinx').addClass('w4active');
      $('#chitietx').removeClass('w4active');
      $('#hosox').removeClass('w4active');
      $("#placecss").fadeIn(0);
      $.ajax({
          url : "{{url('step1/'.$id)}}",
          type : "GET",
          dataType:"text",
          success : function (result){
              $('#boxaddpro').html(result);
          }
      });
      $.ajax({
          url : "{{url('step1bar/'.$id)}}",
          type : "GET",
          dataType:"text",
          success : function (result){
              $('#slidebar').html(result);
          }
      });
      $('html,body').animate({
          scrollTop: 130
      }, 700);
    }
  }
  function hoso() {
    if (checkaj != 2) {
      // checkaj =2;
      $('#chitietx').removeClass('w4active');
      $('#thongtinx').removeClass('w4active');
      $('#hosox').addClass('w4active');
      $("#placecss").fadeIn(0);
      $.ajax({
          url : "{{url('step2/'.$id)}}",
          type : "GET",
          dataType:"text",
          success : function (result){
              $('#boxaddpro').html(result);
          }
      });
      $.ajax({
          url : "{{url('step2bar/'.$id)}}",
          type : "GET",
          dataType:"text",
          success : function (result){
              $('#slidebar').html(result);
          }
      });
      $('html,body').animate({
          scrollTop: 130
      }, 700);
    }
  }
  function chitiet() {
    if (checkaj != 3) {
      // checkaj =3;
      $('#thongtinx').removeClass('w4active');
      $('#chitietx').addClass('w4active');
      $('#hosox').removeClass('w4active');
      $("#placecss").fadeIn(0);
      $.ajax({
          url : "{{url('step3/'.$id)}}",
          type : "GET",
          dataType:"text",
          success : function (result){
              $('#boxaddpro').html(result);
          }
      });
      $.ajax({
          url : "{{url('step3bar/'.$id)}}",
          type : "GET",
          dataType:"text",
          success : function (result){
              $('#slidebar').html(result);
          }
      });
      $('html,body').animate({
          scrollTop: 130
      }, 700);
    }
  }
</script>
</body>
</html>