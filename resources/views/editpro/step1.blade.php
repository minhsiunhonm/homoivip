<link rel="stylesheet" href="{{url('public')}}/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="{{url('public')}}/dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="{{url('public')}}/dist/bootstrap-tagsinput.css">
<div id="thongtin"></div>
<h3 id="w8tit">Xây dựng chiến dịch</h3>
<div class="alert alert-danger alert-dismissible" id="thongbaoloitab1" style="display: none;">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon fa fa-ban"></i> Thông báo!</h4>
  Đã sảy ra lỗi, vui lòng xem lại dữ liệu đã nhập!
</div>
<hr>
@foreach($project as $pr)
<form class="form-horizontal col-md-12" action="{{route('step1sub')}}" id="formstep1" method="post" >
  @csrf

  <div class="form-group">
    <label class="col-sm-2 control-label">Tên dự án</label>
    <div class="col-sm-9">
      <input type="text" class="form-control winput" name="tenduan" value="{{$pr->name}}" placeholder="Tên dự án của bạn">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Url dự án</label>
    <div class="col-sm-3">
      <span class="urlweb">https://www.homoi.com/</span>
    </div>
    <div class="col-sm-6">
      <input type="text" name="urlduan" value="@if($pr->id != $pr->url){{$pr->url}}@endif" class="form-control winput" placeholder="Tên dự án">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Tỉnh thành</label>
    <div class="col-sm-3">
      <select class="form-control select2" name="tinhthanh" style="width: 100%;border-radius: 0px">
        @foreach($city as $ci)
        <option value="{{$ci->id}}" @if($pr->id_city == $ci->id) selected @endif>{{$ci->name}}</option>
        @endforeach
      </select>
    </div>
    <label class="col-sm-2 control-label">Địa điểm</label>
    <div class="col-sm-4">
      <input type="text" class="form-control winput" name="diadiem" value="{{$pr->place}}" placeholder="Địa điểm thực hiện">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Dòng giới thiệu</label>
    <div class="col-sm-9">
      <textarea class="form-control" rows="3" placeholder="Giới thiệu về dự án của bạn" name="description">{{$pr->short_description}}</textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Ngành nghề</label>
    <div class="col-sm-9">
      <select class="form-control select2" name="nganhnghe" style="width: 100%;border-radius: 0px">
        @foreach($career as $care)
        <option value="{{$care->id}}" @if($pr->id_career == $care->id) selected @endif>{{$care->name}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <h3 id="w8tit" style="margin-bottom: 0px;">Từ khóa dự án</h3>
  <span class="help-span">
    Chọn từ khóa liên quan dến dự án, giúp nhà đầu tư tìm thấy bạn.
  </span>
  <div class="form-group">
    <label class="col-sm-2 control-label">Nhập từ khóa</label>
    <div class="col-sm-9">
      <input type="text" value="{{$pr->tag}}" name="tukhoa" data-role="tagsinput"/>
    </div>
  </div>
  <hr>
  <h3 id="w8tit" style="margin-bottom: 0px;">Kết nối dự án</h3>
  <span class="help-span">
    Kết nối mạng Mạng Xã Hội và Website của bạn để chứng minh sự uy tín của bạn.
  </span>
  <div class="form-group">
    <label class="col-sm-2 control-label">Địa chỉ Email</label>
    <div class="col-sm-9">
      <input type="email" class="form-control winput" name="diachiemail" value="{{$pr->emailpro}}" placeholder="Địa chỉ Email áp dụng cho dự án">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Số điện thoại</label>
    <div class="col-sm-9">
      <input type="number" class="form-control winput"  placeholder="Số điện thoại áp dụng cho dự án" value="{{$pr->phonepro}}" name="sodienthoai">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Url trang web</label>
    <div class="col-sm-9">
      <input type="text" name="urlweb" value="{{$pr->webpro}}" class="form-control winput" placeholder="Url trang web áp dụng cho dự án">
    </div>
  </div>
  <h3 id="w8tit" >Mạng xã hội</h3>
  <div class="form-group">
    <label class="col-sm-2 control-label">Facebook</label>
    <div class="col-sm-9">
      <input type="text" class="form-control winput" value="{{$pr->facebookpro}}" name="facebook" placeholder="Facebook Url">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Linked In</label>
    <div class="col-sm-9">
      <input type="text" class="form-control winput" placeholder="Linked In Url" value="{{$pr->linkedinpro}}" name="linkedin">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Twitter</label>
    <div class="col-sm-9">
      <input type="text" class="form-control winput" placeholder="Twitter Url" value="{{$pr->twitterpro}}" name="twitter">
    </div>
  </div>
  <hr>
  <h3 id="w8tit" style="margin-bottom: 0px;">Hình ảnh của dự án</h3>
  <span class="help-span">
    Loại hình ảnh: jpg, png.
  </span>
  <div class="col-md-6">
    <p><b>Logo</b></p>
    <div class='logomark' onclick="logoclick()" @if($pr->avatar != '') style="background-color:#fff" @endif >
      @if($pr->avatar == '')
      <span class="glyphicon glyphicon-camera"></span>
      @else
      <img src="{{url('public/fileupload/'.$pr->avatar)}}" id="imglogo">
      @endif
    </div>
    <p>Tối đa 2MP</p>
    <p>kích thước 170x170</p>
  </div>
  <div class="col-md-6">
    <p><b>Ảnh nổi bật</b></p>
    <div class='bannermark' onclick="bannerclick()"  @if($pr->avatar != '') style="background-color:#fff" @endif>
      @if($pr->banner == '')
      <span class="glyphicon glyphicon-picture"></span>
      @else
      <img src="{{url('public/fileupload/'.$pr->banner)}}" id="imgbanner">
      @endif
    </div>
    <p>Tối đa 2MP</p>
    <p>kích thước 750x430</p>
  </div>
  <hr>
  <h3 id="w8tit" style="margin-bottom: 0px;">Video dự án</h3>
  <span class="help-span">
    Video giới thiệu công ty giúp dự án hấp dẫn hơn.
  </span>
  <div class="col-md-5">
    <div class='videomark' id="videobox" >
      @if($pr->video == null || $pr->video == '')
      <span class="fa fa-youtube"></span>
      @else
      <iframe src="{{$linkvideo}}?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> 
      @endif
    </div>
  </div>
  <div class="col-md-6" style="padding-top: 70px;">
    <div class="form-group" id="helpvideo">
      <div class="col-sm-9">
        <textarea class="form-control winput" id="formvideo" placeholder="Youtube Url"></textarea>
        <span class="help-block helpvideo" style="display: none;">Vui lòng nhập lại đường dẫn của bạn</span>
      </div>
      <input class="col-sm-2 control-label btn btn-danger" onclick="checkvideo()" style="color: #fff" value="Thêm" type="button" />
    </div>
  </div>
  <h3 id="w8tit" style="margin-bottom: 0px;width: 100%;float: left;">Slideshare</h3>
  <span class="help-span">
    Mô tả dự án của bạn bằng slide.
  </span>
  <div class="col-md-5">
    <div class='videomark' id="slideshare">
      @if($pr->slide == null || $pr->slide == '')
      <span class="fa fa-slideshare"></span>
      @else
      <?= $pr->slide; ?>
      @endif
    </div>
  </div>
  <div class="col-md-6" style="padding-top: 70px;">
    <div class="form-group  " id="helpslide">
      <div class="col-sm-9">
        <textarea class="form-control winput"  id="formslide" placeholder="Slideshare Url"></textarea>
        <span class="help-block helpslide" style="display: none;">Vui lòng nhập lại đường dẫn của bạn</span>
      </div>
      <input style="color: #fff" class="col-sm-2 control-label btn btn-danger" value="Thêm" type="button" onclick="checkslide()" />
    </div>
  </div>
  <input type="hidden" name="nextrq" id="nextrq">
  <input type="hidden" name="idproject" id="idproject" value="{{$id}}">
  <div class="col-md-12" style="margin-bottom: 50px;padding-top: 20px;text-align: right;">
    <input style="border-radius: 0px;" type="button" onclick="saveform()" value="Lưu" class="btn btn-lg btn-primary" name="">
    <input style="border-radius: 0px;" onclick="($('#nextrq').val('1')); saveform()" type="button" value="Lưu và tiếp tục" class="btn btn-lg btn-warning" name="">
  </div>
  <!--  -->
</form>
@endforeach
<form id="banner" action="{{route('thaybanner')}}"  method="post" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="id" value="{{$id}}">
  <div class="form-group">
    <div class="custom-file">
      <input name="myfile" type="file" style="display: none;" class="custom-file-input" id="customFilebanner"> 
      <script type="text/javascript">
        function bannerclick(){
          document.getElementById("customFilebanner").click();
        }
        function readURLbn(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('#imgbanner').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            $( "#banner" ).submit();
          }
        }
        $("#customFilebanner").change(function() {
          readURLbn(this);
        });
      </script>
    </div>
  </div>
