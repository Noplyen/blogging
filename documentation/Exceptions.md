### Halaman ini akan membahas Exceptions

---

Exception merupakan hal yang umum dan sering ditemui pada 
kode program, kalian harus menghandlenya.

Pada project ini saya menggunakan exception custom 
agar pembacaan exception lebih mudah, setidaknya ada :

- `AlreadyExistExceptions`
- `DataNotFoundExceptions`
- `FailedInsertingDataExceptions`
- `IncorrectPasswordExceptions`
- `InvalidLicenseExceptions`
- `UserNotFoundExceptions`
- `ValidationExceptions`

Exceptions yang khusus adalah `FailedInsertingDataExceptions`
ini digunakan ketika beroperasi dengan database model
kita akan menghandle exceptionnya contoh : 

```php
 try {
    $this->sessionLoginModel->save($this->sessionLogin);

 } catch (\ReflectionException|Exception $e) {
     throw new FailedInsertingDataExceptions('gagal insert session cookie ke database',$e);
 }
```

pada class `FailedInsertingDataExceptions` memiliki
logger beserta context dari exception operasi model database
maka dari itu isikan parameter `FailedInsertingDataExceptions`
dengan utuh seperti contoh. Untuk controller yang akan
catch exception ini silahkan gunakan pesan anda sendiri 
atau saya rekomendasikan tidak usah di catch pada
controller, agar dia merujuk ke halaman error 500.

Banyak class exceptions saya extends dari `RuntimeException`
maka dari itu selalu gunakan PHP doc, dan berikan `@throws`

```php
/**
     * @param string $cookie
     * @param string $userId
     * @return void
     * @throws FailedInsertingDataExceptions error when save session
*/
```