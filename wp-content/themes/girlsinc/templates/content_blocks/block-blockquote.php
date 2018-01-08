<?php
$row = get_row(true);
$parts = explode(',', $row['speaker'], 2);
?>
<div class="content-block content-block-blockquote row"
     style="background-image: <?= $row['background_image'] ? "url({$row['background_image']})" : 'none' ?>">
    <div class="col-lg-7 col-md-12 blockquote-inner" style="color: <?= $row['color'] ?>">
        <blockquote><?= $row['quote'] ?></blockquote>
        <p class="speaker">
            <strong><?= $parts[0] ?></strong><?= isset($parts[1]) ? ",$parts[1]" : '' ?>
        </p>
    </div>
</div>
