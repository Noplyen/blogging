<?php if(!empty($category)):?>
    <?php for($i=0; $i<count($category); $i++) : ?>

        <li>
            <a href="<?= base_url().'category/'.$category[$i]['name']?>"
               class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2"
            ><?= $category[$i]['name']?></a>
        </li>


    <?php endfor;?>
<?php endif;?>