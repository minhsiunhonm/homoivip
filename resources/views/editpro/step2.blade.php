<div id="hoso"></div>
<h3 id="w8tit">Xây dựng chiến dịch</h3>
<div class="alert alert-danger alert-dismissible" id="thongbaoloitab1" style="display: none;">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon fa fa-ban"></i> Thông báo!</h4>
  Đã sảy ra lỗi, vui lòng xem lại dữ liệu đã nhập!
</div>
<form class="form-horizontal col-md-12" action="{{route('step2sub')}}" id="formstep2" method="post" >
<hr>
  @csrf
  <p><b>Tổng quan chiến dịch</b></p>
  <span class="help-span">
    Viết một đoạn giới thiệu về dự án của bạn
  </span>
  <div id="noidungformmodul">
    @if(count($tongquan) != 0)
    @foreach($tongquan as $tongq)
    <textarea id="editor1" name="noidung" class="form-control"  style="width: 100%; height: 350px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px">{{$tongq->content}}</textarea>
    @endforeach
    @else
    <textarea id="editor1" name="noidung" class="form-control"  style="width: 100%; height: 350px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px"></textarea>
    @endif
  </div>
  <hr>
  <h3 id="w8tit">Thành viên</h3>
  <span class="help-span">
    Quản lý thành viên trong dự án của bạn
  </span>
  <hr>
  <p><b>Sinh viên</b></p>
  <div class="row" id="tbodysv">
    @foreach($teamsv as $team)
    <div class="col-md-2 w9" >
      <a href="{{url($team->users['linkprofile'])}}" target="blank">
        <img src="{{url('public/avatar/'.$team->users['avatar'])}}" >
        <p>{{$team->users['name']}}</p>
      </a>
      @if($team->agree == 0)
      <button class="btn btn-default" disabled="" type="button">Đã mời</button>
      <a onclick="huymoi('{{$team->id_user}}','{{$id}}')" class='w9x3'>Hủy mời</a>
      @endif
    </div>
    @endforeach
    @if(count($teamsv) != 0)
    <div class="col-md-2 w9x2" >
      <a href="#">Xem thêm</a>
    </div>
    @else
    <span class="help-span col-md-12">
      Chưa có thành viên nào
    </span>
    @endif
  </div>
  <script type="text/javascript">
    function huymoi(idu,da) {
      $("#placecss").fadeIn(0);
      $.ajax({
          url : "{{url('huymoi')}}",
          type : "GET",
          dataType:"text", 
          data : { idu,da },
          success : function (result){
            if (result == 'loithem') {
                loithem('sv');
            }else{
                $('#tbodysv').html(result);
            }
          }
      });
    }
  </script>
  <div class="form-group">
    <label class="col-sm-3 control-label">Tìm kiếm sinh viên</label>
    <div class="col-sm-6">
      <input type="email" id="tensinhvient2" class="form-control winput" placeholder="Tên sinh viên hoặc số điện thoại">
    </div>
    <button class="btn btn-danger col-md-2 winput nuttimkiemt2 "  onclick="timkiemsinhvien()" type="button">Tìm kiếm</button>
  </div>
  <div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10 w10" id="kqsinhvien">
    </div>
  </div>
  <hr>
  <p><b>Ban cố vấn</b></p>
  <div class="row" id="tbodygt">
    @foreach($teamgt as $teamg)
    <div class="col-md-2 w9" >
      <a href="{{url($teamg->users['linkprofile'])}}" target="blank">
        <img src="{{url('public/avatar/'.$teamg->users['avatar'])}}" >
        <p>{{$teamg->users['name']}}</p>
      </a>
      @if($teamg->agree == 0)
      <button class="btn btn-default" disabled="" type="button">Đã mời</button>
      <a onclick="huymoigt('{{$teamg->id_user}}','{{$id}}')" class='w9x3'>Hủy mời</a>
      @endif
    </div>
    @endforeach
    @if(count($teamgt) != 0)
    <div class="col-md-2 w9x2" >
      <a href="#">Xem thêm</a>
    </div>
    @else
    <span class="help-span col-md-12">
      Chưa có thành viên nào
    </span>
    @endif
  </div>
  <script type="text/javascript">
    function huymoigt(idu,da) {
      $("#placecss").fadeIn(0);
      $.ajax({
          url : "{{url('huymoigt')}}",
          type : "GET",
          dataType:"text", 
          data : { idu,da },
          success : function (result){
            if (result == 'loithem') {
                loithem('sv');
            }else{
                $('#tbodygt').html(result);
            }
          }
      });
    }
  </script>
  <div class="form-group">
    <label class="col-sm-3 control-label">Tìm kiếm ban cố vấn</label>
    <div class="col-sm-6">
      <input type="email" id="tengate2" class="form-control winput" placeholder="Tên Gatekeeper hoặc số điện thoại">
    </div>
    <button  class="btn btn-danger col-md-2 winput  nuttimkiemt2" onclick="timkiemgatekeeper()" type="button">Tìm kiếm</button> 
  </div>
  <div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10 w10" id="kqgatekeeper">
    </div>
  </div>
  <hr>
  <p><b>Gatekeeper</b></p>
  <span class="help-span">
    Gatekeeper là giảng viên, là người tạo ra dự án
  </span>
  <div class="col-md-12 w10">
    <div style="position: relative;background-color: #fff">
      @foreach($project as $pr)
        <img src="{{url('public/avatar/'.$pr->users['avatar'])}}" style="border-radius: 100%;width: 120px;height: 120px;">
        <p><b>{{$pr->users['name']}}</b></p>
        <?php $demposi=0; ?>
        @foreach($position as $posi)
          @if($posi->code == 'cv')
          <p>Làm <b>{{$posi->name}}</b> tại <b>{{$posi->company}}</b></p>
          @endif
        @endforeach
        @foreach($position as $posi)
          @if($posi->code == 'th')
          <p>Từng học tại: <b>{{$posi->name}}</b></p>
          @endif
        @endforeach
        @foreach($position as $posi)
          @if($posi->code == 'kn')
          <?php $demposi++; ?>
          @endif
        @endforeach
      @endforeach
      <?php $demp2=0; ?>
      @foreach($position as $p)
        @if($p->code == 'kn')
          <?php if ($demp2 == 0) {
            echo "Kỹ năng: ";
            }
            $demp2++;
          ?>
          <b>{{$p->name}}</b>@if($demp2 < $demposi),@else.@endif
        @endif
      @endforeach
      <p style="padding-top: 5px;">
        <a style="text-decoration: underline" href="{{url($pr->users['linkprofile'].'/thong-tin-ca-nhan')}}"> Chỉnh sửa</a>
      </p>
    </div>
  </div>
  <hr>
  <h3 id="w8tit">Tiến độ dự án đề ra</h3>
  <div class="col-md-11" id="tabletiendoduan">
    <div id="khungtimeline">
      <?php 
      $demprog = count($progress);
      if($demprog != 0 ){
        $vach = array();
        foreach ($progress as $key) {
          $vach[] = date('d-m-Y', strtotime($key->date));
        }
        $date1=date_create($vach[0]);
        $date2=date_create($vach[$demprog-1]);
        $diff=date_diff($date1,$date2);
        $tongpc = $diff->format("%R%a");
        for ($i=0; $i < $demprog ; $i++) { 
          if ($i == 0) {
            echo '<button type="button" id="vach'.$i.'" class="buttimeline" data-toggle="tooltip" data-placement="left" title="'.$vach[$i].'" style="left: 0%"></button>';
          }elseif($demprog > 1){
            if ($i == ($demprog-1)) {
              echo '<button type="button" id="vach'.$i.'" class="buttimeline" data-toggle="tooltip" data-placement="left" title="'.$vach[$i].'" style="left: 99%"></button>';
            }else{
              $vach1=date_create($vach[0]);
              $vach2=date_create($vach[$i]);
              $diffvach =date_diff($vach1,$vach2);
              $tongvach = $diffvach->format("%R%a");
              $timpc = $tongvach/($tongpc/100);
              $timpc = $timpc - ($timpc/100);
              echo '<button type="button" id="vach'.$i.'" class="buttimeline" data-toggle="tooltip" data-placement="left" title="'.$vach[$i].'" style="left: '.$timpc.'%"></button>';
            }
          }
        }
      }
      ?>
    </div>
    <div class="col-md-12">
      @if($status == 2 || $status == 3 || $status == 4) 
      @else
      <div id="formtiendo" style="display: block;">
        <div class="form-group">
          <h3 id="tiletiendo">Thêm tiến độ</h3>
          <label>Ngày thực hiện</label>
          <input type="date" class="form-control " id="datefrom">
        </div>
        <div class="form-group">
          <label>Mục tiêu đề ra</label>
          <textarea class="form-control" placeholder="Mục tiêu đề ra" id="muctieuform"></textarea>
          <div class="col-md-12" style="text-align: right;padding: 0;margin-top: 10px;">
            <button type="button"  class="btn btn-success" onclick="subtiendo()">Thêm</button>
            <button type="button"  class="btn btn-default" onclick="huytiendo()">Hủy</button>
          </div>
        </div>
      </div>

      <div class="col-sm-12 w13">
        <div class="form-group">
          <div class="col-sm-6">
            <label class="col-sm-3 control-label" style="color: #999;padding: 7px 0;" id="giatrilabel">Ngày thực hiện</label>
            <div class="col-sm-9">
              <input type="text" class="form-control winput" placeholder="Nhập giá trị">
            </div>
          </div>
          <div class="col-md-2">
            <button style="padding-left: 0;padding-right: 0" onclick="themkpi()" class="btn btn-danger col-md-12 winput" id="btnkpi" type="button" disabled="">Thêm KPI</button>
          </div>
        </div>
      </div>
      @endif
    </div>
    <table class="table ">
      <thead>
        <th style="width: 100px;border-bottom: 2px solid #b5b5b5;">Ngày</th>
        <th style="width: 500px;border-bottom: 2px solid #b5b5b5;">Mục tiêu đề ra</th>
        <th style="text-align: right;border-bottom: 2px solid #b5b5b5;"><button class="btn btn-default" type="button" @if($status == 2 || $status == 3 || $status == 4) disabled="" @endif title="Dự án đã được triển khai." onclick="themtiendo()">Thêm tiến độ dự án</button></th>
      </thead>
      <tbody>
        <?php $demtable = 0; ?>
        @foreach($progress as $prg)
        <tr id="bang{{$demtable}}" class="trformxoatd" onmouseover="bang({{$demtable}})" onmouseout="tru({{$demtable}})">
          <td id="date{{$prg->id}}"><?= date('d-m-Y', strtotime($prg->date)); ?></td>
          <td style="white-space: pre-line;" id="content{{$prg->id}}">{{$prg->content}}
          </td>
          <td style="text-align: right;">
            <button type="button" onclick="formxoatiendo('{{$prg->id}}','{{$demtable}}')" class=" btn" @if($status == 2 || $status == 3 || $status == 4) disabled=""  title="Dự án đã được triển khai." @endif><span class="glyphicon glyphicon-trash"></span></button>
            <button type="button" class="btn-warning btn" @if($status == 2 || $status == 3 || $status == 4) disabled=""  title="Dự án đã được triển khai." @endif><span class="glyphicon glyphicon-pencil"></span></button>
          </td>
        </tr>
        <tr style="background-color: #ccc;text-align: center;display: none;" class="hienthiformxoatd" id="formxoatiendo{{$prg->id}}">
          <td colspan="3" >
            <p>Xác nhận xóa?</p>
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="quaylaiformxtd('{{$prg->id}}','{{$demtable}}')">Quay lại</button>
            <button type="button" class="btn btn-danger" onclick="xoatiendo('{{$prg->id}}')">Đồng ý xóa</button>
          </td>
        </tr>
        <?php $demtable++; ?>
        @endforeach
      </tbody>
    </table>
  </div>
  <hr>
  <h3 id="w8tit">Bảng dự toán</h3>
  <div class="col-md-11">
    <table class="table">
      <thead>
        <th>Khoản mục</th>
        <th>Số lượng</th>
        <th>Đơn vị</th>
        <!-- <th style="text-align: right;">Số tiền khi thuê ngoài</th> -->
        <th style="text-align: right;">Số tiền</th>
        <th></th>
      </thead>
      <tbody>
        <?php $tongngoai = 0; $tongsv= 0; ?>
        @foreach($estimate as $es)
        <?php 
        $tongsv = $tongsv+$es->sotiensv;
        $tongngoai = $tongngoai+$es->sotienkhac;
        ?>
        <tr>
          <td><span id="khoanmuc{{$es->id}}">{{$es->name}}</span></td>
          <td><span id="soluong{{$es->id}}">{{$es->soluong}}</span></td>
          <td><span id="donvi{{$es->id}}">{{$es->donvi}}</span></td>
          <!-- <td style="text-align: right;"><span id="sotienkhac{{$es->id}}">{{$es->sotienkhac}}</span> đ</td> -->
          <td style="text-align: right;"><span id="sotiensv{{$es->id}}">{{$es->sotiensv}}</span> đ</td>
          <td style="text-align: right;">
            <a  @if($status ==1 )   href="{{url('xoadutoan/'.$es->id)}}" @endif>
              <button type="button" @if($status != 1) disabled="" @endif class="btn "><span class="glyphicon glyphicon glyphicon-trash"></span></button>
            </a>
            <button  type="button" @if($status != 1) disabled="" @endif class="btn btn-warning" onclick="suadutoan({{$es->id}})"><span class="glyphicon glyphicon-pencil"></span></button>
          </td>
        </tr>
        @endforeach
        <tr style="border-top: 2px #b5b5b5 solid">
          <td>Tổng</td>
          <td></td>
          <td></td>
          <td style="text-align: right;">{{$tongsv}} đ</td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
  <hr>
  <h3 id="w8tit">KPI's</h3>
  <div class="col-sm-12">
    <div class="col-md-12 kpihienthi" style="padding: 0px">
      @foreach($kpi as $kk)
      <div class="col-md-2 w12 hoverdele{{$kk->id}}">
        @if($kk->code == 2)
        <img src="{{url('public/fileweb/icon/006-businessman-1.png')}}">
        @elseif($kk->code == 3)
        <img src="{{url('public/fileweb/icon/015-business-man.png')}}">
        @elseif($kk->code == 4)
        <img src="{{url('public/fileweb/icon/006-presentation.png')}}">
        @elseif($kk->code == 5)
        <img src="{{url('public/fileweb/icon/002-tools.png')}}">
        @endif
        <p style="margin-bottom: 0;font-weight: 500">{{$kk->giatri}}</p>
        @if($kk->code == 2)
        <p>Người tham gia</p>
        @elseif($kk->code == 3)
        <p>Sinh viên</p>
        @elseif($kk->code == 4)
        <p>Buổi đào tạo</p>
        @elseif($kk->code == 5)
        <p>{{$kk->tengoi}}</p>
        @endif
        <button class="btn btn-danger btn-xs" onmouseover="$('.hoverdele{{$kk->id}}').css('background-color','#ccc');" onmouseout="$('.hoverdele{{$kk->id}}').css('background-color','#fff');" type="button" onclick="delekpi('{{$kk->id}}')"><span class="glyphicon glyphicon-trash"></span></button>
      </div>
      @endforeach
    </div>
    @if(count($kpi) < 6)
    <div class="col-sm-12 w13">
      <div class="form-group">
        <div class="col-sm-4">
          <select class="form-control select2" style="width: 100%;border-radius: 0px" id="selectpki" onchange="chonkpi()">
           <option value="1" disabled="" selected="">Loại KPI</option>
           <option value="2">Người dùng</option>
           <option value="3">Sinh viên</option>
           <option value="4">Số buổi đào tạo</option>
           <option value="5">Khác</option>
         </select>
       </div>
      <div class="col-sm-6">
        <label class="col-sm-3 control-label" style="color: #999;padding: 7px 0;" id="giatrilabel">Giá trị</label>
        <div class="col-sm-9">
          <input type="text" class="form-control winput" id="giatrikpi" placeholder="Nhập giá trị">
        </div>
        <div style="margin-top: 5px;padding: 0px;display: none;" class="col-sm-12" id="kpikhac">
          <label class="col-sm-3 control-label" style="color: #999;padding: 7px 0;">Tên gọi</label>
          <div class="col-sm-9">
            <input type="text" class="form-control winput" id="tengoikpi" placeholder="Tên gọi Kpi">
          </div>
        </div>
      </div>
      <div class="col-md-2">
        <button style="padding-left: 0;padding-right: 0" onclick="themkpi()" class="btn btn-danger col-md-12 winput" id="btnkpi" type="button" disabled="">Thêm KPI</button>
      </div>
    </div>
    @endif
  </div>
  <input type="hidden" name="nextrq" id="nextrq">
  <input type="hidden" name="idproject" id="idproject" value="{{$id}}">
  <div class="col-md-12" style="margin-bottom: 50px;padding-top: 20px;text-align: right;float: right;width: 100%;">
    <input style="border-radius: 0px;" type="button" onclick="saveform()" value="Lưu" class="btn btn-lg btn-primary" name="">
    <input style="border-radius: 0px;" type="button" onclick="($('#nextrq').val('1')); saveform()" value="Lưu và tiếp tục" class="btn btn-lg btn-warning" name="">
  </div>
  <!--  -->
