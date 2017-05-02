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
					this.$parent.currentView='child8'
					
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
			template:'#my_favour_cmd'
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
							vm.addWin=false;
							this.thisIndex=this.dataList.address.length-1;
							vm.dataList.address.push({
								'address':vm.address.provinCity,
								'addressname':vm.address.userName,
								'default':vm.address.isDefault,
								'detailaddrass':vm.address.provinCity,
								'id':res.id[0]['max(id)'],
								'phone':vm.address.phone
							});
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
			template:'#change_purse_pwd',
		},
		 'loading':{
			template:'#loading'
		},
	}
})
}, function(res){
	console.log(res);
});