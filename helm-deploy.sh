#!/usr/bin/env bash

export KUBECONFIG=/home/nalcheg/develop/minikube/.kube/config

helm upgrade geoex helm --install --set-string phpfpm.env.plain.APP_ENV=prod,nginx.host=geoex.local,imageTag=latest --namespace geoex --recreate-pods
