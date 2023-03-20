<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Theme Boost Union Child - Library
 *
 * @package    theme_boost_union_child
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// TODO: Check if we need to set our own H5P renderer or if Boost Union's is used.

/**
* Returns the main SCSS content.
* @return string
*/
function theme_boost_union_child_get_main_scss_content():string {
    global $CFG;
    // Reuse the scss of Boost Union to be able to just use Boost Union's settings
    $scss = theme_boost_union_get_main_scss_content(theme_config::load('boost_union'));
    $scss .= file_get_contents($CFG->dirroot . '/theme/boost_union_child/scss/post.scss');
    return $scss;
}

/**
 * // Copy of theme/boost_union/lib.php, function theme_boost_union_before_standard_html_head (Plugin version: v4.1-r4)
 * // Reason: https://github.com/moodle-an-hochschulen/moodle-theme_boost_union/issues/245
 * // Can be removed once PR is in master
 * Callback to add head elements.
 *
 * We use this callback to inject the FontAwesome CSS code and the flavour's CSS code to the page.
 *
 * @return string
 */
function theme_boost_union_child_before_standard_html_head() {
    global $CFG;

    // Initialize HTML (even though we do not add any HTML at this stage of the implementation).
    $html = '';

    // If another theme than Boost Union is active, return directly.
    // This is necessary as the before_standard_html_head() callback is called regardless of the active theme.
// MODIFICATION start (We need to check for our theme)
//    if ($CFG->theme != 'boost_union') {
    if ($CFG->theme != 'boost_union_child') {
// MODIFICATION end (We need to check for our theme)
        return $html;
    }

    // Require local library.
    require_once($CFG->dirroot . '/theme/boost_union/locallib.php');

    // Add the FontAwesome icons to the page.
    theme_boost_union_add_fontawesome_to_page();

    // Add the flavour CSS to the page.
    theme_boost_union_add_flavourcss_to_page();

    // Return an empty string to keep the caller happy.
    return $html;
}

/**
 * Note: This is necessary if we just want to use the configured Boost Union settings
 *  and we don't want to reimplement them.
 *  Although theme_boost_union_get_pre_scss gets called earlier,
 *  $theme there is this theme which doesn't necessarily reimplement Boost Union's settings.
 *
 * Get SCSS to prepend.
 *
 * @return string
 */
function theme_boost_union_feu_base_get_pre_scss():string {
    return theme_boost_union_get_pre_scss(theme_config::load('boost_union'));
}

/**
 * This is necessary as long as MDL-77657 isn't finished.
 * We need to recreate the extra scss from Boost Union and append it after Boost's extra SCSS overwrote everything.
 *
 * Get SCSS to append.
 *
 * @return string
 */
function theme_boost_union_feu_base_get_extra_scss():string {
    return theme_boost_union_get_extra_scss(theme_config::load('boost_union'));
}

