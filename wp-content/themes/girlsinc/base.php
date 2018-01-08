<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?> style="margin-top: 0 !important;">
<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

<?php
do_action('get_header');
get_template_part('templates/header');
?>

<div class="wrap container-fluid" role="document">
    <div class="content">
        <main class="main">
            <?php
            do_action('get_content');
            include Wrapper\template_path();
            ?>
        </main><!-- /.main -->
    </div><!-- /.content -->
</div><!-- /.wrap -->

<?php
do_action('get_footer');
get_template_part('templates/footer');
wp_footer();
?>

</body>
</html>
