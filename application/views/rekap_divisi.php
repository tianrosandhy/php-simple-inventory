<table class="data table">
	<thead>
		<tr>
			<th>#</th>
			<th>Nama Divisi</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php
	$no = 1;
	foreach($list as $iddiv=>$nmdiv){
	?>
		<tr>
			<td><?=$no?></td>
			<td><?=$nmdiv?></td>
			<td>
				<a href="javascript:;" data-fancybox data-src="mutasi/detaildivisi/<?=$iddiv?>" class="btn btn-sm btn-primary"><span class="fa fa-eye"></span> Detail</a>
			</td>
		</tr>
	<?php
		$no++;
	}
	?>
	</tbody>
</table>