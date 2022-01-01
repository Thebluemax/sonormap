/**
 * Sonormap
 *
 * An open source application for archive sounds for the education and history
 * of a City or region, Develop in Codeigniter framework for PHP 5.1.6 or newer
 *
 * @package   Sonormap
 * @author    Maximiliano Fernández - @mxml13
 * @copyright under GNU/GPL licence 2013.
 * @license   http://  /license.html
 * @link    http://
 * @since   Version 0.0
 * @filesource  /js/
 */
var activeInfo;
 var json_l;
 var json_s;
 var slide_flag=true;
 //var loader='<img src=\"<?=$this->config->item("pre_gif")?>\" alt>"';
 var cont_search=$('#histories');
 var move=false;
 var flag=false;
 change_child('Vida');
 var map;
var alertBox= new AlertHolder();
var sideBar;
 $(document).ready(function()
 {
 	int();
 });
 function int()
 {
 	$.getJSON("<?=site_url('list/json_list/standar_rq')?>").done(function(data){

 	json_l=data;
 	do_map();
 		//Copiamos el Json para las busquedas
 	json_s=data;
 	//sideBar=new slideBar($('div#asd_sld'),data);
 	//sideBar.build();

 	//slide_bar();
          });
 	$('#entry-list-old').click(function  () {
 		//$('#asd_sld').slideToggle();
 		//if($('#searcher').css('display')!='none'){
 		//	$('#searcher').slideToggle();
		//}
                //preventDefault();
              $('#listModal').modal('show');
            });

 	$('#srch-btn').click(function  () {
 		$('#searcher').slideToggle();
	//if($('#asd_sld').css('display')!='none'){
 			//$('#asd_sld').slideToggle();
		//}
                //preventDefault();
            });

 	$('#select_opt').change(function(event){
 		$('#select_opt option:selected').each( function()
 			{
 				change_child($(this).text());
 			});
 	});
 	//Activando los tool tips para las historias.
 	$('[data-toggle="tooltip"]').tooltip();

 	$('button.btn-search').click(function  (e) {
 		e.preventDefault();
 		buscar($(this).data('search'));
  	});
 	// Restauración de todas las marcas en el mapa.
 	$('#rst').click(function  (e) {
 		e.preventDefault();
 		//map.restore_marks();
 		map.clear_marks();
 		marks(json_l.data);
 		sideBar=new slideBar($('div#asd_sld'),json_l);
 		sideBar.build();
  });
 	pointer_active();
 	$( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      altField: "#date-to-db",
      altFormat: "yy-mm-dd"
    }).datepicker('widget').wrap('<div class="ll-skin-lugo"/>');
 }

function pointer_active () {
	if (activeInfo != undefined) {
		map.close_info(activeInfo);
	}
	$('a.map-pointer').click(function(event){
 		event.preventDefault();
 		map.one_mark($(this).data('ref'));
 		activeInfo = $(this).data('ref');
 		$('#listModal').modal('hide');
 	});
}
 function change_child(c)
 {
 	$('#select_child').html(jSon_child[c]);
 }
  // slide.
  function slide_bar(){
  	var ancho_cont;
  	var ancho_slide;
  	var mo_barra=$('.itm_slc_bx').width();
  	$('.flecha').click(function(event){
  		event.preventDefault();
  		ancho_cont=$('div#histories').width();
  		ancho_slide=$('#slc_itm_cont').width();

  		if($(this).hasClass('izq')){
  			m_barra=true;
  		}else{
  			m_barra=false;
  		}
  		flag=true;
  		move_bar(m_barra,ancho_slide,ancho_cont,mo_barra);
  	});
}

