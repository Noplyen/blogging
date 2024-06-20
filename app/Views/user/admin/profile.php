<?= $this->extend('layout/admin/dashboard') ?>


<?= $this->section('content') ?>
<div class="text-center mb-4">
    <span class="text-2xl">user profile</span>
</div>

<?php if(!empty($user)):?>
    <form action="<?= base_url('/admin/profiles')?>" class="max-w-md mx-auto" method="post">
        <input name="user_id" type="hidden" value="<?=$user['id']?>">
        <input name="username" type="hidden" value="<?=$user['username']?>">
        <input type="hidden" name="_method" value="PUT">

        <div class="relative z-0 w-full mb-5 group">
            <label for="username"  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >username</label>
            <input type="text"
                   id="username"
                   disabled
                   value="<?= $user['username']?>"
                   class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                   placeholder="username" required />
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <label for="name"  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >name</label>
            <input type="text"
                   name="name" id="name"
                   value="<?= $user['name']?>"
                   minlength="3"
                   maxlength="68"
                   class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <label for="email"  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >email</label>
            <input type="text"
                   name="email" id="email"
                   value="<?= $user['email']?>"
                   minlength="10"
                   maxlength="78"
                   class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <label for="url"  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >url picture</label>
            <input type="text"
                   name="url_picture" id="url"
                   value="<?= $user['url_picture']?>"
                   class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">profile bio</label>
                <textarea name="profile" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="bio"
                ><?= htmlspecialchars($user['profile'])?></textarea>
        </div>

        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>
<?php endif;?>


<?= $this->endSection('content') ?>