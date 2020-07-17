> 要正常运行网站，要作以下配置

# 关于nginx的配置

### 禁止访问目录和文件配置

```
location ~ /(fillwork|app|vendor)/.*\.(php|ini|txt)$ {
    return 403;
}
error_page 403 /error_page/denied.html;
```

### PATHINFO支持一

```
location / {
    index  index.html index.htm index.php;
    try_files $uri $uri/ /index.php$args;
}
```

### PATHINFO支持二

```
location ~ \.php(.*)$ {
    fastcgi_pass   127.0.0.1:9000;
    fastcgi_index  index.php;
    fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
    fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
    fastcgi_param  PATH_INFO  $fastcgi_path_info;
    fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
    include        fastcgi_params;
}
```

### 安装扩展
```
composer require PHPOffice/PhpSpreadsheet
composer require smarty/smarty
composer require twig/twig
```

### 结束

到此，你浏览器即可正常访问网站了


完整vhost.conf

```
location ~ /(fillwork|app|vendor)/.*\.(php|ini|txt)$ {
    return 403;
}
error_page 403 /error_page/denied.html;
location / {
    index  index.html index.htm index.php;
    if ( !-e $request_filename ) {
        rewrite ^(.*)$ /index.php?s=$1 last;
        break;
    }
    # try_files $uri $uri/ /index.php$args;
}
location ~ \.php(.*)$ {
    fastcgi_pass   127.0.0.1:9000;
    fastcgi_index  index.php;
    fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
    fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
    fastcgi_param  PATH_INFO  $fastcgi_path_info;
    fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
    include        fastcgi_params;
}
location ~ .*\.(js|css)?$ {
    expires 7d;
    access_log off;
}
```