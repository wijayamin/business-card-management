Aplikasi-Kartu-Nama
===================
Aplikasi Kartu Nama Untuk PT. PAL Indonesia

Progress 85%

##### Penggunaan Aplikasi
Username Super Admin : **Admin**
Password Super Admin : **Admin**

**Koneksi Database**
* Buat database MySQL Baru Dengan Nama **kartu_nama** atau dengan nama terserah
* Import File **kartu_nama.sql**
* edit file **config.php** dan edit kode seperti dibawah dan ganti sesuai kebutuhan
```
    $database["host"]='localhost'; // Ganti dengan alamat server mysql (contoh : Localhost)
    $database["port"]="3306"; // Port Server MySQL (contoh : 3306)
    $database["name"]="kartu_nama"; // Nama Database yang digunakan
    $database["username"]="root"; // Username Akses MySQL
    $database["password"]=""; // Password Akses MySQL
```

## Versi 0.2
* penambahan halaman admin
* undang pengguna baru via email
* support file PDF dan Image
* Perbaikan Bug
* Partialy Support IE 8

##### catatan Versi 0.2
* Email menggunakan smtp server hosting gratisan (kemungkinan email tidak terikirm menjadi besar)
* beberapa fitur belum bisa digunakan seperti manajemen grup, pesan, dan pengaturan

##### dibangun menggunakan
* Slim Framework (PHP Framework)
* Mustache PHP (PHP Templating Engine)
* Mustache.js (Javascript Templating Engine)
* PHPMailer (PHP email Engine)

