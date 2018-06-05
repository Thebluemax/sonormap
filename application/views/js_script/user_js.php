$(document).ready(function  () {
	var user_list;
	init();
});

function init () {

	var pag = new Pagination($('#user-list'),5);
	pag.build();
	pag.showList();
	pag.paginationBoton();
	userMap= new Gmaps('user-map',{lat: 41.97, lng: 2.78},13);
	$.getJSON("<?=site_url('list/json_list/user_list')?>").done(function(data){
 		user_list=data;
		marks();
          });

	$('table#user-list>tbody>tr').hover(inLine,outLine);
}
function inLine () {
	var i=$('table#user-list>tbody>tr').index($(this));
	userMap.mList[i].setAnimation(google.maps.Animation.BOUNCE);

}
function outLine () {
	var i=$('table#user-list>tbody>tr').index($(this));
	userMap.mList[i].setAnimation(null);
}
function marks(){
	for (var i = 0; i < user_list.length; i++) {
		var texto=user_list[i]['html'];
		var lat_l=parseFloat(user_list[i]['latitude']);
		var lon_l=parseFloat(user_list[i]['longitude']);
		var ico_png=user_list[i]['icon'];
		userMap.add_mark({lat: lat_l, lng: lon_l},user_list[i]['icon'],true,texto);
	};
}