</form>
<br>
<div id="alerttb">
</div>
<script src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
<script> CKEDITOR.replace('editor1'); </script>
<script src="{{url('public')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
  function xoatiendo(n) {
    id='{{$id}}';
    $("#placecss").fadeIn(0);
    $.ajax({
        url : "{{url('xoatiendoduan')}}",
        type : "GET",
        dataType:"text", 
        data : { n,id },
        success : function (result){
          $('#tabletiendoduan').html(result);
        }
    });
  }
  function formxoatiendo(n,m) {
    $('.hienthiformxoatd').each(function() {
      $( this ).hide();
    });
    $('.trformxoatd').each(function() {
      $( this ).show();
    });
    $('#formxoatiendo'+n).show();
    $('#bang'+m).hide();
  }
  function quaylaiformxtd(n,m) {
    $('#formxoatiendo'+n).hide();
    $('#bang'+m).show();
  }
  function themkpi() {
    namekpi = $('#selectpki').val();
    giatrikpi = $('#giatrikpi').val();
    tengoikpi = $('#tengoikpi').val();
    id='{{$id}}';
    $("#placecss").fadeIn(0);
    $.ajax({
        url : "{{url('themkpi')}}",
        type : "GET",
        dataType:"text", 
        data : { namekpi,giatrikpi,tengoikpi,id },
        success : function (result){
          $('.kpihienthi').html(result);
        }
    });
  }
  function delekpi(id) {
    idpr='{{$id}}';
    $("#placecss").fadeIn(0);
    $.ajax({
        url : "{{url('delekpi')}}",
        type : "GET",
        dataType:"text", 
        data : { id,idpr },
        success : function (result){
          $('.kpihienthi').html(result);
        }
    });
  }
  function chonkpi() {
    var kpi = $('#selectpki').val();
    if (kpi == 1) {
      $('#btnkpi').prop('disabled', true);
      $('#giatrikpi').prop('placeholder', 'Nhập giá trị');
      $('#giatrilabel').html('Giá trị');
    }else{
      $('#btnkpi').prop('disabled', false);
    }
    if (kpi == 5) {
      $('#kpikhac').css('display', 'block');
    }else{
      $('#kpikhac').css('display', 'none');
    }
    if (kpi == 2) {
      $('#giatrilabel').html('Số người');
      $('#giatrikpi').prop('placeholder', 'Số người tham gia');
    }else if (kpi == 3) {
      $('#giatrilabel').html('Số sinh viên');
      $('#giatrikpi').prop('placeholder', 'Số sinh viên tham gia');
    }else if (kpi == 4) {
      $('#giatrilabel').html('Số buổi');
      $('#giatrikpi').prop('placeholder', 'Số buổi đào tạo');
    }else if (kpi == 5) {
      $('#giatrilabel').html('Giá trị');
      $('#giatrikpi').prop('placeholder', 'Số lượng');
    }
  }
  var demtiendo = 'them';
  var demtiendoof = 0;
  function saveform() {
    var formData = {
      noidung : CKEDITOR.instances['editor1'].getData(),
      nextrq : $('input[name=nextrq]').val(),
      idproject : $('input[name=idproject]').val(),
    }
    $("#placecss").fadeIn(0);
    $.ajax({
        url : "{{url('step2sub')}}",
        type : "GET",
        dataType:"text", 
        data : { formData },
        success : function (result){
          $('html,body').animate({scrollTop: $('body').offset().top},'slow');
          if (result == 'loi') {
            $('#thongbaoloitab1').css('display','block');
            $('#thongbaoloitab1').delay(3000).hide(0)
          }else if(result == 'next'){
            $('#chitietx').click();
          }
        }
    });
  } 
  var input = document.getElementById("tensinhvient2");
  input.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
      timkiemsinhvien();
    }
  });

  var input2 = document.getElementById("tengate2");
  input2.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
      timkiemgatekeeper();
    }
  });
  function themgate(id) {
      var idproject = '{{$id}}';
      $.ajax({
          url : "{{url('moigate')}}",
          type : "GET",
          dataType:"text",
          data : { id,idproject },
          success : function (result){
              if (result == 'loithem') {
                  loithem('sv');
              }else{
                  $('#tbodygt').html(result);
              }
          }
      });
  }
  function themthanhvien(id) {
    var idproject = '{{$id}}';
    $("#placecss").fadeIn(0);
    $.ajax({
        url : "{{url('moithanhvien')}}",
        type : "GET",
        dataType:"text",
        data : { id,idproject },
        success : function (result){
            if (result == 'loithem') {
                loithem('sv');
            }else{
                $('#tbodysv').html(result);
            }
        }
    });
  }
  function loithem(id) {
      if (id == 'sv') {
          var gettb = $('#alerttb').html();
          var alerttb = gettb+'<div id="idanjs" class="idanjs alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> Lỗi!</h4>Tài khoản này đang bận.</div>';
          $('#alerttb').html(alerttb);
          setTimeout(function() {
              $('.idanjs').fadeOut('fast');
          }, 2000);
      }
  }
  function timkiemgatekeeper() {
    var getdata = $('#tengate2').val();
    $("#placecss").fadeIn(0);
    $.ajax({
        url : "{{url('getRequestgate')}}",
        type : "GET",
        dataType:"text",
        data : { getdata },
        success : function (result){
          if (result == 'khongcogi') {
            $('#kqgatekeeper').html('<div class="khongcogi">Không có kết quả.</div>');
          }else{
            $('#kqgatekeeper').html(result);
          }
        }
    });
  }
  function timkiemsinhvien() {
    var getdata = $('#tensinhvient2').val();
    $("#placecss").fadeIn(0);
    $.ajax({
        url : "{{url('getRequest')}}",
        type : "GET",
        dataType:"text",
        data : { getdata },
        success : function (result){
          if (result == 'khongcogi') {
            $('#kqsinhvien').html('<div class="khongcogi">Không có kết quả.</div>');
          }else{
            $('#kqsinhvien').html(result);
          }
        }
    });
  }
  function bang(n) {
    $('#vach'+n).tooltip('show');
    $('#bang'+n).css('background-color','#d6d6d6');
  }
  function tru(n) {
    $('#vach'+n).tooltip('hide');
    $('#bang'+n).css('background-color','#fff');
  }
  function huytiendo() {
    $('#formtiendo').css('display','none');
    demtiendoof = 0;
  }
  function subtiendo() {
    $('#themdate').val($('#datefrom').val());
    $('#themmuctieu').val($('#muctieuform').val());
    $('#formthem').submit();
  }
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>