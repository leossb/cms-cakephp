<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="header-title"><b>Dashboard</b></h4>
            <h2 class="mb-4"><?= __('Comments to approval') ?></h2>
            <?php foreach ($comments as $comment) { ?>
                <div class="item row border-top border-secondary py-4">
                    <div class="col-12 col-md-8">
                        <strong><?= $comment->user->name ?></strong><br>
                        <?= date_format($comment->created, 'd/m/Y')  ?>
                        <p><?= nl2br($comment->description) ?></p>
                    </div>
                    <div class="col-12 col-md-4">
                        <?= $this->Html->link('Aprovar',['controller'=>'Comments','action'=>'active',$comment->id],['class'=>'btn btn-sm btn-success']) ?>
                        <?= $this->Html->link('Visualizar',['controller'=>'Articles','action'=>'view',$comment->article_id],['class'=>'btn btn-sm btn-primary']) ?>
                        <?= $this->Form->postLink('Deletar',['controller'=>'Comments','action'=>'delete',$comment->id],['confirm' => __('Would you like to delete this comment?'), 'class'=>'btn btn-sm btn-danger']) ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
