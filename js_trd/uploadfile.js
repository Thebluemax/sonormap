var UploadFile = function (id_input) {
	if (window.File && window.FileReader && window.FileList && window.Blob) {

  		  document.getElementById(id_input).addEventListener('change', this.handleFileSelect, false);


} else {
  console.log('The File APIs are not fully supported in this browser.');
}

}
UploadFile.prototype.handleFileSelect=function (evt) {
    var files = evt.target.files; // FileList object

    // files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
      output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
                  f.size, ' bytes, last modified: ',
                  f.lastModifiedDate.toLocaleDateString(), '</li>');
    }
    document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
  }

