<div id="tag-cloud" class="well well-small">
    <div class="settings"><i class="icon-move"></i></div>

    <ul class="nav nav-list">
        <li class="nav-header"><?php echo $this->title ?></li>
        <?php if (count($tags) == 0) : ?>
            <li><i>no tags found</i></li>
        <?php else : ?>
            <?php foreach ($tags as $tag) : ?>
                <span class="weight-<?php echo $tag['weight'] ?>">
                    <?php echo CHtml::link(CHtml::encode($tag['name']), array('entry/index', 'Entry[tagList]' => $tag['name'])) ?>
                </span>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>

</div>