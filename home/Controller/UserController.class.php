<?php 
	
	 class UserController{

	 	public function index(){
	 		$header=new IndexController;
			$header=$header->head();
			
			

	 	}

	 	public function user(){



	 		$this->index();

	 		include './View/login/account.html';
			$foot=new IndexController;
			$foot=$foot->foot();

	 	}

	 	//新建用户的方法
	 	public function NewUser(){
	 		//var_dump($_POST);

	 		//用正则匹配用户注册的用户名与密码是否符合规则
	 			
	 			//帐号(字母开头，允许5-16字节，允许字母数字下划线)
	 			$namepreg='/^[a-zA-Z][a-zA-Z0-9_]{4,15}$/';
	 		if(!preg_match($namepreg,$_POST['username'],$arr)){
	 			$username='账号由字母数字下划线组成，须以字母开头';
				//header('location:index.php?username='.$username);exit;
				$mask = true;
	 		}
	 			//用来匹配密码的位数
	 			$leng = strlen($_POST['password']);
			if($leng<6){
				$pwd='必须至少是6位';
				//header('location:index.php?pwd='.$pwd);exit;
				$mask =true;
			}
				//正则匹配邮箱
				/*$emailpreg='/^[A-Za-zd]+([-_.][A-Za-zd]+)*@([A-Za-zd]+[-.])+[A-Za-zd]{2,5}$/';
			if(!preg_match($emailpreg,$_POST['email'],$arr)){
				$email='请输入正确的邮箱';
				//header('location:index.php?username='.$username);exit;
				$mask = true;
			}	*/
				$phonepreg='/^1[3|4|5|7|8][0-9]{9}$/';
			if(!preg_match($phonepreg,$_POST['phone'],$arr)){
				$phone='请输入正确的手机号';
				//header('location:index.php?username='.$username);exit;
				$mask = true;
			}	
			//如果两个值为真，说明账号或者密码有问题。
			if(@$mask){
				header('location:index.php?c=user&a=user&username='.$username.'&pwd='.$pwd.'&phone='.$phone);exit;
			}
	 		
	 		//接受到之后要先判断密4码与确认密码是否相等
	 		if($_POST['password']==$_POST['repassword']){
		 			unset($_POST['repassword']);
		 			unset($_POST['agree']);
		 			$_POST['password']=md5($_POST['password']);
		 						
		 		//用PDO来新建用户
		 		$dsn='mysql:host=localhost;dbname=ss19_shop;charset=utf8';
		 		$pdo=new PDO($dsn,'root','');
		 		$pdo->setAttribute(3,1);
		 		//先要进行查询，数据库中是否已经存在了相同的用户名.
		 		$sql="SELECT password FROM user_home WHERE username='{$_POST['username']}' ";
			 		$userlist = $pdo->query($sql);
					$userlist=$userlist->fetchAll();
					//var_dump($sql);
			 		//var_dump($userlist);
			 		if(!empty($userlist)){
			 			echo '用户名已存在，<a href="./index.php?c=User&a=user">请直接登录</a>';
			 			exit;
			 			header("refresh:2;url='./index.php?c=User&a=user'");
			 		}
		 		
	 		//准备sql语句
	 		$sql="INSERT INTO user_home(username,email,phone,sex,password) VALUES(:username,:email,:phone,:sex,:password)";

	 		$stmt=$pdo->prepare($sql);

	 		//var_dump($stmt);
	 		
	 		$bool=$stmt->execute($_POST);
	 		//var_dump($_POST);
	 		//var_dump($bool);
	 		//当确定bool值为真时，表示注册成功，我们直接让他处于登录状态
	 		// $_SESSION['']	 		
	 		//echo $stmt->rowCount();
	 		$id=$pdo->lastinsertid();
	 		
				if($bool){
				//不保存密码，销毁密码
					$_SESSION['home']['id']=$id;	
					$_SESSION['home']['username']=$_POST['username'];
					$_SESSION['home']['phone']=$_POST['phone'];
					//将删除后的信息保存到session中
					
					
					echo '登陆成功';
					
					header('location:./index.php?c=index&a=index') ;
					
					}
				
			}else{
				//当bool值为假的情况只剩下，用户名重复。需要排除
				
			}

			
			

	 	}
	 	//登录
	 	public function inlogin(){
	 		//var_dump($_POST);
	 		$username=htmlspecialchars($_POST['username']);
			$password=md5($_POST['password']);
	
			//用PDO来读取用户
	 		$dsn='mysql:host=localhost;dbname=ss19_shop;charset=utf8';
	 		$pdo=new PDO($dsn,'root','');
	 		$pdo->setAttribute(3,1);
	 			//设置SQL语句
	 		$sql="SELECT id,password,username FROM user_home WHERE username='{$username}' ";


	 		$userlist = $pdo->query($sql);
			$userlist=$userlist->fetchAll(2);
			//var_dump($sql);
	 		//var_dump($userlist);

	 		
	 			//当返回的为空时，表示账号不存在。
	 			if(empty($userlist)){
	 				echo '您的账号不存在，请注册后登录。';
	 				exit;
	 			}
				//当账号能够匹配到，进行密码验证
				if($userlist[0]['password']==$password){
						echo '登录成功';
						//var_dump($_POST);
						//var_dump($userlist);

						$_SESSION['home']['id']=$userlist[0]['id'];
						$_SESSION['home']['username']=$userlist[0]['username'];
							header('location:./index.php?c=index&a=index') ;
						//var_dump($_SESSION);
						
					}else{
						echo '密码错误';
						exit;
					}

				
				}



				//用户的个人中心，收货地址管理
				
				public function user_address(){
					
					 	// 调用头
					 	$header=new IndexController;
						$header=$header->head();
						

						$username=$_GET['user'];
							//pdo
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
						$uid=$userlist[0]['id'];
						$dsn='mysql:host=localhost;dbname=ss19_shop;charset=utf8';
	 					$pdo=new PDO($dsn,'root','');
	 					$pdo->setAttribute(3,1);
						//收货人表用WHERE条件，得到收获人的所有信息
						$sql="SELECT * FROM user_address WHERE uid='{$uid}' ";
						$result=$pdo->query($sql);
									//echo $sql;
						$user_hlist = $pdo->query($sql);
						$user_hlist=$user_hlist->fetchAll(2);
						//现在得到$user_hlist就是收获人表中的详细信息
						if($user_hlist){
							
							 include './Include/address.html';
							
						}else{
								$uid=$userlist[0]['id'];
								//var_dump($uid);

							 include './Include/address.html';
/*
								$sql="INSERT INTO user_address(uid,addname,phone,address) VALUES(:uid,:addname,:phone,:address)";

						 		$stmt=$pdo->prepare($sql);
						 				echo $sql;
						 		//var_dump($stmt);
						 		
						 		$bool=$stmt->execute($_POST);
						 		var_dump($_POST);
						 		var_dump($bool);*/
						 		

						}
												
						//这是先通过传过来的username，在用户表里面取得用户的id.
						
								//再通过数组得到的id，再收货人表里面查询所有的收货人！

				 $foot=new IndexController;
				$foot=$foot->foot();

				}

				public function add_address(){
					//echo '添加联系人的地址';
					var_dump($_POST);
				
					// 得到了需要添加的内容
					$dsn='mysql:host=localhost;dbname=ss19_shop;charset=utf8';
	 				$pdo=new PDO($dsn,'root','');
	 				$pdo->setAttribute(3,1);

	 				$sql="INSERT INTO user_address(uid,addname,phone,address,code) VALUES(:uid,:addname,:phone,:address,:code)";

					$stmt=$pdo->prepare($sql);
						

					$bool=$stmt->execute($_POST);
					if($bool){

						echo '收件人添加成功，前往订单页完成订单';
						header('location:index.php');
					}else{
						echo '收件人添加失败，请重新添加';
						header('location:./Include/address.html');
					}

				}





				public function user_add(){


				}

			




			
			

	 	

	 	//注销
	 	public function outlogin(){
	 		unset($_SESSION['home']);
	 		header('location:./index.php');
	 	}

	 }