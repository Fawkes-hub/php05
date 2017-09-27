<?php


	//分页类
	class Page{
		public $num; //每页显示条数
		public $total; //总条数
		public $amount;//总页数
		public $current;  //当前页码数
		public $offset;  //初始值设置
		public $limit ; //分页内容
		public function __construct($total,$num){
			//每页显示条数
			$this->num = $num;
			//总条数
			$this->total = $total;
			//总页数
			$this->amount = ceil($total/$num);

			//初始化当前页码
			$this->init();
			//偏移量
			
			$this->offset = ($this->current -1)*$num;
			//分页字段
			$this->limit = " {$this->offset},{$this->num}";

		}
		//初始化当前页码
		public function init(){
			$this->current = empty($_GET['page'])?'1':$_GET['page'];
			//判断最小值
			if($this->current <1){
				$this->current=1;
			}
			//min 最小值  min($this->amount,$this->current);
			//max  最大值   max (1,$this->current);

			//判断最大值
			if($this->current >$this->amount){
				$this->current=$this->amount;
			}
		}

		//获取分页按钮
		public function getButton(){
			//将变量prev 变量next 赋值为 $_GET 这个数组
			$_GET['page']=empty($_GET['page'])?'1':$_GET['page'];
			$prev = $next = $_GET;
			//上一页
			$prev['page']=$prev['page']-1;
			
			if($prev['page']<1){
				$prev['page']=1;
			}
			//下一页
			$next['page']=$next['page']+1;
			
			if($next['page']>$this->amount){
				$next['page']=$this->amount;
			}

			//要拼接一个跳转路径
			//var_dump($_SERVER);
			$url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'];
			

			//http_build_query() 将数组中的每个单元以参数的形式拼接在一起
			//echo http_build_query($prev);
			
			//拼接完整路径
			$prev = $url.'?'.http_build_query($prev);
			$next = $url.'?'.http_build_query($next);
			//echo $prev;
			
			$str = '';
			$str.='<a href="'.$prev.'">上一页</a>';
			$str.='<a href="'.$next.'">下一页</a>';

			return $str;
		}


	}