</form>
<form  action="{{route('thayavatar')}}" id="formbay" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{$id}}">
    <div class="form-group">
      <div class="custom-file" style="">
        <input name="myfile" type="file" style="display: none;" class="custom-file-input" id="customFilelogo">
        <script type="text/javascript">
          function logoclick(){
            document.getElementById("customFilelogo").click();
          }
          function readURL(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function(e) {
                $('#imglogo').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
              $( "#formbay" ).submit();
            }
          }
          $("#customFilelogo").change(function() {
            readURL(this);
          });
        </script>
      </div>
    </div>
</form>
<script src="{{url('public')}}/dist/bootstrap-tagsinput.min.js"></script>
<script src="{{url('public')}}/assets/app.js"></script>
<script src="{{url('public')}}/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
  // $("input").tagsinput('items')
  function saveform() {
    // var formData = new FormData($('form#formstep1')[0]);
    var formData = {
      tenduan : $('input[name=tenduan]').val(),
      urlduan : $('input[name=urlduan]').val(),
      tinhthanh : $('select[name=tinhthanh]').val(),
      diadiem : $('input[name=diadiem]').val(),
      nganhnghe : $('select[name=nganhnghe]').val(),
      tukhoa : $('input[name=tukhoa]').val(),
      diachiemail : $('input[name=diachiemail]').val(),
      sodienthoai : $('input[name=sodienthoai]').val(),
      urlweb : $('input[name=urlweb]').val(),
      facebook : $('input[name=facebook]').val(),
      linkedin : $('input[name=linkedin]').val(),
      twitter : $('input[name=twitter]').val(),
      nextrq : $('input[name=nextrq]').val(),
      idproject : $('input[name=idproject]').val(),
      description : $('textarea[name=description]').val(),
    }
    $("#placecss").fadeIn(0);
    $.ajax({
        url : "{{url('step1sub')}}",
        type : "GET",
        dataType:"text", 
        data : { formData },
        success : function (result){
          $('html,body').animate({scrollTop: $('body').offset().top},'slow');
          if (result == 'loi') {
            $('#thongbaoloitab1').css('display','block');
            $('#thongbaoloitab1').delay(3000).hide(0)
          }else if(result == 'next'){
            $('#hosox').click();
          }
        }
    });
  }
    
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
  function checkslide() {
    var formslide = $('#formslide').val();
    $("#placecss").fadeIn(0);
    $.ajax({
        url : "{{url('checkslide/'.$id)}}",
        type : "GET",
        dataType:"text",
        data : { formslide },
        success : function (result){
            if (result == 'loi') {
              $('.helpslide').css('display','block');
              $('#helpslide').addClass('has-error');
            }else{
              $('.helpslide').css('display','none');
              $('#helpslide').removeClass('has-error');
              $('#slideshare').html(result);
              $('#formslide').val('');
            }
        }
    });
  }
  function checkvideo() {
    var formvideo = $('#formvideo').val();
    $("#placecss").fadeIn(0);
    $.ajax({
        url : "{{url('checkvideo/'.$id)}}",
        type : "GET",
        dataType:"text",
        data : { formvideo },
        success : function (result){
            if (result == 'loi') {
              $('.helpvideo').css('display','block');
              $('#helpvideo').addClass('has-error');
            }else{
              $('.helpvideo').css('display','none');
              $('#helpvideo').removeClass('has-error');
              $('#formvideo').val('');
              $('#videobox').html(result);
            }
        }
    });
  }
</script>