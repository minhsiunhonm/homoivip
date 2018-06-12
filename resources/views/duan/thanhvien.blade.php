    <h3>Sinh viên</h3>
    <div style="display: none;width: 100%;height: auto;background-color: #fff" id="formthemthanhvien">
        <div class="col-md-6" style="padding-top: 20px;">
            <div class="input-group">
              <input type="text" id="noidung" class="form-control" placeholder="Tìm kiếm thành viên">
              <span class="input-group-addon glyphicon glyphicon-search" style="top: 0px;cursor: pointer;" id="result" onclick="clicknut()"></span>
            </div>
            <div id="ras" style="margin: 20px 0"></div>
        </div>
        <!-- <div class="col-md-6" style="padding-top: 20px;">
            <b>Thành viên đã kết nối</b>
        </div> -->
    </div>
    <table class="table">
        <thead>
            <th>Tên sinh viên</th>
            <th>Chỉ số đánh giá</th>
            <th>Ngày tham gia dự án</th>
            <th></th>
            <th ><input type="button" onclick="clickthemthanhvien()"  value="Thêm sinh viên" class="btn btn-primary"></th>
        </thead>
        <tbody id="tbodysv">
            @foreach($team as $t)
            <tr>
                <td>
                    @foreach($team as $teams)
                        @if($t->id_user == $teams->users['id'])
                            {{$teams->users['name']}}
                        @endif
                    @endforeach
                </td>
                <td></td>
                <td>{{date('d-m-Y', strtotime($t->updated_at))}}</td>
                <td>@if($t->agree == 0) Đã gửi lời mời @elseif($t->agree == 1) Đã tham gia @elseif($t->agree == 3) Từ chối @endif</td>
                <td>@if($t->agree == 0) <a href="{{url('huymoi/'.$t->id_user.'/'.$id)}}"><button class="btn btn-danger">Hủy mời</button></a> @endif</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h3>Ban cố vấn</h3>
    <div style="display: none;width: 100%;height: auto;background-color: #fff" id="formthemgate">
        <div class="col-md-6" style="padding-top: 20px;">
            <div class="input-group">
              <input type="text" id="noidunggate" class="form-control" placeholder="Tìm kiếm Gatekeeper">
              <span class="input-group-addon glyphicon glyphicon-search" style="top: 0px;cursor: pointer;" id="resultgate" onclick="clicknutgate()"></span>
            </div>
            <div id="rasgate" style="margin: 20px 0"></div>
        </div>
    </div>
    <table class="table">
        <thead>
            <th>Tên thành viên</th>
            <th>Chỉ số đánh giá</th>
            <th>Ngày tham gia dự án</th>
            <th></th>
            <th ><input type="button" onclick="clickthemgate()" @if($status != 1) disabled="" @endif value="Thêm cố vấn" class="btn btn-primary"></th>
        </thead>
        <tbody id="tbodygt">
            @foreach($teamgate as $tgate)
            <tr>
                <td>
                    @foreach($teamgate as $teamgates)
                        @if($tgate->id_user == $teamgates->users['id'])
                            {{$teamgates->users['name']}}
                        @endif
                    @endforeach
                </td>
                <td></td>
                <td>{{date('d-m-Y', strtotime($tgate->updated_at))}}</td>
                <td>@if($tgate->agree == 0) Đã gửi lời mời @elseif($tgate->agree == 1) Đã tham gia @elseif($tgate->agree == 3) Từ chối @endif</td>
                <td>@if($tgate->agree == 0) <a href="{{url('huymoi/'.$tgate->id_user.'/'.$id)}}"><button class="btn btn-danger">Hủy mời</button></a> @endif</td>
            </tr>
            @endforeach
        </tbody>
    </table>
<script type="text/javascript">
    function themthanhvien(id) {
        disid = 'annutsc'+id;
        document.getElementById(disid).disabled = true;
        var idproject = '{{$id}}';
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
            }, 3000);
        }
    }
    function themgate(id) {
        disid = 'annutsc'+id;
        document.getElementById(disid).disabled = true;
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
    demtv= 0;
    function clickthemthanhvien() {
        if (demtv == 0) {
            document.getElementById('formthemthanhvien').style.display = 'block';
            demtv = 1;
        }else{
            document.getElementById('formthemthanhvien').style.display = 'none';
            demtv = 0;
        }
    }
    demgt= 0;
    function clickthemgate() {
        if (demgt == 0) {
            document.getElementById('formthemgate').style.display = 'block';
            demgt = 1;
        }else{
            document.getElementById('formthemgate').style.display = 'none';
            demgt = 0;
        }
    }
    $(document).ready(function(){
        $('#result').click(function minh(){
            var getdata = $('#noidung').val();
            $.ajax({
                url : "{{url('getRequest')}}",
                type : "GET",
                dataType:"text",
                data : { getdata },
                success : function (result){
                    $('#ras').html(result);
                }
            });
        });
        $('#resultgate').click(function minhgate(){
            var getdata = $('#noidunggate').val();
            $.ajax({
                url : "{{url('getRequestgate')}}",
                type : "GET",
                dataType:"text",
                data : { getdata },
                success : function (result){
                    $('#rasgate').html(result);
                }
            });
        });
    });
    var input = document.getElementById("noidung");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            var getdata = $('#noidung').val();
            $.ajax({
                url : "{{url('getRequest')}}",
                type : "GET",
                dataType:"text",
                data : { getdata },
                success : function (result){
                    $('#ras').html(result);
                }
            });
        }
    });
    var input2 = document.getElementById("noidunggate");
    input2.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            var getdata = $('#noidunggate').val();
            $.ajax({
                url : "{{url('getRequestgate')}}",
                type : "GET",
                dataType:"text",
                data : { getdata },
                success : function (result){
                    $('#rasgate').html(result);
                }
            });
        }
    });
</script>