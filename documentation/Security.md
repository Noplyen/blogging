### Halaman ini membahas security aplikasi

---

Security pada aplikasi dibutuhkan untuk menghindari
hal buruk yang terjadi pada aplikasi. Saya memiliki 
sedikit pengetahuan tentang security aplikasi, dan
saya terapkan pada aplikasi blog ini.

1. `Validation` ini berguna untuk memvalidasi user 
input, untuk menghadapi sql injection maupun input
data tak sesuai [validation codeigniter](https://codeigniter4.github.io/userguide/libraries/validation.html)
saya memiliki skema layer request untuk menghadapi
data request pada `app\Request` ini terinspirasi dari
framework spring `validation`. Jadi pada layer tersebut
saya membuat class yang menggambarkan validasi pada 
request, contohnya `LoginRequest` dan `RegisterRequest`
hal lain dari layer ini adalah meringankan kode yang ada
pada controller.
    
    _Note : setiap class request meminta `Request` saya_ 
    _tidak tahu ini baik atau tidak mengirim whole of `Request`_
    ```php
     $this->user = $this->loginReq->getLoginRequest($this->request);
    ```
   
2. `Throw Exception` ya ini memang salah satu cara
untuk memperketat security aplikasi, karena kita
tidak ingin ada error kode yang tampil ke halaman pengguna

3. `CSRF dan FILTERS` untuk mengamankan input form,
sehingga hanya form milik kita yang dapat masuk ke server
tidak inputan dari form orang lain. Sederhananya csrf
teknik menyerang website dengan mengeksploitasi form input
jadi anda memiliki halaman login x, lalu penyerang membuat
halaman login serupa dan akan mengirimkan data input user
ke server kita,  dan tara mereka mendapatkan data input user
sebelum dikirim ke server kita. Lalu untuk filters
ini membatasi hak akses mana saja yang dapat diakses oleh 
user.