<?= $this->extend('layout/admin/dashboard') ?>


<?= $this->section('content') ?>

<div>

<?php if (!empty($image_list)) : ?>
    <?php foreach ($image_list as $index => $images) : ?>

    <table class="table-fixed w-full">
        <thead>
        <tr>
            <th>no</th>
            <th>gambar</th>
            <th>url</th>
            <th>delete</th>
        </tr>
        </thead>
        <tbody>
        <tr class="text-center">
            <td>
                <?= $index+1?>
            </td>
            <td>
                <img src="<?= $images['url']?>" style="width: 100px" alt="gambar">
            </td>
            <td>
                <input type="hidden" id="copyValue" value="<?= $images['url']; ?>">
                <button onclick="copied()"
                        id="copyButton"
                        class="btn btn-success btn-sm d-flex align-items-center"
                ><span class="material-symbols-outlined">content_copy</span>
                </button>
            </td>
            <td>
                <form action="<?= base_url().'admin/images/delete'?>"
                      method="post">
                    <input type="hidden" name="id" value="<?= $images['id']; ?>">
                    <button type="submit"
                            class="btn btn-danger btn-sm d-flex align-items-center"
                    ><span class="material-symbols-outlined">delete</span>
                    </button>
                </form>
            </td>
        </tr>
        </tbody>
    </table>

    <?php endforeach;?>
<?php endif;?>
    
</div>

    <script>
        // copied button
        function copied(){
            // Get the text field
            var copyText = document.getElementById("copyValue");
            var copyValue = copyText.value;

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyValue);

            // Alert the copied text
            alert("Copied");
        }
    </script>

<?= $this->endSection('content') ?>