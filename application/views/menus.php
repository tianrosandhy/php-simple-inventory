<a href="" class="btn btn-primary">
	<span class="fa fa-plus"></span>
	Add Menu
</a>

<table class="table data">
	<thead>
		<tr>
			<th>#</th>
			<th>Label</th>
			<th>Type</th>
			<th>Target</th>
			<th>Parent</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php
	$no = 1;
	foreach($table as $row){
		echo "
		<tr>
			<td>$no</td>
			<td>$row[label]</td>
			<td>$row[type]</td>
			<td>$row[target]</td>
			<td>$row[parent_of]</td>
			<td></td>
		</tr>
		";
		$no++;
	}
	?>
	</tbody>
</table>

