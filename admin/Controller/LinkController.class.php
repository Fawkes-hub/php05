<?php 
// if(!$_SESSION['admin']){
// 		header('location:./index.php');
// 	 }


	class LinkController{
		public function index(){
			
			if(!empty($_GET['name'])){


				$map['linkname']=array('like',$_GET['name']);

			}else{
				$map='';
				
				}
		
			$link = new Model('hyperlink');
			
			$total=$link->where($map)->count();
			
			$page = new Page($total,8);
			
			$linklist = $link->where($map)->limit($page->limit)->select();

			//var_dump($linklist);


			$i=1;

			include './View/link/index.html';




		}

		public function add(){
			echo '链接添加页面';
			include './View/link/add.html';
		}
		public function doadd(){
			//var_dump($_POST);

			//要让链接变成以 http://www.  这种样子开头，直接用正则表达式限制
			//
			$link=new Model('hyperlink');
			$result=$link->add($_POST);

			if($result){
				echo '添加成功，<a href="./index.php?c=link&a=index">请返回列表</a>';
				header("refresh:2;url='./index.php?c=link&a=index'");
			}else{
				echo '添加失败,<a href="./index.php?c=link&a=index">请返回列表</a>';
				header("refresh:2;url='./index.php?c=link&a=index'");
			}




		}
		
		//编辑方法
		public function save(){
			echo '编辑方法';
			
			
			
			$id = $_GET['id'];
			var_dump($_GET['id']);
			$user = new Model('hyperlink');
			$links = $user->find($id);
			
			//var_dump($links);
			
			
			include './View/link/edit.html';
		}
		
		public function dosave(){
		//	var_dump($_POST);
			$id = $_POST['id'];
			$links = new Model('hyperlink');
		//	$links = $links->update($id);
			$result=$links->where($_POST['id'])->update($_POST);
			
			//include './View/link/edit.html';
			header('refresh:1;url="./index.php?c=link&a=index"');
		
		}
		
		
		
		public function status(){
			$data['display']=$_GET['display'];
			$data['id']=$_GET['id'];
			
			//把数据传入数据库，然后更新
			$links=new Model('hyperlink');
			$result=$links->update($data);

			if($result){
					header('location:./index.php?c=link&a=index');
				}else{
					header('location:./index.php?c=link&a=index');
				}
		}
		
		

	}