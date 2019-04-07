<?php         
              mysql_connect("localhost","root","");    
              mysql_select_db("test");    
              mysql_query("SET NAMES 'utf8'");    
              $sql = "SELECT email FROM user where email = '$_POST[email]'";    
              $result = mysql_query($sql);    
              $num = mysql_num_rows($result);    
              if($num)    
              {    
                $list=array("result"=>"notValidate!");    
              }    
              else    
              {    
                $list=array("result"=>"validate!");  
            }    
              echo json_encode($list);//返回的是最外层加了双引号的json            
      
  ?>