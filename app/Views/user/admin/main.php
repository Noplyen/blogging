<?= $this->extend('layout/admin/dashboard') ?>

<?= $this->section('content') ?>

<div class="flex text-center">

    <div  class="flex-initial w-72 mx-2 block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
        >BLOG POST</h5>
        <p class="font-normal text-gray-700 dark:text-gray-400 text-2xl"
        >

            <?php if(!empty($all_blog)) :?>
                <?= $all_blog?>
            <?php endif ;?>

        </p>

    </div>

    <div  class="flex-initial w-72 mx-2 block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
        >UNPUBLISHED BLOG</h5>
        <p class="font-normal text-gray-700 dark:text-gray-400 text-2xl"
        >

            <?php if(!empty($unpublished_blog)) :?>
                <?= $unpublished_blog?>
            <?php endif ;?>

        </p>

    </div>

    <div  class="flex-initial w-72 mx-2 block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
        >CATEGORY</h5>
        <p class="font-normal text-gray-700 dark:text-gray-400 text-2xl"
        >

            <?php if(!empty($all_category)) :?>
                <?= $all_category?>
            <?php endif ;?>

        </p>

    </div>

</div>


<?= $this->endSection('content') ?>