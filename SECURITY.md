# 🔐 Turvameetmed – Kasutajatoe Ansible projekt

Selles projektis on rakendatud järgmised turvameetmed, et tagada süsteemi ja kasutajaandmete kaitse.

---

## 1. 🔑 SSH ja Ansible

- Ansible ühendub serveritega ainult **SSH võtmete** abil.
- `ansible.cfg` failis on `host_key_checking = False` ainult õppimise/katsetamise jaoks.
- Ansible töötab `sudo` või `root` õigustes, kuid ainult kindlate masinate vahel.

---

## 2. 📛 Paroolid

- Andmebaasi `root` ja kasutaja `kasutaja` paroolid on failides selgelt (ainult kooli eesmärgil).
- Admin veebiparool on **hashitud** PHP `password_hash()` abil (`bcrypt`).
- PhpMyAdmin ligipääs:
  - IP-põhine piirang (ainult 10.0.24.52 ja 10.0.24.51).
  - Paroolikaitse `.htpasswd` failiga.

---

## 3. 🔐 PhpMyAdmin ligipääsu piiramine

Apache seadistuses (/etc/apache2/conf-available/phpmyadmin.conf):

<Directory /usr/share/phpmyadmin>
    Require ip 10.0.24.52
    Require ip 10.0.24.51
    AuthType Basic
    AuthName "Restricted Access"
    AuthUserFile /etc/phpmyadmin/.htpasswd
    Require valid-user
</Directory>

---

## 4. 🔒 SSL-sertifikaat

- Sertifikaat on **self-signed**, loodud Ansible kaudu.
- Sertifikaat baseerub domeenil `kasutajatugi.oige.local`.
- Failid: `/etc/httpd/ssl/kasutajatugi.oige.local.crt` ja `.key`.

---

## 5. 🧱 MariaDB konfiguratsioon

- `bind-address = 0.0.0.0` lubab ühendused ainult määratud kasutajalt.
- Kasutaja `kasutaja@'%'` on loodud tugeva parooliga.
- Andmebaas: `kasutajatugi`, tabel: `probleemid`.

---

## 6. ✉️ Vormide valideerimine

- Veebivormid nõuavad kõiki välju (HTML `required` + serveripoolne kontroll).
- Andmed salvestatakse **ettevalmistatud SQL-päringuga** (`prepare + bind_param`) vältimaks SQL-süstimist.

---

## 7. 🔁 Varundamine

- Iga 2h tagant cron-job varundab:
  - `/var/www/html` (veebileht)
  - MariaDB dump (`mysqldump`)
- Failid salvestatakse `/var/backups/` kausta.
- Failid sisaldavad kuupäeva ja kellaaega.
- Vanemad kui 7 päeva kustutatakse automaatselt.
- Skript on dokumenteeritud ja seatud Ansible rolliga.

---

## ⚠️ Märkus

See projekt on loodud **õppe eesmärgil**. Soovitame:
- Eemaldada kõigist failidest avatud paroolid.
- Kasutada `Ansible Vault` salastatud muutujate jaoks.
- Paigaldada sertifikaadid usaldusväärsest CA-st.
- Piirata ligipääs tulemüüridega ja täiendava autentimisega.

