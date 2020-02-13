<?php if(isset($link)): ?>
<div class="row">
    <div class="col-12">
        <p class="lead">
            Click here to <a target="_BLANK" href="<?= $link ?>">Authorize Quickbooks</a> to continue.
        </p>
    </div>
</div>
<?php else: ?>
    <?php print_r($token) ?>
<?php endif; ?>

