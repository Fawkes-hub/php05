<?php 
		
		class OrderController{
				public $lastid;  //用来储存，添加订单后生成的订单id
				public $userlist;
			

			public function status(){
				
				$data['status']=$_GET['status'];
				$data['oid']=$_GET['oid'];
				//var_dump($data);
				
				//把数据传入数据库，然后更新
				
					try{
					//用PDO来读取用户
			 		$dsn='mysql:host=localhost;dbname=ss19_shop;charset=utf8';
			 		$pdo=new PDO($dsn,'root','');
			 		$pdo->setAttribute(3,1);
			 			//设置SQL语句
						//这是写入的订单表中
			 			$sql="UPDATE  orders SET  status={$data['status']} WHERE id={$data['oid']}";
			
							$result=$pdo->exec($sql);
						
						

						
						}catch(PDOException $e){
							echo $e->getMessage();
							exit;
						}

						

				if($bool){
						header('index.php?c=order&a=to_user');
					}else{
						header('location:./index.php?c=order&a=to_user');
					}
			}
			
			public function add(){
						//echo '订单的提交页,，跳转到个人中心页';
						//订单的提交页，需要把session里面的内容传到订单表内
						//var_dump($_SESSION);
						//var_dump($_SESSION['cart']);

						foreach ($_SESSION['cart'] as $key => $value) {

							//var_dump($value['total']);
							//进行一次遍历，使$value['total']能够直接取值
						}
						//
						//这是订单表，
						$orders=array(
							'uid'=>$_SESSION['home']['id'],
							'linkname'=>$_SESSION['user_address']['addname'],
							'address'=>$_SESSION['user_address']['address'],
							'phone'=>$_SESSION['user_address']['phone'],
							'code'=>$_SESSION['user_address']['code'],
							'total'=>$value['total'],
							'status'=>0,
							);

						//刚生成的订单，状态status是0，默认新订单
							//	var_dump($orders);
							
							$dsn='mysql:host=localhost;dbname=ss19_shop;charset=utf8';
			 				$pdo=new PDO($dsn,'root','');
			 				$pdo->setAttribute(3,1);
			 					//这是写入的订单表中
			 				$sql="INSERT INTO orders(uid,linkname,address,phone,code,total,status) VALUES(:uid,:linkname,:address,:phone,:code,:total,:status)";

							$stmt=$pdo->prepare($sql);
								
							// $userlist=$userlist->fetchAll(2);
							
							// var_dump($id);
							
							$bool=$stmt->execute($orders);
							$id=$pdo->lastinsertid();
							//echo $id;
							
							$this->lastid=$id;

				
							// 这是订单详情表
						if($bool){
						
							$arr=array();
							foreach ($_SESSION['cart'] as $key => $value) {
							//	var_dump($key);
							//	var_dump($value);
								$arr[]=$value;

																			}
							//var_dump($arr);
							$gid=$value['id'];
							//	var_dump($gid);	
							//	var_dump($arr);	
							//这个数组就是传入数据库中的订单详情数组
								// var_dump($arr);
								// exit;	
								
								foreach ($arr as $key => $value) {
								//	var_dump($value);
									
								
									
								if(is_array($arr)){
									$orders_u=array(
									'oid'=>$id,
									'gid'=>$arr[$key]['id'],
									'gname'=>$arr[$key]['name'],
									'price'=>$arr[$key]['price'],
									'gnum'=>$arr[$key]['num'],
									'uid'=>$_SESSION['home']['id'],
									'pic'=>$arr[$key]['pic']
									);
							//var_dump($orders_u);
							
						
								
					//将订单详情页传入数据库
								$dsn='mysql:host=localhost;dbname=ss19_shop;charset=utf8';
				 				$pdo=new PDO($dsn,'root','');
				 				$pdo->setAttribute(3,1);
				 
				 			$sql="INSERT INTO orders_u(oid,gid,gname,price,gnum,uid,pic) VALUES(:oid,:gid,:gname,:price,:gnum,:uid,:pic)";


								$stmt=$pdo->prepare($sql);

								$bool=$stmt->execute($orders_u);

								//var_dump($_SESSION);
								
								unset($_SESSION['cart']);
								//echo '订单与订单详情上传成功上传成功，前往订单页完成订单';
								header('refresh:1;url="./index.php?c=order&a=to_user"');

							}else{
							//不是数组就是字符，就不要						
								echo '存在错误';
								unset($value);
							

							//提交订单的逻辑
								//这个方法，把订单表和订单详情表都传入了数据库了。
								}
						}
							
							exit;
						}	
			}





			public function to_user(){
				//$id=$_SESSION['home']['id'];
				//先要获取到订单id
				//这表作用是把同一个会员id的订单详情表从数据库拿出来
				
				$id=$_SESSION['home']['id'];
				
				//var_dump($userlist);
				
				/*$dsn='mysql:host=localhost;dbname=ss19_shop;charset=utf8';
	 			$pdo=new PDO($dsn,'root','');
	 			$pdo->setAttribute(3,1);
					//通过用户的的id，去查询到订单的id，将再通过订单的id把信息写入到订单详细信息中
					$sql="SELECT * FROM orders_u WHERE uid='{$id}' ";
					$result=$pdo->query($sql);
							
					$userlist = $pdo->query($sql);
					$userlist=$userlist->fetchAll(2);
					//得到的userlist是订单详情的数组
					//var_dump($userlist);
						//为了得到数据库里面的订单的状态信息 又要再次去查看内容
						foreach ($userlist as $key => $value) {
							var_dump($value['oid']);
								$dsn='mysql:host=localhost;dbname=ss19_shop;charset=utf8';
	 							$pdo=new PDO($dsn,'root','');
	 							$pdo->setAttribute(3,1);
*/
						//两个联合查询
						//$userlist=new Model('orders');
	 							$dsn='mysql:host=localhost;dbname=ss19_shop;charset=utf8';
	 							$pdo=new PDO($dsn,'root','');
	 							$pdo->setAttribute(3,1);

						$sql="SELECT o.id,u.oid,u.gname,u.price,u.gnum,o.status,u.pic  FROM orders o,orders_u u WHERE o.uid={$id} AND o.id=u.oid ";

						
						//$result=$pdo->query($sql);
							
						$userlist = $pdo->query($sql);
						$userlist=$userlist->fetchAll(2);

						//$list=$userlist->query($sql);

						
						






					
					$this->userlist=$userlist;

					//下半部分是把
					
					 $header=new IndexController;
		 		 $header=$header->head();
				include './Include/user.html';
				$foot=new IndexController;
				$foot=$foot->foot();


				

			}


			public function index(){
				echo '订单的查看页';
				
				
				//$userlist=$this->userlist;
				
				var_dump($this->userlist);
				exit;
					
			

			}

			public function create(){
				//在订单创建页里面的表单信息就是订单表的信心 
				//要创建一个订单页面，把购物车修改使用
				//里面有  商品信息，收货人信息，会员信息，总得支付信息

				//通过session中的home的username在表格 user_address中得到收货人的信息
				//
				$username=@$_SESSION['home']['username'];
				//var_dump($username);
					//通过pdo的方法去取出内容
					$dsn='mysql:host=localhost;dbname=ss19_shop;charset=utf8';
	 				$pdo=new PDO($dsn,'root','');
	 				$pdo->setAttribute(3,1);
				//在用户表中通过username来查看，对应的id
					$sql="SELECT id FROM user_home WHERE username='{$username}' ";
						$result=$pdo->query($sql);
								
						$userlist = $pdo->query($sql);
						$userlist=$userlist->fetchAll(2);
						//var_dump($userlist);

						//通过得到的id对应 收货人表中的uid 查询收货人表
						$uid=@$userlist[0]['id'];
					$dsn='mysql:host=localhost;dbname=ss19_shop;charset=utf8';
	 					$pdo=new PDO($dsn,'root','');
	 					$pdo->setAttribute(3,1);
						//收货人表用WHERE条件，得到收获人的所有信息
						$sql="SELECT * FROM user_address WHERE uid='{$uid}' ";
						$result=$pdo->query($sql);
									//echo $sql;
						$user_hlist = $pdo->query($sql);
						$user_hlist=$user_hlist->fetchAll(2);
						
						//
						//我们需要传送订单表的状态信息给USER。
						//通过最后一次
						$user_hlist['status']=0;
						
						$total=0;

			//var_dump($user_hlist);

				 $header=new IndexController;
				 $header=$header->head();
				include './Include/Orders.html';
				$foot=new IndexController;
				$foot=$foot->foot();
			}


			


	}



		