@include('layouts.headermini')
<article class="duan" style="height: auto;background-color: #F2F2F0">
    <div class="container" id="companybox">
        <div class="row">
            <h2 style="margin-bottom: 20px;"><b>Cài đặt.</b></h2>
            <div class="col-md-3 boxsetting" >
                <a style="cursor: pointer;" onclick="thanhvien()">
                    <div class="atbboxsetting" id="thanhvien" style="border-top: solid 1px #dddfe2;border-left: 3px solid #b1b1b1;">Thành viên</div>
                </a>
                <a style="cursor: pointer;" onclick="thanhvienyeucau()">
                    <div class="atbboxsetting" id="thanhvienyeucau">Thành viên yêu cầu</div>
                </a>
                <a style="cursor: pointer;" onclick="yeucauthamgia()">
                    <div class="atbboxsetting" id="yeucauthamgia">Điều kiện tham gia</div>
                </a>
                <a style="cursor: pointer;" onclick="dautu()">
                    <div class="atbboxsetting" id="dautu">Đầu tư</div>
                </a>
            </div>
            <div class="col-md-9 boxaddpro" id="boxaddpro">
                <!-- dữ liệu trả về -->
            </div>
        </div>
    </div>
</article> 

<!-- Modal -->
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
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
<script src="{{url('public')}}/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
    if (window.location.hash == '#yeucauthamgia') {
        yeucauthamgia();
    }else if(window.location.hash == '#dautu'){
        dautu();
    }else if(window.location.hash == '#thanhvienyeucau'){
        thanhvienyeucau();
    }else{
        thanhvien();
    }
    function thanhvien() {
        $('#thanhvien').css('border-left-color','#b1b1b1');
        $('#dautu').css('border-left-color','#fff');
        $('#thanhvienyeucau').css('border-left-color','#fff');
        $('#yeucauthamgia').css('border-left-color','#fff');
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
        $('#thanhvien').css('border-left-color','#fff');
        $('#thanhvienyeucau').css('border-left-color','#fff');
        $('#dautu').css('border-left-color','#fff');
        $('#yeucauthamgia').css('border-left-color','#b1b1b1');
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
        $('#thanhvien').css('border-left-color','#fff');
        $('#dautu').css('border-left-color','#fff');
        $('#yeucauthamgia').css('border-left-color','#fff');
        $('#thanhvienyeucau').css('border-left-color','#b1b1b1');
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
    function dautu() {
        $('#thanhvien').css('border-left-color','#fff');
        $('#yeucauthamgia').css('border-left-color','#fff');
        $('#thanhvienyeucau').css('border-left-color','#fff');
        $('#dautu').css('border-left-color','#b1b1b1');
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
</body>
</html>