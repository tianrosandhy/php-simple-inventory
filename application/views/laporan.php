<form action="" method="get" class="form-horizontal well no-print">
	<div class="form-group">
		<label class="control-label col-sm-3">
			Tampilkan Data			
		</label>
		<div class="col-sm-9">
			<label for="show1" class="block">
				<input type="radio" id="show1" <?php if(isset($_GET['show'])){if($_GET['show'] == 1){echo "checked";}}?> name="show" value="1" onchange="this.form.submit()">
				Master Inventory
			</label>
			<label for="show2" class="block">
				<input type="radio" id="show2" <?php if(isset($_GET['show'])){if($_GET['show'] == 2){echo "checked";}}?> name="show" value="2" onchange="this.form.submit()">
				Inventory di Divisi
			</label>
		</div>
	</div>
	<?php
	if(isset($_GET['show'])){
		if($_GET['show'] == 2){
	?>
	<div class="form-group">
		<label class="control-label col-sm-3">
			Filter Divisi
		</label>
		<div class="col-sm-9">
			<select name="filter" name="divisi" class="form-control" onchange="this.form.submit()">
				<option value="">- Seluruh Divisi -</option>
				<?php
				foreach($listdiv as $iddv=>$dvname){
					$sel = "";
					if(isset($_GET['filter'])){
						if($_GET['filter'] == $iddv){
							$sel = "selected";
						}
					}
					echo "
					<option $sel value='$iddv'>$dvname</option>";
				}
				?>
			</select>
		</div>
	</div>
	<?php
		}
	}
	?>

	<div class="form-group">
		<label class="control-label col-sm-3">
			
		</label>
		<div class="col-sm-9">
			<label for="dtl">
				<input type="checkbox" name="dtl" id="dtl" value="1" onchange="this.form.submit()" <?php if(isset($_GET['dtl'])){if($_GET['dtl'] == 1){echo "checked";}}?>> Tampilkan Dalam Mode Detail
			</label>
		</div>
	</div>

</form>



<div class="print-area">

<?php
if(isset($show)):
echo "
	<a href='javascript:;' onclick='window.print()' class='btn btn-primary no-print'><span class='fa fa-print fa-fw'></span> Print</a>
";

if($show == 1) :
?>

	<table class="data table">
		<thead>
			<tr>
				<th>#</th>
				<th>Nama Item</th>
				<th>Tanggal</th>
				<th>Masuk</th>
				<th>Keluar</th>
				<?php
				if(isset($_GET['dtl'])){
					echo "<th>Keterangan</th>";
				}
				else{
					echo "<th>Stok Akhir</th>";
				}
				?>
			</tr>			
		</thead>
		<tbody>
		<?php
		if(isset($query)){
			$n = 1;
			foreach($query as $idmaster=>$isi){
				if(isset($list_cc[$idmaster])){

					$nama = $list_cc[$idmaster];
					$mutasi = 0;
					$masuk = $keluar = 0;
					foreach($isi as $tgl => $row){
						$date = date("Y-m-d",$tgl);

						$terima = "";
						if(isset($row['terima'])){
							$terima = $row['terima'];
							$mutasi += $terima;
						}
						$kirim = "";
						if(isset($row['kirim'])){
							$kirim = $row['kirim'];
							$mutasi -= $kirim;
						}

						$ket = isset($row['ket']) ? "<em>$row[ket]</em>" : "";


						if($detail == 1){
							echo "
							<tr>
								<td>$n</td>
								<td>$nama</td>
								<td>".indo_date($date,"half")."</td>
								<td>$terima</td>
								<td>$kirim</td>
								<td>$ket</td>
							</tr>
							";
							$n++;
						}
						else{
							$masuk += intval($terima);
							$keluar += intval($kirim);
						}
					}

					if($detail == 1){
						echo "
						<tr class='active'>
							<td colspan=4 align='right'>Stok Akhir</td>
							<td><strong>$mutasi</strong></td>
							<td></td>
						</tr>
						<tr>
							<td colspan=6></td>
						</tr>
						";
					}
					else{
						echo "
						<tr>
							<td>$n</td>
							<td>$nama</td>
							<td>".indo_date($date,"half")."</td>
							<td>$masuk</td>
							<td>$keluar</td>
							<td><strong>$mutasi</strong></td>
						</tr>
						";
						$n++;
					}
				}
			}
		}
		?>
		</tbody>
	</table>

<?php
elseif($show == 2):
?>

	<table class="data table">
		<thead>
			<tr>
				<th>#</th>
				<th>Divisi</th>
				<th>Tanggal</th>
				<th>Nama Inventory</th>
				<th>Terima</th>
				<th>Jual</th>
				<th>Keterangan</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(isset($query)){
			$n = 1;
			foreach($query as $iddivisi=>$isi){
				if(isset($listdiv[$iddivisi])){

					$divisi = $listdiv[$iddivisi];

					foreach($isi as $idmaster => $isis){
						$ccname = isset($list_cc[$idmaster]) ? $list_cc[$idmaster] : null;
						$mutasi = 0;
						$masuk = $keluar = 0;

						foreach($isis as $tgl => $row){
							$date = date("Y-m-d",$tgl);

							$kirim = "";
							if(isset($row['kirim'])){
								$kirim = $row['kirim'];
								$mutasi += $kirim;
							}
							$jual = "";
							if(isset($row['jual'])){
								$jual = $row['jual'];
								$mutasi -= $jual;
							}

							$ket = isset($row['ket']) ? "<em>$row[ket]</em>" : "";


							if($detail == 1){
								echo "
								<tr>
									<td>$n</td>
									<td>$divisi</td>
									<td>".indo_date($date,"half")."</td>
									<td>$ccname</td>
									<td>$kirim</td>
									<td>$jual</td>
									<td>$ket</td>
								</tr>
								";
								$n++;
							}
							else{
								$masuk += intval($kirim);
								$keluar += intval($jual);
							}
						}

						if($detail == 1){
							echo "
							<tr class='active'>
								<td colspan=5 align='right'>Stok Akhir</td>
								<td><strong>$mutasi</strong></td>
								<td></td>
							</tr>
							<tr>
								<td colspan=7></td>
							</tr>
							";
						}
						else{
							echo "
							<tr>
								<td>$n</td>
								<td>$divisi</td>
								<td>".indo_date($date,"half")."</td>
								<td>$ccname</td>
								<td>$masuk</td>
								<td>$keluar</td>
								<td><em>Stok Akhir : <strong>$mutasi</strong></em></td>
							</tr>
							";
							$n++;
						}




					}


				}
			}
		}
		?>
		</tbody>
	</table>

<?php
endif;
echo "
	<a href='javascript:;' onclick='window.print()' class='btn btn-primary no-print'><span class='fa fa-print fa-fw'></span> Print</a>
";
endif;
?>

</div>
