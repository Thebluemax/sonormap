/**
 * Sonormap
 *
 * An open source application for archive sounds for the education and history
 * of a City or region, Develop in Codeigniter framework for PHP 5.1.6 or newer
 *
 * @package   Sonormrmap
 * @author    Maximiliano Fernández - @mxml13
 * @copyright under GNU/GPL licence 2013.
 * @license   http://  /license.html
 * @link    http://
 * @since   Version 0.0
 * @filesource  /js/enJine.js
 */
var tl_ly;
var desc;
var lat_ly;
var lon_ly;
var lat_in;
var lon_in;
var control;
var cards;
var ready_salve;
var ico_sel;
// var
var editor;
var titulo;
var description;
var categoria;
var cat_val;
var latitud;
var longitud;
var boundsMap;
var file_hash;
var usrd;
var aufile=null;
var imgfile=null;
var video_cont=null;
var text_editor=null;
var text_hist;
var compovar=0;
var alertBox;

/**
 * crea el mapa de posicionamiento de la historia.
 *
 */
var boundsMap;<?php  $ar=$this->config->item('web_bounds')?>
$('#new-h').click(function(){
  initNew();
  $('#new-modal').modal('show');
});
//inicio.
function initNew()
{
alertBox=new AlertHolder();
ready_salve=false;
tl_ly=$('#titol');
desc=$('#description');
lat_ly=$("#lat_d");
lon_ly=$("#lon_d");
lat_in=$('#lat');
lon_in=$('#lon');
control=$('.itm_sta');
cards=$('.form_card');
boundsMap=[ <?=$ar['lat1']?>,
            <?=$ar['lat2']?>,
            <?=$ar['lon1']?>,
            <?=$ar['lon2']?>];
upl_machine();
upl_machine_aud();
next(0);

$('#select_opt').change(function(event){
 		$('#select_opt option:selected').each( function(){change_child($(this).text());});
 	});
change_child('Vida');
$('a.next').click(function (e) {
	e.preventDefault();
	console.log('lost'+'/'+$(this).data('pos'));
	switch($(this).data('pos')){
		case 1:
			comprobar_0();
		break;
		case 2:
			comprobar_1();
		break;
		case 3:
			comprobar_m();
		break;
		default:
		break;
	}
	//comprobar_0();
});
$('#send-to').click(function (e) {
	e.preventDefault();
	guardar();
});
$('[data-toggle="tooltip"]').tooltip()
}
// fin init
function comprobar_0 () {
	 titulo= tl_ly.val();
	if (titulo.length >0) {
		var request = $.ajax({
                            url: "<?=site_url('arxivar/check_title')?>",
                            type: "POST",
                            data: {'titulo' :titulo }
                            });
		request.done(function(msg) {
            if (msg.flag==1) {

                 actualizar();
                 next(1);
          	}else{
            	 alertBox.alert_error($('#mensaje'),"<?=$this->lang->line('s_new_err1')?>");
          	}
          });
          request.fail(function(jqXHR, textStatus) {
          alert( "Request failed: " + textStatus );
          });
         } else{
          alertBox.alert_error($('#mensaje'),"<?=$this->lang->line('s_new_err3')?>");
          window.location.hash = '#mensaje';
    };
}
function comprobar_1()
{
    description=desc.val();
    if (description.length>0 && description.length < 140) {
        categoria=$('#subcateg :selected').text();
        cat_val=$('#subcateg').val();
        actualizar();
        next(2);
        do_mapa();
	}else {
        alertBox.alert_error($('#mensaje'),"<?=$this->lang->line('s_new_err2')?>");
    }
}
//creamos el mapa
function do_mapa() {
var map_new=new Gmaps('choose_map',{ lat:41.97,
                         lng:2.78},
                        15
                    );
    var url_ico="<?=base_url('/img').'/'?>"+ico_sel;
    map_new.map.addListener('click',function (e) {
     console.log(e.latLng);
    map_new.clear_marks();
    latitud=e.latLng.lat();
    longitud=e.latLng.lng();
     map_new.add_mark(e.latLng,url_ico,false,'');
     lat_in.val(latitud);
    lon_in.val(longitud);
    });

}
  //comprobaciones del mapa
