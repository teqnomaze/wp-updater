<?php
/**
 * The WordPress theme updater class.
 *
 * @package WpUpdater
 */

namespace Teqnomaze\WpUpdater;

/**
 * The theme updater class.
 */
class Theme_Updater extends Updater {

	/**
	 * The constructor.
	 *
	 * @param Product $product the product object.
	 */
	public function __construct( Product $product ) {
		parent::__construct( $product );
	}
}
