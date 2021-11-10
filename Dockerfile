FROM php:7.4-apache

WORKDIR /var/www/html

EXPOSE 80



RUN apt-get update 
RUN apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        zlib1g-dev \
        libicu-dev \
        g++

RUN docker-php-ext-install -j$(nproc) iconv
RUN pecl mcrypt-1.0.3
# RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ 
# RUN docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-enable mysqli

RUN a2enmod headers \
	&& a2enmod rewrite \
    && sed -ri -e 's/^([ \t]*)(<\/VirtualHost>)/\1\tHeader set Access-Control-Allow-Origin "*"\n\1\2/g' /etc/apache2/sites-available/*.conf

# Clean
# RUN rm /etc/apache2/sites-available/default-ssl.conf
# RUN rm /etc/apache2/mods-available/ssl.load
# RUN rm /etc/apache2/mods-available/ssl.conf

COPY php.ini-development /usr/local/etc/php/php.ini
COPY src/ .
RUN chown -R www-data.www-data /var/www/html/writable
# RUN chown -R www-data.www-data /var/www/html
# RUN chmod -R 777 /var/www/html