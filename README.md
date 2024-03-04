# CoreLaravel

[![Forks](https://img.shields.io/badge/forks-44-blue)](https://github.com/ncholik/laravel)
[![Stars](https://img.shields.io/badge/stars-13-yellow)](https://github.com/ncholik/laravel)


Core laravel adalah sebuah aplikasi berbasis web yang dibangun dengan menggunakan framework Laravel 8. Aplikasi ini dirancang untuk mempermudah programer pemula untuk membuat aplikasi, karena aplikasi ini sudah dilengkapi manajemen user, manajemen menu dan pengelolaan hak akses, sehingga tidak perlu lagi membangun dari awal.


 
## Instalasi 
- clone repository 
```bash
git clone https://github.com/ncholik/laravel.git laravel
```
```bash
cd laravel
```
```bash
composer i
```
```bash
cp .env.example .env
```
```bash
php artisan key:generate
```
```bash
php artisan migrate
```
```bash
php artisan db:seed
```
```bash
php artisan serve
```
Gunakan perintah ini setelah menambahkan route baru
```bash
php artisan permission:create-permission-routes-sync
```

##  Module

Mebuat Modul
```bash
php artisan module:make Blog
```

api modul.
```bash
php artisan module:make Blog --api
```

Enable Modul
```bash
php artisan module:enable ModuleName
```

Membuat file Migrasi di modul
```bash
php artisan module:make-migration create_pegawais_table Kepegawaian
```

Membuat file seeder modul 
```bash
php artisan module:make-seed menu_modul_kepegawaian Kepegawaian
```

Run seeder dari modul
```bash
php artisan module:seed Kepegawaian
```

run seeder dari modul dengan sepesifik class
```bash
php artisan module:seed --class=MenuModulKepegawaianTableSeeder Kepegawaian
```

[Document_Lenkap_modul](https://laravelmodules.com/docs/v8)



## Kontribusi

Kami menyambut kontribusi dari komunitas. Jika Anda ingin berkontribusi, ikuti langkah-langkah berikut:

1. Fork repositori ini
2. Buat cabang baru (`git checkout -b nama-cabang`)
3. Lakukan perubahan pada cabang tersebut
4. Commit perubahan (`git commit -m "Deskripsi perubahan"`)
5. Push ke cabang Anda (`git push origin nama-cabang`)
6. Buka permintaan tarik (pull request) ke repositori ini

## Lisensi

Anda dapat merubah kode apapun tapi jangan hilangkan link repo kode ini berasal.
---
[![](https://img.shields.io/static/v1?label=Sponsor&message=%E2%9D%A4&logo=GitHub&color=%23fe8e86)](https://github.com/sponsors/ncholik)
---
Dibuat oleh [BangCholik](https://github.com/ncholik) [Channel Youtube](https://www.youtube.com/@bangcholik)












