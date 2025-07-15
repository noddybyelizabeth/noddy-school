FROM php:8.4-apache

ARG UID=1000
ARG GID=1000
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    git

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd mysqli

RUN a2enmod rewrite && service apache2 restart

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN sed -i '/<Directory \/var\/www\/html>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

RUN git config --system --add safe.directory /var/www/html

EXPOSE 80

WORKDIR /var/www/html

CMD ["apache2-foreground"]