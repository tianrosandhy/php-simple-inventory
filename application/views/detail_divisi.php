<table class="data table">
	<thead>
		<tr>
			<th>#</th>
			<th>Nama Inventory</th>
			<th>Jumlah</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php
	$no = 1;
	foreach($list_cc as $row){
		$jml = isset($mutasi[$row['id']]) ? $mutasi[$row['id']] : 0;
	?>
		<tr>
			<td><?=$no?></td>
			<td><a href="javascript:;" data-fancybox data-src="mutasi/view/<?=$row['id']?>/<?=$iddiv?>"><?=$row['nama']?></a></td>
			<td><?=$jml?> pcs</td>
			<td>
				<a data-fancybox href="javascript:;" data-src="mutasi/kirim/<?=$row['id']?>/<?=$iddiv?>" class="btn btn-sm btn-info"><span class="fa fa-paper-plane"></span> Tambah Stok</a>
				<a data-fancybox data-src="mutasi/terjual/<?=$row['id']?>/<?=$iddiv?>" class="btn btn-sm btn-warning"><span class="fa fa-pencil"></span> Stok Terpakai</a> 
				
			</td>
		</tr>
	<?php
		$no++;
	}
	?>
	</tbody>
</table>