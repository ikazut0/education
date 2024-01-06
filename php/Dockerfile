FROM php:8.2-fpm

# Install OPCACHE extension
RUN docker-php-ext-install opcache

# Install APCU extension
RUN pecl install apcu \
    && docker-php-ext-enable apcu

# Install INTL extension
RUN apt-get update \
    && apt-get install -y libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && rm -rf /var/lib/apt/lists/*

## Install GD extension
RUN apt-get update \
    && apt-get install -y \
    libpng-dev \
    libfreetype6-dev \
    libjpeg-dev \
    libxpm-dev \
    libxml2-dev \
    libxslt-dev \
    libwebp-dev \
    && docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-xpm \
    --with-webp \
    && docker-php-ext-install gd \
    && rm -rf /var/lib/apt/lists/*

# Install IMAGICK extension
RUN apt-get update \
    && apt-get install -y libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && rm -rf /var/lib/apt/lists/*

# Install EXIF extension
RUN docker-php-ext-install exif

# Install ZIP extension
RUN apt-get update \
    && apt-get install -y libzip-dev zip \
    && docker-php-ext-install zip \
    && rm -rf /var/lib/apt/lists/*

# Install PDO PGSQL extension
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

# Install XSL extension
RUN apt-get update \
    && apt-get install -y libxslt-dev \
    && docker-php-ext-install xsl \
    && rm -rf /var/lib/apt/lists/*

# Install SOAP extension
RUN docker-php-ext-install soap

# Install BCMATH extension
RUN docker-php-ext-install bcmath

# Install GMP extension
RUN apt-get update \
    && apt-get install -y libgmp-dev \
    && docker-php-ext-install gmp \
    && rm -rf /var/lib/apt/lists/*

# Install MONGODB extension
RUN apt-get update \
    && apt-get install -y autoconf pkg-config libssl-dev \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && rm -rf /var/lib/apt/lists/*

# Install REDIS extension
RUN pecl install redis \
    && docker-php-ext-enable redis

# Install XDEBUG extension
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory to /var/www/html
WORKDIR /var/www/html/core

# Copy the application code into the container
COPY . /var/www/html

# Install project dependencies using Composer
RUN composer install --no-interaction --optimize-autoloader

# Copy custom php.ini file
COPY ./php/php.ini /usr/local/etc/php/php.ini


# Expose port 9000 to connect with a web server (e.g., Nginx)
EXPOSE 9000

# Run PHP-FPM
CMD ["php-fpm"]
