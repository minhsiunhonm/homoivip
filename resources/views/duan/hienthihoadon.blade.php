@foreach($projectinvest as $pri)
@endforeach
@foreach($invest as $i)
@if($i->status == 0)
	<div class="alert alert-info alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h4><i class="icon fa fa-info"></i> Thông báo!</h4>
	Bạn hãy chắc chắn là sẽ tài trợ cho dự án, và giúp đỡ họ khi dự án đi vào hoạt động.
	</div>
	<div class="row">
	  	<div class="col-md-3"></div>
	  	<div class="col-md-6 contentmodautu">
	  		<br>
			<div class="form-group" id="boxtien">
	          <label>Số tiền bạn muốn đầu tư cho dự án</label>
	          <input type="number" id="sotien" class="form-control" placeholder="Số tiền" onkeyup="checktien()">
	          <span class="help-block" style="text-align: right;" >Số tiền phải lớn hơn @if($pri->min_money < 1000000) 1,000,000 đ @else {{$pri->min_money}} @endif</span>
	          <div class="boxhientien" style="display: none;">
		          Số tiền: <span id="checktien"></span>
	          </div>
	          <button class="btn btn-defaul" style="float: right;" onclick="hoantatdautu()">Hoàn tất</button>
	        </div>
	  	</div>
	  	<div class="col-md-3"></div>
	</div>
	<script type="text/javascript">
		demdautu = 0;
		function checktien() {
			soten = $('#sotien').val();
			if (soten < 1000000 || soten > {{$pri->money}}) {
				$('#boxtien').addClass('has-error');
				$('#boxtien').removeClass('has-success');
			}else{
				$('#boxtien').addClass('has-success');
				$('#boxtien').removeClass('has-error');
			}
			if (soten > 0) {
				$('.boxhientien').css('display','block');

				chst = soten;
		        for (var i = 0; i < 10; i++) {
		            chst = chst.replace(' ','');
		        }
		        $('#checktien').html(chst.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")+' đ');
			}else{
				$('.boxhientien').css('display','none');
			}
		}
		function editmoney() {
	        ted = $('#idsotien').html();
	        for (var i = 0; i < 10; i++) {
	            ted = ted.replace(' ','');
	        }
	        $('#idsotien').html(ted.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
	        ted = $('#idsotien2').html();
	        for (var i = 0; i < 10; i++) {
	            ted = ted.replace(' ','');
	        }
	        $('#idsotien2').html(ted.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
	    }
		function hoantatdautu() {
			sotenn = $('#sotien').val();
			if (sotenn >= 1000000 && sotenn <= {{$pri->money}}){
				if (demdautu == 0){
					var loadimg = '<div class="row"><div class="col-md-4"></div><div class="col-md-4 contentmodautu"><img src="{{url("public/image/loadding.gif")}}"></div><div class="col-md-4"></div></div>'
					$('#hienthihoadon').html(loadimg);
					idpr = '{{$idpr}}';
					$.ajax({
			            url : "{{url('taodautu')}}",
			            type : "GET",
			            dataType:"text",
			            data : { idpr,sotenn },
			            success : function (result){
							$('#hienthihoadon').html(result);
							// taitro();
			            }
			        });
				}
			}
		}
		editmoney();
	</script>
@elseif($i->status == 1)
	<div class="alert alert-warning alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-warning"></i> Cảnh báo!</h4>
		Giao dịch phải được hoàn thành trong 3 ngày. Nếu không hóa đơn sẽ bị hủy, và tài khoản của bạn sẽ bị cảnh cáo!
	</div>
    <h4 class="modal-title">CHỌN PHƯƠNG THỨC THANH TOÁN</h4>
    <hr style="border: 0.5px dotted #ddd;background">
    <div class="boxphuongthucthanhtoan col-md-12">
    	<div class="col-md-4 boxpttt" id="chuyenkhoan" onclick="chuyenkhoan()">
    		<div class="img-pttt">
    			<img id="imgchuyenkhoan" src="{{url('public/image/chuyen-khoan-hdtt.png')}}">
    		</div>
    		<div class="phuongthuctt">
    			Chuyển khoản
    		</div>
    	</div>
    </div>
    <div class="chitietthanhtoan">
    	<div class="chitietchuyenkhoan" style="display: none;">
    		<div class="col-md-6">
    			<b>Chuyển khoản</b>
    			<p>Quý khách vui lòng chuyển khoản cho chúng tôi theo thông tin sau:</p>
    			<table class="table">
    				<thead>
    					<th></th>
    					<th></th>
    				</thead>
					<tbody>
	    				<tr>
	    					<td>Tên tài khoản</td>
	    					<td><b>Dương Văn Minh</b></td>
	    				</tr>
	    				<tr>
	    					<td>Số TK</td>
	    					<td><b>098765432198</b></td>
	    				</tr>
	    				<tr>
	    					<td>Ngân hàng</td>
	    					<td><b>Vietcombank - Chi nhánh Hà Nội</b></td>
	    				</tr>
	    				<tr>
	    					<td>Mã đơn hàng</td>
	    					<td><b>HOMOI{{$i->id}}</b></td>
	    				</tr>
					</tbody>
    			</table>
    		</div>
    		<div class="col-md-6">
    			<b>Để đảm bảo quyền lợi, khách hàng cần lưu ý</b>
    			<p>Quý khách vui lòng chuyển khoản qua ngân hàng trong phần "Nội dung thanh toán". </p>
    			<li>Quý khách ghi rõ mã đơn hàng cần thanh toán và số điện thoại đã dùng đặt hàng (Mã đơn hàng + Số điện thoại).</li>
    			<li>Sau khi thanh toán Quý khách vui lòng gởi thông báo vào <b>hotro@homoi.vn</b> để chúng tôi hoàn tất đơn hàng cho Quý khách. Dịch vụ chỉ được đăng ký / gia hạn khi nhận được thanh toán và thông tin chính xác đầy đủ.</li>
    		</div>
    	</div>
    </div>
    <h4 class="modal-title " style="width: 100%;float: left;margin-top: 20px">THÔNG TIN ĐĂNG KÝ CỦA BẠN</h4>
	<div class="chitietthanhtoan">
		<table class="table table-striped ">
	  		<thead>
	  			<th style="width: 200px"></th>
	  			<th></th>
	  		</thead>
	  		<tbody>
	  			<tr>
			      	<td>Số tiền đầu tư</td>
			      	<td><b id="sotienhoadon">{{$i->money}}</b> đ</td>
			    </tr>
	  			<tr>
			      	<td>Tên khách hàng</td>
			      	<td><b>{{Auth::user()->name}}</b></td>
			    </tr>
	  			<tr>
			      	<td>Địa chỉ</td>
			      	<td><b>{{Auth::user()->address}}</b></td>
			    </tr>
	  			<tr>
			      	<td>Số điện thoại</td>
			      	<td><b>{{Auth::user()->phone}}</b></td>
			    </tr>
	  			<tr>
			      	<td>Email</td>
			      	<td><b>{{Auth::user()->email}}</b></td>
			    </tr>
	  		</tbody>
	  	</table>
	</div>
    	<!-- <button style="" class="btn btn-danger" disabled="">Tiếp theo</button> -->
<script type="text/javascript">
	function chuyenkhoan() {
		$('#chuyenkhoan').css({'background':'#fa8601'});
		$('.phuongthuctt').css({'color':'#fff'});
		$('#imgchuyenkhoan').attr("src","{{url('public/image/chuyen-khoan-hdtt-active.png')}}");
		$('.chitietchuyenkhoan').css({'display':'block'});
	}
	function editmoney() {
        ted = $('#sotienhoadon').html();
        for (var i = 0; i < 10; i++) {
            ted = ted.replace(' ','');
        }
        $('#sotienhoadon').html(ted.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        ted = $('#idsotien').html();
        for (var i = 0; i < 10; i++) {
            ted = ted.replace(' ','');
        }
        $('#idsotien').html(ted.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        ted = $('#idsotien2').html();
        for (var i = 0; i < 10; i++) {
            ted = ted.replace(' ','');
        }
        $('#idsotien2').html(ted.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
    }
    editmoney();
</script>
@elseif($i->status == 2)
	<div class="alert alert-success alert-dismissible" style="background-color: #008d4c !important">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Bạn đã đầu tư cho dự án này!</h4>
		Bạn đã đầu tư <b id="sotienhoadon2">{{$i->money}}</b>đ. 
	</div>
    <h4 class="modal-title " style="width: 100%;float: left;margin-top: 20px">THÔNG TIN ĐĂNG KÝ CỦA BẠN</h4>
	<div class="chitietthanhtoan">
		<table class="table table-striped ">
	  		<thead>
	  			<th style="width: 200px"></th>
	  			<th></th>
	  		</thead>
	  		<tbody>
	  			<tr>
			      	<td>Số tiền đầu tư</td>
			      	<td><b id="sotienhoadon">{{$i->money}}</b> đ</td>
			    </tr>
	  			<tr>
			      	<td>Tên khách hàng</td>
			      	<td><b>{{Auth::user()->name}}</b></td>
			    </tr>
	  			<tr>
			      	<td>Địa chỉ</td>
			      	<td><b>{{Auth::user()->address}}</b></td>
			    </tr>
	  			<tr>
			      	<td>Số điện thoại</td>
			      	<td><b>{{Auth::user()->phone}}</b></td>
			    </tr>
	  			<tr>
			      	<td>Email</td>
			      	<td><b>{{Auth::user()->email}}</b></td>
			    </tr>
	  		</tbody>
	  	</table>
	</div>
<script type="text/javascript">
	function editmoney() {
        ted = $('#sotienhoadon2').html();
        for (var i = 0; i < 10; i++) {
            ted = ted.replace(' ','');
        }
        $('#sotienhoadon2').html(ted.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        ted = $('#sotienhoadon').html();
        for (var i = 0; i < 10; i++) {
            ted = ted.replace(' ','');
        }
        $('#sotienhoadon').html(ted.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        ted = $('#idsotien').html();
        for (var i = 0; i < 10; i++) {
            ted = ted.replace(' ','');
        }
        $('#idsotien').html(ted.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        ted = $('#idsotien2').html();
        for (var i = 0; i < 10; i++) {
            ted = ted.replace(' ','');
        }
        $('#idsotien2').html(ted.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
    }
    editmoney();
</script>
@endif
@endforeach
