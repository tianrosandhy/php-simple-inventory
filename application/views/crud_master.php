<form onsubmit="cc_edit_master(); return false;">
	<div class="form-group">
		<label for="" class="control-label col-sm-3">
			Nama CC
		</label>
		<div class="col-sm-9">
			<input type="text" name="cc_nama" class="form-control" value="<?=$row['nama']?>">
		</div>
	</div>
	<div class="form-group">
		<label for="" class="control-label col-sm-3">
			Tag
		</label>
		<div class="col-sm-9">
			<input type="text" name="cc_tag" class="form-control" value="<?=$row['tag']?>">
		</div>
	</div>
	<div class="form-group">
		<label for="" class="control-label col-sm-3">
			Tanggal
		</label>
		<div class="col-sm-9">
			<input type="date" name="cc_tgl" class="form-control" value="<?=date("Y-m-d",strtotime($row['tgl']))?>">
		</div>
	</div>
	<div class="form-group">
		<label for="" class="control-label col-sm-3">
			
		</label>
		<div class="col-sm-9">
			<button class="btn btn-primary"><span class="fa fa-save"></span> Update</button>
		</div>
	</div>
</form>

<script>
/*
$("form input").on("keypress",function(e){
	if(e.which == 13){
		cc_master();
	}
});

$(".btn-primary").on("click",function(){
	cc_master();
});
*/

function cc_edit_master(){
    $.ajax({
        dataType : "json",
        url : "ajax/edit_master/<?=$row['id']?>",
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
        	alertify.alert("Success","Berhasil mengupdate data CC");
        }
    }
	);
}
</script>