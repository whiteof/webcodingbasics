<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>

<div class="container">
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
            <div class="list-group">
                <div class="bar">
                    <div class="side-bar-title">Содержание курса</div>
                    <ul>
                        <?php foreach($this->items as $item): ?>
                            <li>
                                <?php if(!empty($item->user_id)): ?>
                                    <a href=""><?php echo $item->title ?></a>
                                <?php else: ?>
                                    <?php echo $item->title ?>
                                <?php endif ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
            
        <div class="col-xs-12 col-sm-9">
            <p class="pull-left visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
            </p>
            <div class="bar">
                <iframe src="https://player.vimeo.com/video/66967728" width="100%" height="450px" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>