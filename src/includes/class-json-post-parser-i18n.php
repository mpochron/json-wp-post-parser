<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://infinum.co/careers
 * @since      1.0.0
 *
 * @package    Json_Post_Parser
 * @subpackage Json_Post_Parser/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Json_Post_Parser
 * @subpackage Json_Post_Parser/includes
 * @author     Infinum <info@infinum.co>
 */
class Json_Post_Parser_i18n {

  /**
   * Load the plugin text domain for translation.
   *
   * @since    1.0.0
   */
  public function load_plugin_textdomain() {
    load_plugin_textdomain(
      'json-post-parser',
      false,
      dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
    );
  }
}
