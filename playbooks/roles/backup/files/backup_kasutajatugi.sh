#!/bin/bash

# === Kasutajatoe varundusskript ===
# Varundab: /var/www/html ja MariaDB andmebaasi 'kasutajatugi'
# Salvestab tulemuse kataloogi /var/backups
# Faili nimi sisaldab kuupäeva ja kellaaega
# Kustutab varasemad kui 7 päeva koopiad

# Kuupäeva ja kellaja vorming
DATE=$(date +"%Y-%m-%d_%H-%M")

# Varukoopia failinimi
BACKUP_FILE="/var/backups/kasutajatugi_backup_$DATE.tar.gz"

# Ajutine kataloog
TMP_DIR="/tmp/kasutajatugi_backup_$DATE"
mkdir -p "$TMP_DIR"

# Lisa logi
echo "[INFO] Alustan varundamist $DATE"

# 1. Veebilehe failide kopeerimine
cp -r /var/www/html "$TMP_DIR/html"

# 2. Andmebaasi dump (eeldab root socket-ühendust)
mysqldump -u root --socket=/run/mysqld/mysqld.sock kasutajatugi > "$TMP_DIR/kasutajatugi.sql"

# 3. Pakkimine
tar -czf "$BACKUP_FILE" -C "$TMP_DIR" .

# 4. Ajutise kausta kustutamine
rm -rf "$TMP_DIR"

# 5. Kustuta vanemad kui 7 päeva
find /var/backups -name "kasutajatugi_backup_*.tar.gz" -mtime +7 -exec rm {} \;

# Lõpplogi
echo "[INFO] Varundus tehtud: $BACKUP_FILE"
