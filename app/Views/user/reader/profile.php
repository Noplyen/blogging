<?= $this->extend('layout/reader/reader') ?>

<?= $this->section('title') ?>
<?php echo getenv('websiteName').' | profile'?>
<?= $this->endSection('title') ?>

<?= $this->section('content') ?>

<?php if(!empty($user_data)) :?>
    <?php foreach ($user_data['users'] as $user):?>

        <div class="profile-container">
            <img src="<?=base_url('/images/resource/stuff.png')?>" alt="img">

            <div class="profile-text">
                <span class="title">Belajar Dari Internet</span>
                <br>
                <span class="slax">writelyblog dibuat untuk menyimpan catatan dari pembelajaran,
        sekaligus berbagi apa yang diketahui kepada orang lain.
        </span>
            </div>

        </div>

        <span class="__author-tag">Author Blog</span>

        <div class="__profile-author">

            <img src="<?= $user['url_picture'] ?>" alt="author_pic">

            <div class="__container-detail">
                <span class="__profile-name"><?= $user['name'] ?></span>

                <div class="__detail-profile">
                    <span ><?= $user['profile'] ?></span>

                    <div class="__profile-sosial">

                        <?php if(!empty($user['media_social'])) :?>
                            <?php foreach ($user['media_social'] as $media_social_user):?>
                                <span>
                            <a href="<?= $media_social_user['link'] ?>">
                                <?= $media_social_user['platform'] ?></a>
                        </span>
                            <?php endforeach ;?>
                        <?php endif ;?>
                    </div>
                </div>

            </div>

        </div>

    <?php endforeach ;?>
<?php endif ;?>


<script>
    var valueDescription = "writelyblog author";
    var title = "<?php echo getenv('websiteName')?>";
    var siteUrl = "<?php echo base_url('profile')?>";
    var valueTag = "writelyblog, writelyblog.com, https://writelyblog.com, https://writelyblog.com/profile";
    var valueAuthor = "<?= $user['name'] ?>";
    document.getElementById("meta-description-value").setAttribute("content", valueDescription);
    document.getElementById("meta-description-value-og").setAttribute("content", valueDescription);
    document.getElementById("meta-title-value-og").setAttribute("content",title );
    document.getElementById("meta-url-value-og").setAttribute("content", siteUrl);
    document.getElementById("meta-tag-value").setAttribute("content",valueTag);
    document.getElementById("meta-author-value").setAttribute("content",valueAuthor);
</script>

<?= $this->endSection('content') ?>
