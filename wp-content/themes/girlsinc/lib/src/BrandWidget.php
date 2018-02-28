<?php

namespace GirlsInc\MarcUSA;

use Roots\Sage\Assets;

class BrandWidget extends \WP_Widget
{
    public function __construct()
    {
        parent::__construct('marcusa_girls_inc_brand', 'Girls Inc Brand');
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        ?>
        <div class="girls-inc-branding hidden-md-down">
            <a class="brand" href="<?= esc_url(home_url('/')); ?>">
                <img src="<?= Assets\asset_path('images/logo-inverse.png') ?>">
            </a>
            <p class="tagline"><?php bloginfo('description'); ?></p>
        </div>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        printf('<p><em>This can be changed under your <a href="%s">Tagline Settings</a></em></p>', admin_url('options-general.php'));
    }
}