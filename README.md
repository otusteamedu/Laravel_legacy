#MLGA
## Kuber
* Запилить kuber > 1.15
* Впилить [nginx-ingress](https://kubernetes.github.io/ingress-nginx/deploy/#gce-gke)
    * TODO он сам создает балансировщик и получает IP - это не дело, ибо IP при удалении пропадет
* Впилить [cert-manager](https://cert-manager.io/docs/tutorials/acme/ingress/)
    * Внимание на Issuer и ClusterIssuer
## App
