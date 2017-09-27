<?php

	//安装类
	
	class  Install{
		//显示方法
		public function index(){
			include './index.html';
		}
		//显示系统信息
		
		public function myserver(){
			//var_dump($_POST);

			//判断你是否点击了已阅读
			if(empty($_POST['yd'])){
				echo '请先阅读内容在过来谢谢合作<a href="./index.php?a=index"> 上一步</a>';exit;
			}
			include './myserver.html';
		}

		//显示配置文件
		public function config(){
			include './config.html';
		}
		//用于处理用户输入的信息
		public function doconfig(){
			var_dump($_POST);
			//连接数据库
			$link = mysqli_connect($_POST['host'],$_POST['user'],$_POST['pwd']);

			//删除数据库 确保数据库没有你一会要创建的数据库
			$sql="DROP DATABASE IF EXISTS {$_POST['db']}";
			mysqli_query($link,$sql);
			//创建数据库
			//mysqli_query($link,'CREATE DATABASE IF EXISTS'.$_POST['db']);
			$sql="CREATE DATABASE IF NOT EXISTS {$_POST['db']}";
			mysqli_query($link,$sql);
			
			//选择数据库
			mysqli_select_db($link,$_POST['db']);
			//设置字符集
			mysqli_set_charset($link,'utf8');
			//导入数据库创建表语句
			include './project.php';
			//往选择的库中创建表
			//使用循环发送sql语句
			foreach($arr as $val){
				mysqli_query($link,$val);
				echo '创建表成功<br/>';
			}
			//添加管理员
			
			$time = time();
			$pwd = md5($_POST['adminpwd']);
			$sql="INSERT INTO user(username,password,level,addtime) VALUES('{$_POST['name']}','{$pwd}',2,'{$time}')";
			$result = mysqli_query($link,$sql);

			if($result && mysqli_affected_rows($link)>0){
				echo '安装成功';
				echo '<a href="../admin">去后台</a>';
				echo '<a href="../home">去前台</a>';
				touch('./xiaopangzi.lock');
			}else{
				echo '安装失败';
			}
			//将config文件修改为我们修改后的内容
			
			$str= <<<EOF
<?php
	define('HOST','{$_POST['host']}');
	define('USER','{$_POST['user']}');
	define('PWD','{$_POST['pwd']}');
	define('DB','{$_POST['db']}');
	define('CHARSET','utf8');

EOF;
		//替换的方式写入文件中
		file_put_contents('../public/Config/config.php',$str);

		}

	}