<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<table class="table table-hover">
	<thead>
		<th style="width: 1px;"></th>
		<th>Họ tên</th>
		<th>Ngày yêu cầu</th>
		<th style="width: 1px;"></th>
	</thead>
	<tbody>
		@foreach($team as $t)
			<tr>
				<td>
					<a target="blank" href="{{url($t->users['linkprofile'])}}">
						<img src="{{url('public/avatar/'.$t->users['avatar'])}}" width="70">
					</a>
				</td>
				<td>
					<a target="blank" href="{{url($t->users['linkprofile'])}}">
						{{$t->users['name']}}
					</a>
				</td>
				<td>
					{{$t->created_at}}
				</td>
				<td>
					<button class="btn btn-success" onclick="pheduyet({{$t->id}})"><span class="glyphicon glyphicon-ok"></span></button>
					<button class="btn btn-danger" onclick="tuchoi({{$t->id}})" style="margin-top: 5px;"><span class="glyphicon glyphicon-remove"></span></button>
				</td>
			</tr>
			<!-- Modal -->
			<div id="mymodal2{{$t->id}}" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Thông báo</h4>
			      </div>
			      <div class="modal-body" style="text-align: right;">
			        <p style="text-align: left;">Từ chối thành viên này?</p>
			        <h2 style="text-align: left;">{{$t->users['name']}}</h2>
			        <br>
			        <br>
			        <button type="button" class="btn btn-default" data-dismiss="modal">Quay lại</button>
			        <a href="{{url('tuchoitvyc/'.$t->id)}}">
				        <button type="button" class="btn btn-danger" >Từ chối</button>
			        </a>
			      </div>
			    </div>
			  </div>
			</div>
			<div id="mymodal{{$t->id}}" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Phê duyệt?</h4>
			      </div>
			      <div class="modal-body" style="text-align: right;">
			        <p style="text-align: left;">Đồng ý phê duyệt thành viên?</p>
			        <br>
			        <br>
			        <button type="button" class="btn btn-default" data-dismiss="modal">Quay lại</button>
			        <a href="{{url('pheduyettvyc/'.$t->id)}}">
				        <button type="button" class="btn btn-success" >Đồng ý</button>
			        </a>
			      </div>
			    </div>
			  </div>
			</div>
		@endforeach
	</tbody>
</table>
<script src="{{url('public')}}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url('public')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{url('public')}}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script type="text/javascript">
function pheduyet(n) {
    $('#mymodal'+n).modal('show');
}
function tuchoi(n) {
    $('#mymodal2'+n).modal('show');
}
</script>