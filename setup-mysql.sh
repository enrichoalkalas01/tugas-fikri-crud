#!/bin/bash
set -e

echo "=== Starting Tugas Fikri Container ==="

# Inisialisasi MySQL jika belum
if [ ! -d "/var/lib/mysql/mysql" ]; then
    echo "Initializing MySQL..."
    mariadb-install-db --user=mysql --basedir=/usr --datadir=/var/lib/mysql
fi

# Start MySQL menggunakan service
echo "Starting MySQL..."
service mariadb start

# Tunggu MySQL siap
echo "Waiting for MySQL..."
sleep 5

# Setup database dan user
echo "Creating databases..."
mariadb -u root <<EOF
CREATE DATABASE IF NOT EXISTS tugas_fikri;
CREATE DATABASE IF NOT EXISTS tugas_data;
CREATE USER IF NOT EXISTS 'fikri'@'%' IDENTIFIED BY 'password123';
CREATE USER IF NOT EXISTS 'fikri'@'localhost' IDENTIFIED BY 'password123';
GRANT ALL PRIVILEGES ON tugas_fikri.* to 'fikri'@'%';
GRANT ALL PRIVILEGES ON tugas_fikri.* TO 'fikri'@'localhost';
GRANT ALL PRIVILEGES ON tugas_data.* TO 'fikri'@'%';
GRANT ALL PRIVILEGES ON tugas_data.* TO 'fikri'@'localhost';
FLUSH PRIVILEGES;
EOF

echo "✅ Database ready!"
echo "   - tugas_fikri"
echo "   - tugas_data"
echo "   User: fikri / password123"

# Start Apache
echo "Starting Apache..."
exec apache2-foreground