<h3><b>Tiến độ dự án đề ra.</b></h3>
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
<div class="row">
  <div class="container">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      @if($status == 2 || $status == 3 || $status == 4) 
      @else
      <form id="formtiendo" style="display: none;">
        <h3 id="tiletiendo">Thêm tiến độ</h3>
        <div class="form-group">
          <label>Ngày thực hiện</label>
          <input type="date" class="form-control " id="datefrom">
        </div>
        <div class="form-group">
          <label>Mục tiêu đề ra</label>
          <textarea class="form-control" placeholder="Mục tiêu đề ra" id="muctieuform"></textarea>
        </div>
        <button type="button"  class="btn btn-success" onclick="subtiendo()">Thêm</button>
        <button type="button"  class="btn btn-default" onclick="huytiendo()">Hủy</button>
      </form>
      @endif
    </div>
    <div class="col-md-3"></div>
    <table class="table table-striped col-md-12">
      <thead style="border-bottom: solid 1px #b1b1b1;">
        <th style="width: 100px;border-bottom: 2px solid #b5b5b5;">Ngày</th>
        <th style="width: 500px;border-bottom: 2px solid #b5b5b5;">Mục tiêu đề ra</th>
        <th style="text-align: right;border-bottom: 2px solid #b5b5b5;"><button class="btn btn-default" @if($status == 2 || $status == 3 || $status == 4) disabled="" @endif title="Dự án đã được triển khai." onclick="themtiendo()">Thêm tiến độ dự án</button></th>
      </thead>
      <tbody>
        <?php $demtable = 0; ?>
        @foreach($progress as $prg)
        <tr id="bang{{$demtable}}" onmouseover="bang({{$demtable}})" onmouseout="tru({{$demtable}})">
          <td id="date{{$prg->id}}"><?= date('d-m-Y', strtotime($prg->date)); ?></td>
          <td style="white-space: pre-line;" id="content{{$prg->id}}">{{$prg->content}}
          </td>
          <td style="text-align: right;">
            <button class="btn-danger btn" data-toggle="modal" data-target=".maoda2{{$prg->id}}" @if($status == 2 || $status == 3 || $status == 4) disabled=""  title="Dự án đã được triển khai." @endif>Xóa</button>
            <button  onclick="suatiendo('{{$prg->id}}')" class="btn-warning btn" data-toggle="modal" data-target=".maoda" @if($status == 2 || $status == 3 || $status == 4) disabled=""  title="Dự án đã được triển khai." @endif>Sửa</button>
          </td>
        </tr>
        <div id="maoda2" class="modal fade maoda2{{$prg->id}}" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Thông báo</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <h2>Xóa ngày: {{$prg->date}}</h2>
                  </div> 
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Quay lại</button>
                <a href="{{url('xoatiendoduan/'.$prg->id)}}">
                  <button type="button" class="btn btn-danger">Đồng ý xóa</button>
                </a>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <?php $demtable++; ?>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<div id="maoda" class="modal fade maoda" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Sửa ngày: <span class="suangay"></span></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <form method="post" action="{{ route('suatiendo') }}">
              @csrf
              <input type="hidden" name="id" id="idinput" value="">
              <div class="form-group">
                <label>Ngày</label>
                <input type="date" id="ngayinput" value="" name="date" class="form-control">
              </div>
              <div class="form-group">
                <label>Mục tiêu đề ra</label>
                <textarea class="form-control" name="content" placeholder="Mục tiêu đề ra" id="muctieuinput"></textarea>
              </div>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
          </div> 
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<form action="{{route('themtiendo')}}" id="formthem" method="post">
  @csrf
  <input type="hidden" name="id" value="{{$id}}">
  <input type="hidden" name="date" id="themdate">
  <input type="hidden" name="muctieu" id="themmuctieu">
</form>
<script type="text/javascript">
  var demtiendo = 'them';
  var demtiendoof = 0;
  
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
  function themtiendo() {
    demtiendo = 'them';
    $('#tiletiendo').html("Thêm tiến độ");
    if (demtiendoof == 0) {
      $('#formtiendo').css('display','block');
      demtiendoof =1;
    }
  }
  function suatiendo(n) {
    var now = new Date($('#date'+n).html());
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#ngayinput').val(today);
    $('.suangay').html($('#date'+n).html());
    $('#muctieuinput').val($('#content'+n).html());
    $('#idinput').val(n);
  }
</script>
