var Pagination=function (t,l) {
  this.currentPage=1;
  this.limitP=l-1;
  this.table=t;
};
Pagination.prototype.build = function() {
  this.tr=this.table.children('tbody').children('tr');
  this.listLength=this.tr.length;
  var list_t=Math.ceil(this.listLength/this.limitP);
  this.limit_max=this.currentPage*this.limitP;
  this.limit_min=this.limit_max-this.limitP;
  var tag="<ul class=\"pagination\">";
  for (var i = 1; i <= list_t; i++) {
    if (i==this.currentPage) {
      tag+="<li class=\"active \"><a data-id=\""+i+"\">"+(i)+"</a></li>";
    } else{
      tag+="<li><a href=\"#\" class=\"pag-btn\" data-id=\""+i+"\"> "+(i)+"</a></li>";
    }
  }
tag+="</ul>";
this.table.append(tag);
};
Pagination.prototype.build_list = function(c) {
  this.tr=this.table.children(c);
  this.listLength=this.tr.length;
  var list_t=Math.ceil(this.listLength/this.limitP);
  this.limit_max=this.currentPage*this.limitP;
  this.limit_min=this.limit_max-this.limitP;
  var tag="<ul class=\"pagination\">";
  for (var i = 1; i <= list_t; i++) {
    if (i==this.currentPage) {
      tag+="<li class=\"active \"><a data-id=\""+i+"\">"+(i)+"</a></li>";
    } else{
      tag+="<li><a href=\"#\" class=\"pag-btn\" data-id=\""+i+"\"> "+(i)+"</a></li>";
    }
  }
tag+="</ul>";
console.log(this.table);
this.table.append(tag);
};
Pagination.prototype.showList = function() {
  for (var i = this.listLength - 1; i >= 0; i--) {
    if (i>this.limit_max || i<this.limit_min) {
      //console.log($('table>tbody tr').eq(i).css('display'));
    this.tr.eq(i).css('display','none');
      //$('table>tbody tr').eq(i).css('display','block');
    }else{
      this.tr.eq(i).css('display','table-row');
    }
  }
};
Pagination.prototype.paginationBoton = function() {
  this.table.children('.pagination').children().children().on('click',{object:this},this.clicked);
};
Pagination.prototype.clicked = function(event) {
  event.preventDefault();
  if (!$(this).parent().hasClass('active')) {
  var a=event.data.object.currentPage;
    var id=  $(this).data('id');                           -
    event.data.object.changePage(id);
    event.data.object.showList();
  };
};
Pagination.prototype.changePage = function(value) {
  this.currentPage=value;
  this.limit_max=this.currentPage*this.limitP;
  this.limit_min=this.limit_max-this.limitP;
  this.table.children('.pagination').children().removeClass('active');
  this.table.children('.pagination').children().eq(value-1).addClass('active');
};
