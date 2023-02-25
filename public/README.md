# After Create new site

- Config site in `public/config.php` and `public/meter/config.php`
- Add upload folder in `public/upload/...` with chmod 777

e.g.
```shell
cd /var/www/pea-meter.com/public_html/upload
```

```shell
sudo chown -R ubuntu:www-data ./PEALPN01
```

```shell
sudo chmod -R 777 ./PEALPN01
```