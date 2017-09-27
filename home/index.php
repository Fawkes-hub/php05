<?php
		//所有的内容都是从这里跳转
	//开启session
	session_start();

	date_default_timezone_set('PRC');

	//导入文件
	//include '../public/Config/config.php';
	// include './Model.class.php';
	// include './Page.class.php';
	// include './IndexController.class.php';
	// include './UserController.class.php';
		
	//当你new 一个对象的时候当类不存在的时候自动触发的魔术函数
	
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


	//用一个方法来调用数据库中间的商品数据
	//


	// //得到index对象
	// $index  = new IndexController();
	// //访问对象里面的成员方法
	// $index->$a();

	// //得到User对象
	// $user = new UserController();
	// //访问对象里面的成员方法
	// $user->$a();

	//获取类名
	$c = isset($_GET['c'])?$_GET['c']:'index';
	
	//拼接类名
	$c = ucfirst(strtolower($c));
	//echo $c;
	$con = $c.'Controller';
	//实例化对象
	$controller = new $con;
	//获取成员方法的方法名
	$a =isset($_GET['a'])?$_GET['a']:'index';
	//var_dump($controller);
	//方法成员方法
	$controller->$a();


