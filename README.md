# yapf
Yet Another PHP Framework

Пример установки виртуального хоста Apache:
```apache
<VirtualHost *:80>
    <Directory "/var/www/framework">
        AllowOverride All
    </Directory>
    ServerName framework.local
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/framework/frontend/public
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```
