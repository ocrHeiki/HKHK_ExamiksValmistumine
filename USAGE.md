# 💻 Kasutajatoe süsteem – Ansible projekt

Ansible projekt, mis seadistab automaatselt ettevõtte sisekasutuse IT kasutajatoe veebirakenduse kolmele masinale (Ubuntu, AlmaLinux, Debian).

---

## 📁 Kataloogistruktuur

Ansible_projects/
├── ansible.cfg
├── inventory/
│   └── inventory.ini
├── playbooks/
│   ├── webserver_setup.yml
│   ├── ssl_setup.yml
│   ├── webapp_setup.yml
│   ├── dbserver_setup.yml
│   ├── phpmyadmin_setup.yml
│   ├── backup_setup.yml
│   ├── verify.yml
│   ├── verify_db.yml
│   └── verify_backup.yml
└── roles/
    ├── webapp/
    ├── dbserver/
    ├── phpmyadmin/
    └── backup/

---

## 🛠️ Eeldused

- Ubuntu juhtmasin (Ansible paigaldatud)
- AlmaLinux (veebiserver, Apache + PHP + SSL)
- Debian (andmebaas, MariaDB + phpMyAdmin)
- SSH võtmed seatud (ilma paroolita)
- Ansible community.mysql kollektsioon paigaldatud:
  ansible-galaxy collection install community.mysql

---

## 🚀 Paigaldusetapid

1. Veebiserver (AlmaLinux):
   ansible-playbook -i inventory/inventory.ini playbooks/webserver_setup.yml --ask-become-pass

2. SSL (AlmaLinux):
   ansible-playbook -i inventory/inventory.ini playbooks/ssl_setup.yml --ask-become-pass

3. Veebirakendus (AlmaLinux):
   ansible-playbook -i inventory/inventory.ini playbooks/webapp_setup.yml --ask-become-pass

4. Andmebaas (Debian):
   ansible-playbook -i inventory/inventory.ini playbooks/dbserver_setup.yml --ask-become-pass

5. phpMyAdmin (Debian):
   ansible-playbook -i inventory/inventory.ini playbooks/phpmyadmin_setup.yml --ask-become-pass

6. Varundus (Debian):
   ansible-playbook -i inventory/inventory.ini playbooks/backup_setup.yml --ask-become-pass

---

## ✅ Kontroll

- Veebiserver:
    ansible-playbook -i inventory/inventory.ini playbooks/verify.yml --ask-become-pass
- Andmebaas:
    ansible-playbook -i inventory/inventory.ini playbooks/verify_db.yml --ask-become-pass
- Varukoopiad:
    ansible-playbook -i inventory/inventory.ini playbooks/verify_backup.yml --ask-become-pass

---

## 🌐 Kasutamine

- Ava veebileht: https://kasutajatugi.oige.local
- Lehed: Avaleht (vorm), Uudised, Tugileht, Kontakt
- Administraatori liides: admin.php (kasutaja: admin, parool: admin123, hashitud)

---

## 🔐 Turvalisus

- SSL: Self-signed, FQDN: kasutajatugi.oige.local
- phpMyAdmin IP-piiranguga + .htpasswd
- Adminliides hashitud parooliga
- Kataloogi sirvimine keelatud (Options -Indexes)
- Andmebaasi ja veebiserveri ühendus on piiratud kasutajaga

---

## 💾 Varundus

- Crontabiga varundamine iga 2h /var/backups kausta
- Failinimes kuupäev + kellaaeg
- Vanemad kui 7 päeva kustutatakse
- Backup skript on kommenteeritud ja asub backup rollis

---

## 📂 GitHub

https://github.com/ocrHeiki/kasutajatugi-ansible

---

## ℹ️ Märkused

- Tegemist on koolitööga, paroolid on demoks ning tuleks päriselus vahetada!
- Soovitame tundlikud andmed panna Ansible Vaulti või gitignore’iga välistada.

