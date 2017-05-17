 document.getElementById('searchBt').onclick=function(){
				 	 var keys=encodeURIComponent(document.getElementById('searchText').value);
				 	location.href='../nav_contain/commodityList.php?keys='+keys;
				 }
window.onload=function(){
	var outerElement=document.getElementById("lunbo_outer");
	var innerElement=document.getElementById("lunbo_inner");
	var controlBt=document.getElementById("lunbobtn").children;
	var preAndNext=document.getElementById("preAndNext");
	lunboFc(outerElement,innerElement,controlBt,preAndNext);
	
}
Vue.http.get('../php/getData/getData.php').then(function(res){
	vm.beautity_life=JSON.parse(res.bodyText)[0];
	vm.life_food=JSON.parse(res.bodyText)[1];
	vm.life_articles=JSON.parse(res.bodyText)[2];
	vm.life_furniture=JSON.parse(res.bodyText)[3];
	
}, function(res){
	
});
var vm=new Vue({
	el:"#familyAndContain",
	data:{
		beautity_life:[],
		life_food:[],
		life_articles:[],
		life_furniture:[],
		index:null
	},
	methods:{
		getDate:function(event,table,index){
			vm.index=table;
			console.log(event.target)
			this.$http.get('../php/getData/upData.php?table='+table+'&category='+event.target.id).then(function(res){
				//console.log(this.cmd_info[this.index])
				vm[vm.index]=JSON.parse(res.bodyText)[0];
				
			}, function(res){
				
			});
		},
		to_detail:function(item,table){
			location.href='../nav_contain/shipingxiangqing.php?category='+table+'&id='+item.id;
		}
	}
});