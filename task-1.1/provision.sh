apt-get  update
DEBIAN_FRONTEND=noninteractive apt-get -y upgrade
apt-get install -y nginx
apt-get install -y mysql-server
apt-get install -y php-fpm php-mysql
apt-get install -y memcached

cat > /etc/nginx/sites-available/project.local <<EOF
server {
    listen 80;
    root /var/www/project.local;
    index index.php index.html;

    server_name project.local;

    location / {
        try_files \$uri \$uri/ =404;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
    }
}
EOF

ln -s /etc/nginx/sites-available/project.local /etc/nginx/sites-enabled/

echo '' >> '/etc/hosts'
echo '127.0.0.1   project.local www.project.local' >> '/etc/hosts'

systemctl reload nginx

