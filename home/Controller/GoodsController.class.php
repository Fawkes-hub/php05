<?php 
	
	class GoodsController{

		public function index(){
			


			$head=new IndexController;
			$head->head();

			
			
			$dsn='mysql:host=localhost;dbname=ss19_shop;charset=utf8';
		 		$pdo=new PDO($dsn,'root','');
		 		$pdo->setAttribute(3,1);

			//通过传过来的商品id得到里面的值
			$sql="SELECT * FROM goods WHERE id={$_GET['id']}";
			$userlist = $pdo->query($sql);
			
			$goodslist=$userlist->fetchAll(2);

			
			


			include './Include/product.html';


			$head->foot();

		}

		




	protected function indexpdo($sql){
			//使用了PDO的方法
			$mysql="mysql:host=localhost;dbname=ss19_shop;charset=utf8";
			//要得到pao的对象
			$pdo=new PDO($mysql,'root','');
			
			//设置错误
			$pdo->setAttribute(3,1);
			//准备预处理
			
			//把SQL模版发送出去
			$this->stmt=$pdo->prepare($sql);
		}



	}