<?php
/**
 * The WordPress plugin updater class.
 *
 * @package WpUpdater
 */

namespace Teqnomaze\WpUpdater;

/**
 * The plugin updater class.
 */
class Plugin_Updater extends Updater {

	/**
	 * The constructor.
	 *
	 * @param Product $product the product object.
	 */
	public function __construct( Product $product ) {
		parent::__construct( $product );
	}

	/**
	 * Load all the WordPress hooks for the class.
	 *
	 * @return void
	 */
	public function load(): void {
		add_filter( 'plugins_api', array( $this, 'get_plugin_popup_info' ), 10, 3 );
		add_filter( 'site_transient_update_plugins', array( $this, 'push_plugin_update_info' ), 10 );
	}

	/**
	 * Load plugin information.
	 *
	 * @param mixed  $result At this point empty.
	 * @param string $action The type of information being requested.
	 * @param object $args Plugin API arguments.
	 * @return mixed
	 */
	public function get_plugin_popup_info( $result, string $action, object $args ) {

		if ( false !== $result || 'plugin_information' !== $action || $this->product->get_slug() !== $args->slug ) {
			return false;
		}

		return $this->get_plugin_data();
	}

	/**
	 * Push plugin update information.
	 *
	 * @param mixed $transient The transient data for all plugins.
	 * @return mixed
	 */
	public function push_plugin_update_info( $transient ) {

		if ( ! isset( $transient->checked ) || empty( $transient->checked ) ) {
			return $transient;
		}

		$data = $this->get_plugin_data();

		if ( true === $data->update_found ) {
			if ( isset( $transient->response ) && is_array( $transient->response ) ) {
				$transient->response[ $this->product->get_basename() ] = $data;
			}
		} else {
			$transient->checked[ $this->product->get_basename() ] = $this->product->get_version();

			if ( isset( $transient->no_update ) && is_array( $transient->no_update ) ) {
				$transient->no_update[ $this->product->get_basename() ] = $data;
			}
		}

		return $transient;
	}

	/**
	 * Get plugin information.
	 *
	 * @return \stdClass
	 */
	private function get_plugin_data(): \stdClass {

		$plugin               = new \stdClass();
		$plugin->slug         = $this->product->get_slug();
		$plugin->version      = $this->product->get_version();
		$plugin->update_found = false;

		$version_found    = false;
		$version_supports = false;

		$data = $this->get_transient_data();

		if ( ! empty( $data ) ) {

			$response = json_decode( $data, true );

			if ( isset( $response['version'] ) ) {
				$version_found       = version_compare( $response['version'], $plugin->version, '>' );
				$plugin->version     = $response['version'];
				$plugin->new_version = $response['version'];
			}

			if ( isset( $response['tested'] ) ) {
				$plugin->tested = $response['tested'];
			}

			if ( isset( $response['requires'] ) ) {
				$version_supports = version_compare( $response['requires'], get_bloginfo( 'version' ), '<' );
				$plugin->requires = $response['requires'];
			}

			if ( isset( $response['requires_php'] ) ) {
				$plugin->requires_php = $response['requires_php'];
			}

			if ( isset( $response['last_updated'] ) ) {
				$plugin->last_updated = $response['last_updated'];
			}

			if ( isset( $response['package'] ) ) {
				$plugin->download_link = $response['package'];
				$plugin->trunk         = $response['package'];
				$plugin->package       = $response['package'];
			}

			if ( isset( $response['sections'] ) && is_array( $response['sections'] ) ) {
				$sections = array();
				foreach ( $response['sections'] as $key => $value ) {
					$sections[ $key ] = $value;
				}
				$plugin->sections = $sections;
			}

			if ( isset( $response['banners'] ) && is_array( $response['banners'] ) ) {
				$banners = array();
				foreach ( $response['banners'] as $key => $value ) {
					$banners[ $key ] = $value;
				}
				$plugin->banners = $banners;
			}

			if ( true === $version_found && true === $version_supports ) {
				$plugin->update_found = true;
			}
		}

		return $plugin;
	}
}
