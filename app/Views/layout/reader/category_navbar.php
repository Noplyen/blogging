<?php if(!empty($category)):?>
    <?php for($i=0; $i<count($category); $i++) : ?>

        <li role="menuitem">
            <a class="dropdown-link"
               href="<?= base_url('category/'.$category[$i]['name'])?>"
            ><?= $category[$i]['name']?></a>
        </li>


    <?php endfor;?>
<?php endif;?>