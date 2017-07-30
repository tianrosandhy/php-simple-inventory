<a href="<?=$addURL?>" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah Data Baru</a>

<table class="data table">
	<thead>
		<tr>
		<?php
		foreach($structure as $st){
			if(isset($st['attr'])){
				if($st['attr'] == "hide")
					continue;				
			}
			$field_name = ucfirst($st['field']);
			echo "
			<th>$field_name</th>";
		}
		?>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach($content as $ct){
			$trclass = "";
			if($ct['stat'] == "Hidden")
				$trclass = "hid";

			echo "<tr class='$trclass'>";
			foreach($ct as $key=>$value){
				echo "<td>$value</td>";
			}
			echo "</tr>";
		}
		?>
	</tbody>
</table>