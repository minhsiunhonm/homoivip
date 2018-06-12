<div class="col-md-8 " >
  <form style="background-color: #fff;padding: 20px;" action="{{route('themmodul')}}" id="formbaymodul" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$id}}">
    <input type="hidden" name="giaodien" id="giaodienmodul">
    <textarea name="giatrihtml" style="display: none;"></textarea>
    <div class="form-group">
      <label>Tên modul</label> <span id="demtenmodul" style="float: right;color: #b3b2b2;" ></span>
      <input type="text" id="tenmodul" onkeyup="checkkytu('tenmodul')" value="" name="tenmodul" class="form-control">
      <span style="float: right;color: #b3b2b2;font-size: 11px;">25 ký tự</span>
    </div>
    <div class="form-group">
      <label >Nội dung modul</label><span id="demmotangan" style="float: right;color: #b3b2b2;" ></span> 
      <div class="col-md-12" style="padding: 0;margin-bottom: 10px;">
        <button type="button" class="btn btn-default btn-lg" onclick="tuychinh()" ><span class="glyphicon glyphicon-wrench"></span> Tùy chỉnh</button>
        <button type="button" class="btn btn-default btn-lg" onclick="thememodul()"><span class="glyphicon glyphicon-th"></span> Giao diện có sẵn</button>
      </div>
      <div id="noidungtheme" style="display:none;">
        <button type="button" class="btn btn-success" onclick="chitieukpi()" style="margin-bottom: 20px;">
          <span class="glyphicon glyphicon-flag"></span> Chỉ tiêu Kpi
        </button>
        <button type="button" class="btn btn-success" onclick="videoyoutubex()" style="margin-bottom: 20px;"><span class="glyphicon glyphicon-facetime-video"></span> Video Youtube</button>
        <button type="button" class="btn btn-success" onclick="slidesharex()" style="margin-bottom: 20px;"><span class="glyphicon glyphicon-picture"></span> Slideshare</button>
        <div id="btnchitieu" style="display: none">
          <h3>Chỉ tiêu Kpi</h3>
          <div id="boxthemeval"></div>
          <button class="btn col-md-12"  style="margin-bottom: 20px;border-radius: 0px;" type="button"  onclick="addchitieu()"><span class="glyphicon glyphicon-plus"></span> Thêm chỉ tiêu</button>
        </div>
        <div id="boxvideoyoutube" style="display: none;">
          <h3>Video Youtube</h3>
          <div class="">
            <div class="form-group" style="background-color: #d4d4d4;padding: 10px;float: left;width: 100%">
              <label>Id video</label>
              <input type="text" name="videoyoutubexx" class="form-control col-md-12"  placeholder="Vd: EnGcGSV2-kA">
            </div>
          </div>
        </div>
        <div id="boxslideshare" style="display: none;">
          <h3>Slideshare</h3>
          <div class="">
            <div class="form-group" style="background-color: #d4d4d4;padding: 10px;float: left;width: 100%">
              <label>Link Slideshare</label>
              <input type="text" name="slidesharexx" class="form-control col-md-12" >
            </div>
          </div>
        </div> 
      </div>
      <div id="noidungformmodul">
        <textarea id="editor1" name="noidung" class="form-control"  style="width: 100%; height: 350px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px"></textarea>
      </div>
    </div> 
    <button type="button" onclick="checkmodul()" @if($status == 2 || $status == 3 || $status == 4) disabled="" @endif title="Dự án đã được triển khai."  class="btn btn-primary">Thêm modul</button>
    @if(count($errors)>0)
    <ul class="tb" style="color:red;margin-top: 20px;list-style: none;">
      @foreach ($errors->all() as $error)
      <li class="text-red">
        {{$error}}
      </li>
      @endforeach
    </ul>
    @endif
  </form>
</div>
<div class="col-md-8" style="margin-top: 30px;">
  <div class="row">
    <div style="padding-right: 0px;" class="col-md-3">
      <ul class="slidebarleft">
        @foreach($modul as $mo)
        <li><a>{{$mo->name}}</a></li>
        @endforeach
      </ul>
    </div>
    <div class="col-md-9">
      @foreach($modul as $mo)
      <h2 class="section-title">{{$mo->name}}</h2>
      <div class="custom-content" style="border-bottom: 1px dashed #b1b1b1;margin-bottom: 25px;float: left;padding-bottom: 20px;width: 100%;"><?php echo($mo->content); ?></div>
      @endforeach
    </div>
  </div>
</div>
<div class="col-md-1"></div>
<div class="col-md-3" style="background-color: #fff">
  <h3>Vị trí</h3>
  <table class="table table-hover">
    @foreach($modul as $mo)
    <tr>
      <td style="font-size: 16px;">{{$mo->name}}</td>
      <td style="width: 1px;">
        <a href="{{url('suamodul/'.$mo->id)}}"><button class="btn btn-warning"  @if($status == 2 || $status == 3 || $status == 4) disabled="" @endif title="Dự án đã được triển khai."  ><span class="glyphicon glyphicon-pencil"></span></button></a>
        <a href="{{url('xoamodul/'.$mo->id)}}"><button class="btn btn-danger"  @if($status == 2 || $status == 3 || $status == 4) disabled="" @endif title="Dự án đã được triển khai."  style="margin-top: 5px;"><span class="glyphicon glyphicon glyphicon-trash"></span></button></a>
      </td>
      <td style="width: 1px;text-align: right;">
        <a href="{{url('lenmodul/'.$mo->id)}}"><button class="btn btn-primary"><span class="glyphicon glyphicon-arrow-up"></span></button></a>
        <a href="{{url('xuongmodul/'.$mo->id)}}"><button class="btn btn-primary" style="margin-top: 5px;"><span class="glyphicon glyphicon-arrow-down"></span></button></a>
      </td>
    </tr>
    @endforeach
  </table>
