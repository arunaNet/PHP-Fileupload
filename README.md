# PHP ``Simple fileupload``

[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.me/PTMarkus)

> A simple fileupload with PHP

## Getestet mit

| PHP       |
| ----------|
| 7.2+      |

## Inhalt für die .htaccess Datei im upload Ordner
```
Order Deny,Allow
Deny from All

SetHandler none
SetHandler default-handler
Options -ExecCGI
RemoveHandler .php .phtml .php3
RemoveType .php .phtml .php3
php_flag engine off
```