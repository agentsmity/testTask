FROM ubuntu:18.04
ENV PHP_VERSION 7.2
RUN apt-get update -y
RUN DEBIAN_FRONTEND=noninteractive apt-get install -y tzdata
RUN apt-get install -y \
    php$PHP_VERSION \
    php$PHP_VERSION-pdo \
    php$PHP_VERSION-bcmath \
    php$PHP_VERSION-mysqlnd \
    php$PHP_VERSION-zip \
    supervisor \
    wget \
    unzip \
    curl \
    git
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/bin/composer
RUN groupadd -g 1000 testuser && useradd -u 1000 -g 1000 testuser && echo '%sudo ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers