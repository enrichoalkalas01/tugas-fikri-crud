FROM php:8.2-apache

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Apache config: allow .htaccess overrides
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Copy application files
COPY --chown=www-data:www-data . /var/www/html/

# Remove extra Dockerfiles and infra files from the image
RUN rm -f /var/www/html/Dockerfile* \
          /var/www/html/compose.yml \
          /var/www/html/k8s.yml \
          /var/www/html/setup-mysql*.sh

# Health check endpoint
RUN echo '<?php http_response_code(200); echo "ok"; ?>' > /var/www/html/health.php

WORKDIR /var/www/html
EXPOSE 80

CMD ["apache2-foreground"]
