<?php

add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker' );
function mw_enqueue_color_picker( $hook_suffix ) {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle', plugins_url('fau-colorpicker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}

// Customize Fancy Admin UI Colors
$fau_color_settings = new fau_color_settings();
class fau_color_settings {
    function __construct( ) {
        add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
    }
    function register_fields() {
        register_setting( 'general', 'fau_primary_color', 'esc_attr' );
        add_settings_field('fau_primary_color', '<label for="fau_primary_color">'.__('Admin UI Primary Color:' , 'fau_primary_color' ).'</label>' , array(&$this, 'fields_html') , 'general' );
    }
    function fields_html() {
        $value = get_option( 'fau_primary_color', '' );
        echo '<input type="text" id="fau_primary_color" name="fau_primary_color" value="' . $value . '" data-default-color="#00a0d2" />';
        echo "
          <script>
            jQuery(document).ready(function($){
              $('#fau_primary_color').wpColorPicker();
            });
          </script>
          ";
    }
}

$fau_secondary_color_settings = new fau_secondary_color_settings();
class fau_secondary_color_settings {
    function __construct( ) {
        add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
    }
    function register_fields() {
        register_setting( 'general', 'fau_secondary_color', 'esc_attr' );
        add_settings_field('fau_secondary_color', '<label for="fau_secondary_color">'.__('Admin UI Secondary Color:' , 'fau_secondary_color' ).'</label>' , array(&$this, 'fields_html') , 'general' );
    }
    function fields_html() {
        $value = get_option( 'fau_secondary_color', '' );
        echo '<input type="text" id="fau_secondary_color" name="fau_secondary_color" value="' . $value . '" data-default-color="#2581bf" />';
        echo "
          <script>
            jQuery(document).ready(function($){
              $('#fau_secondary_color').wpColorPicker();
            });
          </script>
          ";
    }
}