@include('layouts.header')
<article class="duan" style="height: auto;background-color: #F2F2F0">
    <div class="container" id="companybox">
        <div class="row">
            <h2 style="margin-bottom: 20px;"><b>Tạo dự án.</b></h2>
            <div class="col-md-1"></div>
            <div class="col-md-10 boxaddpro">
                <h3><b>Bước 1: Nhập thông tin cơ bản của dự án.</b></h3>
                <div class="col-md-2"></div>
                <div class="col-md-8" style="margin-top: 30px;padding-bottom: 50px;">
                      <div class="form-group">
                        <label>Tên dự án của bạn</label> <span id="demtenduan" style="float: right;color: #b3b2b2;" ></span>
                        <input type="text" id="tenduan" onkeyup="checkkytu('tenduan')" name="tenduan" class="form-control">
                        <span style="float: right;color: #b3b2b2;font-size: 11px;">230 ký tự</span>
                      </div>
                      <!-- <div class="form-group">
                        <label >Mô tả ngắn về dự án của bạn</label><span id="demmotangan" style="float: right;color: #b3b2b2;" ></span>
                        <textarea type="text" class="form-control" id="motangan"  rows="3" onkeyup="checkkytu('motangan')" ></textarea>
                        <span style="float: right;color: #b3b2b2;font-size: 11px;">500 ký tự</span>
                      </div>
                      <div class="form-group">
                        <label>Địa điểm thực hiện dự án</label><span id="demadress" style="float: right;color: #b3b2b2;" ></span>
                        <input  onkeyup="checkkytu('adress')"  id="adress" type="text" class="form-control">
                        <span style="float: right;color: #b3b2b2;font-size: 11px;">230 ký tự</span>
                      </div> -->
                      <div class="form-group">
                        <label>Số tiền bạn muốn kêu gọi</label><span class="tbred" id="tbmoney"></span>
                        <div class="input-group">
                          <input type="text" class="form-control"  id="money" onkeyup='editmoney(this)' >
                          <div class="input-group-addon">VND</div>
                        </div>
                        <span style="float: right;color: #b3b2b2;font-size: 11px;">Chia hết cho 1,000,000đ</span>
                      </div>
                      <div class="form-group">
                        <div class="custom-file" style="margin-top: 30px;">
                            <form action="{{route('taoduan')}}" id="formbay" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="xttenduan" name="tenduan">
                            <input type="hidden" id="xtmoney" name="money">
                            <!-- <input type="hidden" id="xtmotangan" name="motangan"> -->
                            <!-- <input type="hidden" id="xtadress" name="adress"> -->
                            <!-- <input name="myfile" type="file" class="custom-file-input" id="customFile"> -->
                            </form>
                            <!-- <label class="custom-file-label" for="customFile">Logo dự án</label> -->
                        </div>
                      </div>
                      <button type="button" onclick="kiemtra()" class="btn btn-primary">Lưu</button>
                    @if ( session()->has('message2') )
                        <p style="color: red;margin-top: 20px;">
                            {{ session()->get('message2') }}
                        </p>
                    @endif
                    @if(count($errors)>0)
                    <ul class="tb" style="color:red;margin-top: 20px;list-style: none;">
                        @foreach ($errors->all() as $error)
                            <li class="text-red">
                            {{$error}}
                            </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
                <div class="col-md-2"></div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</article>
<footer>
    <div class="container">
        <a href="#">Made by: Dương Văn Minh</a>
    </div>
</footer>
</body>
<script type="text/javascript">
    function kiemtra() {
        tenduan = document.getElementById('tenduan').value;
        money = document.getElementById('money').value;
        for (var i = 0; i < 10; i++) {
            money = money.replace(' ','');
        }
        if (tenduan.length < 231  && tenduan.length != ''  && money.length != '' ) {
            document.getElementById('xttenduan').value= tenduan;
            // document.getElementById('xtmotangan').value= motangan;
            // document.getElementById('xtadress').value= adress;
            document.getElementById('xtmoney').value = money;
            document.getElementById('formbay').submit();

        }
    }
    function checkkytu(data) {
        if (data == 'tenduan') {
            getdt = document.getElementById(data);
            document.getElementById('demtenduan').innerHTML = getdt.value.length;
            if (getdt.value.length > 230) {
                getdt.style.color = 'red';
            }else{
                getdt.style.color = '#333';
            }
        }
        if(data == 'motangan') {
            getdt = document.getElementById(data);
            document.getElementById('demmotangan').innerHTML = getdt.value.length;
            if (getdt.value.length > 500) {
                getdt.style.color = 'red';
            }else{
                getdt.style.color = '#333';
            }
        }
        if(data == 'adress') {
            getdt = document.getElementById(data);
            document.getElementById('demadress').innerHTML = getdt.value.length;
            if (getdt.value.length > 230) {
                getdt.style.color = 'red';
            }else{
                getdt.style.color = '#333';
            }
        }
    }
    function editmoney(el) {
        ted = el.value;
        for (var i = 0; i < 10; i++) {
            ted = ted.replace(' ','');
        }
        el.value = ted.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ");
    }
</script>
</html>