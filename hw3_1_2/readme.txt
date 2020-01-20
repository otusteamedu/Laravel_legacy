# Шаг 1. устанавливаем необходимые пакеты, которые позволяют apt использовать пакеты по HTTPS
sudo apt install apt-transport-https ca-certificates curl software-properties-common

# Шаг 2. Добавляем в свою систему ключ GPG официального репозитория Docker:
sudo curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -

# Шаг 3. Добавляем репозиторий Docker в список источников пакетов APT:
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu bionic stable"

# Шаг 4. Следует убедиться, что мы устанавливаем Docker из репозитория Docker, а не из репозитория по умолчанию Ubuntu:
sudo apt-cache policy docker-ce

# Шаг 5. Устанавливаем Docker:
sudo apt install docker-ce

# Шаг 5.1.  Проверяем Docker:
sudo systemctl status docker


# Шаг 6. Использование команды Docker без sudo (опционально)
sudo sudo usermod -aG docker ${USER}

# Шаг 6.1. Для применения этих изменений в составе группы необходимо разлогиниться и снова залогиниться на сервере или задать следующую команду:

su - ${USER}

# Шаг 6.2. Убедиться, что пользователь добавлен в группу docker можно следующим образом:

id -nG



# Шаг 7. Установка Docker Compose
sudo curl -L https://github.com/docker/compose/releases/download/1.21.2/docker-compose-`uname -s`-`uname -m` -o /usr/local/bin/docker-compose

# Шаг 7.1. Меняем права
sudo chmod +x /usr/local/bin/docker-compose

# Шаг 7.2. Проверем права
docker-compose --version