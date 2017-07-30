
<form action="backend/<?=$action?>" method="post" enctype="multipart/form-data" class="form-horizontal">
	<?php
	if($post_type == "edit"){
		echo "<input type='hidden' name='old_id' value='$dft[id]'>";
	}
	foreach($structure as $st){
		if($st['show'] == 1){
			$field_name = ucfirst($st['field']);
			$val = "";
			if(isset($st['value'])){
				$val = $st['value'];
			}
			$class = "";
			if(isset($st['class'])){
				$class = $st['class'];
			}

			if($post_type == "add"){
				$dff = null;
			}
			else{
				$dff = $dft[$st['field']];
				if($st['type'] == "select_multiple"){
					$dff = explode(",",$dft[$st['field']]);
				}
			}
			echo "
			<div class='form-group'>
				<label for='form-$st[field]' class='control-label col-sm-2'>$field_name</label>
				<div class='col-sm-10'>
					".$this->cms->output_input($st['field'], $st['type'], $class, $val, $dff)."
				</div>
			</div>
			";
		}
	}
	?>
	<div class="row">
		<div class="col-sm-10 col-sm-push-2">
			<label>
				<input type="checkbox" name="show" value=1 checked>
				Langsung Publish Page Ini
			</label>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-10 col-sm-push-2">
			<button name="btn" class="btn btn-primary btn-lg">
				<span class="fa fa-save"></span>
				Simpan
			</button>
		</div>
	</div>
</form>