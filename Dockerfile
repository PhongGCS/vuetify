FROM ubuntu:latest

# Adapt from https://github.com/Frojd/Frojd-Bedrock/blob/master/Dockerfile

MAINTAINER ConceptualStudio
LABEL version="v1.4.1"


# apt-get install All the things!
RUN export DEBIAN_FRONTEND=noninteractive
RUN apt-get -y autoremove
ENV TERM linux

RUN apt-get autoremove
RUN apt-get -y update && apt-get -y install apt-utils 
RUN apt-get -y install software-properties-common
RUN apt-get -y update

RUN apt-get -y install php7.2 php7.2-fpm php7.2-zip php7.2-mysql php7.2-xml php7.2-intl  \
    php7.2-gd php-imagick php7.2-mbstring php7.2-soap php7.2-curl php7.2-cli php7.2-bz2 php7.2-opcache php7.2-pgsql \
    php7.2-imap php7.2-ldap php7.2-recode php7.2-sqlite3 php7.2-xsl \ 
    php-memcache php-xdebug php-geoip \
    && mkdir -p /var/run/php /var/log/supervisor /var/log/nginx /app

RUN apt-get -y install composer supervisor nginx mysql-client xz-utils
RUN apt-get -y install wget apt-utils mc inetutils-ping telnet nano \
     vim curl apt-transport-https language-pack-en

# wp-cli
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && \
    chmod +x wp-cli.phar && \
    mv wp-cli.phar /usr/local/bin/wp

# Install Node & Yarn

ENV NPM_CONFIG_LOGLEVEL info
ENV NODE_VERSION 10.15.1

RUN wget https://nodejs.org/dist/v$NODE_VERSION/node-v$NODE_VERSION-linux-x64.tar.xz \
  && tar -xJf "node-v$NODE_VERSION-linux-x64.tar.xz" -C /usr/local --strip-components=1 \
  && rm "node-v$NODE_VERSION-linux-x64.tar.xz"

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - && \
  echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list && \
  apt-get update && apt-get -y install yarn

RUN npm install gulp -g


# Install configurations

COPY files/config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY files/config/nginx.conf /etc/nginx/sites-enabled/default
COPY files/config/php.ini /etc/php/7.2/fpm


# Permission hack

RUN usermod -u 1000 www-data

# Set up remote debugging for xdebug

ARG XDEBUG_REMOTE_HOST
ARG XDEBUG_IDEKEY
RUN echo "xdebug.remote_enable=on" >> /etc/php/7.2/fpm/conf.d/20-xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /etc/php/7.2/fpm/conf.d/20-xdebug.ini \
    && echo "xdebug.remote_host="${XDEBUG_REMOTE_HOST} >> /etc/php/7.2/fpm/conf.d/20-xdebug.ini \
    && echo "xdebug.idekey="${XDEBUG_IDEKEY} >> /etc/php/7.2/fpm/conf.d/20-xdebug.ini \
    && rm /etc/php/7.2/cli/conf.d/20-xdebug.ini


# Open ports, multiple separated with space, e.g. EXPOSE 80 22 443

EXPOSE 80 443

# https://github.com/yarnpkg/yarn/issues/749
# To consider on handling yarn installation

WORKDIR /app
#COPY site/composer.json /app/composer.json
#COPY site/composer.lock /app/composer.lock
#RUN composer install
# Default command for machine
CMD supervisord