<a class="btn btn-warning" data-toggle="collapse" data-target="#fadd">
	<span class="fa fa-refresh"></span> Buat Data Periode Selanjutnya
</a>
<div id="fadd" class="collapse">
	<div class="row">
		<div class="col-sm-6">
			<div class="input-group">
				<input type="text" name="project_name" class="form-control" id="saveprojtxt" placeholder="Nama Project Saat Ini">
				<div class="input-group-btn">
					<button class="btn btn-primary" id="saveproj">
						Go
						<span class="fa fa-arrow-right"></span>
					</button>
				</div>
			</div>			
		</div>
	</div>
</div>


<br><br>

<div class="well well-sm">
	<h3>Rekap Project</h3>
	<table class="data table">
		<thead>
			<tr>
				<th>#</th>
				<th>Nama Project</th>
				<th>Tanggal</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$no = 1;
		foreach($query as $row){
			echo "
			<tr>
				<td>$no</td>
				<td>$row[nama_project]</td>
				<td>".indo_date($row['tgl'])."</td>
				<td><a href='history/view/$row[id]' class='btn btn-primary'>Lihat Laporan</a></td>
			</tr>
			";
			$no++;
		}
		?>
		</tbody>

	</table>	
</div>
