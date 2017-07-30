<span data-tgl="<?=$date?>"></span>
<table class="data table">
	<thead>
		<tr>
			<th width=38%>Nama Divisi</th>
			<th width=100></th>
		</tr>
		<tr>
			<td colspan="4">
				<div class="btn btn-block btn-primary new-button" data-target="cc_divisi">
					<span class="fa fa-plus fa-fw"></span> New Data
				</div>
			</td>
		</tr>
		<tr class="new-form" id="cc_divisi" style="display:none;">
			<td><input type="text" class="form-control" name="cc_nama" placeholder="Nama Divisi"></td>
			<td>
				<button class="btn btn-success" title="Save"><span class="fa fa-check"></span></button>
				<button class="btn btn-danger close-button" data-target="cc_divisi" title="Cancel"><span class="fa fa-times"></span></button>
			</td>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach($query->result_array() as $row){
		?>
		<tr>
			<td><?=$row['nama_divisi']?></td>
			<td>
				<span class="btn btn-info edit-button btn-sm" data-fancybox data-src="master/edit/divisi/<?=$row['id']?>">Edit</span>
				<span href="master/delete/<?=$row['id']?>/divisi" class="btn btn-danger btn-sm delete-button"><span class="fa fa-trash"></span></span>
			</td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>




<script>
$("#cc_divisi .btn-success").on("click",function(){
	cc_divisi();
});	
$("#cc_divisi input").on("keypress",function(e){
	if(e.which == 13){
		cc_divisi();
	}
});	

function cc_divisi(){
    $.ajax({
        dataType : "json",
        url : "ajax/divisi",
        type : "POST",
        data : {
            cc_nama : $("[name=cc_nama]").val(),
        },
        error: function (request, status, error) {
        	document.write(request.responseText);
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

            //append to new row
            $("table.data tbody").prepend('<tr class="newrow"><td>'+data['nama']+'</td><td><span class="btn btn-info edit-button btn-sm" data-fancybox data-src="master/edit/divisi/'+data['id']+'">Edit</span> <span href="master/delete/'+data['id']+'/divisi" class="btn btn-danger btn-sm delete-button"><span class="fa fa-trash"></span></span></td></tr>');

            //focus to first field
        }
    });
}

</script>