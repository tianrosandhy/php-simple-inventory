<table class="data table">
	<thead>
		<tr>
			<th>#</th>
			<th>Nama CC</th>
			<th>Jumlah</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php
	$no = 1;
	foreach($list as $row){
	?>
		<tr>
			<td><?=$no?></td>
			<td><a href="javascript:;" data-fancybox data-src="mutasi/view/<?=$row['id']?>"><?=$row['nama']?></a></td>
			<td><?=$mutasi[$row['id']]?> pcs</td>
			<td>
				<a href="javascript:;" data-fancybox data-src="mutasi/view/<?=$row['id']?>" class="btn btn-sm btn-primary"><span class="fa fa-eye"></span> Detail</a>
				<a data-fancybox data-src="mutasi/add/<?=$row['id']?>" class="btn btn-sm btn-info"><span class="fa fa-download"></span> Terima Barang</a> 
				<a data-fancybox href="javascript:;" data-src="mutasi/kirim/<?=$row['id']?>" class="btn btn-sm btn-warning"><span class="fa fa-paper-plane"></span> Kirim ke Divisi</a>
			</td>
		</tr>
	<?php
		$no++;
	}
	?>
	</tbody>
</table>