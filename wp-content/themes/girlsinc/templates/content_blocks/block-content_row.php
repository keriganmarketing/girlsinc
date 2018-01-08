<?php
$row = get_row(true);
$format = $row['background_image'] ? '%s url(%s)' : '%s';
$background = sprintf($format, $row['background_color'], $row['background_image']);

if(count($row['content_column'])){
    ?>
    <div class="content-block <?php if ($row['background_image']) { ?>row-background<?php } ?> content-block-content_row row <?php if($row['content_custom-class']) {?><?= implode(' ', $row['content_custom-class']) ?><?php } ?>" style="background: <?= $background ?>">

        <?php if($row['heading']) : ?>
            <div class="col-12">
                <h3><?= $row['heading'] ?></h3>
            </div>
        <?php endif; ?>



        <?php foreach($row['content_column'] as $column) : ?>

            <div class="column-content_row col <?php if($column['text-vertical'] == 1) {?>my-auto<?php } ?>" style="background-color: <?= $column['col-bg-color'] ?: 'inherit' ?>">
                <div class="content_row-inner <?php if($column['column_custom-class']) {?><?= implode(' ', $column['column_custom-class']) ?><?php } ?>" style="color: <?= $column['color'] ?: 'inherit' ?>">
                    <?php if(isset($column['content_link']) && $column['content_link']) : ?>
                        <a href="<?= $column['content_link']; ?>">
                    <?php endif; ?>

                    <?= $column['body'] ?>

                    <?php if(isset($column['content_link']) && $column['content_link']) : ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
}