function comprobar_m(){
  if (latitud!='' && longitud!='') {
         if (((boundsMap[0]>latitud) && (boundsMap[1]<latitud))&&((boundsMap[2]<longitud)&&(boundsMap[3]>longitud)))
          {
                 actualizar();
                 do_smal_map()
                 //make_rec();
                 boulder_media();
                 next(3);
          } else{
            alertBox.alert_error($('#mensaje'),"<?=$this->lang->line('s_new_err4')?>",'error');
          };
  } else{
       alertBox.alert_error($('#mensaje'),"<?=$this->lang->line('s_new_err5')?>");
  };
}
function boulder_media() {

	$('div.button-big').click(function (e) {
	console.log('ok'+$(this).data('media'));
			var action_ref=$(this).data('media');
			switch(action_ref){
				case 'video':
					$('#modal-video').modal() ;
					$('#video-btn').click(function (e) {
						if($('#video_tag').val()!=""){
  							video_cont=$('#video_tag').val();
  							var frameVideo="<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/"+video_cont+"\" class=\"embed-responsive-item\" allowfullscreen></iframe>";
  							$('div#video-div').addClass('embed-responsive-16by9').html(frameVideo);
  							$('#modal-video').modal('hide') ;
  							ready_salve=true;
						}else{
							alertBox.alert_error($('#mensaje-video'),"El enlace es obligatorio");
						}
					});
				break;
				case 'image':

					$('#modal-image').modal() ;

				break;
				case 'text':

					$('#modal-text').modal().on('shown.bs.modal', function () {

            			editor_build();

    							});

					$('#text-btn').click(function () {

						var edt=nicEditors.findEditor('text_item');
  						text_editor=edt.getContent();

  						if(text_editor!=="<br>"){

   								text_hist=text_editor;
   								$('div#history-txt').html("<p>"+text_hist+"</p>");
   								$('#modal-text').modal('hide');
  								ready_salve=true;

							}else{

								alertBox.alert_error($('#mensaje-txt'),"El texto es obligatorio");
							}
					});

				break;
				case 'audio':

					$('#modal-audio').modal() ;

				break;
			}
	});
}
function do_smal_map() {
	$('div#smal-map').css('height','250px');

	var map_smal=new Gmaps('smal-map',{ lat:latitud,
                         lng:longitud},
                        15
                    );
    var url_ico="<?=base_url('/img').'/'?>"+ico_sel;
     map_smal.add_mark({ lat:latitud,
                         lng:longitud},url_ico,false,'');

}
  //Salta de layer en layer.
    function next(p)
    {

      var a;
      //control.css('border','2px solid #081749');
    //if(p<=3){a=p}else if(p>3&&p<6){a=3}else{a=p-2;}
     // control.eq(a).css('border','4px dotted #d35');
      cards.fadeOut(500);
      cards.eq(p).fadeIn(500);

	}
  //funcion de grabacion audio.
function make_rec()	{

	var send_name=hashname();
	file_hash=send_name;
	$.jRecorder(
    	{
	        host : "<?=site_url('/list/file_comp/sv_aud')?>"+"/"+send_name ,
	        recorderlayout_id : 'fl_rc',
	        recorder_id : 'audiorecorder',
	        recorder_name: 'audiorecorder',
	        wmode : 'transparent',
	        bgcolor: '#ff0000',
	        swf_path :"<?=base_url('js_trd/jRecorder.swf')?>",
	        callback_started_recording:     function(){callback_started(); },
	        callback_stopped_recording:     function(){callback_stopped(); },
	        callback_activityLevel:          function(level){callback_activityLevel(level); },
	        callback_activityTime:     function(time){callback_activityTime(time); },
	        callback_finished_sending:     function(time){ callback_finished_sending(); }
    	}

   );
	//jrecord
 $('#record').click(function(){

                      $.jRecorder.record(30);

                  });

$('#stop').click(function(){

                     $.jRecorder.stop();

                  });

$('#send').click(function(){


                     var t=setTimeout(function(){file_comp();subiendo();},2000);
                     $.jRecorder.sendData();


                  });

}

    //comprueba archivo.
    function file_comp()
    {

      var url_req;
        url_req=<?='"'.site_url('list/file_comp/check').'"'?>+"/"+file_hash;
    	var request2 = $.ajax({
            url: url_req,
            type: "GET",
            data: ""
            });
	request2.done(function(msg) {
    if(msg==1){
    	aufile=file_hash+".wav";
            actualizar();
            ready_salve=true;
            next(5);
            limpiar_mensaje();
          }else{
            if (compovar<3) {
              setTimeout(function(){file_comp();},2000);
            } else{
              aufile=0;
              limpiar_mensaje();
              next(5);
            }

          }
            });
  request2.fail(function(jqXHR, textStatus) {
          alert( "Request failed: " + textStatus );
                  });
  }
  //crea una secuencia ,para nombres.
