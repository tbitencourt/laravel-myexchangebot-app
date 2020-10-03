FROM php:7.4.8-fpm-alpine

RUN apk upgrade --update

# Lib dependencies
RUN apk add --no-cache ca-certificates git jpeg-dev libpng-dev freetype-dev libxslt-dev icu-dev libzip-dev $PHPIZE_DEPS

# Install extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd bcmath xsl intl pdo pdo_mysql soap zip opcache

# Install xdebug
ARG XDEBUG_ENABLE
RUN echo XDEBUG_ENABLE = $XDEBUG_ENABLE; \
if [ $XDEBUG_ENABLE = "true" ] || [ $XDEBUG_ENABLE = "1" ]; then \
   pecl install xdebug; \
   docker-php-ext-enable xdebug; \
fi;

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Prestissimo
RUN composer global require hirak/prestissimo

# Memory Limit
RUN echo "memory_limit=2G" >> /usr/local/etc/php/conf.d/from-docker-configuration.ini

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
