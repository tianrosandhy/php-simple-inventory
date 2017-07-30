<table align="left">
	<tr>
		<td>Nama Inventory</td>
		<td style="padding:0 1em;">:</td>
		<td><strong><?=$row['nama']?></strong></td>
	</tr>
</table>
<div class="clearfix"></div>


<table class="data table">
	<thead>
		<tr>
			<th>Tanggal</th>
			<th>Masuk <span class="label label-success"><span class="fa fa-plus"></span></span></th>
			<th>Keluar <span class="label label-danger"><span class="fa fa-minus"></span></span></th>
			<th>Keterangan</th>
			<th>Mutasi</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$mutasi = 0;
	foreach($item_mutasi as $tgl=>$data){
		$tgll = date("Y-m-d H:i:s",$tgl);
		$terima = "";
		if(isset($data['terima'])){
			$terima = $data['terima'];
			$mutasi += $terima;
		}
		$kirim = "";
		if(isset($data['kirim'])){
			$kirim = $data['kirim'];
			$mutasi -= $kirim;
		}
		$ket = isset($data['ket']) ? $data['ket'] : "";


		echo "
		<tr>
			<td>".indo_date($tgll,"half")."</td>
			<td>$terima</td>
			<td>$kirim</td>
			<td><em>$ket</em></td>
			<td>$mutasi</td>
		</tr>
		";
	}
	?>
		<tr>
			<td colspan=4 align="right"><strong>Stok Master Saat Ini</strong></td>
			<td><strong><?=$mutasi?> pcs</strong></td>
		</tr>
	</tbody>
</table>

