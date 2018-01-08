<?php
use GirlsInc\MarcUSA\GoogleMaps;

$map = new GoogleMaps;
$location = get_option('girls_location');
?>

<div class="row no-column-gutters flex-md-row-reverse" id="girls-inc-map-wrapper">
    <div class="col-12 col-lg-6 col-xl-8">
        <div id="girlsinc-map">
            <?php do_action('marcusa_init_google_maps', $map); ?>
        </div>
        <?php get_template_part('templates/map/tpl-girlsinc-map', 'ui'); ?>
    </div>
    <div class="col-12 col-lg-6 col-xl-4 container-dark" id="map-search-wrapper">

        <form id="search-map">
            <input type="hidden" name="init-zip" value="<?= $location? $location : ''; ?>">
            <div class="col-12 form-group">
                <label for="search-zip" class="h5">Find a Girls Inc.</label>
                <div class="search-controls">
                    <input type="text" class="form-control" name="search-zip" id="search-zip" placeholder="Enter Zip/Postal Code">
                    <div id="control-btns">
                        <button id="form-clear" class="control-btn" type="reset">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                        <button id="form-submit" class="control-btn" type="submit">
                            <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <div class="col-12">
            <h5 class="no-uppercase results-label hidden-xs-up">Locations</h5>
        </div>
        <div class="col-12" id="search-results">
            <?php do_action('marcusa_do_zip_results', $map); ?>
        </div>
    </div>
</div>