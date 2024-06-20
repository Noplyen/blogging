<?= $this->extend('layout/admin/dashboard') ?>


<?= $this->section('content') ?>

    <p class="text-3xl text-bold text-center"><span>update article</span></p>


<?php if(!empty($article)) :?>

    <!--    Form update data    -->
    <form action="<?= base_url('admin/articles/update')?>" method="post" id="article-form">

        <input type="hidden" name="id_article" value="<?= $article['id']?>">

        <div>
            <label for="title" class="block mb-2 text-lg  text-gray-900 dark:text-white"
            >title</label>
            <input type="text" id="title" name="title"
                   maxlength="70" minlength="3"
                   autocomplete="off"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   value="<?= $article['title'] ?>"
                   placeholder="title" required />
        </div>
        <div>
            <label for="slug" class="block mb-2 mt-4 text-lg text-gray-900 dark:text-white"
            >slug</label>
            <input type="text" id="slug" name="slug"
                   maxlength="100" minlength="1"
                   autocomplete="off"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   value="<?= str_replace( '-',' ', $article['slug'])?>"
                   placeholder="slug" required />
        </div>
        <div>
            <label for="meta-description" class="block mt-4 mb-2 text-lg text-gray-900 dark:text-white"
            >meta description</label>
            <input type="text" id="meta-description" name="meta-description"
                   maxlength="120" minlength="1"
                   autocomplete="off"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   value="<?= $article['meta_description'] ?>"
                   placeholder="meta description" required />
        </div>
        <div>
            <label for="meta-tag" class="block mb-2 mt-4 text-lg  text-gray-900 dark:text-white"
            >meta tag</label>
            <input type="text" id="meta-tag" name="meta-tag"
                   maxlength="100" minlength="1"
                   autocomplete="off"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   value="<?= $article['meta_tag'] ?>"
                   placeholder="meta tag" required />
        </div>

        <div>
            <label for="category" class="text-lg block mb-2 mt-4 font-medium text-gray-900 dark:text-white"
            >category</label>
            <select id="category" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <?php if(!empty($category_list)):?>

                    <!-- mendapatkan value kategori sebelumnya dari artikel -->
                    <option value="<?= $article['category_id'] ?>" selected>
                        <?= getKategoriName($category_list,$article['category_id']) ?>
                    </option>


                    <?php foreach ($category_list as $category): ?>

                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>

                    <?php endforeach;?>
                <?php endif;?>
            </select>
        </div>

        <div class="my-5" id="container-texteditor" >
            <label for="editor" class="text-lg">article content</label>
            <textarea  id="editor" name="content">
                    <?= $article['content'] ?>
            </textarea>
        </div>

        <button type="submit" class="my-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>
<?php endif;?>

<?php
// method ini untuk mendapatkan data kategori artikel
// yang dipilih sebelumnya
function getKategoriName($listOfKategori, $idKategoriSebelumnya)
{
    // mendapatkan id yang sama pada category
    foreach ($listOfKategori as $data){
        if($data['id'] == $idKategoriSebelumnya){
            // mengembalikan nama category
            return $data['name'];
        }
    }
    return "error";
}
?>


    <script src="<?=base_url('js/ck-editor5/build/ckeditor.js')?>"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ),{
                fontFamily: {
                    options: [
                        'default',
                        'Ubuntu, Arial, sans-serif'
                    ]
                },
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' },
                    ]
                },
                ckfinder:{
                    uploadUrl:'<?php echo base_url()?>admin/images'
                },
            } )
            .catch( error => {
                console.error( error );
            } );

    </script>

<?= $this->endSection('content') ?>