<?php
namespace AIOSEO\Plugin\Pro\Admin;

/**
 * The License class to validate/activate/deactivate license keys.
 *
 * @since 4.0.0
 */
class License {
	/**
	 * Source of notifications content.
	 *
	 * @since 4.0.0
	 *
	 * @var string
	 */
	private $baseUrl = 'https://licensing.aioseo.com/v1/';

	/**
	 * Class constructor.
	 *
	 * @since 4.0.0
	 */
	public function __construct() {
		if ( ! isset( $_GET['page'] ) || 'aioseo-settings' !== wp_unslash( $_GET['page'] ) ) { // phpcs:ignore HM.Security.ValidatedSanitizedInput.InputNotSanitized
			add_action( 'admin_notices', [ $this, 'notices' ] );
		}

		add_action( 'after_plugin_row_' . AIOSEO_PLUGIN_BASENAME, [ $this, 'pluginRowNotice' ] );
		add_action( 'in_plugin_update_message-' . AIOSEO_PLUGIN_BASENAME, [ $this, 'updateRowNotice' ] );

		aioseo()->options->general->licenseKey = '1415b451be1a13c283ba771ea52d38bb';
		$this->maybeValidate();
	}

	/**
	 * Checks if we should validate the license key or not.
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	public function maybeValidate() {
		if ( ! aioseo()->options->general->licenseKey ) {
			if ( $this->needsReset() ) {
				aioseo()->internalOptions->internal->license->reset(
					[
						'expires',
						'expired',
						'invalid',
						'disabled',
						'activationsError',
						'connectionError',
						'requestError',
						'level',
						'addons'
					]
				);
			}
			return;
		}

		// Perform a request to validate the key  - Only run every 12 hours.
		$timestamp = aioseo()->internalOptions->internal->license->lastChecked;
		if ( time() < $timestamp ) {
			return;
		}

		$this->activate();
		aioseo()->internalOptions->internal->license->lastChecked = strtotime( '+12 hours' );
	}

	/**
	 * Validate the license key.
	 *
	 * @since 4.0.0
	 *
	 * @return boolean Whether or not it was activated.
	 */
	public function activate() {
		aioseo()->internalOptions->internal->license->reset(
			[
				'expires',
				'expired',
				'invalid',
				'disabled',
				'activationsError',
				'connectionError',
				'requestError',
				'level',
				'addons'
			]
		);

		$response = aioseo()->helpers->sendRequest( $this->getUrl() . 'activate/', [
			'version'     => AIOSEO_VERSION,
			'license'     => aioseo()->options->general->licenseKey,
			'domain'      => aioseo()->helpers->getSiteDomain(),
			'php_version' => PHP_VERSION,
			'wp_version'  => get_bloginfo( 'version' )
		] );

		if ( empty( $response ) ) {
			// Something bad happened, error unknown.
			aioseo()->internalOptions->internal->license->connectionError = true;
			return false;
		}

		if ( ! empty( $response->error ) ) {
			if ( 'missing-key-or-domain' === $response->error ) {
				aioseo()->internalOptions->internal->license->requestError = true;
				return false;
			}

			if ( 'missing-license' === $response->error ) {
				aioseo()->internalOptions->internal->license->invalid = true;
				return false;
			}

			if ( 'disabled' === $response->error ) {
				aioseo()->internalOptions->internal->license->disabled = true;
				return false;
			}

			if ( 'activations' === $response->error ) {
				aioseo()->internalOptions->internal->license->activationsError = true;
				return false;
			}

			if ( 'expired' === $response->error ) {
				aioseo()->internalOptions->internal->license->expires = strtotime( $response->expires );
				aioseo()->internalOptions->internal->license->expired = true;
				return false;
			}
		}

		// Something bad happened, error unknown.
		if ( empty( $response->success ) ) {
			return false;
		}

		aioseo()->internalOptions->internal->license->level   = ! empty( $response->level ) ? $response->level : null;
		aioseo()->internalOptions->internal->license->expires = strtotime( $response->expires );
		return true;
	}

