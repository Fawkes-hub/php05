<?php 
	
	//echo '这是后台admin的index.php页面';

	//导入文件
	
	include './Config/config.php';
	session_start();
	// if(!$_SESSION['admin']){
	// 	header('location:./index.php');
	// }
	date_default_timezone_set('PRC');

	function __autoload($className){
		//截取你的得到的类名 比较看是否符合那个条件 符合则进行相应加载
		if(substr($className,-10)=='Controller'){
			include './Controller/'.$className.'.class.php';
		}else if(substr($className,-5) =='Model'){
			include './Model/'.$className.'.class.php';
		}else{
			include './Org/'.$className.'.class.php';
		}
	}


	// class BaseController extends IndexController{
	// 	parent::__construct();
	// }

	

	//传输两个值C 与 A
	//获取类名
	$c=isset($_GET['c'])?$_GET['c']:'index';

	$c=ucfirst(strtolower($c));
	//拼接类名
	$con=$c.'Controller';
	//var_dump($con);

	//拼接方法名
	$Controller=new $con;

	$a=isset($_GET['a'])?$_GET['a']:'login';
	//var_dump($a);

	//选中这个方法
	$Controller->$a();











	?>