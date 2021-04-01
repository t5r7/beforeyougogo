# beforeyougogo
massively wip easy no-fuss flat-file php-based url shortener

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

---

# Known Problems
- Code quality is awful (some things have three layers of checks but others have nothing)
- We should use SQLite instead of a text file but that's more effort