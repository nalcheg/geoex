#!/usr/bin/env bash

docker build --no-cache --target prod --build-arg VERSION=1.15 -t nalcheg/geoex-nginx -f ./docker/nginx/Dockerfile .
docker push nalcheg/geoex-nginx

docker build --no-cache --target prod --build-arg VERSION=7.3 -t nalcheg/geoex-php-fpm -f ./docker/php-fpm/Dockerfile .
docker push nalcheg/geoex-php-fpm
