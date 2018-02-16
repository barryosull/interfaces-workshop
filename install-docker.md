# Install with Docker

### Fetch and launch docker
```
docker pull laraedit/laraedit
docker run -p 1234:80 -v [path/to/repo]:/var/www/html/app laraedit/laraedit
```
### Get bash shell
```
docker ps
docker exec -it [Container ID listed by `docker ps`] bash
```
### Boot app
```
cd /var/www/html/app
php boot.php
```
### Visit site
```
http://0.0.0.0:1234
```


