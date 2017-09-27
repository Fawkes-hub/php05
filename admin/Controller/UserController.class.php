<?php

if(!$_SESSION['admin']){
		header('location:./index.php');
	 }


	//用户类
	class UserController{
		//查询方法
		public function  index(){
			//增加查询方法
			//var_dump($_GET['username']);
			if(!empty($_GET['username'])){
				$map['username']=array('like',$_GET['username']);

			}else{
				$map='';
			}
			
			$user = new Model('user');
			$total=$user->where($map)->count();
			$page = new Page($total,8);
			$userlist = $user->where($map)->limit($page->limit)->select();
			//$userlist = $map->limit($page->limit)->select();
			//var_dump($userlist);
			//
			//
			//
			$arr = array('普通会员','普通管理员','超级管理员','禁用');
			 if(!empty($userlist)){


			 foreach($userlist as $key=>$val){
			 	$userlist[$key]['level']=$arr[ $val['level'] ];		 				 	
			 }

			 }
			 //
			 //var_dump($userlist);
			//echo '导入页面';
			$i=1;
			include './View/user/index.html';

		}
		//添加方法
		public function add(){
			include './View/user/add.html';
		}
		//处理添加方法
		public function doadd(){
			if($_POST['password'] != $_POST['repassword']){
				echo '两次密码不一致，请<a href="./View/user/add.html">返回</a>重新输入';
				header("refresh:2;url='./View/user/add.html'");
				exit;
			}

			unset($_POST['repassword']);
			
			$_POST['addtime']=time();
			$_POST['password']=md5($_POST['password']);

			


			$user = new Model('user');
			$result=$user->add($_POST);
			
			if($result){
				echo '注册成功<a href="./index.php?c=user&a=index&page=1">返回</a>';
			}else{
				echo '注册失败,请<a href="./View/user/add.html">返回</a>重新注册';
				header("refresh:2;url='./View/user/add.html'");
			}
		}

		//更新方法
		public function save(){
			// echo 'User 更新方法';
			//var_dump($_GET);
			$id = $_GET['id'];
			$user = new Model('user');
			$userinfo = $user->find($id);
			//var_dump($userinfo);
			include './View/user/edit.html';
		}

		//处理更新方法
		public function dosave(){
			
			$_POST['newpassword']=md5($_POST['newpassword']);
			$_POST['renewpassword']=md5($_POST['renewpassword']);
			//var_dump($_POST);
			//判断是否输入了新密码
			if(empty($_POST['newpassword']) && empty($_POST['renewpassword'])){
				//echo '新密码不存在,显示老密码';
				
				unset($_POST['newpassword']);
				unset($_POST['renewpassword']);
				//var_dump($_POST);

			}else{
				//判断新密码和老密码是否一样
				$id=$_POST['id'];
				if($_POST['newpassword']==$_POST['password']){
					echo "新密码与老密码不可相同,请<a href='./index.php?c=user&a=save&id={$id}'>返回</a>重新输入";
					header("refresh:2;url='./index.php?c=user&a=save&id={$id}");
					exit;	
					}

				//echo '新密码存在，去除老密码';
				
				unset($_POST['password']);
		
				//判断两次密码是否一样
				if($_POST['newpassword'] != $_POST['renewpassword']){
					
					echo "两次新密码不一致，请<a href='./index.php?c=user&a=save&id={$id}''>返回</a>重新输入";
					header("refresh:2;url='./index.php?c=user&a=save&id={$id}'");
					exit;
				}
				unset($_POST['renewpassword']);
				
				$_POST['password']=$_POST['newpassword'];
				
				unset($_POST['newpassword']);
				
				//var_dump($_POST);
				
				$_POST['addtime']=time();

				//$_POST['password']=md5($_POST['password']);
			
				//var_dump($_POST);
			
				}

			$user = new Model('user');
			if($user->update($_POST)){
				echo '修改成功,<a href="./index.php?c=user&a=index">返回</a>列表页......';
				header("refresh:4;url='./index.php?c=user&a=index'");
			 }else{
			 	echo '很遗憾，修改失败了，<a href="./index.php?c=user&a=index">返回</a>列表页中......';
			 	header("refresh:4;url='./index.php?c=user&a=index'");
			 }
		}
		//删除方法
		public function del(){
			//echo 'User 删除方法';
			//var_dump($_GET);
			$id = $_GET['id'];
			$user= new Model('user');
			if($user->del($id)){
				header('location:./index.php?a=index&c=user&page=1');
			}else{
				header('location:./index.php?a=index&c=user');

			}
		}

		public function information(){
				//判断这个id对应的UID是否存在就能够知道，有就提出来，没有就添加
				
				
			$id=$_GET['id'];
			//var_dump($_GET);
			//我要通过id的值，来对应UID，在通过where判断 uid=id时的值。
			
			$uid['uid']=$id;

			//var_dump($uid);

			$infor=new Model('user_u');
			
			$arr=$infor->where($uid)->select();
			//得到arr数据，存在两种可能性，有值为数组，或者没有值为null
			//var_dump($arr);
			if($arr){
				//如果有值，就进行修改
				
				include './View/user/infor.html';
			}else{
				//如果没有值就进行添加
				
				include './View/user/infor.html';
			}
			
			
				
			


		}

		public function doinfor(){
				// foreach ($_POST as $value) {
				// 		if($value==''){
				// 			echo '请填写完整内容';
				// 		}
				// }
				
		
			if($_POST['uid']==''){
				
				//添加操作
				//我们需要把头像添加进去
					//上传头像的四部
					
					$uploads=new upload('pic');
					//设置允许文件上传的保存路径
					$uploads->path='../public/uploads/';
					//执行文件上传
					$bool=$uploads->do_upload();

					if(!$bool){
						echo '文件上传失败';
						exit;
						}
						
						
					$_POST['pic']=@$bool['name'];
					//var_dump($_POST);
					
					//var_dump($_GET);
					//用GET传过来的用户id添加到post下面的uid中
					$_POST['uid']=$_GET['id'];
					$id=$_POST['uid'];
					$username=$_GET['username'];


				$infor=new Model('user_u');
				$result= $infor->add($_POST);

				if($result){
					echo "添加成功,<a href='./index.php?c=user&a=information&id={$id}&username={$username}'>返回</a>详情页。";
					header("refresh:2;url='./index.php?c=user&a=information&id={$id}&username={$username}'");
				}else{
					echo "添加失败,请<a href='./index.php?c=user&a=information&id={$id}&username={$username}'>返回</a>输入";
					header("refresh:2;url='./index.php?c=user&a=information&id={$id}&username={$username}'");
				}
			}else{

				//下面是编辑过程
					//如果没有图片的编辑过程
					if($_FILES['pic']['name']==''){
						$infor=new Model('user_u');
				//var_dump($_POST);
					$uid['uid']=$_POST['uid'];
					$result=$infor->where($uid)->update($_POST);
					$id=$_POST['uid'];
					$username=$_GET['username'];
					if($result){
						echo "修改成功,<a href='./index.php?c=user&a=information&id={$id}&username={$username}'>返回</a>详情页。";
						header("refresh:2;url='./index.php?c=user&a=information&id={$id}&username={$username}'");
					}else{
						echo "修改失败,请<a href='./index.php?c=user&a=information&id={$id}&username={$username}'>返回</a>输入";
						header("refresh:2;url='./index.php?c=user&a=information&id={$id}&username={$username}'");
					}
				}else{
					//有图片上传的编辑
						//有图片的编辑我门就需要先把之前的删除了，再上传新的
						$infor=new Model('user_u');
						$uid['uid']=$_POST['uid'];
						$result=$infor->where($uid)->select();
						//var_dump($result);
						//将原来的图片名放到一个变量里,后面用来赋值给新图片
						$oldname=$result['0']['pic'];
						//再把新图片更新到图片位置
						$uploads=new Upload('pic');
						$uploads->path='../public/uploads/';
						$bool=$uploads->do_upload();
						if(!$bool){
							echo '文件上传失败';
							exit;
						}
						// 将新上传的图片名称放置再更新的pic字段的位置
						$_POST['pic']=$bool['name'];
						$uid['uid']=$_POST['uid'];
						$id=$_POST['uid'];
						$username=$_GET['username'];
						$result=$infor->where($uid)->update($_POST);
						if($result){
							unlink('../public/uploads/'.$oldname);
							echo "修改成功,<a href='./index.php?c=user&a=information&id={$id}&username={$username}'>返回</a>详情页。";
							header("refresh:2;url='./index.php?c=user&a=information&id={$id}&username={$username}'");
						}else{
							echo "修改成功,<a href='./index.php?c=user&a=information&id={$id}&username={$username}'>返回</a>详情页。";
							header("refresh:2;url='./index.php?c=user&a=information&id={$id}&username={$username}'");
						}

						
				}





				//如果出来的结果为真，表示已经有了，就进行修改操作
				
			}
			
			
			



		}



	}