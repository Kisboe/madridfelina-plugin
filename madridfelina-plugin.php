<?php
/**
 * MF-Press
 *
 *
 * @package   MF
 * @author    Kisboe
 * @license   GPL-3.0
 * @link      https://gopangolin.com
 * @copyright 2017 Kisboe (Pty) Ltd
 *
 * @wordpress-plugin
 * Plugin Name:       MF
 * Plugin URI:        https://gopangolin.com
 * Description:       React widgets and shortcodes for MF
 * Version:           1.0.2
 * Author:            Kisboe
 * Author URI:        https://gopangolin.com
 * Text Domain:       mfpress
 * License:           GPL-3.0
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:       /languages
 */


namespace Kisboe\MFR;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'MF_PRESS_VERSION', '1.0.0' );


/**
 * Autoloader
 *
 * @param string $class The fully-qualified class name.
 * @return void
 *
 *  * @since 1.0.0
 */
spl_autoload_register(function ($class) {

    // project-specific namespace prefix
    $prefix = __NAMESPACE__;

    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/includes/';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

/**
 * Initialize Plugin
 *
 * @since 1.0.0
 */
function init() {
	$wpr = Plugin::get_instance();
	$wpr_shortcode = Shortcode::get_instance();
	$wpr_admin = Admin::get_instance();
	$wpr_rest = Endpoint\Example::get_instance();
}
add_action( 'plugins_loaded', 'Kisboe\\MFR\\init' );



/**
 * Register the widget
 *
 * @since 1.0.0
 */
function widget_init() {
	return register_widget( new Widget );
}
add_action( 'widgets_init', 'Kisboe\\MFR\\widget_init' );

/**
 * Register activation and deactivation hooks
 */
register_activation_hook( __FILE__, array( 'Kisboe\\MFR\\Plugin', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Kisboe\\MFR\\Plugin', 'deactivate' ) );

