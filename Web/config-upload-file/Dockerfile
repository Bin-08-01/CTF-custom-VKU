FROM php:7.3-apache

WORKDIR /var/www/html/
COPY ./src .
COPY docker-php.conf /etc/apache2/conf-available/docker-php.conf
COPY apache2.conf /var/www/html/apache2.conf
COPY apache2.conf /etc/apache2/apache2.conf

RUN chown -R root:www-data /var/www/html
RUN chmod 750 /var/www/html
RUN find . -type f -exec chmod 640 {} \;
RUN find . -type d -exec chmod 750 {} \;

RUN chmod g+w /var/www/html/upload/
RUN chmod +t -R /var/www/html/
RUN echo "VKU{fake_flag}" > /flag.txt
