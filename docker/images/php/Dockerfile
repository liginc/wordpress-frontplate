FROM ubuntu:latest

RUN apt-get update --fix-missing
RUN apt-get install -y curl git php7.0-fpm php7.0-curl php7.0-mysql php7.0-xml php7.0-opcache php7.0-intl php7.0-gd php7.0-mbstring php-xdebug
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# php.ini - /etc/php/7.0/fpm/php.ini
# conf.d  - /etc/php/7.0/fpm/conf.d/

RUN curl -sSL -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp

COPY mods-available/xdebug.ini /etc/php/7.0/mods-available/xdebug.ini

EXPOSE 9000
RUN usermod -u 1000 www-data
RUN mkdir /run/php/
COPY pool.d/www.conf /etc/php/7.0/fpm/pool.d/www.conf

COPY ./vendor/wait-for-it.sh /
RUN chmod +x /wait-for-it.sh

COPY ./docker-entrypoint.sh /
RUN chmod +x /docker-entrypoint.sh
ENTRYPOINT ["/docker-entrypoint.sh"]

CMD ["/usr/sbin/php-fpm7.0", "-F"]
