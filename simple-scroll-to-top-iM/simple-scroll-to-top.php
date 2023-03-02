<?php
/*
 * Plugin Name: Simple Scroll To Top iM
 * Plugin URI: developerimdadul.me
 * Text Domain: ssttim
 * Description: Simple Scroll to top plugin
 * Version: 1.0.0
 * Author: Imdadul Haque
 * Author URI: developerimdadul.me
 * Requires at least: 6.1
 * Requires PHP: 7.2
*/



function ssttim_admin_theme_page()
{
    add_menu_page('Scroll to top Option for Admin ', 'Scroll to top', 'manage_options', 'ssttim-plugin-option', 'ssttim_create_page', 'dashicons-arrow-up-alt', 101);
}
add_action('admin_menu', 'ssttim_admin_theme_page');

function ssttim_create_page()
{
?>
    <div class="ssttim_main_area">
        <div class="ssttim_body_area">
            <h1 class="ssttim_title"><?php echo esc_attr('🎨 Simple to Scroll Customizer'); ?></h1>
            <form action="options.php" method="post">
                <?php wp_nonce_field('update-options') ?>
                <!-- Primary Color  -->
                <label for="ssttim_primary_color" name="ssttim_primary_color"><?php echo esc_attr('Primary Color') ?></label>
                <input type="color" name="ssttim_primary_color" id="ssttim_primary_color" value="<?php echo get_option('ssttim_primary_color'); ?>">

                <!-- Menu Position  -->
                <label for="ssttim_image_position" name="ssttim_image_position"><?php echo esc_attr('Button Position') ?></label>
                <select name="ssttim_image_position" id="ssttim_image_position">
                    <option value="true" <?php if (get_option('ssttim_image_position') == 'true') {
                                                echo 'selected = "selected"';
                                            }; ?>>Left</option>
                    <option value="false" <?php if (get_option('ssttim_image_position') == 'false') {
                                                echo 'selected = "selected"';
                                            }; ?>>Right</option>
                </select>


                <!-- Round Corner  -->
                <label for="ssttim_round_corner"><?php echo esc_attr('Do you need round corner?')?></label>
                <label class="ssttim_radio">
                    <input id="ssttim_round_corner" type="radio" name="ssttim_round_corner" value="no" <?php if(get_option('ssttim_round_corner') == 'no') {echo 'checked = "checked"';}; ?>><span>No</span>
                </label>
                <label class="ssttim_radio">
                    <input type="radio" name="ssttim_round_corner" value="yes" <?php if(get_option('ssttim_round_corner') == 'yes') {echo 'checked = "checked"';}; ?>> <span>Yes</span>
                </label>












                <!-- Submit Button  -->
                <input type="submit" name="submit" value="<?php _e('Save Changes', 'ssttim'); ?>">

                <input type="hidden" value="update" name="action">
                <input type="hidden" name="page_options" value="ssttim_primary_color, ssttim_image_position, ssttim_round_corner">
            </form>
        </div>
        <div class="ssttim_author_area"></div>
    </div>

<?php
}


// Including CSS
add_action('wp_enqueue_scripts', 'ssttim_enqueue_style');
function ssttim_enqueue_style()
{
    wp_enqueue_style('ssttim_style', plugins_url('css/ssttim_style.css', __FILE__));
}
// Including JS
add_action('wp_enqueue_scripts', 'ssttim_enqueue_scripts');
function ssttim_enqueue_scripts()
{
    wp_enqueue_script('jquery');
    wp_enqueue_script('ssttim_plugin_script', plugins_url('js/ssttim_scrollUp.js', __FILE__), array(), '1.0.0', 'true');
}

add_action('admin_enqueue_scripts', 'ssttim_admin_style');
function ssttim_admin_style()
{
    wp_enqueue_style('ssttim_admin_style', plugins_url('css/ssttim_admin_style.css', __FILE__), false, "1.0.0");
}
// jQuery Plugin Setting Activation
add_action('wp_footer', 'ssttim_scroll_script');
function ssttim_scroll_script()
{
?>
    <script>
        jQuery(document).ready(function() {
            jQuery.scrollUp();
        });
    </script>
<?php
}
// --------------------------------------------------------

function ssttim_theme_color_cus()
{
?>
    <style>
        #scrollUp {
            /* background-image: url('../img/top.png'); */
            background-color: <?php echo get_option('ssttim_primary_color'); ?> !important;
            <?php if (get_option('ssttim_image_position') == 'true') {
                echo 'left: 20px; bottom: 20px;';
            }; ?>
            <?php if (get_option('ssttim_image_position') == 'false') {
                echo 'right: 20px; bottom: 20px;';
            }; ?>
            <?php if(get_option('ssttim_round_corner') == 'no'){
                echo 'border-radius: 3px';
            };?>
            <?php if(get_option('ssttim_round_corner') == 'yes'){
                echo 'border-radius: 25px !important';
            }; ?>
        }
    </style>

<?php
}
add_action('wp_head', 'ssttim_theme_color_cus');





















?>