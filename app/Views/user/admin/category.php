<?= $this->extend('layout/admin/dashboard') ?>


<?= $this->section('content') ?>


    <div class="overflow-x-auto overflow-y-auto" style="height: 75vh">

    <p class="text-3xl text-bold text-center"><span>category data</span></p>

    <div class="border border-current rounded-md p-3 mt-2" style="width: 300px;">
        <p class="text-center text-lg font-bold"><span>form tambah data</span></p>

<!--    Form tambah data    -->
        <form action="<?= base_url('admin/categories')?>" method="post">
            <div>
                <label for="name" class="block mb-2 text-base  text-gray-900 dark:text-white"
                >category name</label>
                <input type="text" id="name" name="name"
                       maxlength="100" minlength="3"
                       autocomplete="off"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="category name" required />
            </div>
            <button type="submit" class="my-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>


    </div>


<!--TABLE ---------------->
    <table class="table-fixed mt-5 w-full border-collapse border border-gray-300">
        <thead class="text-xl text-gray-900 bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th class="border border-gray-300">no</th>
            <th class="border border-gray-300">name</th>
            <th class="border border-gray-300">delete</th>
            <th class="border border-gray-300">update</th>
        </tr>
        </thead>
        <tbody>


        <?php if (!empty($category_list)) : ?>
            <?php foreach ($category_list as $index => $category) : ?>
                <tr class="text-center border border-gray-300 overflow-y-scroll">
                    <td class="border border-gray-300">
                        <?= $index+1 ?>
                    </td>

<!--   NAME     -->
                    <td class="border border-gray-300"><?= $category['category_name']; ?></td>

<!--   DELETE     -->
                    <td class="border border-gray-300">
                        <?php if (is_null($category['article_id'])) : ?>
                            <form id="delete-form"
                                  onsubmit="return confirm('Do you really want to submit the form?');"
                                  action="<?php echo base_url().'admin/categories/delete/'.$category['category_id']; ?>" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <div class="flex justify-center">
                                    <button id="deleteButton" type="submit">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </td>
<!--   UPDATE     -->
                    <td class="border border-gray-300">
                        <form action="<?php echo base_url().'admin/categories/update/'.$category['category_id']; ?>" method="get">
                            <button type="submit" class="btn btn-success btn-sm d-flex align-items-center">
                                <span class="material-symbols-outlined">update</span>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>


        </tbody>
    </table>


<?= $this->endSection('content') ?>