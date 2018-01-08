<?php $row = get_row(true); ?>

<div class="content-block <?php if($row['custom_class']) {?><?= implode(' ', $row['custom_class']) ?><?php } ?> <?= $row['gallery_type']; ?> content-block-gallery row">
    <?php if($row['gallery_intro']) : ?>
    <div class="gallery-item gallery-item-intro">
        <?= $row['gallery_intro'] ?>
    </div>
    <?php endif; ?>
    <?php foreach( $row['gallery'] as $i=>$image ): ?>

        <?php $imageID = $image['ID']; $imageLink = get_field('image_link', $imageID); ?>
    <div class="gallery-item gallery-item-image">
        <?php if($imageLink) { ?><a href="<?php echo $imageLink; ?>"><?php } ?>
        <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
        <?php if($imageLink) { ?></a><?php } ?>

        <?php if($row['gallery_type'] == 'image-description') { ?>
            <div class="gallery-body-wrapper">
                <h1 class="gallery-item-image-count"><?= $i+1 ?></h1>

                <p class="gallery-body-copy"><?php echo $image['description']; ?></p>
            </div>
        <?php } ?>

        <?php if($row['gallery_type'] == 'full-image') { ?>
            <p class="gallery-headline-copy"><?php echo $image['caption']; ?></p>
        <?php } ?>
    </div>
    <?php endforeach; ?>
</div>
