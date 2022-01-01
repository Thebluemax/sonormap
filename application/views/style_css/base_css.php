*{ 	margin:0px 0px;
 	padding:0px 0px;
 }
 html,body
 {
  height:100%;
 }
 body
 {
    background-attachment: fixed;
    background-image: url('<?=base_url('img/pattern006-light.png') ?>');
    margin:0px 0px;
    width:100%; 
 }
 section {
 }
 #main_box
 {  
    /*background-color: #f5f5f5;*/
    min-height:100%;
    width:100%;
 }
 #main
 {
   overflow:auto;
 }
 a
 {
    text-decoration: none;
 }
/*#header_p
 {
    background: -webkit-linear-gradient(bottom, rgb(255,207,137) 6%, rgba(250,250,250,.6) 80%);
     background: -moz-linear-gradient(bottom, rgb(255,207,137) 6%, rgba(250,250,250,.6) 80%);
     background: -o-linear-gradient(bottom, rgb(255,207,137) 6%, rgba(250,250,250,.6) 80%);
     background: -ms-linear-gradient(bottom, rgb(255,207,137) 6%, rgba(250,250,250,.6) 80%);
     background: linear-gradient(bottom, rgb(255,207,137) 6%, rgba(250,250,250,.6) 80%);
     background: -webkit-gradient(
     linear,
     left bottom,
     left top,
     color-stop(0.6, rgb(255,207,137)),
     color-stop(0.8, rgba(250,250,250,.5))
     );
     -webkit-box-shadow: 0px 0px 10px #000;
     box-shadow: 0px 0px 10px #000;
     padding: 10px 0px 0px 40px;
 }*/
 
 #header_h1
 {
    display:inline-block;
    padding-left:10px;
    vertical-align: top;
    width:25%;
 }
 #header_h1 h1, #header_h1 h2,#header_log label
 {
    display:none;
 }
  #header_h1 img
 {
    width:100%;
 }
 nav
 {
    padding-top: 20px;
 }
 
 div#header_user{
    border-top:1px solid orange;
    color:#081745;
    font-size:12px;
    width: 500px;
 }
div#header_user a
{
    font-size: 12px;
}

  /*user log block*/
 
 
 #bot_sub {
    margin-left: 10px;
    vertical-align: top;
}
#bot_sub a {
    color: #C1640F;
    font-size: 8pt;
    text-decoration: underline;
}
div#slide{
    border-top: .5px solid #000;
    margin-top: 20px;
    position:relative;
    height:auto;
    padding-bottom:20px;
    
}
 #slide_holder {
  width:100%;overflow:hidden;
  height:160px;
  margin:20px 0px 20px 0px;
  position:relative;
   
 }
 button.close{
 color:#777;
 }
div#slide > figure
{
     -webkit-box-shadow: 0px 0px 10px #000;
    box-shadow: 0px 0px 10px #000;
    width:100%;
    height:160px;
    margin: 0px 0px;
    overflow:hidden;
}
.slide_img
{
    width:100%;
    position:absolute;
    top:0px;
}
.cap_slide
{
    bottom:0px;
    color:#fff;
    height:120px;
    font-size: 4em;
    padding-right: 50px;
    position:absolute;
    text-align:right;
    width:90%;
}
#inst_log 
{
    background-color: rgba(255, 255, 255, 0.6);
    margin-top: 50px;
    padding: 20px 0;
}
#inst_log > img
{
    width:60%;
    margin:0px 19%;
}
#sld_pnl
{
    text-align: right;
    padding:0px 15px;
}
.bt_sl{
    display:inline-block;
    height:15px;
 }
