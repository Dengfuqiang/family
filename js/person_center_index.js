var myorder;
var vm=null;
var res={};
Vue.http.options.emulateJSON = true;
Vue.http.get('../php/getData/getOrder.php?fc=userInfo').then(function(res){
	res=JSON.parse(res.bodyText);
	if(res.code==0){
		alert(res.msg);
		location.href='../index/login.html';
		return ;
		
	}else{
		res=res.data[0];
	}
	if(res.code==0){
		alert(res.msg);
		location.href='../index/login.html';
		return ;
	}
	 vm = new Vue({
		el:'#familyAndContain',
		data:{
			navIndex:0,
			currentView:'child0',
			selected_nav:0,
			navInfo:[
				'基本资料',
				'我的订单',
				'我的钱包',
				'我的收藏',
				'收货地址',
				'帮组中心',
				'意见反馈'
			],
			dataArr:{
				myorder:[],
				userInfo:res,
				favourList:[],
				addressList:[],
				purse:true,
			},
			favourList:[]
			
	},
	methods:{
		navSelect:function(e,i){
			this.navIndex=i;
			this.selected_nav=i;
			this.currentView='child'+i;
			if(i==0){
				return false;
			}else if(i==1&&!e.target.hasLoad){
				var url='../php/getData/getOrder.php?status=1&fc=getOrder';
				e.target.hasLoad=true;
					this.$http.get(url).then(function(res){
					res=JSON.parse(res.bodyText);
					if(res.code==0){
						alert(res.msg);
						location.href='../index/login.html';
						return ;
					}
					this.dataArr.myorder=res.data;
				}, function(err){
					
				});
			}else if(i==2&&!e.target.hasLoad){
				var url='../php/getData/getOrder.php?status=1&fc=getOrder';
				e.target.hasLoad=true;
			}else if(i==3&&!e.target.hasLoad){
				console.log(1)
				var url='../php/getData/getOrder.php?fc=getFavour';
				e.target.hasLoad=true;
				this.$http.get(url).then(function(res){
					res=JSON.parse(res.bodyText);
					if(res.code==0){
						alert(res.msg);
						location.href='../index/login.html';
						return ;
					}
					this.dataArr.favourList=res.data;
				}, function(err){
					
				});
			}else if(i==4&&!e.target.hasLoad){
				var url='../php/getData/getOrder.php?fc=getAddress';
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
				var url='../php/getData/getOrder.php?status=1';
				e.target.hasLoad=true;
			}else if(i==6&&!e.target.hasLoad){
				var url='../php/getData/getOrder.php?status=1';
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
			methods:{
				changePwd:function(){
					this.$parent.currentView='child7'
				},
				changePurse:function(){
					if(!this.$parent.dataArr.userInfo.purse_pwd){
						//this.$parent.$options.components.child8.purse=false;
						vm.dataArr.purse=false;
					}
					this.$parent.currentView='child8';
					
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
				tabSelect:function(i){
					this.active=i;
					var url='../php/getData/getOrder.php?status='+(i+1)+'&fc=getOrder';
					this.$http.get(url).then(function(res){
						res=JSON.parse(res.bodyText);
						this.data.myorder=res.data;
					}, function(err){
						
					});
				}
			}
		},
		 'child2':{
		 	props:['data'],
			template:'#my_purse_info'
		},
		 'child3':{
		 	props:['data'],
		 	data:function(){
		 		return {
		 			checkAlls:false,
		 			selectedCheckbox:{}
		 		};
		 	},
			template:'#my_favour_cmd',
			methods:{
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
					var url='../php/getData/getOrder.php?fc=deleteFavour';
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
					var url='../php/getData/getOrder.php?fc=deleteFavour';
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
					address:{
						userName:'',
						phone:'',
						provinCity:'',
						addressDetail:'',
						isDefault:'',
						thisIndex:0
					},
				}
				
			},
			methods:{
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
				},
				submitAddAddress:function(){
					var url='../php/createOrder/addAddress.php';
					this.$http.post(url, this.address).then(function(res){
						res=JSON.parse(res.bodyText);
						console.log(res);
						if(res.code){
							alert(res.msg);
							this.thisIndex=this.data.addressList.length;
							this.data.addressList.push({
									'address':this.address.provinCity,
									'addressname':this.address.userName,
									'default':this.address.isDefault,
									'detailaddrass':this.address.addressDetail,
									'id':res.id[0]['max(id)'],
									'phone':this.address.phone
							});
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
			template:'#help_center'
		},
		 'child6':{
		 	props:['data'],
			template:'#feed_contain',
			data:function(){
				return {
					backs:'',
				};
			},
			methods:{
				back:function(){
					var url='../php/getData/getOrder.php?fc=toback&back='+this.backs;
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
			}
		},
		'child7':{
			template:'#change_pwd',
			data:function(){
				return {
					obj:{
						oldPwd:'',
						newPwd:'',
						repeatPwd:'',
					}
				};
			},
			methods:{
				submits:function(){
					console.log(this.obj)
					if(this.obj.oldPwd.replace(' ','')&&this.obj.newPwd.replace(' ','')&&this.obj.repeatPwd.replace(' ',''))
					{
						if(this.obj.newPwd!=this.obj.repeatPwd){
							alert('请输入与新密码相同的重复密码！');
							return false;
						}else{
							var url='../php/getData/getOrder.php?fc=changePwd';
							this.$http.post(url,this.obj).then(function(res){
								res=JSON.parse(res.bodyText);
								if(res.code==0){
									alert(res.msg)
									location.href='../index/login.html';
									return false;
								}else if(res.code==1){
									alert(res.msg)
									location.href='../index/login.html';return false;
								}else if(res.code==3){
									alert(res.msg);return false;
								}
								alert(res.msg)
							}, function(err){
								
							});
						}
					}else{
						alert('密码不能为空！');
						return false;
					}
					
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
					}
					
				};
			},
			template:'#change_purse_pwd',
			methods:{
				setPursePwd:function(){
					var url='../php/getData/getOrder.php?purse='+this.pursePwd+'&fc=setPurse';
					this.$http.get(url).then(function(res){
						res=JSON.parse(res.bodyText);
						if(res.code==1){
							alert(res.msg);
							this.$parent.currentView='child0';
						}
					}, function(err){
						
					});
				},
				changePursePwd:function(){
					if(this.changeData.newPursePwd!=this.changeData.repeatPwd){
						alert('请输入一样的密码');
						return;
					}
					var url='../php/getData/getOrder.php?fc=changePursePwd';
					this.$http.post(url,this.changeData).then(function(res){
						res=JSON.parse(res.bodyText);
						console.log(res);
						if(res.code==1){
							alert(res.msg);
							this.$parent.currentView='child0';return;
						}
						
							alert(res.msg);
						
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
}, function(res){
	console.log(res);
});

