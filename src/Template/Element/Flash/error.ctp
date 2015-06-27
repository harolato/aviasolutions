<div class="message error"><?= h($message) ?>
<?php if($params['error']):?>
    <ul>
        <?php foreach ($params['error'] as $e): ?>
            <?php foreach( $e as $i ):?>
            <li><?= h(__($i))?></li>
            <?php endforeach;?>
        <?php endforeach;?>
    </ul>
<?php endif;?>
</div>
