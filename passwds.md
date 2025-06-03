# Kasutajatoe Projekti Salasõnad ja Kasutajad

See dokument sisaldab **kõiki kasutatud kasutajanimesid ja paroole** projekti "Kasutajatugi" ülesehituse jooksul. **Mõeldud ainult arendus- ja testkasutuseks!**

---

## 🔐 Andmebaas (MariaDB – Debian server)
- **Kasutajanimi:** `kasutaja`
- **Parool:** `salasona`
- **Õigused:** `kasutajatugi.*:ALL`
- **Host:** `%` (lubatud kaugühendused)

---

## 🔐 PhpMyAdmin (Basic Authentication)
- **Kasutajanimi:** `admin`
- **Parool:** `@dM1n`
- **Kaitstud .htpasswd failiga:** `/etc/phpmyadmin/.htpasswd`

---

## 🔐 Veebirakenduse adminpaneel (login.php)
- **Kasutajanimi:** `admin`
- **Parool:** `admin123`
- **Parool on hashitud kujul PHP-s:**  
  `$2y$10$mvJyxoy2zMC7vboVJLTB0eQfMbvYj1nC7L/mnK1XW2UZ7g9K.RcHG`

---

## 🔐 SSH ühendused (Ansible kaudu)
- **Kasutajanimi:** `kasutaja`
- **Autentimine:** SSH võtmega
- **Privaatvõti:** `/home/kasutaja/.ssh/id_rsa`
- **Serverid:** AlmaLinux (10.0.24.51), Debian (10.0.24.50)

---

## ℹ️ Märkused
- Kõik paroolid on test- ja õppekeskkonna jaoks.  
- GitHubi üles laadides **soovitame see fail `.gitignore` kaudu välistada** või asendada tundlik info mallidega.

