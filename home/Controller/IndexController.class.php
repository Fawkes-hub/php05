<?php 
	
	class IndexController{
			public $sql; 	//设置默认的sql语句
			public $stmt;	//储存发送的语句
			public $goods;	//把商品信息储存在上面

		//提出来的头部
		public function head(){
			include './view/head.html';
		}

			
	

		public function index(){
			
			//调用头的方法，是网页拼接
			$this->head();
			//var_dump($_SESSION);
			//通过传过来的typeid，在数据库中把数据得到
			$album=new Model('album');
			//var_dump($album);

			$res=$album->select();

			//var_dump($res);
			include './view/index.html';
			//$this->foot();
		}
		//用来显示相册详情的方法
		public function content(){
				$this->head();
                //var_dump($_GET);
				unset($_GET['c']);
				unset($_GET['a']);
				$map['alb_id'] =$_GET['alb_id'];
				
			$pic=new Model('pic');
			$res=$pic->where($map)->select();
			

			
			include './view/picture.html';
		}
		//添加相册照片
		public function pic_add(){
			//$this->head();
			//echo '添加照片';
			include './view/pic_add.html';
		}
		public function pic_doadd(){
			//echo '添加照片准备';
			//var_dump($_POST);
			//var_dump($_FILES);
			//var_dump($_FILES['fm_name']['name']);
			$fm_name=$_FILES['fm_name'];
			
			foreach ($fm_name as $key => $value) {
				//var_dump($key);
				//var_dump($value);
				}
				foreach ($value as $k => $v) {
					# code...
					//var_dump($k);
					//var_dump($v);
					$data=array(
				'name'=>$fm_name['name'][$k],
				'type'=>$fm_name['type'][$k],
				'tmp_name'=>$fm_name['tmp_name'][$k],
				'error'=>$fm_name['error'][$k],
				'size'=>$fm_name['size'][$k]


				);
					$_FILES['fm_name']=$data;


					//需要把文件传过去 4步
				$type=new Upload('fm_name');
				
				//书写保存路径
				$type->path='../public/picture/';
				//执行文件上传
				$bool=$type->do_upload();
				


				if(!$bool){
				echo '文件上传失败';
			}
			//通过文件名，插入图片库的其他选项
			$time=time();
			
			$_POST['user_name']=$_SESSION['username'];
			$_POST['pic_name']=@$bool['name'];
			$_POST['pic_size']=$fm_name['size'][$k];
			$_POST['pic_time']=$time;

			//进行数据的添加
               $username=$_SESSION['username'];
			$album=new Model('pic');
			$result=$album->add($_POST);

			}
			if($result){
				echo  "<script>alert('添加成功');history.go(-2)</script>";
			

			}else{
				//图片上传成功，但是添加失败
				unlink('../public/picture/'.$_POST['pic_name']);
				echo  "<script>alert('添加成功');history.go(-2)</script>";
			
			}

			
			
			
			
				
			

		}

		//用来显示个人相册
		public function user_album(){
				$this->head();
				//调用头的方法，是网页拼接
			//var_dump($_SESSION);
			$data['user_name']=$_SESSION['username'];
			//var_dump($data);
			
			//var_dump($_SESSION);
			//通过传过来的typeid，在数据库中把数据得到
			$album=new Model('album');
			//var_dump($album);

			$res=$album->where($data)->select();
			//var_dump($res);
			include './view/user_album.html';
		}

		//添加相册
		public function add(){
			//$this->head();
			include './view/add.html';
		}
		//相册添加处理
		public function doadd(){
			//$this->head();
			//var_dump($_SESSION);
			//var_dump($_POST);
			//var_dump($_FILES);

			//需要把文件传过去 4步
			$type=new Upload('fm_name');
			//var_dump($type);

			//书写保存路径
			$type->path='../public/picture/';
			//执行文件上传
			$bool=$type->do_upload();

			//var_dump($bool);
			//判断文件是否上传
			if(!$bool){
				echo '文件上传失败';
			}
			//文件上传的名字，需要这个是为了后面能够拼接路径可以在页面之间查看
			$_POST['user_name']=$_SESSION['username'];
			$username=$_SESSION['username'];
			$_POST['fm_name']=$bool['name'];
			//var_dump($_POST);
			//进行数据的添加
			$album=new Model('album');
			$result=$album->add($_POST);
			
			if($result){
				echo  "<script>alert('相册添加成功');history.go(-2)</script>";
				
			}else{
				//图片上传成功，但是添加失败
				unlink('../public/picture/'.$_POST['pic']);
				echo  "<script>alert('相册添加失败');history.go(-2)</script>";
				
			}


		}











/*************下面是登录的控制方法***********************/
		public function login(){
			include './View/login.html';
			//由登录页面之间跳转过来
			

		}

		public function inlogin(){
			//接受数据
			var_dump($_POST);
			// var_dump($_SESSION);
			
			unset($_POST['x']);
			unset($_POST['y']);
			
			//转换一下，与后台数据相匹配
			$username=htmlspecialchars($_POST['username']);
			$password=md5($_POST['password']);
			//先把账号密码进行正则匹配
			
	
	//把发过来的内容和数据库中间的内容进行匹配
			//把发过来的内容和数据库中间的内容进行匹配
			
			$userarr['username']=$username;
			$userarr['password']=$password;
			//$userarr['level']=2;
			//var_dump($userarr);
			//正则匹配一下账号密码



			$user=new Model('user');
			
			$a=$user->where($userarr)->select();
			
			if($a){
			//不保存密码，销毁密码
			unset($_SESSION[0]['password']);
			//将删除后的信息保存到session中
			
			
			$_SESSION['username']=$username;
			
			

			header('location:./index.php?c=index&a=index') ;
			
			exit;
			}else{

			echo  "<script>alert('账号或密码输入错误，请重新输入');history.go(-1);</script>";		
			
			}

		
		}
		//新建用户的方法
		public function NewUser(){
			include './View/newuser.html';
			//由注册页面之间跳转过来
		}
	 	public function doNewUser(){
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
				
	 		
	 		//接受到之后要先判断密4码与确认密码是否相等
	 		 if($_POST['password']==$_POST['repassword']){
		 	 		unset($_POST['repassword']);
		 	// 		unset($_POST['agree']);
		 			//var_dump($_POST);
		 	//		unset($_POST['repassword']);
		 			$_POST['password']=md5($_POST['password']);
		 						
		 		//用PDO来新建用户
		 		$dsn='mysql:host=localhost;dbname=xiangche;charset=utf8';
		 		$pdo=new PDO($dsn,'root','');
		 		$pdo->setAttribute(3,1);
		 		//先要进行查询，数据库中是否已经存在了相同的用户名.
		 		$sql="SELECT password FROM user WHERE username='{$_POST['username']}' ";
			 		$userlist = $pdo->query($sql);
					$userlist=$userlist->fetchAll();
					//var_dump($sql);
			 		//var_dump($userlist);
			 		if(!empty($userlist)){
			 			
			 			echo  "<script>alert('用户名已存在,请直接登录');history.go(-1);</script>";
			 			exit;
			 			
			 		}
		 		
	 		//准备sql语句
	 		$sql="INSERT INTO user(username,password) VALUES(:username,:password)";

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
					var_dump($_POST);
					$_SESSION['username']=$_POST['username'];
					
					//将删除后的信息保存到session中
					
					
					
					
					header('location:./index.php?c=index&a=index') ;
					
					}
				
			
		}else{
	 		    
                 echo  "<script>alert('两次密码不一样请重新输入');history.go(-1);</script>";
                 //header('location:./index.php?c=index&a=login') ;
	 		 }
        }

		//退出的方法
		public function outlogin(){
			//销毁session
			//var_dump($_GET);
			unset($_SESSION['username']);
			
			header('location:./index.php') ;
		}


	}