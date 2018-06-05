	var alertBox= new AlertHolder();
 $(document).ready(function(){
  init();
});
function init()
{
	var	indice=new Pagination($('#cont_scroll_2'),4);
	indice.build_list('a');
	indice.paginationBoton();
	indice.showList();

	var indice1=new Pagination($('#cont_scroll'),4);
	indice1.build_list('a');
	indice1.paginationBoton();
	indice1.showList();

	$('button#validation').click(function (e) {
		var rf=$(this).data('ref');
		val_itm(rf);

               });
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

										var myDoughnut = new Chart(document.getElementById("serverstatus02").getContext("2d")).Doughnut(doughnutData);
//    tool tips

    $('.tooltips').tooltip();

//    popovers

    $('.popovers').popover();



// custom bar chart

    if ($(".custom-bar-chart")) {
        $(".bar").each(function () {
            var i = $(this).find(".value").html();
            $(this).find(".value").html("");
            $(this).find(".value").animate({
                height: i
            }, 2000)
        })
    }

}
var ajaxR=function (u,d,f,bm) {

	var req = $.ajax({
            url: u,
            type: "POST",
            data: d
            });
	req.done(f);
	req.fail(function(jqXHR, textStatus) {
          alert( "Request failed: " + textStatus );
                  });

}
function validationCallBack(m) {

	if(m >0){

             //  lanzar_mensaj(" Entrada validada.");
               //loader de mails
              // send_mass_mail();
              return msg;

            }else{
              lanzar_mensaj("<?=$this->lang->line('s_adm_erj')?>");
              return false;
            }

}
function val_itm(r)
    {
	    //alert( e.currentTarget);
	    var u=<?='"'.site_url('administracio/validar').'"'?>+"/"+r;
	    // lanzar_mensaj(loader);
	    var ajx= new ajaxR(u,'',validationCallBack,'bm');
	    console.log(ajx);
	}
