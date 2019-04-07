<?php
class Page{
      
      public $total;
      public $show;
      public $page;
      public $currentPage;
      public $start;


      	public function __construct($total,$show){
          $this->total = $total;
          $this->show = $show;
          $this->page = ceil($this->total/$this->show);
          $this->currentPage = empty($_GET['page'])?1:$_GET['page'];//当前页
          if($this->currentPage>$this->page){//防止出右边界
              $this->currentPage = $this->page;
          }
          if($this->currentPage<0){//防止出右边界
            $this->currentPage = 1;
          }
          $this->start = ($this->currentPage-1)*$this->show;
    }


    public function showPage($name=""){
        //输出页码
      $strData = "<li><a>当前".$this->currentPage."/".$this->page."页 共".$this->total."条记录</a></li>";
   $strData .="<li><a href='?page=1'>首页</a></li>";
   if($this->currentPage>1)
   {
    $strData .="<li><a href='?page=".($this->currentPage-1)."'>上一页</a></li>";
   }
   else
   {
     $strData .="<li><a href='?page=1'>上一页</a></li>";
   }
   if($this->currentPage<$this->page)
   {
    $strData .="<li><a href='?page=".($this->currentPage+1)."'>下一页</a></li>";
   }
   else
   {
    $strData .="<li><a href='?page=".$this->currentPage."'>下一页</a></li>";
   }
   $strData .="<li><a href='?page=".$this->currentPage."'>尾页</a></li>";
   echo $strData;
    }


    
}