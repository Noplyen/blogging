### Halaman ini akan membahas logging

---

Logging merupakan sebuah teknik untuk tracking informasi
kode program kita, ini akan mempermudah dalam proses debug,
atau monitoring aplikasi.

```text
INFO | 2024-6-16, 1:25 am > success creating user | {"username":"fhgvbcvsdfdsfrte"} 
```

pada aplikasi saya menggunakan `Monolog`, dikarenakan
ini lebih baik ketimbang log default dari php.
Konfigurasi log ada pada `Libraries\AppLogger`, saya
telah mengkonfigurasi beberapa hal seperti output dan format.

```php
// NOTE : Logger punya monolog
private Logger $myLogger;
$this->myLogger        = AppLogger::LoggerCreations(Login::class);
```

Silahkan gunakan log untuk memberikan informasi yang revelan,
dari exception dan informasi lainnya. Lalu ada 1 class
yang digunakan untuk logger context yakni `Helpers\LoggerContext`
digunakan untuk membuat factory context pada log. Saya
membuat ini untuk logging context exceptions, tetapi sesuaikan
kebutuhan anda.

```php
// contoh sederhana tanpa factory LoggerContext
$this->myLogger->info('success creating user',['username'=>$user->username]);
// contoh penggunaan factory LoggerContext
 $c = LoggerContext::setLoggerContext
        (
            $previousException->getMessage(),
            $previousException->getTrace(),
        );

 $this->myLogger->error($message,$c);
```