<?php

if ( class_exists( 'WPUpdatePhp' ) ) {
	return;
}

class WPUpdatePhp {
	/** @var string */
	private $minimum_version;

	/** @var string */
	private $recommended_version;

	/** @var string */
	private $plugin_name = '';

	/**
	 * @param $minimum_version string
	 * @param $recommended_version string
	 */
	public function __construct( $minimum_version, $recommended_version = null ) {
		$this->minimum_version = $minimum_version;
		$this->recommended_version = $recommended_version;
	}

	/**
	 * @param $name string Name of the plugin to be used in admin notices
	 */
	public function set_plugin_name( $name ) {
		$this->plugin_name = $name;
	}

	/**
	 * @param $version
	 *
	 * @return bool
	 */
	public function does_it_meet_required_php_version( $version = PHP_VERSION ) {
		if ( $this->version_passes_requirement( $this->minimum_version, $version ) ) {
			return true;
		}

		$this->load_version_notice( array( $this, 'minimum_admin_notice' ) );
		return false;
	}

	/**
	 * @param $version
	 *
	 * @return bool
	 */
	public function does_it_meet_recommended_php_version( $version = PHP_VERSION ) {
		if ( $this->version_passes_requirement( $this->recommended_version, $version ) ) {
			return true;
		}

		$this->load_version_notice( array( $this, 'recommended_admin_notice' ) );
		return false;
	}

	/**
	 * @param $requirement
	 * @param $version
	 *
	 * @return bool
	 */
	private function version_passes_requirement( $requirement, $version ) {
		return version_compare( $requirement, $version, '<=' );
	}

	/**
	 * @param $callback
	 *
	 * @return void
	 */
	private function load_version_notice( $callback ) {
		if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
			add_action( 'admin_notices', $callback );
		}
	}

	/**
	 * Method hooked into admin_notices when minimum PHP version is not available to show this in a notice
	 * @hook admin_notices
	 */
	public function minimum_admin_notice() {
		echo '<div class="error">';

		if ( ! empty( $this->plugin_name ) ) {
			echo '<p>Unfortunately, '. $this->plugin_name .' can not run on PHP versions older than '. $this->minimum_version .'. Read more information about <a href="http://www.wpupdatephp.com/update/">how you can update</a>.</p>';
		} else {
			echo '<p>Unfortunately, this plugin can not run on PHP versions older than '. $this->minimum_version .'. Read more information about <a href="http://www.wpupdatephp.com/update/">how you can update</a>.</p>';
		}

		echo '</div>';
	}

	/**
	 * Method hooked into admin_notices when recommended PHP version is not available to show this in a notice
	 * @hook admin_notices
	 */
	public function recommended_admin_notice() {
		echo '<div class="error">';

		if ( ! empty( $this->plugin_name ) ) {
			echo '<p>'. $this->plugin_name .' recommends a PHP versions higher than '. $this->recommended_version .'. Read more information about <a href="http://www.wpupdatephp.com/update/">how you can update</a>.</p>';	
		} else {
			echo '<p>This plugin recommends a PHP versions higher than '. $this->recommended_version .'. Read more information about <a href="http://www.wpupdatephp.com/update/">how you can update</a>.</p>';	
		}
		
		echo '</div>';
	}
}