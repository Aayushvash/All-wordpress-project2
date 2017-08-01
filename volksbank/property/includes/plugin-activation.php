<?php
/**
* @package TGM-Plugin-Activation
* @subpackage Example
* @version 2.4.0
* @author Thomas Griffin <thomasgriffinmedia.com>
* @author Gary Jones <gamajo.com>
* @copyright Copyright (c) 2014, Thomas Griffin
* @license http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
* @link https://github.com/thomasgriffin/TGM-Plugin-Activation
*/

/**
* Include the TGM_Plugin_Activation class.
*/
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

function my_theme_register_required_plugins() {


$plugins = array(

        array(
            'name' => 'Query Multiple Taxonomies', // The plugin name.
            'slug' => 'query-multiple-taxonomies', // The plugin slug (typically the folder name).
            'source' => get_stylesheet_directory() . '/lib/plugins/query-multiple-taxonomies.zip', // The plugin source.
            'required' => true, // If false, the plugin is only 'recommended' instead of required.
            'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => '', // If set, overrides default API URL and points to an external URL.
           ),
		
		 array(
            'name' => 'Easy Google Fonts', // The plugin name.
            'slug' => 'easy-google-fonts', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
            ),

        array(
            'name' => 'Contactform7',
            'slug' => 'contact-form-7',
            'required' => false,
        ),
		array(
            'name' => 'Post Type Switcher',
            'slug' => 'post-type-switcher',
            'required' => false,
        ),

    );


    $config = array(
        'id' => 'tgmpa', 
        'default_path' => '', 
        'menu' => 'tgmpa-install-plugins', 
        'has_notices' => true, 
        'dismissable' => true, 
        'dismiss_msg' => '', 
        'is_automatic' => false, 
        'message' => '', 
        'strings' => array(
'page_title' => __( 'Install Required Plugins', 'bobox' ),
'menu_title' => __( 'Install Plugins', 'bobox' ),
'installing' => __( 'Installing Plugin: %s', 'bobox' ), // %s = plugin name.
'oops' => __( 'Something went wrong.', 'bobox' ),
'notice_can_install_required' => __( 'This theme requires the following plugins: %1$s.', 'bobox' ),
'notice_can_install_recommended' => __( 'This theme recommends the following plugins: %1$s.', 'bobox' ),
'notice_cannot_install' => __( 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'bobox' ),
'notice_can_activate_required' => __( 'The following required plugins are currently inactive: %1$s.', 'bobox' ),
'notice_can_activate_recommended'=> __( 'The following recommended plugins are currently inactive: %1$s.', 'bobox' ),
'notice_cannot_activate' => __('Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'bobox' ),
'notice_ask_to_update' => __( 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'bobox' ),
'notice_cannot_update' => __( 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'bobox' ),
'activate_link' => __( 'Begin activating plugins', 'bobox' ),
'install_link' => __( 'Begin installing plugins', 'bobox' ),
'return' => __( 'Return to Required Plugins Installer', 'bobox' ),
'dashboard' => __( 'Return to the dashboard', 'bobox' ),
'plugin_activated' => __( 'Plugin activated successfully.', 'bobox' ),
'activated_successfully' => __( 'The following plugin was activated successfully:', 'bobox' ),
'complete' => __( 'All plugins installed and activated successfully. %s', 'bobox' ), // %s = dashboard link.
'dismiss' => __( 'Dismiss this notice', 'bobox' ),
'nag_type' => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}