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
 * @filesource  /js/admin-enjine
 */
var tl_ly;
var desc;
var control;
var cards;
var ready_salve;
var ico_sel;
// var
var editor="sin datos";
var titulo;
var indice;
var description;
var categoria;
var cat_val;
var latitud;
var longitud;
var boundsMap;
var text_hist;
var loader='<img src=\"<?=base_url("")."/".$this->config->item("pre_gif")?>\" alt="">';
/**
 * crea el mapa de posicionamiento de la historia.
 *
 */
 $(document).ready(function(){
  init();
});
//inicio.
function init() {
  ready_salve=false;
 /*tl_ly=$('#titol');
 desc=$('#description');
 lat_ly=$("#lat_d");
 lon_ly=$("#lon_d");
 lat_in=$('#lat');
 lon_in=$('#lon');
 control=$('.itm_sta');
 cards=$('.form_card');*/
 <?php if ($level==1):?>
 //indice=new Pagination($('#cont_scroll_2'),4);
// indice.build_list('a');
// indice.paginationBoton();
 //indice.showList();

 //indice1=new Pagination($('#cont_scroll'),4);
// indice1.build_list('a');
// indice1.paginationBoton();
 //indice1.showList();

 <?php endif;?>
 <?php if ($level==2):?>

 <?php endif;?>
<?php if ($level==3):?>
 //indice1=new Pagination($('#cont_scroll'),4);
 //indice1.build_list('a');
 //indice1.paginationBoton();
// indice1.showList();

// indice.build_list('a');
// //indice.showList();
 <?php endif;?>

               $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });

            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
            var doughnutData = [
											{
												value: 60,
												color:"#68dff0"
											},
											{
												value : 40,
												color : "#444c57"
											}
										];
										var myDoughnut = new Chart(document.getElementById("serverstatus02").getContext("2d")).Doughnut(doughnutData);
 }

function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
//creamos el mapa
/**function do_mapa() {
$("#map").gMap({latitude: latitud,
                        longitude: longitud,
                        maptype:google.maps.MapTypeId.HYBRID,
                        zoom:15
                    });

 $("#map").gMap('addMarker', { latitude: latitud, longitude: longitud , icon: {
                image: icon_png,
                iconsize: [36, 52],
                //iconanchor: [12,46],
                infowindowanchor: [12, 0]
            }});
}**/

 function clear_marks()
  {
    $("#choose_map").gMap("removeAllMarkers");
     latitud=0.0;
      longitud=0.0;
      lat_in.val('');
      lon_in.val('');

  }
  //comprobaciones del mapa
  function ver_art(d) {
   $('#reader').css('display','block');
   url="<?=site_url('list/item_respose/get_adm').'/'?>"+d;
   $.get(url, function(data) {
$('#cont').html(data);
do_mapa();
});
  }


// valida el archivo -admin.
 function val_itm(r,e)
    {
    //alert( e.currentTarget);
      var url_req;
        url_req=<?='"'.site_url('administracio/validar').'"'?>+"/"+r;
        lanzar_mensaj(loader);
    var request3 = $.ajax({
            url: url_req,
            type: "GET",
            data: ""
            });
  request3.done(function(msg) {
            if(msg>0){
              var nom="#art_"+r;
              $(nom).remove();
               lanzar_mensaj(" Entrada validada.");
               //loader de mails
              // send_mass_mail();
               $.get( "<?=site_url('administracio/send_mass')?>/"+r, function( data ) {
                          if (data==1) {
                                lanzar_mensaj("Missatges enviats");
                          }else{
                              lanzar_mensaj("<?=$this->lang->line('s_adm_erj')?>");
                          }
                                                             });
            }else{
              lanzar_mensaj("<?=$this->lang->line('s_adm_erj')?>");
            }
            });


  request3.fail(function(jqXHR, textStatus) {
          alert( "Request failed: " + textStatus );
                  });
  }

  // inicio editor de texto

  // contactar user.
