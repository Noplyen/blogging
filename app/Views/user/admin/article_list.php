<?= $this->extend('layout/admin/dashboard') ?>


<?= $this->section('content') ?>
<p class="text-3xl text-bold text-center"><span>list article</span></p>


<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right  dark:text-gray-400">
        <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            information
            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                you can publish, edit or delete by click update
            </p>
        </caption>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                no
            </th>
            <th scope="col" class="px-6 py-3">
                title
            </th>
            <th scope="col" class="px-6 py-3">
                author
            </th>
            <th scope="col" class="px-6 py-3">
                created date
            </th>
            <th scope="col" class="px-6 py-3">
                status
            </th>
            <th scope="col" class="px-6 py-3">
                <span>update</span>
            </th>
        </tr>
        </thead>
        <tbody>


<!--   DATA LOOPING     -->
            <?php if (!empty($article_list)) : ?>
                <?php foreach ($article_list as $index =>$article) : ?>
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <td class="px-6 py-4">
                <?= $index+1 ?>
            </td>
            <td class="px-6 py-4">
                <?= $article['title'] ?>
            </td>
            <td class="px-6 py-4">
                <?= $article['user_name'] ?>
            </td>
            <td class="px-6 py-4">
                <?= $article['date_create'] ?>
            </td>
            <td class="px-6 py-4">
                <?php
                if($article['publish_status']){
                    echo <<<HTML
                                <div class="bg-green-500 w-full text-center">
                                <span class="p-2 text-base">published</span>                                
                                </div>
                                HTML
                    ;
                }else{
                    echo <<<HTML
                                <div class="bg-yellow-500 w-full text-center">
                                <span class="p-2 text-base">unpublished</span>                                
                                </div>
                                HTML;
                }
                ?>
            </td>
            <td class="px-6 py-4 text-left">
                <a href="<?= base_url('/admin/articles/'.$article['article_id'])?>"
                   class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                >update</a>
            </td>
        </tr>
                <?php endforeach;?>
            <?php endif;?>

        </tbody>
    </table>
</div>


<?= $this->endSection('content') ?>
