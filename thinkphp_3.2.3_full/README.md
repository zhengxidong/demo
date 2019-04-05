## 手册
### Thinkphp3.2.3
  * [在线手册](https://www.kancloud.cn/manual/thinkphp/1678)
  * [离线手册](https://github.com/zhengxidong/example/blob/master/handbook/ThinkPHP3.2.2%E5%AE%8C%E5%85%A8%E5%BC%80%E5%8F%91%E6%89%8B%E5%86%8C.chm)

## 整合Thinkphp3.2.3功能系列

* 使用`PHPExcel`导出Excel
* 导出csv
* 导出csv(将数据分割保存在多个csv文件中，并且最后压缩成zip文件提供下载) - 未测试
* 导出csv(分批查询数据库导出数据) - 未测试
* `PHPMailer`发送SMTP邮件可带附件 - 未测试

## 配置nginx
```js
server {
    listen       80;
    server_name  thinkphp3.site;

    access_log  /var/log/nginx/thinkphp3.site.access.log;
    error_log /var/log/nginx/thinkphp3.site.error_log;

    charset utf-8;

    index index.html index.htm index.php;
    root   /usr/local/nginx/html/thinkphp3.site;
    location / {
    
    //重写隐藏index.php
	if (!-e $request_filename) {
            rewrite  ^(.*)$  /index.php?s=$1  last;
            break;
    	}
    }

    # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
    #
    location ~ [^/]\.php(/|$){

	fastcgi_read_timeout 300; 
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
	# 开启支持path_info模式
	fastcgi_split_path_info         ^(.+\.php)(.*)$;
    	fastcgi_param  PATH_INFO        $fastcgi_path_info;    
    	fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        include        fastcgi_params;
    }

}

```
## 配置thinkphp支持重写模式

```js
return array(
	//'配置项'=>'配置值'
	'URL_MODEL' => 2, //设置URL模式重写模式
);
```
