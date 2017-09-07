<div class="coop">
    <h4>ИГРЫ</h4>
    <ul class="list-group">
       <?php foreach($this->arr_games as $key => $val):?>
        <?php
            $oh = $this->createUrl('site/games', array('abbr'=>$key));
        ?>
        <li class="list-group-item">
            <a href="<?php echo $oh; ?>"><?php echo $val['name']; ?></a>
        </li>
       <?php endforeach; ?> 
    </ul>    
</div>

<div class="cop">
    <?php echo $this->randomBanner(); ?>
</div>