<?php 
	class CartController{
		//添加购物车方法
		public function addcart(){
			//echo '添加购物车';

			//var_dump($_GET);
			//var_dump($_SESSION);
			if(empty($_SESSION['home'])){
				header('location:./index.php?c=user&a=user');
				exit;
			}
				
			if(!empty($_GET['gid'])){
				//如果session里面已经有值了，就应该进行增加操作，不是重新赋值的操作
				if(!empty($_SESSION['cart'][$_GET['gid']])){
					$_SESSION['cart'][$_GET['gid']]['num'] +=1;
					header('location:./index.php?c=cart&a=index');
					exit;
				}
				try{
				//现在是进行调用数据库，把goodsid对应的数据储存到session中！
				$dsn='mysql:host=localhost;dbname=ss19_shop;charset=utf8';
				$pdo=new PDO($dsn,'root','');
				$pdo->setAttribute(3,1);
				//发送sql语句

				$sql="SELECT * FROM goods WHERE id=:id";
				$stmt=$pdo->prepare($sql);

				$gid=$_GET['gid'];
				$stmt->bindParam(':id',$gid);
				$stmt->execute();

				if($stmt->rowCount()){
					$goods=$stmt->fetchAll(2);
				}

				//var_dump($goods);
				
				$goods[0]['num']=1;
				$_SESSION['cart'][$goods[0]['id']]=$goods[0];

				include './View/cart/addcart.html';
			}catch(PDOException $e){
				echo $e->getMessage();
				exit;
			}




			}else{
				echo '请添加指定商品';
			}

			
		}


		public function index(){
			//调用Index方法里面的头
			
			$header=new IndexController;
			$header=$header->head();
			
			$total=0;


			include './View/cart/cart.html';
			$foot=new IndexController;
				$foot=$foot->foot();
		}

		//删除某个商品
		public function del(){
			unset($_SESSION['cart'][$_GET['id']]);
			header('location:./index.php?c=cart&a=index');



		}
		//清空购物车
		public function delete(){
			unset($_SESSION['cart']);
			header('location:./index.php?c=cart&a=index');
		}

		public function Qty(){
			//var_dump($_GET);
			//var_dump($_POST);

			//var_dump($_SESSION['cart']);
			$id= $_GET['id'];
			//将传过来的商品个数，提交的后台，再进行赋值，传回去
			$_SESSION['cart'][$id]['num']=$_POST['num'];

			//var_dump($_SESSION['cart']);

			header('location:index.php?c=cart&a=index');


		}


		//
		//
		//
		//
	}