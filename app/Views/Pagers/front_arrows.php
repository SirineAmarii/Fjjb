<div class="pagination-arrows">
    <?php if ($pager->hasPreviousPage()) : ?>
        <a href="<?= $pager->getPreviousPage() ?>" class="arrow">&larr;</a>
    <?php endif ?>

    <?php if ($pager->hasNextPage()) : ?>
        <a href="<?= $pager->getNextPage() ?>" class="arrow">&rarr;</a>
    <?php endif ?>
</div>
