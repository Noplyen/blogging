<?= $this->extend('layout/reader/reader') ?>

<?= $this->section('title') ?>
<?php echo getenv('websiteName')?>
<?= $this->endSection('title') ?>

<?= $this->section('content') ?>

    <div class="parent-container-card">

        <div class="card-container">

            <?php if(!empty($list_article)) :?>
                <?php foreach ($list_article as $artikel):?>


                    <div class="card">

                        <div class="card-top">
                            <time><?= $artikel['date_create'] ?></time>
                            <a href="<?= base_url('category/'.$artikel['category_name'])?>">
                                <?= $artikel['category_name'] ?>
                            </a>
                        </div>

                        <div class="card-bottom">
                            <a href="<?= base_url("post/".$artikel['slug'].'?more='.substr($artikel['article_id'],0,8))?>">
                                <?= $artikel['title'] ?>
                            </a>
                            <p>
                                <?= $artikel['meta_description'] ?>
                            </p>
                        </div>
                    </div>


                <?php endforeach ;?>
            <?php endif ;?>

        </div>


    </div>


    <?php if(!empty($pager)):?>
        <?= $pager->links('default','custom') ?>
    <?php endif;?>


    <script>
        var valueDescription = "Berbagi ilmu di catatan digital dari pengalaman belajar";
        var title = "<?php echo getenv('websiteName')?>";
        var siteUrl = "<?php echo base_url()?>";
        var valueTag = "writelyblog, em hadissi haslam, writelyblog.com, https://writelyblog.com";
        var valueAuthor = "em hadissi haslam";
        document.getElementById("meta-description-value").setAttribute("content", valueDescription);
        document.getElementById("meta-description-value-og").setAttribute("content", valueDescription);
        document.getElementById("meta-title-value-og").setAttribute("content",title );
        document.getElementById("meta-url-value-og").setAttribute("content", siteUrl);
        document.getElementById("meta-tag-value").setAttribute("content",valueTag);
        document.getElementById("meta-author-value").setAttribute("content",valueAuthor);
    </script>

<?= $this->endSection('content') ?>