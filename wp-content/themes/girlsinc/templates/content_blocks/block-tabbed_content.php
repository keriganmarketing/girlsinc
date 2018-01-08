<?php $row = get_row(true); ?>
<div class="content-block content-block-tabbed_content row">
    <div class="col-12">
        <ul class="tabbed-content-head row nav-tabs" role="tablist">
            <?php /*<li class="nav-item col hidden-md-up mobile-prev-tab">
                <a class="tab-link" href="#">
                    <i class="fa fa-chevron-left"></i>
                </a>
            </li>*/ ?>
            <?php foreach($row['tab'] as $i=>$tab) : ?>
            <li class="nav-item col user-tab">
                <a class="<?= $i ? '' : 'active ' ?>tab-link" href="#tab-<?= sanitize_title($tab['title']) ?>" role="tab" data-toggle="tab">
                    <?= $tab['title'] ?>
                </a>
            </li>
            <?php endforeach; ?>
            <?php /*<li class="nav-item col hidden-md-up mobile-next-tab">
                <a class="tab-link" href="#">
                    <i class="fa fa-chevron-right"></i>
                </a>
            </li>*/ ?>
        </ul>
    </div>
    <div class="col-12">
        <div class="tabbed-content-body tab-content">
            <?php foreach($row['tab'] as $i=>$tab) : ?>
                <div role="tabpanel" class="tab-pane fade row<?= $i ? '' : ' show active' ?>" id="tab-<?= sanitize_title($tab['title']) ?>">
                    <div class="col-12">
                        <?= $tab['tab_body'] ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

