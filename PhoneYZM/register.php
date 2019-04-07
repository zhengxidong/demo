<?php    
      if(isset($_POST["submit"]) && $_POST["submit"] == "注册")    
      {    
          $user = $_POST["login_name"];    
          $psw = $_POST["password"];    
          $psw_confirm = $_POST["password_confirm"];  
          $phone=$_POST["phone"];  
          $email=$_POST["email"];    
          $vertificationCode=$_POST["vertificationCode"];  
       
          if($user == "" || $psw == "" || $psw_confirm == "" || $phone== "" || $email== "" || $vertificationCode == "")    
          {    
              echo "<script>alert('请确认信息完整性！'); history.go(-1);</script>";    
          }    
          else    
          {    
              if($psw == $psw_confirm)    
              {    
                  mysql_connect("localhost","root","");   //连接数据库    
                  mysql_select_db("test");  //选择数据库    
                  mysql_query("SET NAMES 'utf8'"); //设定字符集    
                  $sql = "SELECT username FROM user WHERE username = '$_POST[login_name]'"; //SQL语句    
                  $result = mysql_query($sql);    //执行SQL语句    
                  $num = mysql_num_rows($result); //统计执行结果影响的行数    
                  if($num)    //如果已经存在该用户    
                  {    
                      echo "<script>alert('用户名已存在'); history.go(-1);</script>";    
                  }    
                  else    //不存在当前注册用户名称    
                  {    
                      $sql_insert = "INSERT INTO user (username,password,phone,email) VALUES('$_POST[login_name]','$_POST[password]','$_POST[phone]','$_POST[email]')";    
                      $res_insert = mysql_query($sql_insert);    
                      //$num_insert = mysql_num_rows($res_insert);    
                      if($res_insert)    
                      {    
                          echo "<script>alert('注册成功！'); </script>";    
                      }    
                      else    
                      {    
                          echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";    
                      }    
                  }    
              }    
              else    
              {    
                  echo "<script>alert('密码不一致！'); history.go(-1);</script>";    
              }    
          }    
      }    
      else    
      {    
          echo "<script>alert('提交未成功！'); history.go(-1);</script>";    
      }    
  ?> 