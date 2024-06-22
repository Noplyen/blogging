<?= $this->extend('layout/admin/dashboard') ?>

<?= $this->section('content') ?>

    <div class="border border-current rounded-md p-3 mt-2">
        <p class="text-center text-lg font-bold"><span>form tambah data</span></p>

        <!--    Form tambah data    -->
        <form action="<?= base_url('admin/social')?>" method="post"
              class="flex gap-x-4">

            <input type="hidden" name="user_id" value="<?=!empty($user_media_social)?$user_media_social[0]['user_id']:""?>">

            <div class="flex-none w-34">
                <label for="name" class="block mb-2 text-base  text-gray-900 dark:text-white"
                >platform</label>
                <input type="text" id="name" name="platform"
                       maxlength="100" minlength="3"
                       autocomplete="off"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="facebook" required />
            </div>
            <div class="flex-none w-60">
                <label for="name" class="block mb-2 text-base  text-gray-900 dark:text-white"
                >link</label>
                <input type="text" id="name" name="link"
                       maxlength="100" minlength="3"
                       autocomplete="off"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="https://facebook.com" required />
            </div>
            <button type="submit"
                    class="my-auto mt-9 text-white bg-blue-700 hover:bg-blue-800
                    focus:ring-4 focus:outline-none focus:ring-blue-300
                    font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2
                    text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>


    </div>

    <div class="mt-5 relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="border border-current w-full text-sm text-left rtl:text-right  dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    no
                </th>
                <th scope="col" class="px-6 py-3">
                    platform
                </th>
                <th scope="col" class="px-6 py-3">
                    link
                </th>
                <th scope="col" class="px-6 py-3">
                    delete
                </th>
            </tr>
            </thead>
            <tbody>


            <!--   DATA LOOPING     -->
            <?php if (!empty($user_media_social)) : ?>
                <?php foreach ($user_media_social as $index =>$user) : ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">
                            <?= $index+1 ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= $user['platform'] ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= $user['link'] ?>
                        </td>
                        <td class="px-6 py-4 text-left">
                            <form action="<?= base_url('admin/social')?>" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" value="<?= $user['id']?>">
                                <input type="hidden" name="link" value="<?= $user['link']?>">
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded"
                                >delete</button>
                            </form>
                        </td>
                    </tr>

                <?php endforeach;?>
            <?php endif;?>

            </tbody>
        </table>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleButtons = document.querySelectorAll('[data-modal-toggle]');

            toggleButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const modalId = button.getAttribute('data-modal-toggle');
                    const modal = document.getElementById(modalId);
                    modal.classList.toggle('hidden');
                });
            });
        });
    </script>
<?= $this->endSection('content') ?>