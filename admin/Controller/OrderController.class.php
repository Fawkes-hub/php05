<?php 	
	
	class OrderController{

		public function index(){
			echo '查看订单列表';
			if(!empty($_GET['username'])){
				$map['username']=array('like',$_GET['username']);

			}else{
				$map='';
			}

			$order = new Model('orders');
			$total=$order->where($map)->count();
			$page = new Page($total,8);
			$orders= $order->where($map)->limit($page->limit)->select();

			//var_dump($orders);





			$i=1;



			include './View/order/index.html';

		}

		public function orderinfo(){
			echo '后台的订单详情页';
			
			//$oid=$_GET['oid'];
			
			$oid['oid']=$_GET['oid'];
			
			$orders_u=new Model('orders_u');
			$orderinfo=$orders_u->where($oid)->select();
			$i=1;
					
			include './View/order/indexinfo.html';
		}

		public function add(){
			echo '添加订单';
		}


		public function status(){
			$data['status']=$_GET['status'];
			$data['id']=$_GET['id'];
			
			//把数据传入数据库，然后更新
			$orders=new Model('orders');
			$result=$orders->update($data);

			if($result){
					header('location:./index.php?c=order&a=index');
				}else{
					header('location:./index.php?c=order&a=index');
				}
		}

	}