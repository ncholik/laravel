Aplikasi dasar menggunakan framework laravel versi 8

pada saat baru clone dari git setelah install semua dependency dan migrate database lakukan 
1. php artisan migrate
2. php artisan db:seed  --> untuk mengisi data dalam database
3. php artisan permission:create-permission-routes-sync -> untuk generate permision route jika ada penambahan routing baru


php artisan optimize:clear -> untuk membersihkan cache

git add --all -> untuk menambahkan semua file2 baru sebelum commit
git commit -m "Integrasi SSO POLIWANGI" -> untuk proses commit dengan komentar untuk mempermudah tracing
git push -u origin master -> untuk proses push ke server setelah commit


- untuk menambah role untuk filter gate menu adminlte ada di app\Providers\AuthServiceProvider.php



untuk mengganti warna tema public\assets\css

rename admin_custom-{warna}.css menjadi admin_custom.css
rename login_custom-{warna}.css menjadi login_custom.css












