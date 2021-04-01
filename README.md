# beforeyougogo
easy no-fuss flat-file php-based url shortener

---

# Perms
Make sure access to /manage is controlled somehow (I just use CloudFlare Access)

If you don't want your data file to be public, make sure /data is inaccessable too.

Obviously the web server needs to be able to r/w the data file as well.

---

# NGINX Config
```
error_page 404 = /lib/404_handler.php;

location /data {
    deny all;
    return 403;
} 
```