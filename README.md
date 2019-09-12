Geoex
===
Simple Symfony 4 application, that returns country by ip with MaxMind database.

Last step, with Kubernetes and Helm.
---
- preparation, checkout branch `kubernetes`:
```bash
git checkout kubernetes
```
- firstatall, we should just install Kubernetes and Helm:

Minikube install ansible role - https://github.com/nalcheg/ansible/tree/master/roles/minikube \
Helm install ansible role - https://github.com/nalcheg/ansible/tree/master/roles/helm \
`kubectl` utility install role - https://github.com/nalcheg/ansible/tree/master/roles/kubectl

- create Kubernetes namespace and deploy Helm chart in it:
```bash
kubectl create namespace geoex
helm upgrade geoex helm --install --set-string phpfpm.env.plain.APP_ENV=prod,nginx.host=geoex.local,imageTag=latest --namespace geoex --recreate-pods
```

- test application after its start:
```bash
curl http://geoex.local/?ip=8.8.8.8
```
___

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
- test application after its start:
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
