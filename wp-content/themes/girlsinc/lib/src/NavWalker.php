<?php

namespace GirlsInc\MarcUSA;

class NavWalker extends \Walker_Nav_Menu {
    public function start_lvl(&$output, $depth = 0, $args = [])
    {
        $output .= '<div class="sub-menu-wrap">';
        parent::start_lvl($output, $depth, $args);
    }
    public function end_lvl(&$output, $depth = 0, $args = [])
    {
        parent::end_lvl($output, $depth, $args);
        $output .= '</div>';
    }
}
