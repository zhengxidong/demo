<?php
class Cart{
    public $id;
    public $arrDatax;
    //初始化
    public function __construct($id,$arrDatax){
    	$this->id =$id;
    	$this->arrDatax = $arrDatax;
    }
	public function checkCart(){
	
    //判断
		    if(empty($_SESSION['shopcar'])){
		             $_SESSION['shopcar'][] = $this->arrDatax;
		             
				    header("Location:show.php");
				    return true;
		    }else
		    {
		        //判断是否相同
		        //添加一条新数据
		        if(!$this->check($id)){
					    $_SESSION['shopcar'][] =$this->arrDatax;
					    
						header("Location:show.php");
						return true;
		        }
		        //加1
		        else{
		        	    
						header("Location:show.php");
						return false;
		        }
		       return false;	
		    } 

		}
   
	public function check($id){
		    foreach($_SESSION['shopcar'] as $key =>$value){
		        if($value['id']==$this->id)
		        {
		            $_SESSION['shopcar'][$key]['num'] +=1;
		           return true;
		           break;
		        }
		    }
		    return false;
		}
	public function del($id){
		if(!empty($id))
			{
				foreach($_SESSION['shopcar'] as $key =>$value)
				{
					if($value['id']==$id)
					{
						unset($_SESSION['shopcar'][$key]);
						header("Location:show.php");
						return true;
					}
				}

			}
			else
			{
				return false;
			}
	}
}