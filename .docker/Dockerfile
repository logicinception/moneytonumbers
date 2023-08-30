FROM php:8.1-fpm-alpine3.18

RUN apk add --no-cache shadow bash

RUN touch /root/.bashrc | echo "PS1='\w\$ '" >> /root/.bashrc
RUN touch /home/www-data/.bashrc | echo "PS1='\w\$ '" >> /home/www-data/.bashrc

WORKDIR /var/www
RUN rm -rf /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN usermod -u 1000 www-data

USER www-data

EXPOSE 9000

ENTRYPOINT ["php-fpm"]