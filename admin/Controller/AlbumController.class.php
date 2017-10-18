<?php
	


	class AlbumController{
		public function index(){
			//echo '商品查看页面';
			
			//var_dump($_GET);
			
			//查询操作
			if(!empty($_GET['name'])){
				$map['name']=array('like',$_GET['name']);

			}else{
				$map='';
			}
				$goods=new Model('album');
				$total=$goods->where($map)->count();
				$page=new page($total,6);
				$result=$goods->where($map)->limit($page->limit)->select();

				$i=1;


			include './View/album/index.html';
		}
		//查看相册详细照片
		public function content(){
			//echo'用来查看相册详细照片';
				//搜索照片
			if(!empty($_GET['name'])){
				$map['pic_name']=array('like',$_GET['name']);
				$pic=new Model('pic');
					//$total=$goods->where($map)->count();
					//$page=new page($total,6);
					$result=$pic->where($map)->select();
					//echo ($pic->sql);
					$i=1;
					include './view/pic/index.html';
					exit;
			}else{
				$map='';
			}

				$map['alb_id']=@$_GET['id'];

				//var_dump($map);
				$pic=new Model('pic');
				//$total=$goods->where($map)->count();
				//$page=new page($total,6);
				$result=$pic->where($map)->select();
				//echo ($pic->sql);
				$i=1;


			include './view/pic/index.html';
		}

		

		public function status(){
			$data['status']=$_GET['status'];
			$data['id']=$_GET['id'];
			
			//把数据传入数据库，然后更新
			$goods=new Model('goods');
			$result=$goods->update($data);

			if($result){
					header('location:./index.php?c=goods&a=index');
				}else{
					header('location:./index.php?c=goods&a=index');
				}
		}

		public function del(){		
			$albs=new Model('album');

			$sql="DELETE FROM album WHERE alb_id={$_GET['alb_id']}";
			
			$result=$albs->execute($sql);
			if($result){
				header('location:./index.php?c=album&a=index');
				  //echo '<script>alert("恭喜您，操作成功！"); .history.go(-1); </script>';
			}else{
				echo '错误';
				//header(location:.getenv("HTTP_PRFERER"));
			}
		}
		//图片的删除
		public function pic_del(){		

			$pics=new Model('pic');

			$sql="DELETE FROM pic WHERE pic_id={$_GET['pic_id']}";
			
			$result=$pics->execute($sql);
			if($result){
				header('location:./index.php?c=album&a=index');
				  //echo '<script>alert("恭喜您，操作成功！"); .history.go(-1); </script>';
			}else{
				echo '错误';
				//header(location:.getenv("HTTP_PRFERER"));
			}
		}

		public function save(){
			
			//var_dump($_GET);
			$alb=new Model('album');
			$result=$alb->find($_GET['alb_id']);
			//这个是商品的商品分类 typeid，用来在后面三元运算的时候进行匹配，相同者默认，不同者不同		
			//这是用传默认的商品分类的
			//$typeid=$result['typeid'];
			//var_dump($typeid);

			//$type=new Model('type');

			//$typeresult=$type->order("CONCAT(path,id,',')ASC")->select();
			
			//var_dump($typeresult);
			//这是用来传图片信息的
			
			//var_dump($result);
			

			include './View/album/edit.html';
		}

		public function dosave(){
			//var_dump($_POST);
			
			if($_FILES['pic']['name']==''){
				//当文件域下面的name不存在的时候，就说明没有上传新的头像，则调用老头像的名字，保持文件不变
				//var_dump($_POST['oldpic']);
				$_POST['pic']=$_POST['oldpic'];
				unset($_POST['oldpic']);

				//var_dump($_POST);

			
				
			}else{
				//当上车了新的头像文件，就使用新的文件替换老的文件
				 // var_dump($_FILES);
				  //需要把文件传过去 4步
				$type=new Upload('pic');
				//书写保存路径
				$type->path='../public/goods/';
				//执行文件上传
				$bool=$type->do_upload();

				//var_dump($bool);
				//判断文件是否上传
				if(!$bool){
					echo '文件上传失败';
				}
				//文件上传的名字，需要这个是为了后面能够拼接路径可以在页面之间查看
				$_POST['pic']=$bool['name'];
					//删除数据库中原有的老照片
				unlink('../public/goods/'.$_POST['oldpic']);
					//去除老照片的键值
				unset($_POST['oldpic']);
				//var_dump($_POST);



			}
				$goods=new Model('goods');
				$result=$goods->where($_POST['id'])->update($_POST);

				if($result){
					echo '更新成功,	<a href="./index.php?c=goods&a=index">返回商品列表</a>';
					header('refresh:1;url="./index.php?c=goods&a=index"');
				}else{
					echo '更新成功,	<a href="./index.php?c=goods&a=index">返回商品列表</a>';
					header('refresh:1;url="./index.php?c=goods&a=index"');
				}
		
		}

		//搜索
		public function search(){

		} 















	}

?>