</div>
<script src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
<script> CKEDITOR.replace('editor1'); </script>
<script type="text/javascript">
  demmodul = 0;
  demchitieu = 0;
  
  
  function addchitieu() {
    $('#boxthemeval').html($('#boxthemeval').html()+'<div class="col-md-12 chitieukpi" id="flagkpi'+demchitieu+'"> <div class="form-group"> <label>Chỉ tiêu</label> <input type="text" name="chitieu'+demchitieu+'" class="form-control"  placeholder="Chỉ tiêu"></div> <div class="col-md-6" style="padding-left: 0px;"> <div class="form-group"> <label>Số lượng</label> <input type="text" class="form-control"  placeholder="Số lượng" name="soluong'+demchitieu+'"></div></div> <div class="col-md-6" style="padding: 0px;"> <div class="form-group"> <label>Đơn vị</label> <input type="text" class="form-control" name="donvi'+demchitieu+'" placeholder="Đơn vị"></div></div><input type="button" class="btn btn-danger" onclick="xoakpi('+demchitieu+')"  value="xóa" /></div>');
    demchitieu++;
  } 
  function xoakpi(n) {
    ($('#flagkpi'+n).remove());
    demchitieu = 0;
  }
  function chitieukpi() {
    $('#giaodienmodul').val('chitieukpi');
    $('#btnchitieu').css('display','block');
    $('#boxvideoyoutube').css('display','none');
    $('#boxslideshare').css('display','none');
  }
  function videoyoutubex() { 
    $('#giaodienmodul').val('videoyoutube');
    $('#btnchitieu').css('display','none');
    $('#boxvideoyoutube').css('display','block');
    $('#boxslideshare').css('display','none');
  }
  function slidesharex() {
    $('#giaodienmodul').val('slideshare');
    $('#btnchitieu').css('display','none');
    $('#boxvideoyoutube').css('display','none');
    $('#boxslideshare').css('display','block');
  }
  function tuychinh() {
    if(demmodul == 1){
      $('#noidungformmodul').css('display','block');
      $('#noidungtheme').css('display','none');
      $('#boxthemeval').html('');
      $('#giaodienmodul').val('tuychinh');
      demmodul = 0;
    }
  }
  function thememodul() {
    if(demmodul == 0){
      $('#noidungformmodul').css('display','none');
      $('#noidungtheme').css('display','block');
      $('#giaodienmodul').val('theme');
      demmodul = 1;
    }
  }
  function checkmodul() {
    var data = '';
    var getgiaodien = $('#giaodienmodul').val();
    if (getgiaodien == '' || getgiaodien == 'tuychinh') {
      $('#formbaymodul').submit();
    }else if(getgiaodien == 'chitieukpi'){
      if (demchitieu == 0) {
        $( "textarea[name*='giatrihtml']" ).val('');
      }
      for (var i = 0; i <= demchitieu-1; i++) {
        chitieu = $( "input[name*='chitieu"+i+"']" ).val();
        soluong = $( "input[name*='soluong"+i+"']" ).val();
        donvi = $( "input[name*='donvi"+i+"']" ).val();
        makedate = '<div class="col-md-4 w1" ><img src="{{url("public/image/icon-company-traction.png")}}"><p>'+chitieu+'</p><span>'+soluong+' '+donvi+'</span></div>';
        data = data+makedate;
      }
      $( "textarea[name*='giatrihtml']" ).val(data);
      $('#formbaymodul').submit();
    }else if(getgiaodien == 'videoyoutube'){
      valvideoyoutube =  $( "input[name*='videoyoutubexx']" ).val();
      if (valvideoyoutube != '') {
        makedate = '<iframe width="100%" height="315" src="https://www.youtube.com/embed/'+valvideoyoutube+'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
        $( "textarea[name*='giatrihtml']" ).val(makedate);
        $('#formbaymodul').submit();
      }
    }else if(getgiaodien == 'slideshare'){
      valslideshare =  $( "input[name*='slidesharexx']" ).val();
      if (valslideshare != '') {
        makedate = '<iframe src="//www.slideshare.net/slideshow/embed_code/key/u6WNbsR5worSzC" width="595" height="485" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" style="border:1px solid #CCC; border-width:1px; margin-bottom:5px; max-width: 100%;" allowfullscreen> </iframe>';
        $( "textarea[name*='giatrihtml']" ).val(makedate);
        $('#formbaymodul').submit();
      }
    }else{
      alert(getgiaodien);
    }
  }

  function checkkytu(data) {
      if (data == 'tenmodul') {
          getdt = document.getElementById(data);
          document.getElementById('demtenmodul').innerHTML = getdt.value.length;
          if (getdt.value.length > 25) {
              getdt.style.color = 'red';
          }else{
              getdt.style.color = '#333';
          }
      }
  }
</script>