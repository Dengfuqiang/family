var myorder;
var vm=null;
var res={};
Vue.http.options.emulateJSON = true;
var selectUser={
	name:'',
	phone:'',
	pwd:'',
	purse_pwd:'',
	balance:'',
};
var nav1 ={"msg":"","list":{"columnIcon":"","msgCount":0,"pageList":[{"id":"224","title":"中外名酒"},{"id":"225","title":"茗茶月饼"},{"id":"226","title":"休闲食品"},{"id":"229","title":"奶粉"},{"id":"230","title":"饮品"},{"id":"312","title":"生鲜蔬果"},{"id":"313","title":"干货"},{"id":"379","title":"保健品"},{"id":"402","title":"特产类"}],"pageNum":1,"pageSize":10000,"totalPage":1,"totalRecord":9,"updateTime":""},"status":"0"};
var nav2 ={"msg":"","list":{"columnIcon":"","msgCount":0,"pageList":[{"id":"232","title":"小家电"},{"id":"233","title":"大家电"},{"id":"234","title":"厨电总汇"},{"id":"336","title":"手机数码"},{"id":"337","title":"名表首饰"},{"id":"365","title":"化妆品"},{"id":"370","title":"服装"},{"id":"371","title":"女装"},{"id":"372","title":"母婴"},{"id":"373","title":"鞋靴箱包"},{"id":"374","title":"运动户外"},{"id":"375","title":"汽车用品"},{"id":"380","title":"日常用品"},{"id":"395","title":"床上用品"}],"pageNum":1,"pageSize":10000,"totalPage":1,"totalRecord":14,"updateTime":""},"status":"0"};
var nav3 ={"msg":"","list":{"columnIcon":"","msgCount":0,"pageList":[{"id":"239","title":"厨具"},{"id":"240","title":"家具"},{"id":"241","title":"灯具"},{"id":"242","title":"五金"},{"id":"243","title":"饰品"}],"pageNum":1,"pageSize":10000,"totalPage":1,"totalRecord":5,"updateTime":""},"status":"0"};
Vue.http.get('../php/index/admin_manage.php?fc=userInfo').then(function(res){
	res=JSON.parse(res.bodyText);
	 vm = new Vue({
		el:'#familyAndContain',
		data:{
			navIndex:0,
			currentView:'child0',
			selected_nav:0,
			navInfo:[
				'账号管理',
				'订单管理',
				'商品管理',
				'反馈管理'
			],
			dataArr:{
				myorder:[],
				userInfo:res.data,
				favourList:[],
				addressList:[],
				purse:true,
				backList:[],
				editCmd:{},
		 		category:'life_food',
		 		twoCategory:nav1,
			},
			favourList:[],
		 	category:'life_food',
			
	},
	methods:{
		navSelect:function(e,i){
			this.navIndex=i;
			this.selected_nav=i;
			this.currentView='child'+i;
			if(i==0){
				return false;
			}else if(i==1&&!e.target.hasLoad){
				var url='../php/index/admin_manage.php?status=1&fc=getOrder';
				e.target.hasLoad=true;
					this.$http.get(url).then(function(res){
					res=JSON.parse(res.bodyText);
					this.dataArr.myorder=res.data.reverse();
				}, function(err){
					
				});
			}else if(i==2&&!e.target.hasLoad){
				var url='../php/index/admin_manage.php?fc=getFavour';
				e.target.hasLoad=true;
				this.$http.get(url).then(function(res){
					res=JSON.parse(res.bodyText);
					if(res.code==0){
						alert(res.msg);
						location.href='../index/login.html';
						return ;
					}
					console.log(res.data)
					this.dataArr.favourList=res.data;
				}, function(err){
					
				});
				this.currentView='child'+2;
			}else if(i==3&&!e.target.hasLoad){
				console.log(1)
				this.currentView='child'+3;
				var url='../php/index/admin_manage.php?fc=getBack';
				e.target.hasLoad=true;
				this.$http.get(url).then(function(res){
					res=JSON.parse(res.bodyText);
					if(res.code==0){
						alert(res.msg);
						location.href='../index/login.html';
						return ;
					}
					this.dataArr.backList=res;
				}, function(err){
					
				});
			}else if(i==4&&!e.target.hasLoad){
				var url='../php/index/admin_manage.php?fc=getAddress';
				e.target.hasLoad=true;
				this.$http.get(url).then(function(res){
					res=JSON.parse(res.bodyText);
					if(res.code==0){
						alert(res.msg);
						location.href='../index/login.html';
						return ;
					}
					console.log(res);
					this.dataArr.addressList=res.data;
				}, function(err){
					
				});
			}else if(i==5&&!e.target.hasLoad){
				var url='../php/index/admin_manage.php?status=1';
				e.target.hasLoad=true;
			}else{
				return false;
			}
			
		}
	},
	components:{
		 'child0':{
		 	props:['data'],
			template:'#info_right',
			data:function(){
				return{
					show:false,
					selectUser:{}
				};
			},
			methods:{
				deleteUser:function(index,item){
					if(confirm('是否确认删除账号！')){
						var url='../php/index/admin_manage.php?fc=deleteUser&phone='+item.phone;
							this.$http.get(url).then(function(res){
							res=JSON.parse(res.bodyText);
							console.log(res)
							if(res.code==1){
								alert(res.msg);
								this.data.userInfo.splice(index,1);
								
							}
						}, function(err){
							
						});
					}
				}
				,changeUser:function(index,item){
					selectUser=item;
					console.log(item)
					this.$parent.currentView='child7';
				}
			}
		},
		 'child1':{
		 	props:['data'],
			template:'#order_list_ct',
			data:function(){
				return{
					tabs:[
						'待付款',
						'待发货',
						'待收货',
						'已完成',
						'退货/售后'
					],
					active:0
				}
				
			},
			methods:{
				cencelSale:function(index,item){
					console.log(item);
					if(confirm('是否确认取消售后！')){
						var url='../php/index/admin_manage.php?fc=cencelSale&order_code='+item.order_code;
							this.$http.get(url).then(function(res){
							res=JSON.parse(res.bodyText);
							console.log(res)
							if(res.code==1){
								alert(res.msg);
								this.data.myorder.splice(index,1);
								
							}
						}, function(err){
							
						});
					}
				},
				tabSelect:function(i){
					this.active=i;
					var url='../php/index/admin_manage.php?status='+(i+1)+'&fc=getOrder';
					this.$http.get(url).then(function(res){
						res=JSON.parse(res.bodyText);
						this.data.myorder=res.data.reverse();
					}, function(err){
						
					});
				},
				orderDetial:function(item){
					console.log(item);
					location.href='order_detail.php?order_code='+item.order_code;
				},
				cencelOrder:function(index,item){
					if(confirm('是否确认删除订单！')){
						var url='../php/index/admin_manage.php?fc=cencelOrder&order_code='+item.order_code;
							this.$http.get(url).then(function(res){
							res=JSON.parse(res.bodyText);
							console.log(res)
							if(res.code==1){
								alert(res.msg);
								this.data.myorder.splice(index,1);
								
							}
						}, function(err){
							
						});
					}
				},
				getCmd:function(index,item){
					if(confirm('是否确认收货！')){
						var url='../php/index/admin_manage.php?fc=getCmd&order_code='+item.order_code;
							this.$http.get(url).then(function(res){
							res=JSON.parse(res.bodyText);
							console.log(res)
							if(res.code==1){
								alert(res.msg);
								this.data.myorder.splice(index,1);
								
							}
						}, function(err){
							
						});
					}
				}
			}
		},
		 'child2':{
		 	props:['data'],
		 	data:function(){
		 		return {
		 			checkAlls:false,
		 			selectedCheckbox:{},
		 		};
		 	},
			template:'#my_favour_cmd',
			methods:{
				edit_cmd:function(item){
					this.$parent.dataArr.editCmd=item;
					this.$parent.currentView='child5';
				},
				add_cmd:function(){
					this.$parent.currentView='child8';
				},
				to_deatil:function(item){
						location.href='../nav_contain/shipingxiangqing.php?category='+this.$parent.category+'&id='+item.id;
				},
				checkAll:function(){
					this.checkAlls=!this.checkAlls;
					if(this.checkAlls){
						for(i=0;i<this.data.favourList.length;i++){
							this.selectedCheckbox[i]=this.data.favourList[i].id;
						}
					}else{
						this.selectedCheckbox={};
					}
					console.log(this.selectedCheckbox);
				},
				deleteThis:function(index,item){
					var url='../php/index/admin_manage.php?fc=deleteFavour';
					var index=index;
					var arr=[];
					arr.push(item.id);
					var obj={
						arr:arr,
					}
					this.$http.post(url, obj).then(function(res){
						res=JSON.parse(res.bodyText);
						if(res.code==1){
							this.data.favourList.splice(index,1);
							alert(res.msg);
						}else{
							alert(res.msg);
						}
					}, function(err){
						alert(err);
					});
				},
				childCheck:function(index,item,e){
					if(e.target.checked){
						if(!this.selectedCheckbox[index]){
							this.selectedCheckbox[index]=item.id;
						}
					}else{
						if(this.selectedCheckbox[index]){
							delete this.selectedCheckbox[index];
						}
					}
					console.log(this.selectedCheckbox);
				},
				deleteSelect:function(){
					console.log(1)
					var url='../php/index/admin_manage.php?fc=deleteFavour';
					var obj={};
					obj.arr=[];
					 for(a in this.selectedCheckbox){
						obj.arr.push(this.selectedCheckbox[a])
					 }
					this.$http.post(url, obj).then(function(res){
						res=JSON.parse(res.bodyText);
						if(res.code==1){
							alert(res.msg);
							location.reload();
						}else{
							alert(res.msg);
						}
					}, function(err){
						alert(err);
					});
				}
			}
		},
		 'child4':{
		 	props:['data'],
			template:'#address_ct',
			data:function(){
				return{
					thisIndex:0,
					selectedAddress:0,
					addWin:false,
					flag:1,
					address:{
						userName:'',
						phone:'',
						provinCity:'',
						addressDetail:'',
						isDefault:'',
						id:''
					},
				}
				
			},
			methods:{
				changeAddress:function(item){
					this.addWin=true;
					this.address.userName=item.username;
					this.address.phone=item.phone;
					this.address.provinCity=item.address;
					this.address.addressDetail=item.detailaddrass;
					this.address.isDefault=item.default;
					this.address.id=item.id;
					this.flag=0;
				},
				deleteAddress:function(index,item){
					if(confirm('是否确认删除收货地址！')){
						var url='../php/index/admin_manage.php?fc=deleteAddress&id='+item.id;
							this.$http.get(url).then(function(res){
							res=JSON.parse(res.bodyText);
							console.log(res)
							if(res.code==1){
								alert(res.msg);
								this.data.addressList.splice(index,1);
								return;
							}
							alert(res.msg)
						}, function(err){
							
						});
					}
				},
				defaults:function(item,index){
					if(item.default==1){
						this.selectedAddress=item.id;
						this.thisIndex=index;
						return true;
					}
					else{
						return false;
					}
				},
				selected:function(index,item,e){
					var lis=document.querySelector('.address_list').children;
					for(i=0;i<lis.length;i++){
						lis[i].className='';
					}
					lis[index].className='selected';
					this.selectedAddress=item.id;
				},
				addAddress:function(){
						this.addWin=!this.addWin;
						this.flag=1;
				},
				submitAddAddress:function(){
					var url='../php/createOrder/addAddress.php?flag='+this.flag+'&id='+this.address.id;
					this.$http.post(url, this.address).then(function(res){
						res=JSON.parse(res.bodyText);
						console.log(res);
						if(res.code){
							alert(res.msg);
							this.thisIndex=this.data.addressList.length;
							if(this.flag){
								this.data.addressList.push({
										'address':this.address.provinCity,
										'username':this.address.userName,
										'default':this.address.isDefault,
										'detailaddrass':this.address.addressDetail,
										'id':res.id[0]['max(id)'],
										'phone':this.address.phone
								});
							}else{
									location.reload();
								}
							
							this.addWin=false;
							return ;
						}else{
							alert(res.msg);
							
						}
					}, function(err){
						
					});
				},
			}
		},
		 'child5':{
		 	props:['data'],
			template:'#help_center',
			data:function(){
				return {
					picFlag:true,
					newPic:'',
					imgList:'',
					contentFlag:true,
					imgList:[]
				};
			},
			methods:{
				changeContent:function(e){
					this.contentFlag=false;
					var obj={};
					var that=this;
					that.imgList=[];
					for(i=0;i<e.target.files.length;i++){
						
						var files =e.target.files[i];
						obj[i]=new FileReader();
						obj[i].onloadend = function () {
				        // 图片的 base64 格式, 可以直接当成 img 的 src 属性值
					        var dataURL = this.result;
					        // 插入到 DOM 中预览
					        // ...
					       that.imgList.push(dataURL) ;
					    };
				   		 obj[i].readAsDataURL(files);
					}
				
				},
				changePic:function(e){
					this.picFlag=false;
					var file = e.target.files[0];
				    var reader = new FileReader();
					var that=this;
				    reader.onloadend = function () {
				        // 图片的 base64 格式, 可以直接当成 img 的 src 属性值
				        var dataURL = reader.result;
				        // 插入到 DOM 中预览
				        // ...
				        that.newPic=dataURL;
				    };
				
				    reader.readAsDataURL(file);
				},
				selectTwo:function(e){
					var val=e.target.value;
					this.$parent.dataArr.editCmd.category=val;
					console.log(this.data);
				},
				changePursePwd:function(){
					var formData=new FormData(document.getElementById('edit_cmd'));
					formData.append('table',this.$parent.dataArr.category);
					console.log(this.$parent.dataArr.editCmd);
					
					formData.append('newData',JSON.stringify(this.$parent.dataArr.editCmd));
					var url='../php/index/admin_manage.php?fc=editCommodity';
					this.$http.post(url,formData).then(function(res){
						res=JSON.parse(res.bodyText);
						console.log(res);
//						if(res.code==1){
//							alert(res.msg);
//							location.reload();return;
//						}
//						alert(res.msg)
						
					}, function(err){
						
					});
				},
			}
		},
		 'child3':{
		 	props:['data'],
			template:'#feed_contain',
			data:function(){
				return {
					backs:'',
				};
			},
			methods:{
				back:function(){
					var url='../php/index/admin_manage.php?fc=toback&back='+this.backs;
					this.$http.get(url).then(function(res){
						res=JSON.parse(res.bodyText);
						if(res.code==0){
							alert(res.msg)
							location.href='../index/login.html';
							return false;
						}else if(res.code==1){
							alert(res.msg)
							this.backs='';return false; 
						}
						alert(res.msg)
					}, function(err){
						
					});
				}
				,deleteBack:function(index,item){
					if(confirm('是否确认删除账号！')){
						var url='../php/index/admin_manage.php?fc=deleteBack&id='+item.id;
							this.$http.get(url).then(function(res){
							res=JSON.parse(res.bodyText);
							console.log(res)
							if(res.code==1){
								alert(res.msg);
								this.data.backList.splice(index,1);
								
							}
						}, function(err){
							
						});
					}
				}
			}
		},
		'child7':{
			template:'#change_pwd',
			data:function(){
				return {
					obj:selectUser,
				};
			},
			methods:{
				submits:function(){
					console.log(this.obj)
					var url='../php/index/admin_manage.php?fc=changeUser';
					this.$http.post(url,this.obj).then(function(res){
						res=JSON.parse(res.bodyText);
						alert(res.msg)
						location.reload();
					}, function(err){
						
					});
					
				}
				

			}
		},
		'child8':{
			props:['data'],
			data:function(){
				return {
					pursePwd:'',
					changeData:{
						newPursePwd:'',
						repeatPwd:'',
						phone:'',
						sms:'',
					},
					imgList:[],
					blobs:[],
					twoCategory:nav1,
					oneCategory:[
						'生活食品',
						'生活用品',
						'生活家具'
					],
					one:'life_food',
					two:'',
					files:'',
				};
			},
			template:'#change_purse_pwd',
			methods:{
				addContent:function(e){
					this.files=e.target.files;
				},
				selectOne:function(e){
					var val=e.target.value;
					console.log(val);
					if(val==0){
						this.twoCategory=nav1;
					this.one='life_food';
					}else if(val==1){
						this.twoCategory=nav2;
						this.one='life_articles';
					}else{
						this.twoCategory=nav3;
					this.one='life_furniture';
					}
				},
				selectTwo:function(e){
					var val=e.target.value;
					this.two=val;
				},
				changePursePwd:function(){
					var formData=new FormData(document.getElementById('add_cmd'));
					formData.append('table',this.one);
					formData.append('category',this.two);
					formData.append('createDate',formatDate(new Date().getTime()));
					formData.append('files',this.files);
					var url='../php/index/admin_manage.php?fc=addCommodity';
					this.$http.post(url,formData).then(function(res){
						res=JSON.parse(res.bodyText);
						console.log(res);
						if(res.code==1){
							alert(res.msg);
							location.reload();return;
						}
						alert(res.msg)
						
					}, function(err){
						
					});
				},
				setPursePwd:function(){
					var url='../php/index/admin_manage.php?purse='+this.pursePwd+'&fc=setPurse';
					this.$http.get(url).then(function(res){
						res=JSON.parse(res.bodyText);
						if(res.code==1){
							alert(res.msg);
							this.$parent.currentView='child0';
						}
					}, function(err){
						
					});
				}
			}
		},
		 'loading':{
			template:'#loading'
		},
	}
})
	 
//var obj={
//	target:{
//		hasLoad:false
//	}
//}
//vm.navSelect(obj,selectNum);
}, function(res){
	console.log(res);
});
function formatDate(ns) {  
    var d = new Date(ns);  
    var dformat = [ d.getFullYear(), d.getMonth() + 1, d.getDate() ].join('-')   
            + ' ' + [ d.getHours(), d.getMinutes(), d.getSeconds() ].join(':');  
    return dformat;  
} 