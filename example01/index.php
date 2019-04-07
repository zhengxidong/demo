<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	
</head>
<body>
	<ul id="list">
		<li><label><input type="checkbox" value="1"></label>1.时间都去哪儿了</li>
		<li><label><input type="checkbox" value="2"></label>2.海阔天空</li>
		<li><label><input type="checkbox" value="3"></label>3.真的爱你</li>
		<li><label><input type="checkbox" value="4"></label>4.不再犹豫</li>
		<li><label><input type="checkbox" value="5"></label>5.光辉岁月</li>
		<li><label><input type="checkbox" value="6"></label>6.喜欢妳</li>
	</ul>
	<input type="checkbox" id="all">
	<input type="button" value="全选" class="btn" id="selectAll">
	<input type="button" value="全不选" class="btn" id="unSelect">
	<input type="button" value="反选" class="btn" id="reverse">
	<input type="button" value="获得选中的所有值" class="btn" id="getValue">
	<script src="../js/jquery-2.1.1.min.js"></script>

	<script>
	$(function () {
	//全选或全不选
	$("#all").click(function(){   
    	if(this.checked){   
        	$("#list :checkbox").prop("checked", true);  
    	}else{   
		$("#list :checkbox").prop("checked", false);
    	}   
 	}); 
	//全选  
   /* $("#selectAll").click(function () {
         $("#list :checkbox,#all").prop("checked", true);  
    });  
	//全不选
    $("#unSelect").click(function () {  
         $("#list :checkbox,#all").prop("checked", false);  
    });*/  
    //反选 
    /*$("#reverse").click(function () { 
         $("#list :checkbox").each(function () {  
              $(this).prop("checked", !$(this).prop("checked"));  
         });
		 allchk();
    });*/
	
	//设置全选复选框
	$("#list :checkbox").click(function(){
		allchk();
	});
 
	//获取选中选项的值
	$("#getValue").click(function(){
		/*var vals ="";*/
		var valArr = [];
		$("#list :checkbox").each(function(){
			if($(this).prop("checked")==true){
				/*vals +=$(this).val()+",";*/
				valArr.push($(this).val());
			}
		})
		alert(valArr);
		/*var valArr = new Array;
        $("#list :checkbox[checked]").each(function(i){
			valArr[i] = $(this).val();
        });
		var vals = valArr.join(',');
      	alert(vals);*/
    });
}); 
function allchk(){
	var chknum = $("#list :checkbox").size();//选项总个数
	var chk = 0;
	$("#list :checkbox").each(function () {  
        if($(this).prop("checked")==true){
			chk++;
		}
    });
	if(chknum==chk){//全选
		$("#all").prop("checked",true);
	}else{//不全选
		$("#all").prop("checked",false);
	}
}     
	</script>
</body>
</html>