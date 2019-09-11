Geoex
===
Simple Symfony 4 application, that returns country by ip with MaxMind database.

First step, with Docker and docker-compose (you must have Docker and docker-compose installed, if you hasn't - Google will help you install they).
---
- preparation, checkout branch `docker`:
```bash
git checkout docker
```
- firstatall, we should build and push to DockerHub our application containers (or we may build containers by `docker-compose`, I commentes this variant in `docker-compose.yml`):
```bash
./build.sh
```
- run docker-compose (you may run docker-compose with `-d` option for detach containers output from console):
```bash
docker-compose up [-d]
```
- test application after it start:
```bash
curl http://0.0.0.0:8088?ip=8.8.8.8
```
___

Zero step, use only PHP.
---
- preparation, install Composer dependences (I apologize for reminding):
```bash
composer install
```
- firstatall, we should get MaxMind ip/country database:
```bash
bin/console geo-update
```
- start Symfony dev server:
```bash
bin/console server:run 0.0.0.0:8088
```
- get country by ip address:
```bash
curl http://0.0.0.0:8088?ip=8.8.8.8
```
___
