<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pages $page
 */
?>
<style>
    img#image {
        max-width: 100%;
    }
</style>

<!-- Css -->
<?= $this->Html->css('../libs/cropper/css/cropper.css', ['block' => 'cssCropper']) ?>

<!-- Script -->
<?= $this->Html->script('../libs/cropper/js/cropper.js', ['block' => 'scriptCropper']) ?>
<?= $this->Html->script('../libs/cropper/js/jquery-cropper.js', ['block' => 'scriptCropper']) ?>


<div class="row">
	<div class="col-12">
		<div class="card-box table-responsive">
			<h4 class="header-title"><b>Cropper</b></h4>
            <p class="sub-header"><?= __('Crop') . ' ' . __('Image') ?></p>
            <div class="row">
                <div class="col-12 col-md-6">
                    <?= $this->Html->image($path.$image,['id'=>'image']) ?><br><br>
                </div>
            </div>
        </div>
    </div>
</div>
