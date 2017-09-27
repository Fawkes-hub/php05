<?php
// if(!@$_SESSION['admin']){
// 		echo '请从登录页面登入';
//  }

	//index类
	class IndexController{
		//查询方法
		public function  index(){
			//echo '<a href="./index.php?c=user&a=index">跳转到user控制器下面的index方法</a>';
			
			if(empty($_SESSION['admin'])){
				header('./location:inpdex.php?c=index&a=inlogin');
			}else{
				
				include './View/index.html';
			}
		}

		public function login(){
			include './View/login.html';
			//由登录页面之间跳转过来
			

		}

		public function inlogin(){
			//接受数据
			
			unset($_POST['x']);
			unset($_POST['y']);
			//var_dump($_POST);
			/*$name= $_POST['username'];
			$password=$_POST['password'];
			var_dump($name);
			$preg='/^[A-Za-z]\w{5,15}/';
			if(!preg_match($preg,$name,$arr)){
				$username='账号或密码输入错误，请重新输入1';
				$mask=true;
				echo $username;
			}
			
			var_dump(preg_match($preg,$name,$arr));
			
			$leng=strlen($password);
			if($leng<6){
				$password='账号或密码输入错误，请重新输入2';
				$mask=true;
					echo $password;
			}

			if($mask){
			//如何判断是不是由登陆页面跳转进来的？
			var_dump($mask);*/
			//转换一下，与后台数据相匹配
			$username=htmlspecialchars($_POST['username']);
			$password=md5($_POST['password']);
			//先把账号密码进行正则匹配
			
	
	//把发过来的内容和数据库中间的内容进行匹配
			//把发过来的内容和数据库中间的内容进行匹配
			
			$userarr['username']=$username;
			$userarr['password']=$password;
			$userarr['level']=2;
			//var_dump($userarr);
			//正则匹配一下账号密码



			$user=new Model('user');
			
			$a=$user->where($userarr)->select();
			
			if($a){
			//不保存密码，销毁密码
			unset($_SESSION[0]['password']);
			//将删除后的信息保存到session中
			$_SESSION['admin']=$username[0];
			
			echo '登陆成功';

			header('location:./index.php?c=index&a=index') ;
			
			exit;
			}else{


			echo '账号或密码输入错误，请重新输入3';
			}

		
}

		//退出的方法
		public function outlogin(){
			//销毁session
			//var_dump($_GET);
			unset($_SESSION['admin']);
			
			header('location:./index.php') ;
		}

		//添加方法
		public function add(){
			//echo 'Index 添加方法';
			include './View/add.html';
		}
		//更新方法
		public function save(){
			echo 'Index 更新方法';
		}
		//删除方法
		public function del(){
			echo 'Index 删除方法';
		}




	}