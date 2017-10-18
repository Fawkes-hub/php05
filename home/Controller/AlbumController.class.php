<?php 

	class AlbumController{

        public function head(){
            include './view/head.html';
        }
	   
		public function dodel(){

            $username=$_SESSION['username'];
			//var_dump($_POST);
			//得到了post里面传过来的相册alb_id
			$album=new Model('album');
			$sql="DELETE FROM album WHERE alb_id={$_GET['alb_id']}";
			$res=$album->execute($sql);
			if($res){
				//如果相册删除成功，就删除相册内所有照片
				$sql2="DELETE FROM pic WHERE alb_id={$_GET['alb_id']}";
				$res2=$album->execute($sql2);
					if($res2){
						echo  "<script>alert('相册及相册内照片删除成功');history.go(-1)</script>";
						// echo '相册及相册内照片删除成功';
						// header('refresh:1;url="./index.php?c=index&a=user_album&username='.$username.'"');
					}else{
						echo  "<script>alert('相册删除成功');history.go(-1)</script>";
						// echo '相册删除成功';
						// header('refresh:1;url="./index.php?c=index&a=user_album&username='.$username.'"');
					}
				
				
			}else{
				echo '删除失败';
				header('refresh:1;url="./index.php?c=index&a=user_album&username='.$username.'"');
			}
		}

		public function pic_del(){
			
			$album=new Model('pic');
			$sql="DELETE FROM pic WHERE pic_id={$_GET['pic_id']}";
			$res=$album->execute($sql);
			
			echo  "<script>alert('删除成功');history.go(-1)</script>";
			exit;
		
		}

		//相册的修改
		public function edit(){
			
			$map['alb_id']=$_GET['alb_id'];
			$album=new Model('album');
			$res=$album->where($map)->select();
			include './view/album/edit.html';
		}

		public function doedit(){
			//var_dump($_POST);
			//var_dump($_FILES);
            $username=$_SESSION['username'];
           // $this->head();
			$data['album_name']=$_POST['album_name'];
			$data['album_content']=$_POST['album_content'];
			$data['fm_name']=$_POST['old_fm_name'];
			$map['alb_id']=$_POST['alb_id'];
			
			if(empty($_FILES['fm_name']['name'])){
				$album=new Model('album');
				$res=$album->where($map)->update($data);
				if($res){
					//echo '修改成功';
					echo  "<script>alert('相册修改成功');history.go(-2)</script>";
                    // header('refresh:1;url="./index.php?c=index&a=user_album&username='.$username.'"');
				}else{
					//echo '修改失败';
					echo  "<script>alert('相册修改失败');history.go(-1)</script>";
                    // header('refresh:1;url="./index.php?c=index&a=user_album&username='.$username.'"');
				}


			}else{
				//有上传新封面
					//需要把文件传过去 4步
				$type=new Upload('fm_name');
				//var_dump($type);

				//书写保存路径
				$type->path='../public/picture/';
				//执行文件上传
				$bool=$type->do_upload();

				//var_dump($bool);
				//判断文件是否上传
				if(!$bool){
					echo '文件上传失败';
				}else{
					@unlink('../public/picture/'.$_POST['old_fm_name']);
					//echo '上传成功';
				}
				$data['fm_name']=$bool['name'];
				//var_dump($data);

				$album=new Model('album');
				$res=$album->where($map)->update($data);
				if($res){
					//echo '修改成功';
					echo  "<script>alert('相册修改成功');history.go(-2)</script>";
					// header('refresh:1;url="./index.php?c=index&a=user_album&username='.$username.'"');
				}else{
					//echo '修改失败';
					echo  "<script>alert('相册修改失败');history.go(-1)</script>";
					//header('refresh:1;url="./index.php?c=index&a=user_album&username='.$username.'"');
				}
			}
		}

	}