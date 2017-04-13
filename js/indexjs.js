window.onload=function(){
	var outerElement=document.getElementById("lunbo_outer");
	var innerElement=document.getElementById("lunbo_inner");
	var controlBt=document.getElementById("lunbobtn").children;
	var preAndNext=document.getElementById("preAndNext");
	lunboFc(outerElement,innerElement,controlBt,preAndNext);
	
}
Vue.http.get('../php/getData/getData.php').then(function(res){
	var data=JSON.parse(res.bodyText);
	var vm=new Vue({
		el:"#familyAndContain",
		data:{
			cmd_info:data
		}
	});
}, function(res){
	
});