function contactar_user(u)
{
 console.log(u);
 $('#id_user').val(u);
 $('#for_use').slideDown(1000);
}
function env_mail(){
    var url_req;

        url_req="<?=site_url('administracio/mail_user')?>";
           dates={
                  'us':$('#id_user').val(),
                  'msj':$('#msj').val()

           }

    var request2 = $.ajax({
            url: url_req,
            type: "POST",
            data: dates
            });

  request2.done(function(msg) {
   // cerrar();
            if(msg.succes!==false){
              lanzar_mensaj("<?=$this->lang->line('s_adm_mes')?>");
            }else{
              lanzar_mensaj("<?=$this->lang->line('s_adm_men')?>");

            }
            });
  request2.fail(function(jqXHR, textStatus) {
          alert( "Request failed: " + textStatus );
                  });
}
// ejecuta el mensaje
function lanzar_mensaj(t){
$('#mensaje').html(t).css('display','block').fadeOut(5000);
}
//cierra la ventana de control
  function cerrar() {
    $('#reader').css('display','none');
  }
  function ver_user(u)
{

   var url_req;

        url_req="<?=site_url('administracio/ver_user')?>";
           dates={
                  'usr':u

           }

    var request2 = $.ajax({
            url: url_req,
            type: "POST",
            data: dates
            });

  request2.done(function(msg) {
            if(msg.succes!=='false'){
              msg=msg[0];
              $('#usr_alias').html(msg.alias_usuario);
               $('#usr_nom').html(msg.nombre);
                $('#usr_cog').html(msg.apellido_1+" "+msg.apellido_2);
                 $('#usr_avt').html(msg.avatar);
                  $('#usr_rol').html(msg.rol);
                   $('#usr_dob').html(msg.dat_nacimiento);
                    $('#usr_mail').html(msg.mail);
                    $('#reader').slideDown();
            }else{
              lanzar_mensaj("<?=$this->lang->line('s_adm_meu')?>");

            }
            });
  request2.fail(function(jqXHR, textStatus) {
          alert( "Request failed: " + textStatus );
                  });
}
//BLoqueo de usuario.
function block_user(u,e)
{
var url_req;

        url_req="<?=site_url('administracio/block_user')?>";
           dates={
                  'us':u

           }

    var request2 = $.ajax({
            url: url_req,
            type: "POST",
            data: dates
            });

  request2.done(function(msg) {
            if(msg.succes!=='false'){
                     var box='#art_'+u;
                     $(box).fadeOut(3000);
                    lanzar_mensaj("<?$this->lang->line('a_adm_mud')?>");

            }else{
              lanzar_mensaj("<?=$this->lang->line('a_adm_erj')?>");

            }
            });
  request2.fail(function(jqXHR, textStatus) {
          alert( "Request failed: " + textStatus );
                  });
}

function unblock_user(u,e)
{
var url_req;

        url_req="<?=site_url('administracio/unblock_user')?>";
           dates={
                  'us':u

           }

    var request2 = $.ajax({
            url: url_req,
            type: "POST",
            data: dates
            });

  request2.done(function(msg) {
            if(msg.succes!=='false'){
                     var box='#art_'+u;
                     $(box).fadeOut(3000);
                    lanzar_mensaj("<?=$this->lang->line('a_adm_mua')?>");

            }else{
              lanzar_mensaj("<?=$this->lang->line('a_adm_erj')?>");

            }
            });
  request2.fail(function(jqXHR, textStatus) {
          alert( "Request failed: " + textStatus );
                  });
}
function conf_user(u)
{
   var url_req;

        url_req="<?=site_url('administracio/val_user')?>";
          dates={
                  'us':u

           }

    var request2 = $.ajax({
            url: url_req,
            type: "POST",
            data: dates
            });

  request2.done(function(msg) {
            if(msg.succes!=='false'){
                     var box='#usr_'+u;
                     $(box).fadeOut(3000);
                    lanzar_mensaj("<?=$this->lang->line('s_adm_mua')?>.");

            }else{
              lanzar_mensaj("<?=$this->lang->line('a_adm_erj')?>");

            }
            });
  request2.fail(function(jqXHR, textStatus) {
          alert( "Request failed: " + textStatus );
                  });
}
function errase_h(h)
{
var id='#art_'+h+'>p>.titulo';
var nom=$(id).text();
  if(confirm('¿Quieres eliminar la história '+nom+'?'))
  {
     var url_req;

        url_req="<?=site_url('eliminar')?>";
          dates={
                  'elim_v':h

           }

    var request2 = $.ajax({
            url: url_req,
            type: "POST",
            data: dates
            });

  request2.done(function(msg) {
            if(msg==1){

                    lanzar_mensaj("Entrada eliminada");
                    $('#art_'+h).fadeOut(600)

            }else{
              lanzar_mensaj("No se ha podido eliminar la entrada");

            }
            });
  request2.fail(function(jqXHR, textStatus) {
          alert( "Request failed: " + textStatus );
                  });
  }
  else
  {
    return false;
  }

}
//Bliquea una historia
function block_hist(h)
{

      var url_req="<?=site_url('administracio/bloq_hist')?>";
          var  dates={
                  'hist':h

           }

    var request2 = $.ajax({
            url: url_req,
            type: "POST",
            data: dates
            });

  request2.done(function(msg) {
            if(msg.succes!=='false'){
                     var box='#art_'+h;
                     $(box).fadeOut(3000);
                    lanzar_mensaj("<?=$this->lang->line('a_adm_erd')?>");

            }else{
              lanzar_mensaj("<?=$this->lang->line('a_adm_erj')?>");

            }
            });
  request2.fail(function(jqXHR, textStatus) {
          alert( "Request failed: " + textStatus );
                  });
  function mass_mail(d)
{
   var url_req;

        url_req="<?=site_url('administracio/send_mass')?>";
          dates={
                  'url_d':d

           }

    var request2 = $.ajax({
            url: url_req,
            type: "POST",
            data: dates
            });

  request2.done(function(msg) {
            if(msg.succes!=='false'){
                     var box='#usr_'+u;
                     $(box).fadeOut(3000);
                    lanzar_mensaj("<?=$this->lang->line('a_adm_mua')?>");

            }else{
              lanzar_mensaj("<?=$this->lang->line('a_adm_erj')?>");

            }
            });
  request2.fail(function(jqXHR, textStatus) {
          alert( "Request failed: " + textStatus );
                  });
}
}