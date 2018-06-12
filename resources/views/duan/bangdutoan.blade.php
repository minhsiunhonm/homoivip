  <h3><b>Bảng dự toán</b></h3>
  <div class="col-md-3"></div>
  @if($status == 1) 
  <div class="col-md-6" style=";margin: 20px 0;">
    <form id="formdutoan" action="{{route('formdutoan')}}" method="post" style="display: none">
      @csrf
      <input type="hidden" name="id" value="{{$id}}">
      <h3>Thêm dự toán</h3>
      <div class="form-group">
        <label>Khoản mục</label>
        <input placeholder="Khoản mục" type="text" class="form-control " name="khoanmuc">
      </div>
      <div class="form-group">
        <label>Số lượng</label>
        <input placeholder="Số lượng" type="number" class="form-control " name="soluong">
      </div>
      <div class="form-group">
        <label>Đơn vị</label>
        <input placeholder="Đơn vị" type="text" class="form-control " name="donvi">
      </div>
      <div class="form-group">
        <label>Số tiền khi thuê ngoài</label>
        <input placeholder="Số tiền khi thuê ngoài" type="text" class="form-control" onkeyup="sotienkhacfun()" id="sotienkhac" name="sotienkhac">
      </div>
      <div class="form-group">
        <label>Số tiền trên nền tảng homoi.vn</label>
        <input placeholder="Số tiền trên nền tảng homoi.vn" type="text" onkeyup="sotiensvfun()" id="sotiensv" class="form-control" name="sotiensv">
      </div>
      <button type="button" onclick="hoanthanhthem()" class="btn btn-success" style="float: right;">Hoàn thành</button>
      <button type="button"  class="btn btn-default" onclick="huydutoan()" style="float: right;margin-right: 10px">Hủy</button>
    </form>
    <script type="text/javascript">
      function hoanthanhthem() {
        $('#sotienkhac').val($('#sotienkhac').val().replace(/ +/g, ""));
        $('#sotiensv').val($('#sotiensv').val().replace(/ +/g, ""));
        $('#formdutoan').submit();
      }
    </script>
    <form id="formsuadutoan" action="{{route('suadutoan')}}" method="post" style="display: none">
      @csrf
      <input type="hidden" name="id" value="{{$id}}">
      <input type="hidden" name="iddutoan" id="iddutoan">
      <h3>Sửa dự toán</h3>
      <div class="form-group">
        <label>Khoản mục</label>
        <input placeholder="Khoản mục" type="text" class="form-control " name="khoanmuc" id="suakhoanmuc">
      </div>
      <div class="form-group">
        <label>Số lượng</label>
        <input placeholder="Số lượng" type="text" class="form-control " name="soluong" id="suasoluong">
      </div>
      <div class="form-group">
        <label>Đơn vị</label>
        <input placeholder="Đơn vị" type="text" class="form-control " name="donvi" id="suadonvi">
      </div>
      <div class="form-group">
        <label>Số tiền khi thuê ngoài</label>
        <input placeholder="Số tiền khi thuê ngoài" type="text" class="form-control" onkeyup="sotienkhacfun()" id="suasotienkhac" name="sotienkhac">
      </div>
      <div class="form-group">
        <label>Số tiền trên nền tảng homoi.vn</label>
        <input placeholder="Số tiền trên nền tảng homoi.vn" type="text" onkeyup="sotiensvfun()" id="suasotiensv" class="form-control" name="sotiensv">
      </div>
      <button type="submit"  class="btn btn-success" style="float: right;">Hoàn thành</button>
      <button type="button"  class="btn btn-default" onclick="huydutoan()" style="float: right;margin-right: 10px">Hủy</button>
    </form>
  </div> 
  @endif
  <div class="col-md-3"></div>
  <table class="table">
    <thead>
      <th>Khoản mục</th>
      <th>Số lượng</th>
      <th>Đơn vị</th>
      <th style="text-align: right;">Số tiền khi thuê ngoài</th>
      <th style="text-align: right;">Số tiền trên nền tảng homoi.vn</th>
      <th><button class="btn btn-default" onclick="themdutoan()" @if($status == 2) disabled="" @endif>Thêm dự toán</button></th>
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
        <td style="text-align: right;"><span id="sotienkhac{{$es->id}}">{{$es->sotienkhac}}</span> đ</td>
        <td style="text-align: right;"><span id="sotiensv{{$es->id}}">{{$es->sotiensv}}</span> đ</td>
        <td>
          <a  @if($status ==1 )   href="{{url('xoadutoan/'.$es->id)}}" @endif>
            <button @if($status != 1) disabled="" @endif class="btn btn-danger"><span class="glyphicon glyphicon glyphicon-trash"></span></button>
          </a>
          <button @if($status != 1) disabled="" @endif class="btn btn-warning" onclick="suadutoan({{$es->id}})"><span class="glyphicon glyphicon-pencil"></span></button>
        </td>
      </tr>
      @endforeach
      <tr style="border-top: 2px #000 solid">
        <td>Tổng</td>
        <td></td>
        <td></td>
        <td style="text-align: right;">{{$tongngoai}} đ</td>
        <td style="text-align: right;">{{$tongsv}} đ</td>
        <td></td>
      </tr>
    </tbody>
  </table>
<script type="text/javascript">
  function sotienkhacfun() {
    ted2 = $('#sotienkhac').val();
    for (var i = 0; i < 10; i++) {
        ted2 = ted2.replace(' ','');
    }
    $('#sotienkhac').val(ted2.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 "));
  }
  function suadutoan(n) {
    $('#formdutoan').css('display','none');
    $('#formsuadutoan').css('display','block');
    khoanmuc = $('#khoanmuc'+n).html();
    soluong = $('#soluong'+n).html();
    donvi = $('#donvi'+n).html();
    sotienkhac = $('#sotienkhac'+n).html();
    sotienkhac = sotienkhac.replace(/ +/g, "");
    sotiensv = $('#sotiensv'+n).html();
    sotiensv = sotiensv.replace(/ +/g, "");
    $('#suakhoanmuc').val(khoanmuc);
    $('#suasoluong').val(soluong);
    $('#suadonvi').val(donvi);
    $('#suasotienkhac').val(sotienkhac);
    $('#suasotiensv').val(sotiensv);
    $('#iddutoan').val(n);
  }
  function sotiensvfun() {
    ted2 = $('#sotiensv').val();
    for (var i = 0; i < 10; i++) {
        ted2 = ted2.replace(' ','');
    }
    $('#sotiensv').val(ted2.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 "));
  }
  function themdutoan() {
    $('#formdutoan').css('display','block');
    $('#formsuadutoan').css('display','none');
  }
  function huydutoan() {
    $('#formsuadutoan').css('display','none');
    $('#formdutoan').css('display','none');
  }
  
</script>