//para eliminar ya que tenemos otra opción
function move_bar(m_barra,ancho_slide,ancho_cont,mo_barra){
	var dif_brr=ancho_slide-ancho_cont;
	var pos=$('#slc_itm_cont').offset();
	var pos_l= pos.left;
	//console.log('pp'+ancho_slide+"//"+ancho_cont);
	var  pos_s=pos_l;
	if(m_barra==true )
	{
		pos_s=pos_l-(mo_barra*2);
	}else {
		pos_s=pos_l+(mo_barra*2);
	}
	if (pos_s>0)
	{
		pos_s=0;
	};
	if (pos_s<ancho_cont-ancho_slide)
	{
		pos_s=ancho_cont-ancho_slide;
	};
	var time_a=700;
	$('#slc_itm_cont').animate({left:pos_s},time_a);
}
//Crea el mapa y las marcas de posición.
function do_map()
{
	map= new Gmaps('map',{lat: 41.97, lng: 2.78},15);
			marks(json_l.data);
}
//Dibuja las marcas en el mapa
function marks(j){
	var json = j;

	for (var i = 0; i < json.length; i++) {
		var texto = parseHtml(json[i], i);
		var lat_l = parseFloat(json[i].latitud);
		var lon_l = parseFloat(json[i].longitud);
		var title = json[i].titulo;
		//console.log(json[i].ico_punt + " - " + lon_l);
		var ico_png = "<?= base_url('/img')."/"?>" + json[i].ico_punt;
		map.add_mark({lat: lat_l, lng: lon_l}, ico_png, true, texto, title);
	};
}
function parseHtml(obj, pos) {

	// $url_tlt=$res[$i]['titulo'];
    var texto_html='<div class="" style="width:250px;overflow:hidden">'
    +'<div class="panel panel-default"><div class="panel-body">';
    texto_html +='<figure><img src="' + '<?= base_url("/upload/thumb")."/";?>' + obj.file_image
    + '"></figure>';
    texto_html +='<a style="color:orange;background:rgba(0,0,0,.5);width:100%;display:block" href="'
     +'<?= site_url("historia")."/";?>'+obj.url+'" title="'
     + obj.titulo + '"><h4 class="ttl">'+ obj.titulo +'</h4></a>';

    texto_html +='</div> </div></div>';

    return texto_html;
}

function buscar(r){
	alertBox.loading_bar($('#asd_sld'));
	var serc_w='';
	var searc_t=';'
	switch(r){
		case 'palabras':
		searc_w=$('#palabra').val();
		searc_t=1;
		break;
		case 'categorias':
		searc_w=$('#subcateg').val();
		searc_t=2;
		break;
		case 'iconos':
		searc_w=$("input[type='radio'][name='bs_ico']:checked").val();
		searc_t=3;
		break;
		case 'fechas':
		searc_w=$("select[name='anio']").val()+'-'+$("select[name='mes']").val()+'-'+$("select[name='dia']").val();
		searc_t=4+$("input[name='termino']").val();
		break;
	}
	var dato={
		tipo:searc_t,
		termino:searc_w
	};
	var url_req="<?=site_url('list/search/html')?>";
	var request2 = new AjaxRq (url_req, doneResquest, dato);
}
function doneResquest (msg) {
		if(msg!=0){
			//console.log(msg);
			map.clear_marks();
			marks(msg.data);
			//$('div#panel-info').html(msg);
			//$('div#asd_sld').html(msg);
			pointer_active();
			//marker_searc(dato);
			sideBar=new slideBar($('div#asd_sld'),msg);
 			sideBar.build();
		}else{
			alertBox.alert_error($('div#panel-info'),"<?= $this->lang->line('s_bsq_error');?>");
		}
     }

function marker_searc (a) {
	var  url_req="<?=site_url('list/search/json_r')?>";
	var request2 = $.ajax({
		url: url_req,
		type: "POST",
		data: a

	});

	request2.done(function(msg) {
		if(msg!=0){
			json_s=msg;
			//mapa_do();
		}else{

		}
	});
	request2.fail(function(jqXHR, textStatus) {
		alert( "Request failed: " + textStatus );
	});
}

var slideBar=function (b,d) {
	this.block=b;
	this.contStr='';

	var starStr = "<div id=\"slc_itm_cont\">";
	var boxItm = "<div class=\"itm_slc_bx panel panel panel-default\">";
	var boxClose = "</div>";
	for (var i = d.data.length - 1; i >= 0; i--) {
	var boxBody = "<div class=\"panel-body bx-item\" data-toggle=\"tooltip\" data-placement=\"bottom\" "
	+" title=\"\" data-original-title=\"\">"
	+"<img src=\"<?= base_url('/upload/thumb').'/';?>"+d.data[i].file_image+"\" alt=\"\" width=\"100%\"></div>";
	var footerBox = '<div class="panel-footer"><ul class="btn-group btn-group-justified">'+
					'<a href="/historia/'+ d.data[i].url + '" class="btn btn-primary" >' +
					'<span class="glyphicon glyphicon-plus"></span></a>' +
					'<a href="" class="btn btn-primary map-pointer" data-ref="'+ i +
					'"><span class="glyphicon glyphicon-map-marker"></span></a></ul></div>';
	var titleBox = "<div class=\"panel-heading\">"+d.data[i].titulo+"</div>";
	this.contStr += boxItm + titleBox + boxBody + footerBox + boxClose;
	}
	var endStr="</div>";
	this.contStr=starStr+this.contStr+endStr;
}
slideBar.prototype.build = function() {
	this.block.html(this.contStr);
	this.widthHolder=this.block.width();
	this.widthSlide=this.block.children().width();
	//console.log(this.widthSlide+"/"+this.widthHolder);
	pointer_active();

};
slideBar.prototype.move = function(first_argument) {
	// body...
};
slideBar.prototype.getString = function() {
	return this.contString;
};