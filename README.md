# php05
单商家项目 

1.项目分为 : 客户需求  和 自行研发
商城项目:
		商城分类
			  单商家	 商家就是网站的所有者    小米 凡客 vip 魅族 苹果  C2C
			  多商家	 网站的所有者不是卖家    淘宝 B2C

			  单商家

项目的开发过程 
	   1.需求分析

	   			  项目的功能模块
	   			  	   前台 : 首页 列表页 详情页 购物车  订单页 个人中心 注册页等等
	   			  	   后台 ： 会员模块  类别模块  商品模块 订单模块
	   	2.数据库设计

	   			1. 找实体
	   			2. 为实体找属性 
	   			3. 找关系
	   	3.程序设计
	   			项目的目录结构
	   			project
-----------------------------------------------------------------------------------------
			 |-- admin  网站后台目录
			 |		|-- Include  //网站后台公共目录
			 |		|	  |---Images //后台图片资源目录
			 |		|	  |---Css 	 //后台css样式
			 |		|	  |---Js 	 //后台js文件
			 |		|-- View   //视图层
			 |		|	  |---user //会员模块目录	
			 |		|	  |---type //分类模块目录	
			 |		|	  |---goods //商品模块目录	
			 |		|	  |---order //订单模块目录	
			 |		|	  |---login //后台管理员登录与退出模块目录	
			 |		|-- Controller   //控制器
			 |		|     |--- IndexController.clss.php //显示网站后台主页(后台登录与退出)
			 |		|     |--- UserController.clss.php //操作会员模块
			 |		|     |--- TypeController.clss.php //操作分类模块
			 |		|     |--- GoodsController.clss.php //操作商品模块
			 |		|     |--- OrderController.clss.php //操作订单模块
			 |		|-- Model   //模型层
			 |              |     |--- Model.class.php // 数据库操作类  自己写
			 |   	        |-- Org  //扩展目录
			 |		|     |--- 需要我们扩展的类 或者扩展的函数
			 |		|--index.php  访问后台入口文件
			 |
			 |
			 |
			 |
			 |-- home   网站前台目录
			 |		|-- Include  //网站前台公共目录
			 |		|	  |---Images 	//前台图片资源目录
			 |		|	  |---Css 	 	//前台css样式
			 |		|	  |---Js 	 	//前台js文件
			 |		|	  |---head.html //前台网页公共页
			 |		|	  |---foot.html //前台网页公共页
			 |		|-- View  
			 |		|     |--- user -会员相关操作
			 |		|     |--- goods-商品相关操作
			 |		|     |--- cart -购物车相关操作
			 |		|     |--- order-订单相关操作
			 |		|     |--- login-前台 注册登录相关操作
			 |		|--Controller -控制器
			 |		|	  |--- UserController.class.php
			 |		|	  |--- GoodsController.class.php
			 |		|	  |--- IndexController.class.php
			 |		|	  |--- OrderController.class.php
			 |		|	  |--- CartController.class.php -- 购物车操作控制器
			 |              |-- Model 
			 |              |     |--- 前台我们不使用model 全部使用pdo 
			 |		|-- index.php 前台入口文件
			 |--Public  公共资源目录  数据库配置文件  图片上传目录
			 |--index.php 网站入口文件
			 |--index.html  空文件  防止跳墙的

		4.编码阶段
		5.项目测试  
		6.验收完工
