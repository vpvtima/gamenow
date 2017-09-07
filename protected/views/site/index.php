<div class="row">
    <?php foreach($this->arr_games as $key => $val):?>
        <?php
            $oh = $this->createUrl('site/games', array('abbr'=>$key));
        ?>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="<?php echo $oh;?>"><?php echo $val['name']; ?></a>
                </div>
                <div class="panel-body">
                    <a href="<?php echo $val['img-mid']; ?>">
                        <img class="img-thumbnail" src="<?php echo $val['img-sm']; ?>" alt="<?php echo $val['name']; ?>">
                    </a>
                </div>
            </div>        
        </div>
    <?php endforeach; ?>   
</div>