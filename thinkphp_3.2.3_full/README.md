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
