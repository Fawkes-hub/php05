<?php 
	
	class IndexController{
			public $sql; 	//设置默认的sql语句
			public $stmt;	//储存发送的语句
			public $goods;	//把商品信息储存在上面



		public function head(){
			//我们需要把导航遍历下来
			try{
				
				$sql="SELECT * FROM type WHERE display=0 order by concat(path,id,',') ASC";
				$this->sql=$sql;
				$this->indexpdo($this->sql);


				$stmt=$this->stmt;
			
			//执行语句，返回的是布尔值
			$bool=$stmt->execute();

			if($stmt->rowCount()){
				//把内容以数组的形式全部得出来
				$types=$stmt->fetchAll(2);
			
				$pid=$types;		//赋值给$pid为了区别
				
			}
			
		}catch(PDOException $e){
			$e->getMessage();
			exit;
		}

			include './Include/head.html';
	}
	//尾部也需要用导航遍历，把友情链接放进去
	public function foot(){
		try{
				
				$sql="SELECT * FROM hyperlink ";
				$this->sql=$sql;
				$this->indexpdo($this->sql);


				$stmt=$this->stmt;
				//var_dump($sql);

			//执行语句，返回的是布尔值
			$bool=$stmt->execute();

			if($stmt->rowCount()){
				//把内容以数组的形式全部得出来
				$types=$stmt->fetchAll(2);
			
				// $pid=$types;		//赋值给$pid为了区别
				
			}
			
		}catch(PDOException $e){
			$e->getMessage();
			exit;
		}
				
			include './Include/foot.html';



	}

		


		public function index(){
			
			//调用头的方法，是网页拼接
			$this->head();
			//var_dump($_SESSION);
			//通过传过来的typeid，在数据库中把数据得到
			include './Include/main.html';
			
			

			$this->foot();
			
		}


		public function cate(){
			
			$this->head();

			//var_dump($_GET);

			
			try{
					//如果传过来的typeid为空  则查看全部内容
					
				/*if(empty($_GET['typeid'])){		//如果你没有点击导航，就显示所有的内容。
													//因为我是有导航页，到了这里面肯定是点击了导航的。此判断不需要！！
					$sql="SELECT * FROM goods WHERE `status`=:status limit 8";
					$this->sql=$sql;
					$this->indexpdo($this->sql);
					$stmt=$this->stmt;
					//绑定参数
					$status=0;

					$stmt->bindParam(':status',$status);
					
					
				}else{
*/
					//如果得到了typeid，就信息筛选，查看子分类下面的内容
					//这个sql语句的意思是 查看goods表单里面的 上架 和 typeid 包括（在type表单里pid=某个值的所有的id的集合）的值。
				$sql="SELECT * FROM goods WHERE `status`=:status and (typeid in(select id  from type WHERE pid=:id) or typeid=:id)";
				$this->sql=$sql;
				$this->indexpdo($this->sql);

				//echo $this->sql;
				
				$stmt=$this->stmt;
				$status=0;
				$typeid=$_GET['typeid'];
				$stmt->bindParam(':status',$status);
				$stmt->bindParam(':id',$typeid);
				

				

				$stmt->execute();

				if($stmt->rowCount()){
					$this->goods=$stmt->fetchAll(2);

				}


				include './Include/category.html';
				
			}catch(PDOException $e){
				$e->getMessage();
				exit;
			}
				//var_dump($stmt->fetchAll(2));
				//var_dump($this->goods);
			//var_dump($this->goods);
			
			
				// $total=0;


				//include './Include/category.html';
				
				$foot=new IndexController;
				$foot=$foot->foot();
			
			
			}	










		/*****************用来储存pdo的方法********************/
		protected function indexpdo($sql){
			//使用了PDO的方法
			$mysql="mysql:host=localhost;dbname=ss19_shop;charset=utf8";
			//要得到pao的对象
			$pdo=new PDO($mysql,'root','');
			
			//设置错误
			$pdo->setAttribute(3,1);
			//准备预处理
			
			//把SQL模版发送出去
			$this->stmt=$pdo->prepare($sql);
		}


	}