	/**
	 * Deactivate the license key.
	 *
	 * @since 4.0.0
	 *
	 * @return boolean Whether or not it was deactivated.
	 */
	public function deactivate() {
		$response = aioseo()->helpers->sendRequest( $this->getUrl() . 'deactivate/', [
			'license'     => aioseo()->options->general->licenseKey,
			'domain'      => aioseo()->helpers->getSiteDomain(),
			'php_version' => PHP_VERSION,
			'wp_version'  => get_bloginfo( 'version' ),
			'sku'         => 'aioseo'
		] );

		if ( empty( $response ) ) {
			// Something bad happened, error unknown.
			aioseo()->internalOptions->internal->license->connectionError = true;
			return false;
		}

		if ( ! empty( $response->error ) ) {
			if ( 'missing-key-or-domain' === $response->error || 'not-activated' === $response->error ) {
				aioseo()->internalOptions->internal->license->requestError = true;
				return false;
			}

			if ( 'missing-license' === $response->error ) {
				aioseo()->internalOptions->internal->license->invalid = true;
				return false;
			}

			if ( 'disabled' === $response->error ) {
				aioseo()->internalOptions->internal->license->disabled = true;
				return false;
			}
		}

		aioseo()->internalOptions->internal->license->reset(
			[
				'expires',
				'expired',
				'invalid',
				'disabled',
				'activationsError',
				'connectionError',
				'requestError',
				'level',
				'addons'
			]
		);
		return true;
	}

