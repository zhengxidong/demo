<?php    
        if(isset($_POST["submit"]) && $_POST["submit"] == "登录")    
        {    
            $user = $_POST["login_name"];    
            $psw = $_POST["password"];    
            if($user == "" || $psw == "")    
            {    
                echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";    
            }    
            else    
            {    
                mysql_connect("localhost","guest","guest123");    
                mysql_select_db("vt");    
                mysql_query("SET NAMES 'utf8'");    
                $sql = "SELECT username,password FROM user where username = '$_POST[login_name]' and password = '$_POST[password]'";    
                $result = mysql_query($sql);    
                $num = mysql_num_rows($result);    
                if($num)    
                {    
                    $row = mysql_fetch_array($result);  //将数据以索引方式储存在数组中    
                    //echo $row[0];  
                    echo "<script>alert('登录成功！');</script>";    
                }    
                else    
                {    
                    echo "<script>alert('用户名或密码不正确！');history.go(-1);</script>";    
                }    
            }    
        }    
        else    
        {    
            echo "<script>alert('提交未成功！'); history.go(-1);</script>";    
        }    
        
    ?>