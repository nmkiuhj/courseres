Array.prototype.inArray=function (value){for (var i=0;i<this.length;i++){if (this[i] == value){return true;}}return false};    
function isFormChanged(el) {  
    var tips="";
    var arr1=new Array(); 
    var arr2=new Array();
    var isChanged=false;
    var itemVal='';
    var form = document.getElementById(el);  
    for (var i = 0; i < form.elements.length; i++) {  
        var element = form.elements[i];  
        var type = element.type;
        switch(type){
            case "text":
                case "hidden":
                case "textarea":
                case "button":
                tips += (element.value != element.defaultValue)?tips.length==0?element.name+"='"+escape(element.value)+"'":"&"+element.name+"='"+escape(element.value)+"'":"";
            break;
            case "radio":
                if(!arr1.inArray(element.name)){
                arr1.push(element.name);
                var myRadio=document.getElementsByName(element.name);
                for(var k=0;k<myRadio.length;k++){
                    tips += (myRadio[k].checked && !myRadio[k].defaultChecked)?tips.length==0?myRadio[k].name+"='"+myRadio[k].value+"'":"&"+myRadio[k].name+"='"+myRadio[k].value+"'":"";
                }
            }
            break;
            case "checkbox":
                if(!arr2.inArray(element.name)){
                arr2.push(element.name);
                isChanged=false;
                var myBox=document.getElementsByName(element.name);
                itemVal='';
                for(var k=0;k<myBox.length;k++){
                    if(myBox[k].checked){//当前checkbox被选中
                        if(!myBox[k].defaultChecked){isChanged=true}//是否与初始状态不同,如果是则标记为当前checkbox需更新
                        itemVal += itemVal.length==0?myBox[k].value:","+myBox[k].value;//同一name追加值
                    }else{
                        if(myBox[k].defaultChecked){
                            isChanged=true;//初始化时为选中状态但当前未选中，标记该复选框组值需更新
                        }
                    }
                }
                if(isChanged){itemVal=element.name+"='"+itemVal+"'";tips+=tips.length==0?itemVal:'&'+itemVal}
            }
            break;
            case "select-one":
                for (var j = 0; j < element.options.length; j++) {
                tips += (element.options[j].selected && !element.options[j].defaultSelected)?tips.length==0?element.name+"='"+element.value+"'":"&"+element.name+"='"+element.value+"'":"";  
            }
            break; 
            case "select-multiple": 
                isChanged=false;
            itemVal='';
            for (var j = 0; j < element.options.length; j++) {
                if(element.options[j].selected){
                    if(!element.options[j].defaultSelected){isChanged=true}//是否与初始状态不同,如果是则标记为当前select需更新
                    itemVal +=itemVal.length==0?element.options[j].value:","+element.options[j].value;//同一个元素只追加值  
                }else{
                    if(element.options[j].defaultSelected){
                        isChanged=true;//初始化时为选中状态但当前未选中，标记该select值需更新
                    }
                }
            }
            if(isChanged){itemVal=element.name+"='"+itemVal+"'";tips+=tips.length==0?itemVal:'&'+itemVal}
            break;  
        } 
    }
    return tips;
} 

$.fn.pageHtml = function(url, currentPage, prePageNumItems, totalItems){
	var totalPage = Math.ceil(totalItems / prePageNumItems);
    var html = '<ul>';
    currentPage = parseInt(currentPage);
    if (currentPage == 1) {
        html += '<li><a href="#">前一页</a></li>\
        <li class="active"><a href="#">1</a></li>';
    } else {
        html += '<li><a href="' + url + (currentPage - 1) + '" data-page="' + (currentPage - 1) + '">前一页</a></li>';
        if (currentPage < 2 + 2) {
            var i = 1;
        } else if (totalPage - currentPage < 2 && totalPage > 2 * 2 + 1) {
            var i = currentPage - (4 - (totalPage - currentPage));
        } else {
            var i = currentPage - 2;
        }
        for (; i < currentPage; i++) {
            html += '<li><a href="' + url + i + '" data-page="' + i + '">' + i + '</a></li>';
        }
        html += '<li class="active"><a href="#">' + currentPage + '</a></li>';
    }
    for (var i = currentPage + 1; (i <= currentPage + 2 || totalPage <= 5) && i <= totalPage; i++) {
        html += '<li><a href="' + url + i + '" data-page="' + i + '">' + i + '</a></li>';
    }
    if (currentPage == totalPage) {
        html += '<li><a href="#">后一页</a></li>';
    } else {
        html += '<li><a href="' + url + (currentPage + 1) + '" data-page="' + (currentPage + 1) + '">后一页</a></li>';
    }
    $(this).addClass('pagination');
    $(this).html(html);
};

loadStart = function () {
    $('#loadModal').modal({backdrop:false});
}

loadEnd = function () {
    $('#loadModal').modal('hide');
}