.sld_bd img
{
    display:inline;
    margin-left:10px;
    cursor:pointer;
}
.sld_bd img:hover
{
    box-shadow: 2px 2px 3px #777;
    cursor:pointer;
}

 /**
  * Estilos para el sticky footer
  */
 
 #sonor{
  text-align: left;

 }
 #sonor a{
    color: #881010;
    display: block;
    font-size: 7px;
    padding: 7px;
 }
 #footer{
    margin-bottom:-70px;
 }
 /*
 * 
 //*/

 #ui-datepicker-div{
  background-color:rgba(255,255,255,.8);
}
.ui-datepicker {
    display: none;
    padding: 0.2em 0.2em 0;
    width: 17em;
}
.ui-datepicker .ui-datepicker-header {
    padding: 0.2em 0;
    position: relative;
}
.ui-datepicker .ui-datepicker-prev, .ui-datepicker .ui-datepicker-next {
    height: 1.8em;
    position: absolute;
    top: 2px;
    width: 1.8em;
}
.ui-datepicker .ui-datepicker-prev-hover, .ui-datepicker .ui-datepicker-next-hover {
    top: 1px;
}
.ui-datepicker .ui-datepicker-prev {
    left: 2px;
}
.ui-datepicker .ui-datepicker-next {
    right: 2px;
}
.ui-datepicker .ui-datepicker-prev-hover {
    left: 1px;
}
.ui-datepicker .ui-datepicker-next-hover {
    right: 1px;
}
.ui-datepicker .ui-datepicker-prev span, .ui-datepicker .ui-datepicker-next span {
    display: block;
    left: 50%;
    margin-left: -8px;
    margin-top: -8px;
    position: absolute;
    top: 50%;
}
.ui-datepicker .ui-datepicker-title {
    line-height: 1.8em;
    margin: 0 2.3em;
    text-align: center;
}
.ui-datepicker .ui-datepicker-title select {
    font-size: 1em;
    margin: 1px 0;
}
.ui-datepicker select.ui-datepicker-month, .ui-datepicker select.ui-datepicker-year {
    width: 45%;
}
.ui-datepicker table {
    border-collapse: collapse;
    font-size: 0.9em;
    margin: 0 0 0.4em;
    width: 100%;
}
.ui-datepicker th {
    border: 0 none;
    font-weight: bold;
    padding: 0.7em 0.3em;
    text-align: center;
}
.ui-datepicker td {
    border: 0 none;
    padding: 1px;
}
.ui-datepicker td span, .ui-datepicker td a {
    display: block;
    padding: 0.2em;
    text-align: right;
    text-decoration: none;
}
.ui-datepicker .ui-datepicker-buttonpane {
    background-image: none;
    border-bottom: 0 none;
    border-left: 0 none;
    border-right: 0 none;
    margin: 0.7em 0 0;
    padding: 0 0.2em;
}
.ui-datepicker .ui-datepicker-buttonpane button {
    cursor: pointer;
    float: right;
    margin: 0.5em 0.2em 0.4em;
    overflow: visible;
    padding: 0.2em 0.6em 0.3em;
    width: auto;
}
.ui-datepicker .ui-datepicker-buttonpane button.ui-datepicker-current {
    float: left;
}
.ui-datepicker.ui-datepicker-multi {
    width: auto;
}
.ui-datepicker-multi .ui-datepicker-group {
    float: left;
}
.ui-datepicker-multi .ui-datepicker-group table {
    margin: 0 auto 0.4em;
    width: 95%;
}
.ui-datepicker-multi-2 .ui-datepicker-group {
    width: 50%;
}
.ui-datepicker-multi-3 .ui-datepicker-group {
    width: 33.3%;
}
.ui-datepicker-multi-4 .ui-datepicker-group {
    width: 25%;
}
.ui-datepicker-multi .ui-datepicker-group-last .ui-datepicker-header, .ui-datepicker-multi .ui-datepicker-group-middle .ui-datepicker-header {
    border-left-width: 0;
}
.ui-datepicker-multi .ui-datepicker-buttonpane {
    clear: left;
}
.ui-datepicker-row-break {
    clear: both;
    font-size: 0;
    width: 100%;
}
.ui-datepicker-rtl {
    direction: rtl;
}
.ui-datepicker-rtl .ui-datepicker-prev {
    left: auto;
    right: 2px;
}
.ui-datepicker-rtl .ui-datepicker-next {
    left: 2px;
    right: auto;
}
.ui-datepicker-rtl .ui-datepicker-prev:hover {
    left: auto;
    right: 1px;
}
.ui-datepicker-rtl .ui-datepicker-next:hover {
    left: 1px;
    right: auto;
}
.ui-datepicker-rtl .ui-datepicker-buttonpane {
    clear: right;
}
.ui-datepicker-rtl .ui-datepicker-buttonpane button {
    float: left;
}
.ui-datepicker-rtl .ui-datepicker-buttonpane button.ui-datepicker-current, .ui-datepicker-rtl .ui-datepicker-group {
    float: right;
}
.ui-datepicker-rtl .ui-datepicker-group-last .ui-datepicker-header, .ui-datepicker-rtl .ui-datepicker-group-middle .ui-datepicker-header {
    border-left-width: 1px;
    border-right-width: 0;
}
.ll-skin-lugo {
  font-size: 90%;
}

.ll-skin-lugo .ui-widget {
  font-family: "Helvetica","Trebuchet MS",Tahoma,Verdana,Arial,sans-serif;
  background: #1c1c1c;
  border: none;
  border-radius: 0;
  -moz-box-shadow: 0 0 3px #292c32; 
  -webkit-box-shadow: 0 0 3px #292c32;
  box-shadow: 0 0 3px #292c32;

}

.ll-skin-lugo .ui-datepicker {
  padding: 0;
}

.ll-skin-lugo .ui-datepicker-header {
  margin-top: 5px;
  font-size: 80%;
  border:none;
  border-top: 1px solid #000; /* stroke */
  border-bottom: 1px solid #000; /* stroke */
  background: #333; /* layer fill content */
  color: #fff; /* text color */
  font-size: 14px;
  font-weight: bold;
  text-shadow: 0 1px 2px rgba(0,0,0,.7); /* drop shadow */
  border-radius: 0;
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  -moz-box-shadow: inset 0 0 3px rgba(255,255,255,.1); /* inner glow */
  -webkit-box-shadow: inset 0 0 3px rgba(255,255,255,.1); /* inner glow */
  box-shadow: inset 0 0 3px rgba(255,255,255,.1); /* inner glow */

}

