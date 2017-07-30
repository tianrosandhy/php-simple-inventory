<span data-tgl="<?=$date?>"></span>
<table class="data table">
	<thead>
		<tr>
			<th width=38%>Nama CC</th>
			<th width=30%>Tag</th>
			<th width=20%>Diinput Tanggal</th>
			<th width=100></th>
		</tr>
		<tr>
			<td colspan="4">
				<div class="btn btn-block btn-primary new-button" data-target="cc_master">
					<span class="fa fa-plus fa-fw"></span> New Data
				</div>
			</td>
		</tr>
		<tr class="new-form" id="cc_master" style="display:none;">
			<td><input type="text" class="form-control" name="cc_nama" placeholder="Nama CC"></td>
			<td><input type="text" class="form-control" name="cc_tag" placeholder="Tag"></td>
			<td><input type="date" name="cc_tgl" value="<?=$date?>" class="form-control"></td>
			<td>
				<button class="btn btn-success" title="Save"><span class="fa fa-check"></span></button>
				<button class="btn btn-danger close-button" data-target="cc_master" title="Cancel"><span class="fa fa-times"></span></button>
			</td>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach($query->result_array() as $row){
		?>
		<tr>
			<td><?=$row['nama']?></td>
			<td><?=$row['tag']?></td>
			<td><?=indo_date($row['tgl'],"half")?></td>
			<td>
				<span class="btn btn-info edit-button btn-sm" data-fancybox data-src="master/edit/master/<?=$row['id']?>">Edit</span>
				<span href="master/delete/<?=$row['id']?>" class="btn btn-danger btn-sm delete-button"><span class="fa fa-trash"></span></span>
			</td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>




<script>
$("#cc_master .btn-success").on("click",function(){
	cc_master();
});	
$("#cc_master input").on("keypress",function(e){
	if(e.which == 13){
		cc_master();
	}
});	

function cc_master(){
    $.ajax({
        dataType : "json",
        url : "ajax/master",
        type : "POST",
        data : {
            cc_nama : $("[name=cc_nama]").val(),
            cc_tag : $("[name=cc_tag]").val(),
            cc_tgl : $("[name=cc_tgl]").val()
        }
    }).done(function (data){
        if(data['error'] > 0){
        	//gagal
        	alertify.alert("Error",data['message']);
        }
        else{
        	//sukses
            //reset field
            $("[name=cc_nama]").val("").focus();
            $("[name=cc_tag]").val("");
            $("[name=cc_tgl]").val($("[data-tgl]").attr("data-tgl"));

            //append to new row
            $("table.data tbody").prepend('<tr class="newrow"><td>'+data['nama']+'</td><td>'+data['tag']+'</td><td>'+data['tgl']+'</td><td><span class="btn btn-info edit-button btn-sm" data-fancybox data-src="master/edit/master/'+data['id']+'">Edit</span> <span href="master/delete/'+data['id']+'" class="btn btn-danger btn-sm delete-button"><span class="fa fa-trash"></span></span></td></tr>');

            //focus to first field
        }
    }
	);
}

</script>