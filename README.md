# Kasutajatugi – Ansible projekt

See projekt automatiseerib ettevõtte sisekasutuseks mõeldud **Kasutajatoe veebirakenduse** paigalduse, kasutades Ansible'it. Lahendus hõlmab kolme serverit:

- **Ubuntu** – juhtmasin koos Ansible’iga
- **AlmaLinux** – veebiserver (Apache + PHP + SSL + CRUD rakendus)
- **Debian** – andmebaasiserver (MariaDB + phpMyAdmin + varukoopiad)

---

## 🛠️ Rollid ja funktsionaalsus

### 1. `webapp` (AlmaLinux)
- Apache ja PHP paigaldus
- SSL sertifikaat (kasutajatugi.oige.local)
- Kataloogisirvimise keelamine
- Bootstrap-il põhinev veebileht:
  - Vorm probleemide esitamiseks
  - Admin-liides (hashitud parooliga)
  - Statistika, CRUD-toimingud

### 2. `dbserver` (Debian)
- MariaDB paigaldus ja seadistamine
- Kasutaja ja andmebaasi loomine (`kasutajatugi`)
- Tabel `probleemid` loomine
- phpMyAdmin paigaldus ja turvamine (IP ja BasicAuth kaitse)

### 3. `backup` (Debian)
- Varundusskript, mis:
  - loob /var/backups/ alla `.tar.gz` arhiivi iga 2h järel
  - logib varundused logifaili `/var/log/backup_kasutajatugi.log`
  - kustutab varundused, mis on vanemad kui 7 päeva
- crontab seadistus

---

## 📦 Failistruktuur

```
Ansible_projects/
├── ansible.cfg
├── inventory/
│   └── inventory.ini
├── playbooks/
│   ├── webserver_setup.yml
│   ├── dbserver_setup.yml
│   ├── ssl_setup.yml
│   ├── webapp_setup.yml
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
```

---

## 🚀 Kasutamine

1. Lisa IP-d `hosts` faili (nt `/etc/hosts`):
```
10.0.24.51 kasutajatugi.oige.local
```

2. Käivita vajalikud playbookid:

```bash
cd ~/Ansible_projects

# Veebiserver ja rakendus
ansible-playbook -i inventory/inventory.ini playbooks/webserver_setup.yml
ansible-playbook -i inventory/inventory.ini playbooks/ssl_setup.yml
ansible-playbook -i inventory/inventory.ini playbooks/webapp_setup.yml

# Andmebaasiserver ja phpMyAdmin
ansible-playbook -i inventory/inventory.ini playbooks/dbserver_setup.yml
ansible-playbook -i inventory/inventory.ini playbooks/phpmyadmin_setup.yml

# Varukoopiad
ansible-playbook -i inventory/inventory.ini playbooks/backup_setup.yml
```

---

## 👤 Autor

Autor: [ocrHeiki](https://github.com/ocrHeiki)  
Õppetöö eesmärgil (Pilet 4 – Linux)

---

## 📄 Litsents

See projekt on loodud õppetöö eesmärgil ja ei sisalda turvalisi paroole ega autentimisvõtmeid.  
Soovitatav on eemaldada või muuta kõik tundlik info enne avalikku kasutust.
