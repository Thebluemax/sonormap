/**
 * Sonormap
 *
 * An open source application for archive sounds for the education and history
 * of a City or region, Develop in Codeigniter framework for PHP 5.1.6 or newer
 *
 * @package   Sonormap
 * @author    MaximilianoFernández
 * @copyright Creative Commons Atribución-NoComercial-CompartirIgual 3.0 - 2013
 * @license   http://creativecommons.org/licenses/by-nc-sa/3.0/.
 * @link    https://github.com/Thebluemax/Sonormap
 * @since   Version 0.0
 *
 */

var editor;
var latitud_ch;
var longitud_ch;
var ico_sel;
var filename;
var loader_activo;
var alertBox;
var map;
// Launcher
$(document).ready(function(){
  init();
});
//Función inicial
function init(){
   latitud_ch=jSonObject.latitud;
   longitud_ch=jSonObject.longitud;
   ico_sel=jSonObject.ico_punt;
   // Formularios
	$('form.form-edit').submit(function(event){
    event.preventDefault();
    var act=$(this).find('input[name="action"]').val();
    if(act==='hist'||act==='hist_new'){
    editor=nicEditors.findEditor('text_item').saveContent();
  }
    dato=$(this).serializeArray();
    sendAjax(dato);
    //console.log($(this)+dato)
    message_load($(this).find('.msje'));

	});
	editor_build();
	do_map();
  upl_machine();
  upl_machine_aud();
  alertBox=new AlertHolder();
}
 // inicio editor de texto
  function editor_build(){
   editor=new nicEditor().panelInstance('text_item');

  }
  function do_map(){
  var lati=parseFloat(jSonObject.latitud);
  var longi=parseFloat(jSonObject.longitud);
  	map= new Gmaps('map',{lat:lati,
                         lng:longi },
                        15
                   );
  map.map.addListener('click',function (e) {
    map.clear_marks();
      e.latLng;
      latitud_ch=e.latLng.lat();
      longitud_ch=e.latLng.lng();
  $('#lat').val(latitud_ch);
  $('#lon').val(longitud_ch);
  var url_ico="<?=base_url('/img').'/'?>"+ico_sel;
      map.add_mark(e.latLng,url_ico,false);
  });

}
  /*
  funciones de reseteo,
   */

  function reset_text(){
    $('#text_item').val(jSonObject.texto);
   nicEditors.findEditor( "text_item" ).setContent( jSonObject.texto );
  }
  function reset_marks(){
    map.clear_marks();
    latitud_ch=parseFloat(jSonObject.latitud);
    longitud_ch=parseFloat(jSonObject.longitud);
    map.add_mark({lat:latitud_ch,lng:longitud_ch},'img/'+ico_sel,false);
    $('#lat').val(latitud_ch);
  $('#lon').val(longitud_ch);

  }
  function reset_descr () {
    $('#contenido_desc').val(jSonObject.descripcion);
  }
  /*
  * Función de ajax común para todas las actulizaciones.
   */
  function sendAjax(d){

    var ajxPetition = $.ajax({
            url: "<?=site_url('list/edicio/update')?>",
            type: "POST",
            data: d
            });

    ajxPetition.done(function(msg) {
      if (msg.msj===true) {
        message_complete('<?=$this->lang->line('s_edt_m16')?>');
      }else{
        message_error('<?=$this->lang->line('s_edt_m15')?>'+msg.msj);
      };
    });

ajxPetition.fail(function(jqXHR, textStatus) {
          message_error( "Request failed: " + textStatus );
                  });
  }
    //upload foto
  function upl_machine(){
    var botn=$('#boton_img');
    var uploader_ent=new qq.FineUploaderBasic({
      button:$('#boton_img')[0],
request: {
endpoint: '<?=site_url("list/file_comp/upload_pic") ?>'
},
 validation: {
allowedExtensions: ['jpeg', 'jpg', 'gif', 'png'],
sizeLimit: 3048000 // 200 kB = 200 * 1024 bytes
}
,callbacks:{onComplete: function(id, fileName, result) {

   imgfile=result['filename'];
//usrd=responseJSON['usr'];
//  actualizar();
//  ready_salve=true;
 // limpiar_mensaje();
 // next(6);
  if (result['success']==true) {
     upl_i(result['filename']);

  } else{

  };
},
 onSubmitted: function (id, name) {
 // subiendo();
        }}
});
  }
  function upl_i (r) {
      var data_en={
        image:r,
        id_rgtro:jSonObject.registro,
        action:'upl_img'
       };
       message_load($('#imagen_form').find('.msje'));
       sendAjax(data_en);
    // body...
  }
   function upl_a (r) {
      var data_en={
        audio:r,
        id_rgtro:jSonObject.registro,
        action:'upl_aud'
       };
       message_load($('#audi_form').find('.msje'));
       sendAjax(data_en);
    // body...
  }
  //Upload audio
  function upl_machine_aud(){
    var botn_a=$('#boton_aud');
    var uploader_aud=new qq.FineUploaderBasic({
      button:$('#boton_aud')[0],
request: {
endpoint: '<?=site_url("list/file_comp/upload_audio") ?>'
},
 validation: {
allowedExtensions: ['wav'],
sizeLimit: 10048000 // 200 kB = 200 * 1024 bytes
}
,callbacks:{onComplete: function(id, fileName, result) {

   aufile=result['filename'];
//usrd=responseJSON['usr'];
//  actualizar();
//  ready_salve=true;
 // limpiar_mensaje();
 // next(6);
  if (result['success']==true) {
     upl_a(result['filename']);

  } else{

  };
},
 onSubmitted: function (id, name) {
 // subiendo();
        }}
});
  }
  function message_load (o) {
    o.slideDown();
    alertBox.loading_bar(o);
    loader_activo=o;
  }
  function message_complete (m) {
    //loader_activo.html(m);
    alertBox.alert_success(loader_activo,m);
    loader_activo.slideDown();
  }
  function message_error (m) {
    //loader_activo.html(m);
    alertBox.alert_error(loader_activo,m);
    loader_activo.slideDown();
  }