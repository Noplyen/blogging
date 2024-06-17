<?= $this->extend('layout/reader/reader') ?>

<?= $this->section('text-slate') ?>
<div class="mx-auto max-w-2xl lg:mx-0 py-3">
    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">writeLy blog</h2>
    <p class="mt-2 text-lg leading-8 text-gray-600">Berbagi pengetahuan dari sejarah pembelajaran</p>
</div>
<?= $this->endSection('text-slate') ?>


<?= $this->section('title') ?>
<?php echo getenv('websiteName')?>
<?= $this->endSection('title') ?>


<?= $this->section('content') ?>

<div class="mx-auto mt-10 grid
            max-w-2xl grid-cols-1
            gap-x-8 gap-y-16 border-t
            border-gray-200 pt-10
            sm:mt-5 sm:pt-5 lg:mx-0
            lg:max-w-none lg:grid-cols-3">

    <?php if(!empty($list_article)) :?>
    <?php foreach ($list_article as $artikel):?>

    <article class="flex max-w-xl flex-col items-start justify-between">
        <div class="flex items-center gap-x-4 text-xs">

            <!--  publish date  -->
            <time class="text-gray-500"
            ><?= $artikel['date_create'] ?></time>

            <!--  category  -->
            <a href="#" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100"
            ><?= $artikel['category_name'] ?></a>

        </div>
        <div class="group relative">
            <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">


                <!--  title  -->
                <a href="<?= base_url()."post/".$artikel['slug'].'?more='.substr($artikel['article_id'],0,8)?>">
                    <span class="absolute inset-0"></span>
                    <?= $artikel['title'] ?>
                </a>

            </h3>

            <!--  description  -->
            <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600"
            ><?= $artikel['meta_description'] ?></p>

        </div>
        <div class="relative mt-8 flex items-center gap-x-4">

<!--  author image  -->
            <img src="<?= $artikel['url_picture'] ?>"
                 alt=""
                 class="h-10 w-10 rounded-full bg-gray-50">
            <div class="text-sm leading-6">
                <p class="font-semibold text-gray-900">

<!--  author  -->
                    <span>
                        <span class="absolute inset-0"></span>
                        <?= $artikel['user_name'] ?>
                    </span>

                </p>
            </div>
        </div>
    </article>

        <?php endforeach ;?>
    <?php endif ;?>

    <!-- More posts... -->
</div>
<?= $this->endSection('content') ?>
