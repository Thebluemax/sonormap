
/*$(document).ready(function  () {
	map= new Gmaps('map',{lat: -34.397, lng: 150.644});
	map.add_mark({lat: -34.397, lng: 150.644});
	map.map.addListener('click',function  (e) {
		console.log('ok'+e.latLng);
		map.add_mark(e.latLng);
		map.panTo(e.latLng);
	});
	//$('#map').click();
});*/

var Gmaps=function (d,l,z) {
	// Lista de marcas
	this.mList=[];
	this.center=l;
	//lista de infowindows
	this.mInfo=[];
	this.map = new google.maps.Map(document.getElementById(d), {
	    center:l ,
	    scrollwheel: false,
	    zoom: z
	});
}

Gmaps.prototype.add_mark = function(p,i,f,info=0,title) {
  var pointer;
 var image = {
    url: i,
    // This marker is 20 pixels wide by 32 pixels high.
    size: new google.maps.Size(25, 32),
    // The origin for this image is (0, 0).
    origin: new google.maps.Point(0, 0),
    // The anchor for this image is the base of the flagpole at (0, 32).
    anchor: new google.maps.Point(0, 32)
  };
	var marker = new google.maps.Marker({
   	position: p,
   icon: image,
   title:title
});
	this.mList.push(marker);
  pointer=this.mList.length-1;
  this.mList[this.mList.length-1].setMap(this.map);
  if (f==true) {
    var infowindow = new google.maps.InfoWindow({
    content: info
  });
    this.mInfo.push(infowindow);
    var i=this.mInfo[this.mInfo.length-1];
    var l=this.mList[this.mList.length-1];
    var m=this.map ;
    this.mList[this.mList.length-1].addListener('click',function  () {

      i.open(m,l );
    });


  };

};
Gmaps.prototype.panTo = function(p) {
	this.map.panTo(p);
};
Gmaps.prototype.choosePoint = function() {
  this.map.addListener('click',this.getPoint);
};
Gmaps.prototype.getPoint = function(i) {
  this.mList[i].setMap(this.map);
};
Gmaps.prototype.view_marks = function (f) {


  for (var i = 0; i < this.mList.length; i++) {
  	if (f==true) {
    	this.mList[i].setMap(this.map);
  	} else{
    	this.mList[i].setMap(null);
  	};
  }
};

Gmaps.prototype.close_info = function(i) {
	this.mInfo[i].close();
};

Gmaps.prototype.one_mark = function (i) {
	this.view_marks(false);
	this.mList[i].setMap(this.map);
	this.mInfo[i].open(this.map,this.mList[i]);
	this.map.setZoom(19);
	var l=this.mList[i].getPosition();
	var lat=l.lat();
	var lng=l.lng();
	//console.log(new google.maps.LatLng(lat, lng));
	this.map.panTo(new google.maps.LatLng(lat, lng));

};
Gmaps.prototype.clear_marks = function () {
  for (var i = 0; i < this.mList.length; i++) {
    	this.mList[i].setMap(null);
  }
  this.mList=[];
};
Gmaps.prototype.restore_marks = function () {
  for (var i = 0; i < this.mList.length; i++) {
    	this.mList[i].setMap(this.map);
  }
 this.map.setCenter(this.center);
 this.map.setZoom(15);
};