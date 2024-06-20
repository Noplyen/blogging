<?= $this->extend('layout/admin/dashboard') ?>


<?= $this->section('content') ?>

<div class="">
    <!--        FORM INPUT         -->
    <?php if (!empty($article)) : ?>
        <form action="<?=base_url('admin/articles/preview')?>"
              class="p-3"
              method="post">

            <input name="id_article"
                   type="hidden"
                   value="<?= $article['id']?>">

            <label for="small" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >Choose article option</label>
            <select id="small" name="article_option" class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="update" >update</option>
                <option value="delete" >delete</option>
                <option value="publish" >publish</option>
            </select>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
            >Submit</button>

        </form>
        <!--        FORM INPUT         -->
    <?php endif;?>
</div>

<!--CONTENT PREVIEW-->
<div class="min-h-screen">
    <?php if (!empty($article)) : ?>
        <h1 class="text-4xl font-bold px-3 pb-5"><?= $article['title']?></h1>
        <hr>
        <section class="py-3 px-3">
            <?= $article['content']?>
        </section>
    <?php endif;?>
</div>

<?= $this->endSection('content') ?>