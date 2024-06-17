### Halaman Model & Entities

---
Untuk berkomunikasi dengan database dengan baik
framework codeigniter menyediakan fasilitas model
yang telah memiliki fitur query builder, ini memudahkan
untuk berinteraksi dengan database. Model direpresentasikan
sebagai class perwujudan table, dengan extends Model.

```php
class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = "array";
    protected $useSoftDeletes   = false;
    protected $allowedFields    =
        [
            "id","profile",
            "name","username",
            "email","password",
            "url_picture"
        ];
}
```

`returnType` pada aplikasi ini memang saya buat array,
karena fitur entites yang tidak terlalu baik seperti java
orm. Juga dengan alasan agar kita mudah ketika banyak 
join table dan menggunakan alias untuk hasilnya, contoh.

```php
$this->articleModel
            ->select('article.* , category.* , users.* , detail_article.*')
            ->select('users.id as user_id , article.id as article_id')
            ->select('category.id as category_id , users.name as user_name')
            ->select('category.name as category_name')
```
sehingga `category_name` dapat dengan mudah dipanggil dengan 
array, ketimbang kembalian bertipe entities yang memungkinkan
developer baru akan sulit menerimanya. 

Sebelumnya saya infokan bahwa fitur entities tidak teralalu
baik, kenapa? karena php memiliki fitur magic function,
lalu ini adalah permasalahannya biasanya kita membuat class
dengan variable field lalu setter getter agar bisa dengan
pasti mengetahui dan benar menggunakan field dari class tsb.
Lalu di codeigniter ini kita tidak dapat melakukan itu pada
class entities (_Note: argument saya_)

```php
class User extends Entity
{
    private string $username;

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

}
```

diatas merupakan contoh, kita tidak dapat melakukan ini
pada entities dan menggunakannya sebagai tipe kembalian 
model. Akan terjadi error ketika kita ingin mengakses 
data entities.

Maka dari itu, saya menggunakan entities sebagai input data
dan untuk result query saya gunakan array.

```php
//contoh penggunaan entities untuk insert data
$user = new User();

            $user->username =$username;
            $user->email    =$email;
            $user->password =$password;
$this->usermodel->save($user);

// contoh result query dengan array
$result = $this->licenseModel
            ->where('license', $license)
            ->first();
if(!$result['is_used'])
```