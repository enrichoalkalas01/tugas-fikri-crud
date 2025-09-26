FROM php:8.2-apache

# Update package list
RUN apt-get update

# Install MySQL Server dan dependencies
RUN DEBIAN_FRONTEND=noninteractive apt-get install -y \
    mariadb-server \
    mariadb-client

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Create MySQL run directory
RUN mkdir -p /var/run/mysqld && \
    chown -R mysql:mysql /var/run/mysqld

# Copy script untuk setup MySQL
COPY setup-mysql.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/setup-mysql.sh

# Expose ports
EXPOSE 80 3306

# Set working directory
WORKDIR /var/www/html

# Start MySQL dan Apache
CMD ["/bin/bash", "-c", "/usr/local/bin/setup-mysql.sh && apache2-foreground"]