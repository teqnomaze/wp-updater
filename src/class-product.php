<?php
/**
 * The class for storing product information.
 *
 * @package    WpUpdater
 */

namespace Teqnomaze\WpUpdater;

/**
 * The product info class.
 */
class Product {

	/**
	 * The product basename.
	 *
	 * @var string|null $basename
	 */
	private $basename = null;

	/**
	 * The product slug.
	 *
	 * @var string|null $slug
	 */
	private $slug = null;

	/**
	 * The product version.
	 *
	 * @var string|null $version
	 */
	private $version = null;

	/**
	 * The product remote url.
	 *
	 * @var string|null $remote_url
	 */
	private $remote_url = null;

	/**
	 * The product API access key.
	 *
	 * @var string|null $access_token
	 */
	private $access_token = null;

	/**
	 * The remote sslverify flag.
	 *
	 * @var bool $sslverify
	 */
	private $sslverify = false;

	/**
	 * Get the product basename.
	 *
	 * @return string|null
	 */
	public function get_basename(): ?string {
		return $this->basename;
	}

	/**
	 * Set the product basename.
	 *
	 * @param  string $basename the basename.
	 * @return self
	 */
	public function set_basename( string $basename ): self {
		$this->basename = $basename;
		return $this;
	}

	/**
	 * Get the product slug.
	 *
	 * @return string|null
	 */
	public function get_slug(): ?string {
		return $this->slug;
	}

	/**
	 * Set the product slug.
	 *
	 * @param  string $slug the slug.
	 * @return self
	 */
	public function set_slug( string $slug ): self {
		$this->slug = $slug;
		return $this;
	}

	/**
	 * Get the product version.
	 *
	 * @return string|null
	 */
	public function get_version(): ?string {
		return $this->version;
	}

	/**
	 * Set the product version.
	 *
	 * @param  string $version the version.
	 * @return self
	 */
	public function set_version( string $version ): self {
		$this->version = $version;
		return $this;
	}

	/**
	 * Get the product remote url.
	 *
	 * @return string|null
	 */
	public function get_remote_url(): ?string {
		return $this->remote_url;
	}

	/**
	 * Set the product remote url.
	 *
	 * @param  string $remote_url the remote url.
	 * @return self
	 */
	public function set_remote_url( string $remote_url ): self {
		$this->remote_url = $remote_url;
		return $this;
	}

	/**
	 * Get the product access key.
	 *
	 * @return string|null
	 */
	public function get_access_token(): ?string {
		return $this->access_token;
	}

	/**
	 * Set the product access key.
	 *
	 * @param  string $access_token the access key.
	 * @return self
	 */
	public function set_access_token( string $access_token ): self {
		$this->access_token = $access_token;
		return $this;
	}

	/**
	 * Get the remote sslverify flag.
	 *
	 * @return bool
	 */
	public function get_sslverify(): bool {
		return $this->sslverify;
	}

	/**
	 * Set the remote sslverify flag.
	 *
	 * @param  bool $sslverify the sslverify flag.
	 * @return self
	 */
	public function set_sslverify( bool $sslverify ): self {
		$this->sslverify = $sslverify;
		return $this;
	}
}
