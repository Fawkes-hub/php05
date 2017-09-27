<?php
	
	echo '这是index.php,需要默认进入前台';
//在最外面判断文件是否存在，如果文件存在则安装过，不是第一次进入
//如果没有这个文件，则是第一次来到，就进入安装目录
	if(file_exists('./install/xiaopangzi.lock')){
		header('location:./home/index.php');
	}else{
		header('location:./install/index.php');
	}
	


?>