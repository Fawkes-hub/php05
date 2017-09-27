<?php

	//安装index
	include './install.class.php';
	//得到安装对象
	
	$install = new Install();
	//var_dump($install);
	
	//调用方法
	$a= isset($_GET['a'])?$_GET['a']:'index';

	//调用方法
	
	$install->$a();