<form onsubmit="cc_edit_divisi(); return false;">
	<div class="form-group">
		<label for="" class="control-label col-sm-3">
			Nama Divisi
		</label>
		<div class="col-sm-9">
			<input type="text" name="cc_nama" class="form-control" value="<?=$row['nama_divisi']?>">
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
		cc_divisi();
	}
});

$(".btn-primary").on("click",function(){
	cc_divisi();
});
*/

function cc_edit_divisi(){
    $.ajax({
        dataType : "json",
        url : "ajax/edit_divisi/<?=$row['id']?>",
        type : "POST",
        data : {
            cc_nama : $("[name=cc_nama]").val()
        }
    }).done(function (data){
        if(data['error'] > 0){
        	//gagal
        	alertify.alert("Error",data['message']);
        }
        else{
        	//sukses
        	alertify.alert("Success","Berhasil mengupdate data divisi");
        }
    }
	);
}
</script>