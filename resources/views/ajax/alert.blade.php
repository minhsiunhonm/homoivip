<?php $demgavt = 0; ?>
@foreach($note as $not)
<a href="{{url('project/'.$not->id_project)}}">
	<li @if($not->status == '1') class='bgffff' @endif>
		<img src="{{url('public/fileupload/'.$not->projects['avatar'])}}">
		<span>
			@if($not->code == 'moisv')
				Bạn được mời tham gia dự án <b>{{$not->projects['name']}}</b>
			@elseif($not->code == 'moigt')
				Bạn được mời làm <b>cố vấn</b> dự án <b>{{$not->projects['name']}}</b> 
			@elseif($not->code == 'chuadt')
				Bạn chưa chuyển tiền cho dự án <b>{{$not->projects['name']}}</b> 
			@elseif($not->code == 'flmem')
				<b>{{$not->name}}</b> đã tạo dự án <b>{{$not->projects['name']}}</b> 
			@endif
			{{$not->id}},
			{{$not->projects['id']}}
		</span>
	</li>
</a>
<!--chiamang-->
<?php $demgavt++; ?>
@endforeach