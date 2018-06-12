
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
<table class="table ">
  <thead>
    <th style="width: 100px;border-bottom: 2px solid #b5b5b5;">Ngày</th>
    <th style="width: 500px;border-bottom: 2px solid #b5b5b5;">Mục tiêu đề ra</th>
    <th style="text-align: right;border-bottom: 2px solid #b5b5b5;"></th>
  </thead>
  <tbody id="tabletiendoduan">
    <?php $demtable = 0; ?>
    @foreach($progress as $prg)
    <tr id="bang{{$demtable}}" class="trformxoatd" onmouseover="bang({{$demtable}})" onmouseout="tru({{$demtable}})">
      <td id="date{{$prg->id}}"><?= date('d-m-Y', strtotime($prg->date)); ?></td>
      <td style="white-space: pre-line;" id="content{{$prg->id}}">{{$prg->content}}
      </td>
      <td style="text-align: right;">
        <button type="button" onclick="formxoatiendo('{{$prg->id}}','{{$demtable}}')" class=" btn" ><span class="glyphicon glyphicon-trash"></span></button>
        <button type="button" class="btn-warning btn" ><span class="glyphicon glyphicon-pencil"></span></button>
      </td>
    </tr>
    <tr style="background-color: #ccc;text-align: center;display: none;" class="hienthiformxoatd" id="formxoatiendo{{$prg->id}}">
      <td colspan="3" >
        <p>Xác nhận xóa?</p>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="quaylaiformxtd('{{$prg->id}}','{{$demtable}}')">Quay lại</button>
        <button type="button" class="btn btn-danger" onclick="xoatiendo('{{$prg->id}}')">Đồng ý xóa</button>
      </td>
    </tr>
    <?php $demtable++; ?>
    @endforeach
  </tbody>
</table>
