<h1><?php echo $this->pageTitle; ?></h1>

<div class="all">
    <?php foreach($this->arr_games as $key => $val) : ?>

    <div class="panel panel-default">
        <div class="panel-heading head">
            <h3><?php echo $val['name']; ?></h3>
        </div>
        <div class="panel-body">
            <?php $this->renderPartial("files/photos_{$key}"); ?>
        </div>
    </div>

    <?php endforeach; ?>    
</div>