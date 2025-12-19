FROM php:8.4-fpm

RUN docker-php-ext-install sockets

ARG USER
ARG UID
ARG WORKING_DIR

RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql \
    && apt-get install git zip -y


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node
RUN curl -sL https://deb.nodesource.com/setup_18.x > setup_18.x \
    && chmod +x setup_18.x \
    && ./setup_18.x \
    && apt install -y nodejs

# Create system user to run Composer and Artisan Commands
COPY ./docker/php/docker-entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $UID -d /home/$USER $USER
RUN mkdir -p /home/$USER/.composer && \
    chown -R $USER:$USER /home/$USER

RUN chown $USER:$USER /etc/environment \
    && chown $USER:$USER /usr/local/etc/php/conf.d/* \
    && chown $USER:$USER /usr/local/etc/php/conf.d/ \
    && chown -R $USER:$USER /usr/local/etc/php/

WORKDIR $WORKING_DIR

USER $USER

ENTRYPOINT ["/entrypoint.sh"]

CMD ["php-fpm"]
