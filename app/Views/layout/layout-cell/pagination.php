<nav aria-label="Page navigation example" class="mt-4">
    <ul class="inline-flex -space-x-px text-sm">
        <?php if ($pager->hasPrevious()) : ?>
            <li>
                <a href="<?= $pager->getFirst() ?>"
                   aria-label="<?= lang('Pager.first') ?>"
                   class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                ><?= lang('Pager.first') ?></a>
            </li>
            <li>
                <a href="<?= $pager->getPrevious() ?>"
                   aria-label="<?= lang('Pager.previous') ?>"
                   class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                ><?= lang('Pager.previous') ?></a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link): ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a href="<?= $link['uri'] ?>"
                   class="flex items-center justify-center px-3 h-8 leading-tight <?= $link['active'] ? 'text-white bg-blue-500 border-blue-500' : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white' ?>"
                >
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <li class="page-item">
                <a href="<?= $pager->getNext() ?>"
                   aria-label="<?= lang('Pager.next') ?>"
                   class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                >
                    <?= lang('Pager.next') ?>
                </a>
            </li>
            <li class="page-item">
                <a href="<?= $pager->getLast() ?>"
                   aria-label="<?= lang('Pager.last') ?>"
                   class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-s-0 border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                >
                    <?= lang('Pager.last') ?>
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>
