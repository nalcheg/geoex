Geoex
===
Simple Symfony 4 application, that returns country by ip with MaxMind base.

First step, use only PHP.
---

How to run:
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
