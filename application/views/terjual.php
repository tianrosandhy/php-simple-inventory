<form action="mutasi/addterjual/" method="post" class="form form-horizontal">
	<input type="hidden" name="idmaster" value=<?=$idmaster?>>
	<input type="hidden" name="iddivisi" value=<?=$iddivisi?>>
	<input type="hidden" name="cc_terjual" value="<?=$real_stok?>">

	<div class="form-group">
		<label class="control-label col-sm-3">
			Tanggal
		</label>
		<div class="col-sm-9">
			<input type="date" class="form-control" name="cc_tgl" value="<?php if(isset($_SESSION['cc_jml'])){echo $_SESSION['cc_jml']; unset($_SESSION['cc_jml']);}else{echo $tgl;}?>">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">
			Jumlah Inventory Terpakai (Stok divisi : <?=$real_stok?>)
		</label>
		<div class="col-sm-9">
			<div class="input-group">
				<input type="number" name="cc_jml" value="<?php if(isset($_SESSION['cc_jml'])){echo $_SESSION['cc_jml']; unset($_SESSION['cc_jml']);}?>" class="form-control">
				<span class="input-group-addon">pcs</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">
			Keterangan
		</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="cc_ket" value="">
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