<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<h2>Экспресс видеокурс "Как стать web-программистом за 2 недели"</h2>    

<?php foreach($this->items as $item): ?>
    <p>
        <?php if(!empty($item->user_id)): ?>
            <a href=""><?php echo $item->title ?></a>
        <?php else: ?>
            <?php echo $item->title ?>
        <?php endif ?>
    </p>
<?php endforeach ?>
 
    