<?= $this->extend('layout/reader/reader') ?>

<?= $this->section('title') ?>
<?php echo getenv('websiteName').'-profile'?>
<?= $this->endSection('title') ?>


<?= $this->section('content') ?>
    <div class="mx-auto min-h-screen max-w-6xl px-6 lg:px-8">

<?php if(!empty($user_data)) :?>
    <?php foreach ($user_data['users'] as $user):?>

    <section class="my-4 border border-slate-400 bg-neutral-100 p-4 rounded-lg max-w-ful">
        <div class="mx-auto">
            <div class="card md:flex max-w-lg">
                <div class="w-20 h-20 mx-auto mb-6 md:mr-6 flex-shrink-0">

<!--    image profile            -->
                    <img class="object-cover rounded-full"
                         src="<?= $user['url_picture'] ?>" alt="author-profile-picture">


                </div>
                <div class="flex-grow text-center md:text-left">

<!--    name        -->
                    <h3 class="text-xl heading"><?= $user['name'] ?></h3>

<!--    profile     -->
                    <p class="mt-2 mb-3">
                        <?= $user['profile'] ?>
                    </p>

<!--    social media -->
                    <div class="my-2 flex-row">
        <?php if(!empty($user['media_social'])) :?>
            <?php foreach ($user['media_social'] as $media_social_user):?>

                        <span class="bg-neutral-300 border px-3 py-1 rounded-lg text-sm"
                        ><a href="<?= $media_social_user['link'] ?>"
                            ><?= $media_social_user['platform'] ?></a></span>

            <?php endforeach ;?>
        <?php endif ;?>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <?php endforeach ;?>
<?php endif ;?>

</div>
<?= $this->endSection('content') ?>