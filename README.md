# BeforeYouGoGo
Massively-WIP no-fuss flat-file PHP-based URL shortener. Created because everything else was too complicated; I just wanted something you can shove on a web server and not care about.

![](https://img.tomr.me/Readmes/beforeyougogo/gogo.jpg)

# Perms
Make sure access to /manage is controlled somehow (I just use CloudFlare Access)

# Config
## NGINX
```nginx
error_page 404 = /manage/api/404_handler.php;
```
## Caddy
```caddyfile
# Version 2
handle_errors {
    @404 {
        expression {http.error.status_code} == 404
    }
    rewrite @404 /manage/api/404_handler.php
    file_server
}
# Version 1
errors {
    404 /manage/api/404_handler.php
}
```
## Apache
```apache
ErrorDocument 404 /manage/api/404_handler.php
```


# Known Problems
- Code quality is awful (some things have three layers of checks but others have nothing)
- We should use SQLite instead of a text file but that's more effort
