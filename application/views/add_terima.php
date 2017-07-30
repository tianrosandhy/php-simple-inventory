<form action="mutasi/addproses/<?=$row['id']?>" method="post">
	<div class="form-group">
		<label class="control-label col-sm-3">
			Tanggal
		</label>
		<div class="col-sm-9">
			<input type="date" class="form-control" name="cc_tgl" value="<?=$tgl?>">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">
			Jumlah Item Diterima
		</label>
		<div class="col-sm-9">
			<div class="input-group">
				<input type="number" name="cc_jml" class="form-control">
				<span class="input-group-addon">pcs</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">
			Keterangan
		</label>
		<div class="col-sm-9">
			<input type="text" name="cc_ket" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">
			
		</label>
		<div class="col-sm-9">
			<button class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
		</div>
	</div>

</form>