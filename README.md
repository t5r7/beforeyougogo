# BeforeYouGoGo
massively wip easy no-fuss flat-file php-based url shortener

everything else was too complicated, i just wanted something you can shove on a web server and not care about

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