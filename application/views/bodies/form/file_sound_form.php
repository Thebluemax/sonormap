<form action= method="get" enctype="multipart/form-data">
    <label for="imag_arx">Introduzca Sonido</label>
    <p>Solo archivos .wav .</p>
     <div id="jquery-wrapped-fine-uploader"></div>


<script>

$('#jquery-wrapped-fine-uploader').fineUploader({
request: {
endpoint: '<?=site_url("list/file_comp/upload_arx") ?>'
}

}).on('complete',function(event, id, name, response){
	imgfile=response['filename'];
	usrd=response['usr'];
	$('#aud_d').text(imgfile);
	$('#usr_d').text(usrd);
	//guardar();
});
</script>
  
</form>