# Шаг 1 - Установка веб-сервера Nginx

sudo apt-get update
sudo apt-get install nginx

# Шаг 1.2 Фаервол. Настройки стандартные
sudo ufw allow 'Nginx HTTP'

# Шаг 1.3 Настройка Nginx для phpfpm
#location ~ \.php$ {
#	include snippets/fastcgi-php.conf;

	# With php7.0-cgi alone:
	# fastcgi_pass 127.0.0.1:9000;
	# With php7.0-fpm:
#	fastcgi_pass unix:/run/php/php7.2-fpm.sock;
#}

# Шаг 2 - Установка php-fpm / CLI
sudo apt-get install php-fpm
sudo apt-get install php-cli
sudo apt-get install php-mysql



# Шаг 3 - Установка MySQL для хранения данных сайта
sudo apt-get install mysql-server

# Шаг 3.1 Настройка безопасности
sudo mysql_secure_installation


# Шаг 4 Установка Redis
sudo apt install redis-server


# Шаг 4.1 Tesr Redis
sudo systemctl status redis