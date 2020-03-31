<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<!--<div class="message success"><?= $message ?></div>-->

<div class="alert alert-success alert-dismissible fade show" role="alert" data-dismiss="alert" aria-label="Close">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <?= $message ?>
</div>