.ll-skin-lugo .ui-datepicker-header .ui-state-hover {
  background: transparent;
  border-color: transparent;
  cursor: pointer;
}

.ll-skin-lugo .ui-datepicker .ui-datepicker-next span {
  background-image: url(images/ui-icons_ffffff_256x240.png);
  background-position: -32px -16px;
}

.ll-skin-lugo .ui-datepicker .ui-datepicker-prev span {
  background-image: url(images/ui-icons_ffffff_256x240.png);
  background-position: -96px -16px;
}

.ll-skin-lugo .ui-datepicker table {
  margin: 0;
}

.ll-skin-lugo .ui-datepicker th {
  color: #b7b7b7;
  font-size: 9px;
  text-transform: uppercase;
}

.ll-skin-lugo .ui-datepicker td {
  border-top: 1px solid #2c2c2c;
  border-right: 1px solid #2c2c2c;
  padding: 0;
  background: #eee;
}

.ll-skin-lugo .ui-datepicker td:last-child {
  border-right: none;
}

.ll-skin-lugo td .ui-state-default {
  border: none;
  text-align: center;
  padding: .7em 0;
  margin:0;
  font-size: 12px;
  font-weight: bold;
  color: #e7e7e7; /* text color */
  text-shadow: 0 1px 2px #000; /* drop shadow */
  background-color: #373737; /* layer fill content */
  -moz-box-shadow: inset 0 0 3px rgba(255,255,255,.2); /* inner glow */
  -webkit-box-shadow: inset 0 0 3px rgba(255,255,255,.2); /* inner glow */
  box-shadow: inset 0 0 3px rgba(255,255,255,.2); /* inner glow */
  background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxsaW5lYXJHcmFkaWVudCBpZD0iaGF0MCIgZ3JhZGllbnRVbml0cz0ib2JqZWN0Qm91bmRpbmdCb3giIHgxPSI1MCUiIHkxPSIxMDAlIiB4Mj0iNTAlIiB5Mj0iLTEuNDIxMDg1NDcxNTIwMmUtMTQlIj4KPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzM3MzczNyIgc3RvcC1vcGFjaXR5PSIxIi8+CjxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0iIzQyNDI0MiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgIDwvbGluZWFyR3JhZGllbnQ+Cgo8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgZmlsbD0idXJsKCNoYXQwKSIgLz4KPC9zdmc+); /* gradient overlay */
  background-image: -moz-linear-gradient(bottom, #373737 0%, #424242 100%); /* gradient overlay */
  background-image: -o-linear-gradient(bottom, #373737 0%, #424242 100%); /* gradient overlay */
  background-image: -webkit-linear-gradient(bottom, #373737 0%, #424242 100%); /* gradient overlay */
  background-image: linear-gradient(bottom, #373737 0%, #424242 100%); /* gradient overlay */

}

.ll-skin-lugo td.ui-state-disabled .ui-state-default {
  background: #666;
  color: #ccc;
  text-shadow: none;
}

.ll-skin-lugo td .ui-state-hover {
  background-color: #373737; /* layer fill content */
  -moz-box-shadow: inset 0 0 4px rgba(0,0,0,.7);  /*inner shadow */
  -webkit-box-shadow: inset 0 0 4px rgba(0,0,0,.2); /* inner shadow */
  box-shadow: inset 0 0 4px rgba(0,0,0,.2); /* inner shadow */
  background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxsaW5lYXJHcmFkaWVudCBpZD0iaGF0MCIgZ3JhZGllbnRVbml0cz0ib2JqZWN0Qm91bmRpbmdCb3giIHgxPSI1MCUiIHkxPSIxMDAlIiB4Mj0iNTAlIiB5Mj0iLTEuNDIxMDg1NDcxNTIwMmUtMTQlIj4KPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzQyNDI0MiIgc3RvcC1vcGFjaXR5PSIxIi8+CjxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0iIzM3MzczNyIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgIDwvbGluZWFyR3JhZGllbnQ+Cgo8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgZmlsbD0idXJsKCNoYXQwKSIgLz4KPC9zdmc+); /* gradient overlay */
  background-image: -moz-linear-gradient(bottom, #424242 0%, #373737 100%);  /*gradient overlay*/ 
  background-image: -o-linear-gradient(bottom, #424242 0%, #373737 100%);  /*gradient overlay */
  background-image: -webkit-linear-gradient(bottom, #424242 0%, #373737 100%); /* gradient overlay */
  background-image: linear-gradient(bottom, #424242 0%, #373737 100%); /* gradient overlay */
}

.ll-skin-lugo td .ui-state-active {
  background: #3f6b8a; /* layer fill content */
  -moz-box-shadow: inset 0 0 5px rgba(7,15,21,.9); /* inner shadow */
  -webkit-box-shadow: inset 0 0 5px rgba(7,15,21,.9); /* inner shadow */
  box-shadow: inset 0 0 5px rgba(7,15,21,.9); /* inner shadow */

}