function hashname(){

  var stamp= new Date();
  var char_time= stamp.getTime().toString();
  var a=65+Math.floor(Math.random()*25);
  var b=97+Math.floor(Math.random()*25);
  var c=65+Math.floor(Math.random()*25);
  var d=97+Math.floor(Math.random()*25);
  var arx=String.fromCharCode(a,b,c,d)+char_time;

  return arx;

}
function actualizar()
{

	//$("#titulo_d").text(titulo);
	if (description!=undefined) {
		//$("#descript_d").text(description);
		$('div#description-value').html('<blockquote>'+description+'</blockquote>');
	}
	$('div#title-div').html('<h2>'+titulo+'</h2>');
	$("#categ_d").text(categoria);

}
  //upload foto
  function upl_machine(){
    var botn=$('#jquery-uploader');
    var uploader_ent=new qq.FineUploaderBasic(
    	{
      		button:$('#jquery-uploader')[0],
			request: {
			endpoint: '<?=site_url("list/file_comp/upload_pic") ?>'
			},
 			validation: {
				allowedExtensions: ['jpeg', 'jpg', 'gif', 'png'],
				sizeLimit: 1204 * 1024 // 1 MB = 1204 * 1024 bytes
			},
			callbacks:{
				onComplete: function(id, fileName, responseJSON) {
  									if (responseJSON['success']) {

	   									imgfile=responseJSON['filename'];
	   									srcUrl="<?=base_url('upload').'/'?>"+imgfile;
	 		 							usrd=responseJSON['usr'];
	  									actualizar();
	  									ready_salve=true;
	  									limpiar_mensaje();
	  									$('div#img-div').html('<img src="'+srcUrl+'">');
  										launch_msj($('div#mensaje'),"Imagen subida",'ok');
  										$('div#mensaje-img').html('');
  										$('#modal-image').modal('hide') ;
  									} else{
  										alertBox.alert_error($('#mensaje-img'),"Error al subir archivo");
  									};
								},
 				onSubmitted: function (id, name) {
  								load_bar($('div#mensaje-img'));
        				}
        }
		});
  }
  // inicio editor de texto
  function editor_build(){

   editor=new nicEditor().panelInstance('text_item');

  }
  // guadamos todos los datos.
function guardar()
{
  if(imgfile==="no seleccionada"){imgfile=0;}
    if(aufile==="no seleccionada"){aufile=0;}

   var url_req;

        url_req="<?=site_url('/arxivar/new_item')?>";
           dates={
                  'id_u':usrd,
                  'tlt':titulo,
                  'dcp':description,
                  'catg':cat_val,
                  'lat':latitud,
                  'lon':longitud,
                  'icon':ico_sel,
                  'fil_a':imgfile,
                  'fil_s':aufile,
                  'vid':video_cont,
                  'text_h':text_hist
           			}
    var request2 = $.ajax({
            url: url_req,
            type: "POST",
            data: dates
            });

  request2.done(function(msg) {

            if(msg>0){
              //launch_msj("datos Guardados");
              $('.form_card').html('');
              $('#final_adv').css('display','block');
            }else{
              launch_msj($('div#mensaje'),"<?=$this->lang->line('s_new_bad')?>",'error');

            }
            });
  request2.fail(function(jqXHR, textStatus) {
          alert( "Request failed: " + textStatus );
                  });
}
function comp_final(){
  if(ready_salve){
  guardar();
}else{
  launch_msj($('div#mensaje'),"<?=$this->lang->line('s_new_err6') ?>",'error');
}
}
// ejecuta el mensaje
function launch_msj(t,b,s){

  if (s==='error') {
            alertBox.alert_error(b,t);

  }else{
            alertBox.alert_success(b,t);
  }

  window.location.hash = '#'+b.attr('id');
}
function load_bar(block){
	alertBox.loading_bar(block);
}
function limpiar_mensaje(){
  $('#mensaje').html('');
}
function cancel_h(){
  next(0);
   window.location.hash = '#section_p';
}
  //upload audio
  function upl_machine_aud(){
    var botn2=$('#aud-uploader');
    var uploader_ent2=new qq.FineUploaderBasic({
      	button:$('#aud-uploader')[0],
		request: {
			endpoint: '<?=site_url("list/file_comp/upload_audio") ?>'
		},
		 validation: {
			allowedExtensions: ['wav'],
			sizeLimit: 7400000 // 200 kB = 200 * 1024 bytes
		}
		,callbacks:{
			onComplete: function(id, fileName, responseJSON) {
		  	aufile=responseJSON['filename'];
			usrd=responseJSON['usr'];
			actualizar();
			ready_salve=true;
			limpiar_mensaje();
			next(5);
			if (responseJSON['status']) {} else{};
		},
		onSubmitted: function (id, name) {
			subiendo();
		        }}
	});
  }

  // JRecorder.
	function callback_finished()
	{

	  $('#status').html('Recording is finished');

	}

	function callback_started()
	{

	  $('#status').html('Recording is started');

	}

	function callback_error(code)
	{
	  $('#status').html('Error, code:' + code);
	}

	function callback_stopped()
	{
	  $('#status').html('Stop request is accepted');
	}

	function callback_finished_recording()
	{

	  $('#status').html('Recording event is finished');

	}

	function callback_finished_sending()
	{

	  $('#status').html('File has been sent to server mentioned as host parameter');

	}

	function callback_activityLevel(level)
	{

		$('#level').html(level);
		if(level == -1)
		{
			$('#levelbar').css("width",  "2px");
		}
		else
		{
		 	$('#levelbar').css("width", (level * 2)+ "px");
		}


	}

	function callback_activityTime(time)
	{

		//$('.flrecorder').css("width", "1px");
		//$('.flrecorder').css("height", "1px");
		$('#time').html(time);

	}
  function change_child(c)
 {
	  $('#select_child').html(jSon_child[c]);
	  $('#ico_cont').html("<img src=\"<?=base_url('img')?>/"+jSon_icon[c]+"\">");
	  ico_sel= jSon_icon[c];
 }