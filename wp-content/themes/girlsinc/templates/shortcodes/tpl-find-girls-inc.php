<form id="about-find-form" action="<?= home_url('/find-girls-inc') ?>" method="get">
    <input id="zip" name="zip" type="text" placeholder="Enter Zip/Postal Code"/>
    <div class="selectdiv">
        <label>
            <?php
            //Loads registered terms from Address taxonomy
            wp_dropdown_categories([
                'taxonomy' => 'address',
                'hierarchical' => true,
                'depth' => 2,
                'name' => 'state',
                'show_option_none' => 'State',
                'option_none_value' => '',
                'value_field' => 'name',
                'orderby' => 'name'
            ]);
            ?>
        </label>
    </div>
    <input type="submit" value="Find"/>
</form>