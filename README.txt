CARA PASANG (XAMPP: aktifkan Apache + MySQL, buat database "jarkomdas" di phpMyAdmin)
1. composer create-project laravel/laravel:^10.0 jarkomdas
2. Salin folder app, database, resources, routes dari zip ini ke dalam folder jarkomdas (timpa file yang sama).
3. Di .env isi: DB_DATABASE=jarkomdas, DB_USERNAME=root, DB_PASSWORD= (kosong)
4. php artisan migrate:fresh --seed
5. php artisan serve  ->  buka http://127.0.0.1:8000
Akun: guru / guru123  |  siswa / siswa123
