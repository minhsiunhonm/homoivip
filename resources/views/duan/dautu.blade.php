<form action="{{route('suamoney')}}" method="post" id="formsuamoney">
  @csrf
  <input type="hidden" name="money" id="nhanmoney">
  <input type="hidden" name="id" value="{{$id}}">
  <input type="hidden" name="minmoney" id="nhanminmoney">
</form>
<div class="col-md-6">
  <div class="form-group">
    <label>Số tiền bạn muốn kêu gọi</label><span class="tbred" id="tbmoney"></span>
    <div class="input-group">
      <input type="text" value="{{$money}}" class="form-control"  id="money" onkeyup='editmoney(money)' >
      <div class="input-group-addon">VND</div>
    </div>
    <span style="float: right;color: #b3b2b2;font-size: 11px;">Chia hết cho 1,000,000đ</span>
  </div>
  <div class="form-group">
    <label>Giới hạn số tiền đầu tư</label><span class="tbred" id="tbmoney"></span>
    <div class="input-group">
      <input type="text"  value="{{$min_money}}" class="form-control"  id="minmoney" onkeyup='editmoney(minmoney)' >
      <div class="input-group-addon">VND</div>
    </div>
    <span style="float: right;color: #b3b2b2;font-size: 11px;">Chia hết cho 1,000,000đ</span>
  </div>
  <input type="button" onclick="ckecknum()" value="Lưu" class="btn btn-primary" @if($status != '1') disabled="" @endif >
</div>
<div class="col-md-6">
  <h3>Nhà đầu tư</h3>
  <table class="table">
    <thead>
      <th>Nhà đầu tư</th>
      <th>Số tiền</th>
      <th>Trạng thái</th>
    </thead>
    <tbody>
      @if(count($invest) != 0)
      @foreach($invest as $in)
      <tr>
        <td>{{$in->users['name']}}</td>
        <td>{{$in->money}}</td>
        <td>@if($in->status == 1) Đợi nhà đầu tư chuyển tiền @elseif($in->status == 2) Đã nhận được tiền của nhà đầu tư @endif</td>
      </tr>
      @endforeach
      @endif
    </tbody>
  </table>
  @if(count($invest) == 0)
  <h4>Chưa có nhà đầu tư nào</h4>
  @endif
</div>
<script type="text/javascript">
    editmoney(money);
    editmoney(minmoney);
    function editmoney(el) {
        ted = el.value;
        for (var i = 0; i < 10; i++) {
            ted = ted.replace(' ','');
        }
        el.value = ted.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ");
    }
    function ckecknum() {
      var money = $('#money').val();
      var minmoney = $('#minmoney').val();
      for (var i = 0; i < 10; i++) {
        money = money.replace(' ','');
        minmoney = minmoney.replace(' ','');
      }
      if (money > 100000000 || minmoney > 100000000 || money < 1000000 || minmoney < 1000000){
        alert('Số tiền phải lớn hơn 1,000,000đ và nhỏ hơn 100,000,000đ.');
      }else{
        $('#nhanmoney').val(money);
        $('#nhanminmoney').val(minmoney);
        $('#formsuamoney').submit();
      }
    }
</script>