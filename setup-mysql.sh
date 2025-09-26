#!/bin/bash

# Initialize MySQL data directory if not exists
if [ ! -d "/var/lib/mysql/mysql" ]; then
    echo "Initializing MySQL data directory..."
    mysql_install_db --user=mysql --datadir=/var/lib/mysql
fi

# Start MySQL
echo "Starting MySQL..."
mysqld_safe --user=mysql --skip-grant-tables &

# Wait for MySQL to be ready
echo "Waiting for MySQL to start..."
for i in {1..30}; do
    if mysqladmin ping &>/dev/null; then
        echo "MySQL is ready!"
        break
    fi
    sleep 1
done

# Setup database and permissions
echo "Setting up database..."
mysql << EOF
FLUSH PRIVILEGES;
ALTER USER 'root'@'localhost' IDENTIFIED BY '';
CREATE DATABASE IF NOT EXISTS tugas_data;
GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY '' WITH GRANT OPTION;
FLUSH PRIVILEGES;
EOF

# Restart MySQL dengan grant tables
echo "Restarting MySQL with grant tables..."
mysqladmin shutdown
sleep 2
mysqld_safe --user=mysql &

# Wait again
for i in {1..30}; do
    if mysqladmin -u root ping &>/dev/null; then
        echo "MySQL restarted successfully!"
        break
    fi
    sleep 1
done

# Import SQL file jika ada
if [ -f "/var/www/html/tugas_data.sql" ]; then
    echo "Importing tugas_data.sql..."
    mysql -u root tugas_data < /var/www/html/tugas_data.sql
    echo "Import completed!"
fi

echo "MySQL setup completed successfully!"

# exec untuk pass control ke Apache
exec apache2-foreground