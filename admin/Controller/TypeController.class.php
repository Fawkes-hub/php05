<?php 

	// if(!$_SESSION['admin']){
	// 	header('location:./index.php');
	//  }


	class TypeController{

		
		public function index(){		
			//先判断你是否查询的子分类
			if(empty($_GET['name'])){


				if(empty($_GET['pid'])){
					$map['pid']=0;
					$weizhi='查看顶级分类';			
				}else{
					$map['pid']=$_GET['pid'];
					$weizhi='查看子分类';
				}
			}else{
				$map['name']=array('like',$_GET['name']);
			}
				$type=new Model('type');
				$typelist=$type->where($map)->select();

			//var_dump($typelist);

			$i=1;
			include './View/type/index.html';
		}
		public function back(){
			//返回上一级
			



			include './index.php?c=type&a=index';
		}

		public function add(){

			//var_dump($_GET['pid']);
			
			if(empty($_GET['pid'])){	//表示是添加分类
				$pid='0';
				$path='0,';
				$weizhi="添加顶级分类";
				

				}else{					//表示是添加子分类
					$pid=$_GET['pid'];
					
					$type=new Model('type');
					$typeinfo=$type->find($pid);
					//能够查询出来他的路径，再拼接父类的id
					
					$path=$typeinfo['path'].$typeinfo['id'].',';
					

					$weizhi="添加子分类";
				}
					include './View/type/add.html';
				
			}

		public function doadd(){
			
			
			
			//要销毁ID，id自增
			$type=new Model('type');
			$result=$type->add($_POST);
			

			if($result){
				echo '添加成功,<a href="./index.php?c=type&a=index">返回分类列表</a>';
				
				header("refresh:1;url='./index.php?c=type&a=index'");
			}else{
				echo '添加失败,<a href="./index.php?c=type&a=index">返回分类列表</a>';
				header("refresh:1;url='./index.php?c=type&a=index'");
			}
		}

		public function del(){
			
			//判断分类下面有没有子类

			$type=new Model('type');
			$map['pid']=$_GET['id'];		//查询是否有pid=id值的，就能够知道有没有id值的子类
			$result=$type->where($map)->select();
			//判断结果是否存在，就能够知道是否有值
			if($result){
				echo '父级分类无法直接删除，请<a href="./index.php?c=type&a=index">返回查看分类</a>';
				header("refresh:2;url='./index.php?c=type&a=index'");
			}else{
				if($type->del($_GET['id'])){
					header('location:index.php?c=type&a=index');
				}
					header('location:index.php?c=type&a=index');
			}
		}

		public function display(){
			$data['display']=$_GET['display'];
			$data['id']=$_GET['id'];

			//更新数据库里面的display字段的内容
			$type=new Model('type');
			$result=$type->update($data);
			if($result){
				header('location:index.php?c=type&a=index');
			}else{			
				header('location:index.php?c=type&a=index');
			}


		}


		public function save(){
			
			$id = $_GET['id'];
			$type = new Model('type');
			$typeinfor = $type->find($id);
			
			include './View/type/edit.html';
		}

		public function dosave(){
			
			$type=new Model('type');
			$result=$type->update($_POST);
			if($result){
				echo '修改成功，<a href="./index.php?c=type&a=index">返回当前列表</a>';
				header("refresh:1;url='./index.php?c=type&a=index'");
			}else{
				echo '修改失败，<a href="./index.php?c=type&a=index">返回当前列表</a>';
				header("refresh:1;url='./index.php?c=type&a=index'");
			}

		}


	}


 ?>