	/**
	 * Output any notices generated by the class.
	 *
	 * @since 4.0.0
	 *
	 * @param bool $belowH2
	 */
	public function notices( $belowH2 = false ) {
		// Grab the option and output any nag dealing with license keys.
		$key      = aioseo()->options->general->licenseKey;
		$expired  = aioseo()->internalOptions->internal->license->expired;
		$invalid  = aioseo()->internalOptions->internal->license->invalid;
		$disabled = aioseo()->internalOptions->internal->license->disabled;
		$belowH2  = $belowH2 ? 'below-h2' : '';

		// If there is no license key, output nag about ensuring key is set for automatic updates.
		if ( ! $key ) {
			?>
			<div class="notice notice-info <?php echo esc_attr( $belowH2 ); ?> aioseo-license-notice">
				<p>
					<?php
					echo
						wp_kses(
							sprintf(
								// Translators: 1 - Opening link tag, 2 - Closing link tag, 4 - The plugin name ("All in One SEO").
								esc_html__( 'Please %1$senter and activate%2$s your license key for %3$s to enable automatic updates.', 'aioseo-pro' ),
								sprintf( '<a href="%1$s">', esc_url( add_query_arg( [ 'page' => 'aioseo-settings' ], admin_url( 'admin.php' ) ) ) ),
								'</a>',
								esc_html( AIOSEO_PLUGIN_NAME )
							),
							[
								'a' => [
									'href' => [],
								],
							]
						)
					?>
				</p>
			</div>
			<?php
			return;
		}

		// If a key has expired, output nag about renewing the key.
		if ( $expired ) {
			$renewNowUrl  = aioseo()->helpers->utmUrl( AIOSEO_MARKETING_URL . 'my-account/subscriptions/', 'admin-notice', 'renew-now' );
			$learnMoreUrl = aioseo()->helpers->utmUrl( AIOSEO_MARKETING_URL . 'faqs/how-do-i-renew-a-support-and-updates-subscription/', 'admin-notice', 'learn-more' );
			?>
			<div class="error notice <?php echo esc_attr( $belowH2 ); ?> aioseo-notice aioseo-license-notice">
				<h3 style="margin: .75em 0 0 0;">
					<svg xmlns="http://www.w3.org/2000/svg" width="24.067" height="24" style="vertical-align: text-top; width: 24.067px; margin-right: 7px;">
						<defs>
							<style>.b{fill:#231f20}</style>
						</defs>
						<g transform="translate(-.066)"><path d="M1.6 24a1.338 1.338 0 01-1.3-2.1L11 .9c.6-1.2 1.6-1.2 2.2 0l10.7 21c.6 1.2 0 2.1-1.3 2.1z" fill="#ffce31" />
							<path class="b" d="M10.3 8.6l1.1 7.4a.605.605 0 001.2 0l1.1-7.4a1.738 1.738 0 10-3.4 0z" />
							<circle class="b" cx="1.7" cy="1.7" r="1.7" transform="translate(10.3 17.3)" />
						</g>
					</svg>
					<?php
					// Translators: 1 - The plugin name ("All in One SEO"). */
					printf( esc_html__( 'Heads up! Your %1$s license has expired.', 'aioseo-pro' ), esc_html( AIOSEO_PLUGIN_NAME ) );
					?>
				</h3>
				<p>
					<?php
					// Translators: 1 - The plugin name ("All in One SEO").
					printf( esc_html__( 'An active license is needed to use any of the Pro features of %1$s. It also provides access to new features & addons, plugin updates (including security improvements), and our world class support!', 'aioseo-pro' ), esc_html( AIOSEO_PLUGIN_NAME ) ); // phpcs:ignore Generic.Files.LineLength.MaxExceeded
					?>
				</p>
				<p>
					<a href="<?php echo esc_url( $renewNowUrl ); ?>" class="button-primary"><?php esc_html_e( 'Renew Now', 'aioseo-pro' ); ?></a> &nbsp
					<a href="<?php echo esc_url( $learnMoreUrl ); ?>" class="button-secondary"><?php esc_html_e( 'Learn More', 'aioseo-pro' ); ?></a>
				</p>
			</div>
			<?php
		}

		// If a key has been disabled, output nag about using another key.
		if ( $disabled ) {
			?>
			<div class="error notice <?php echo esc_attr( $belowH2 ); ?> aioseo-license-notice">
				<p>
					<?php
					printf(
						// Translators: 1 - The plugin name ("All in One SEO").
						esc_html__( 'Your license key for %1$s has been disabled. Please use a different key to continue receiving automatic updates.', 'aioseo-pro' ),
						esc_html( AIOSEO_PLUGIN_NAME )
					);
					?>
				</p>
			</div>
			<?php
		}

		// If a key is invalid, output nag about using another key.
		if ( $invalid ) {
			?>
			<div class="error notice <?php echo esc_attr( $belowH2 ); ?> aioseo-license-notice">
				<p>
					<?php
						printf(
							// Translators: 1 - The plugin name ("All in One SEO").
							esc_html__( 'Your license key for %1$s is invalid. The key no longer exists or the user associated with the key has been deleted. Please use a different key to continue receiving automatic updates.', 'aioseo-pro' ), // phpcs:ignore Generic.Files.LineLength.MaxExceeded
							esc_html( AIOSEO_PLUGIN_NAME )
						);
					?>
					<a href="admin.php?page=aioseo-settings"><?php esc_html_e( 'Manage Licenses', 'aioseo-pro' ); ?>.</a>
				</p>
			</div>
			<?php
		}
	}

	/**
	 * Adds a notice to the update row for unlicensed users.
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	public function updateRowNotice() {
		if ( ! $this->isActive() ) {
			echo '<br><span style="margin-left:26px;">' . sprintf(
				// Translators: 1 - Opening HTML bold tag, 2 - Closing HTML bold tag, 3 - The plugin name ("All in One SEO").
				esc_html__( 'A %1$svalid license key%2$s is required to download updates for %3$s.', 'aioseo-pro' ),
				'<strong>',
				'</strong>',
				esc_html( AIOSEO_PLUGIN_NAME )
			) . '</span>';
		}
	}

	/**
	 * Add row to Plugins page with licensing information, if license key is invalid or not found.
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	public function pluginRowNotice() {
		if ( ! $this->isActive() && ! is_network_admin() ) {
			$message = sprintf(
				// Translators: 1 - Opening HTML link tag, 2 - Closing HTML link tag.
				esc_html__( 'has not been entered. %1$sClick here to enter one now%2$s', 'aioseo-pro' ),
				'<a href="' . admin_url( 'admin.php?page=aioseo-settings' ) . '">',
				'</a>'
			);

			$licenseKey = aioseo()->options->general->licenseKey;
			if ( ! empty( $licenseKey ) ) {
				if ( $this->isExpired() ) {
					$message = esc_html__( 'is expired', 'aioseo-pro' );
				}
				if ( $this->isDisabled() ) {
					$message = esc_html__( 'is disabled', 'aioseo-pro' );
				}
				if ( $this->isInvalid() ) {
					$message = esc_html__( 'is invalid', 'aioseo-pro' );
				}
			}
			echo '
				<tr class="plugin-update-tr active">
					<td colspan="4" class="plugin-update colspanchange">
						<div class="update-message notice notice-warning notice-alt inline">
							<p>
								<span>' .
									sprintf(
										'%1$s <strong>%2$s</strong> %3$s.',
										esc_html__( 'Your', 'aioseo-pro' ),
										esc_html__( 'license key', 'aioseo-pro' ),
										$message // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									) .
								'</span>
							</p>
							<p>
								<a href="admin.php?page=aioseo-settings">' . esc_html__( 'Manage Licenses', 'aioseo-pro' ) . '</a> |
								<a
									href="' . aioseo()->helpers->utmUrl( AIOSEO_MARKETING_URL . 'pricing/', 'invalid-license' ) . '"' // phpcs:ignore WordPress.Security.EscapeOutput, Generic.Files.LineLength.MaxExceeded
									. 'target="_blank"
								>' . esc_html__( 'Purchase one now.', 'aioseo-pro' ) . '</a>
							</p>
						</div>
					</td>
				</tr>
			';
		}
	}

	/**
	 * Get the URL to check licenses.
	 *
	 * @since 4.0.0
	 *
	 * @return string The URL.
	 */
	public function getUrl() {
		if ( defined( 'AIOSEO_LICENSING_URL' ) ) {
			return AIOSEO_LICENSING_URL;
		}

		return $this->baseUrl;
	}

	/**
	 * Checks to see if the current license is expired.
	 *
	 * @since 4.0.0
	 *
	 * @return bool True if expired, false if not.
	 */
	public function isExpired() {
		$licenseKey = aioseo()->options->general->licenseKey;
		if ( empty( $licenseKey ) ) {
			return false;
		}

		$expired = aioseo()->internalOptions->internal->license->expired;
		if ( $expired ) {
			return true;
		}

		$expires = aioseo()->internalOptions->internal->license->expires;
		return 0 !== $expires && $expires < time();
	}

	/**
	 * Checks to see if the current license is disabled.
	 *
	 * @return bool True if disabled, false if not.
	 */
	public function isDisabled() {
		$licenseKey = aioseo()->options->general->licenseKey;
		if ( empty( $licenseKey ) ) {
			return false;
		}

		return aioseo()->internalOptions->internal->license->disabled;
	}

	/**
	 * Checks to see if the current license is invalid.
	 *
	 * @since 4.0.0
	 *
	 * @return bool True if invalid, false if not.
	 */
	public function isInvalid() {
		$licenseKey = aioseo()->options->general->licenseKey;
		if ( empty( $licenseKey ) ) {
			return false;
		}

		return aioseo()->internalOptions->internal->license->invalid;
	}

	/**
	 * Checks to see if the current license is disabled.
	 *
	 * @since 4.0.0
	 *
	 * @return bool True if disabled, false if not.
	 */
	public function isActive() {
		$licenseKey = aioseo()->options->general->licenseKey;
		if ( empty( $licenseKey ) ) {
			return false;
		}

		return ! $this->isExpired() && ! $this->isDisabled() && ! $this->isInvalid();
	}

	/**
	 * Get the license level for the activated license.
	 *
	 * @since 4.0.0
	 *
	 * @return string The license level.
	 */
	public function getLicenseLevel() {
		$licenseKey = aioseo()->options->general->licenseKey;
		if ( empty( $licenseKey ) ) {
			return 'Unknown';
		}

		return aioseo()->internalOptions->internal->license->level;
	}

	/**
	 * Checks whether a given addon can be used with the current license plan.
	 *
	 * @since 4.0.0
	 *
	 * @param  string  $addonName The addon name.
	 * @return boolean            Whether the addon can be used.
	 */
	public function isAddonAllowed( $addonName ) {
		$addons = aioseo()->addons->getAddons();
		foreach ( $addons as $addon ) {
			if ( $addonName !== $addon->sku ) {
				continue;
			}
			if ( ! isset( $addon->levels ) ) {
				return false;
			}
			return in_array( $this->getLicenseLevel(), $addon->levels, true );
		}
		return false;
	}

	/**
	 * Checks if the license data needs to be reset.
	 *
	 * @since 4.0.0
	 *
	 * @return bool True if a reset is needed, false if not.
	 */
	private function needsReset() {
		$licenseKey = aioseo()->options->general->licenseKey;
		if ( ! empty( $licenseKey ) ) {
			return false;
		}

		if ( aioseo()->internalOptions->internal->license->level ) {
			return true;
		}

		if ( aioseo()->internalOptions->internal->license->invalid ) {
			return true;
		}

		if ( aioseo()->internalOptions->internal->license->disabled ) {
			return true;
		}

		$expired = aioseo()->internalOptions->internal->license->expired;
		if ( $expired ) {
			return true;
		}

		$expires = aioseo()->internalOptions->internal->license->expires;
		return 0 !== $expires;
	}
}