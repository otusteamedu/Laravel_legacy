# MLGA
## Kuber
* Kubernetes > 1.15
* Helm 3+
* [nginx-ingress](https://kubernetes.github.io/ingress-nginx/deploy/#gce-gke)
* [cert-manager](https://cert-manager.io/docs/tutorials/acme/ingress/)

## Local
### Run
```shell script
docker-compose up -d --build
```
http://localhost:8149

### Init
```shell script
docker-compose exec app composer install
docker-compose exec app artisan migrate
```
### Test
```shell script
docker-compose exec app phpunit
```
## Environment
* Develop: https://test.otus.make-laravel-great-again.tk/
* Master: https://otus.make-laravel-great-again.tk/

## CI
Coming soon..

