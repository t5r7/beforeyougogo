# beforeyougogo
massively wip easy no-fuss flat-file php-based url shortener

---

# Perms
Make sure access to /manage is controlled somehow (I just use CloudFlare Access)

---

# NGINX Config
```
error_page 404 = /404_handler.php;
```

---

# Known Problems
- Code quality is awful (some things have three layers of checks but others have nothing)
- We should use SQLite instead of a text file but that's more effort