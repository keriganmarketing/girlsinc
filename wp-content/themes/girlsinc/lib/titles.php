<?php

namespace Roots\Sage\Titles;

/**
 * Add UI Highlights to the title
 */
function marcusa_title_highlight($title, $id)
{
    if ($highlight = get_field('title_highlight', $id)) {
        $title = marcusa_wrap_title_segment($title, $highlight, $id);
    }
    return $title;
}

function marcusa_wrap_title_segment($title, $highlight, $id){
    $pattern = sprintf('/(%s)/i', preg_quote(strip_tags($highlight)));
    $highlightClass = apply_filters('marcusa_title_highlight_class', 'girlsinc-title-ui', $title, $id);
    $el = apply_filters('marcusa_title_highlight_el', 'span', $title, $id);

    $filter = sprintf('<%s class="%s">$1</%1$s>', $el, $highlightClass);
    $replacement = apply_filters('marcusa_title_highlight_replacement', $filter, $title, $id);
    return preg_replace($pattern, $replacement, $title);
};

function marcusa_enable_content_filters()
{
    add_filter('the_title', __NAMESPACE__ . '\\marcusa_title_highlight', 10, 2);
}

function marcusa_disable_content_filters()
{
    remove_filter('the_title', __NAMESPACE__ . '\\marcusa_title_highlight');
}

//Enable title highlights before main content
add_action('get_content', __NAMESPACE__ . '\\marcusa_enable_content_filters');
//Disable title highlights before footer
add_action('get_footer', __NAMESPACE__ . '\\marcusa_disable_content_filters');