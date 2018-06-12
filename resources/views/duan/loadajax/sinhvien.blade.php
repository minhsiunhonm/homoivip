@foreach($users as $m)
<div style="position: relative;">
	<a href="{{url($m->linkprofile.'/')}}" target="_blank">
		<img src="{{url('public/avatar/'.$m->avatar)}}" >
		<p><b>{{$m->name}}</b></p>
	</a>
	<?php $demkn=0;  ?>
	<?php $demsokn=0;  ?>
	@foreach($m->position as $upo)
	@if($upo->code == 'cv')
	<p>Làm <b>{{$upo->name}}</b> tại <b>{{$upo->company}}</b></p>
	@elseif($upo->code == 'th')
	<p>Từng học tại: <b>{{$upo->name}}</b></p>
	@elseif($upo->code == 'kn')
	<?php $demkn++;  ?>
	@endif	
	@endforeach
	@if($demkn != 0)
	<p>Kỹ năng chuyên môn: 
		<b>
		@foreach($m->position as $upo)
			@if($upo->code == 'kn')
				<?php $demsokn++; ?>
				{{$upo->name}}@if($demsokn+1 == $demkn),@elseif($demsokn == $demkn).@endif
			@endif 
		@endforeach
		</b>
	</p>
	@endif
	<input type="button" class="btn btn-success" value="Mời tham gia" id="btnmtgt2" name="" style="right: 0;position: absolute;top: 0" onclick="themthanhvien('{{$m->id}}')">
</div>
@endforeach
