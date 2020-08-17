<?php
/**
 * The WordPress plugin and theme updater main class.
 *
 * @package WpUpdater
 */

namespace Teqnomaze\WpUpdater;

/**
 * The updater main class.
 */
class Updater {

	/**
	 * The product object.
	 *
	 * @var Product|null $product
	 */
	protected $product = null;

	/**
	 * Prevent the instance using new().
	 *
	 * @param Product $product the product object.
	 */
	protected function __construct( Product $product ) {
		$this->product = $product;
	}

	/**
	 * Get plugin transient information.
	 *
	 * @return string|null
	 */
	protected function get_transient_data(): ?string {

		$transient = get_transient( $this->product->get_slug() );

		if ( false === $transient ) {
			$transient = $this->get_remote_data();
			if ( ! is_null( $transient ) ) {
				set_transient( $this->product->get_slug(), $transient, 120 );
			}
		}

		return $transient;
	}

	/**
	 * Get the product information from remote server.
	 *
	 * @return string|null
	 */
	private function get_remote_data(): ?string {

		$remote_url = $this->product->get_remote_url();

		if ( ! is_null( $this->product->get_access_token() ) ) {
			$remote_url = add_query_arg( array( 'access_token' => $this->product->get_access_token() ), $remote_url );
		}

		$response = wp_remote_get(
			$remote_url,
			array(
				'sslverify' => $this->product->get_sslverify(),
				'headers'   => array(
					'Accept' => 'application/json',
				),
			)
		);

		if ( ! is_wp_error( $response ) ) {
			$response_code = wp_remote_retrieve_response_code( $response );
			$response_body = wp_remote_retrieve_body( $response );

			if ( 200 === $response_code && ! empty( $response_body ) ) {
				return $response_body;
			}
		}

		return null;
	}

	/**
	 * Prevent the instance from being cloned.
	 */
	private function __clone() {}

	/**
	 * Prevent from being unserialized.
	 */
	private function __wakeup() {}
}
