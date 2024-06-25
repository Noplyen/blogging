<?= $this->extend('layout/reader/reader') ?>

<?= $this->section('title') ?>
<?php if (!empty($article)) : ?>
    <?= (!empty($article['title'])?$article['title']:" ")?>
<?php endif;?>
<?= $this->endSection('title') ?>


<?= $this->section('content') ?>

<!--DIV DIBAWAH INI MERUPAKAN ATURAN UNTUK CONTAINER VIEW-->
<!--ini karena template read article dan home sama -->
<!-- lalu ukuran agar berbeda maka div ini ada di setiap section content -->
<div class="mx-auto max-w-6xl px-6 lg:px-8">

<div class="md:container md:mx-auto md:my-5">

    <?php if (!empty($article)) : ?>

    <!--  title  -->
    <h1 class="text-4xl font-extrabold dark:text-white mt-3"
    ><?= $article['title'] ?></h1>

    <div class="my-2">

        <!--  author  -->
        <a href="#" >
            <span class="font-medium text-gray-500">
                <span>author : </span>
                <span><?= $article['user_name'] ?></span>
            </span>
        </a>
        <br>

        <!--  category  -->
        <a href="#">
            <span class="font-medium text-gray-500">
                <span>category : </span>
                <span><?= $article['category_name'] ?></span>
            </span>
        </a>
    </div>
    <hr>

    <!--  content  -->
    <section class="my-4">
        <span class="font-normal overscroll-x-auto">
            <?= $article['content'] ?>
        </span>
    </section>

    <?php endif;?>

</div>
</div>

<?php if (!empty($article)){
    $metaDescription    =   $article['meta_description'];
    $metaTag            =   $article['meta_tag'];
    $metaAuthor         =   $article['user_name'];

    echo <<<script
        <script>
            var valueDescription = "{$metaDescription}";
            var valueTag = "{$metaTag}";
            var valueAuthor = "{$metaAuthor}";
            document.getElementById("meta-description-value").setAttribute("content", valueDescription);
            document.getElementById("meta-tag-value").setAttribute("content",valueTag);
            document.getElementById("meta-author-value").setAttribute("content",valueAuthor);
        </script>
     script;
} ?>

<script>
    var figure = document.querySelector('figure');

    if(figure != null){
        figure.className += ' flex justify-center items-center';
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let images = document.querySelectorAll('p > a');

        images.forEach(image => {
            image.className += 'text-blue-600 dark:text-blue-500 hover:underline';

        });
    });
</script>

<?= $this->endSection('content') ?>
