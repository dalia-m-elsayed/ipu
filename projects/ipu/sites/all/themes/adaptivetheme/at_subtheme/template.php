<?php

/**
 * @file
 * Process theme data.
 *
 * Use this file to run your theme specific implimentations of theme functions,
 * such preprocess, process, alters, and theme function overrides.
 *
 * Preprocess and process functions are used to modify or create variables for
 * templates and theme functions. They are a common theming tool in Drupal, often
 * used as an alternative to directly editing or adding code to templates. Its
 * worth spending some time to learn more about these functions - they are a
 * powerful way to easily modify the output of any template variable.
 *
 * Preprocess and Process Functions SEE: http://drupal.org/node/254940#variables-processor
 * 1. Rename each function and instance of "adaptivetheme_subtheme" to match
 *    your subthemes name, e.g. if your theme name is "footheme" then the function
 *    name will be "footheme_preprocess_hook". Tip - you can search/replace
 *    on "adaptivetheme_subtheme".
 * 2. Uncomment the required function to use.
 */


/**
 * Preprocess variables for the html template.
 */
/* -- Delete this line to enable.
function adaptivetheme_subtheme_preprocess_html(&$vars) {
  global $theme_key;

  // Two examples of adding custom classes to the body.

  // Add a body class for the active theme name.
  // $vars['classes_array'][] = drupal_html_class($theme_key);

  // Browser/platform sniff - adds body classes such as ipad, webkit, chrome etc.
  // $vars['classes_array'][] = css_browser_selector();

}
// */


/**
 * Process variables for the html template.
 */
/* -- Delete this line if you want to use this function
function adaptivetheme_subtheme_process_html(&$vars) {
}
// */


/**
 * Override or insert variables for the page templates.
 */
/* -- Delete this line if you want to use these functions
function adaptivetheme_subtheme_preprocess_page(&$vars) {
}
function adaptivetheme_subtheme_process_page(&$vars) {
}
// */


/**
 * Override or insert variables into the node templates.
 */
/* -- Delete this line if you want to use these functions
function adaptivetheme_subtheme_preprocess_node(&$vars) {
}
function adaptivetheme_subtheme_process_node(&$vars) {
}
// */


/**
 * Override or insert variables into the comment templates.
 */
/* -- Delete this line if you want to use these functions
function adaptivetheme_subtheme_preprocess_comment(&$vars) {
}
function adaptivetheme_subtheme_process_comment(&$vars) {
}
// */


/**
 * Override or insert variables into the block templates.
 */
/* -- Delete this line if you want to use these functions
function adaptivetheme_subtheme_preprocess_block(&$vars) {
}
function adaptivetheme_subtheme_process_block(&$vars) {
}
// */
function adaptivetheme_subtheme_menu_link__menu_block__1(array $vars) {

    global $theme_key;
    $theme_name = $theme_key;

    $element = $vars['element'];
    $sub_menu = '';

    /*
     * Dalia's code to display image with menu link in menu block
     */
    if(isset($element['#localized_options']['content']['image'])){
        $fId = $element['#localized_options']['content']['image'];
        $imageInfo = file_load($fId);
        $imagePath = image_style_url('thumbnail',$imageInfo->uri);
    }


    if ($element['#below']) {
        $sub_menu = drupal_render($element['#below']);
    }

    if (at_get_setting('extra_menu_classes', $theme_name) == 1 && !empty($element['#original_link'])) {
        if (!empty($element['#original_link']['depth'])) {
            $element['#attributes']['class'][] = 'menu-depth-' . $element['#original_link']['depth'];
        }
        if (!empty($element['#original_link']['mlid'])) {
            $element['#attributes']['class'][] = 'menu-item-' . $element['#original_link']['mlid'];
        }
    }

    if (at_get_setting('menu_item_span_elements', $theme_name) == 1 && !empty($element['#title'])) {
        $element['#title'] = '<span>' . $element['#title'] . '</span>';
        $element['#localized_options']['html'] = TRUE;
    }

    if (at_get_setting('unset_menu_titles', $theme_name) == 1 /* && !empty($element['#localized_options']['attributes']['title']) */) {
        unset($element['#localized_options']['attributes']['title']);
    }

    // Possible feature to show menu descriptions in span elements
    //if ($element['#original_link']['menu_name'] == "main-menu" && isset($element['#localized_options']['attributes']['title'])){
    //  $element['#title'] = '<span class="title">' . $element['#title'] . '</span>';
    //  $element['#title'] .= '<span class="description">' . $element['#localized_options']['attributes']['title'] . '</span>';
    //  $element['#localized_options']['html'] = TRUE;
    //}

    $output = l($element['#title'], $element['#href'], $element['#localized_options']);

    if(isset($imagePath)){
        return '<li' . drupal_attributes($element['#attributes']) . '><img src=' .$imagePath . '/>' . $output . $sub_menu . "</li>";
    }else{
        return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>";
    }
}
function adaptivetheme_subtheme__links__system_main_menu_menu($variables) {
    exit;
}