<?php foreach ($locations as $location) : ?>
    <div class="location row" data-attr-ID="<?= $location['ID']; ?>">
        <div class="col-12">
            <div class="primary-info" data-toggle="collapse" data-target="#additional-info-<?= $location['ID']; ?>">
                <h6 class="location-name"><?= $location['name']; ?></h6>
                <p class="location-address"><?= nl2br($location['address']['human']); ?></p>
            </div>
            <div class="collapse additional-info" id="additional-info-<?= $location['ID']; ?>">
                <?php /*if ($location['mailing_address']) : ?>
                    <p class="location-mailing-address"><?= $location['mailing_address']; ?></p>
                <?php endif;*/ ?>
                <?php if ($location['director']) : ?>
                    <p class="location-director">Executive Director: <?= $location['director']; ?></p>
                <?php endif; ?>
                <?php if ($location['phone']) : ?>
                    <p class="location-phone"><i class="fa fa-phone"></i><?= $location['phone']; ?></p>
                <?php endif; ?>
                <?php if ($location['fax']) : ?>
                    <p class="location-fax"><i class="fa fa-fax"></i><?= $location['fax']; ?></p>
                <?php endif; ?>
                <?php if ($location['email']) : ?>
                    <a class="btn btn-secondary location-email" href="mailto:<?= $location['email'] ?>">Email</a>
                <?php endif; ?>
                <?php if ($location['website']) : ?>
                    <a class="btn btn-secondary location-website" href="<?= $location['website'] ?>" target="_blank">Website</a>
                <?php endif; ?>
            </div>
            <hr>
        </div>
    </div>
<?php endforeach;