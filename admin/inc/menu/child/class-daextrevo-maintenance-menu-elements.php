<?php
/**
 * Class used to implement the back-end functionalities of the "Maintenance" menu.
 *
 * @package daext-helpful
 */

/**
 * Class used to implement the back-end functionalities of the "Maintenance" menu.
 */
class Daextrevo_Maintenance_Menu_Elements extends Daextrevo_Menu_Elements {

	/**
	 * An instance of the class used to write the custom CSS file.
	 *
	 * @var Daextrevo_Write_Css_File|null
	 */
	private $write_css_file = null;

	/**
	 * Constructor.
	 *
	 * @param object $shared The shared class.
	 * @param string $page_query_param The page query parameter.
	 * @param string $config The config parameter.
	 */
	public function __construct( $shared, $page_query_param, $config ) {

		// Write CSS File.
		$this->write_css_file = Daextrevo_Write_Css_File::get_instance();

		parent::__construct( $shared, $page_query_param, $config );

		$this->menu_slug      = 'maintenance';
		$this->slug_plural    = 'maintenance';
		$this->label_singular = __( 'Maintenance', 'real-voice');
		$this->label_plural   = __( 'Maintenance', 'real-voice');
	}

	/**
	 * Process the add/edit form submission of the menu. Specifically the following tasks are performed:
	 *
	 * 1. Sanitization
	 * 2. Validation
	 * 3. Database update
	 *
	 * @return void
	 */
	public function process_form() {

		// Preliminary operations ---------------------------------------------------------------------------------------------.
		global $wpdb;

		if ( isset( $_POST['form_submitted'] ) ) {

			// Nonce verification.
			check_admin_referer( 'daextrevo_execute_task', 'daextrevo_execute_task_nonce' );

			// Sanitization ---------------------------------------------------------------------------------------------------.
			$data['task'] = isset( $_POST['task'] ) ? intval( $_POST['task'], 10 ) : null;

			// Validation -----------------------------------------------------------------------------------------------------.

			$invalid_data_message = '';
			$invalid_data         = false;

			if ( false === $invalid_data ) {

				switch ( $data['task'] ) {

					// Delete Data.
					case 0:
						// Delete data in the 'feedback' table.
						global $wpdb;

						// phpcs:ignore WordPress.DB.DirectDatabaseQuery
						$query_result_request = $wpdb->query( "DELETE FROM {$wpdb->prefix}daextrevo_request" );

						if ( false !== $query_result_request ) {

							if ( $query_result_request > 0 ) {

								$this->shared->save_dismissible_notice(
									intval(
										$query_result_request,
										10
									) . ' ' . __( 'records have been successfully deleted.', 'real-voice'),
									'updated'
								);

							} else {

								$this->shared->save_dismissible_notice(
									__( 'There are no API Log data.', 'real-voice'),
									'error'
								);

							}
						}

						break;

					// Reset Options.
					case 1:
						// Set the default values of the options.
						$this->shared->reset_plugin_options();

						// Regenerate the plugin public CSS.
						if ( $this->write_css_file->write_custom_css() === false ) {

							$this->shared->save_dismissible_notice(
								__( "The plugin can't write files in the upload directory.", 'real-voice'),
								'error'
							);

						}

						$this->shared->save_dismissible_notice(
							__( 'The plugin options have been successfully set to their default values.', 'real-voice'),
							'updated'
						);

						break;

				}
			}
		}
	}

	/**
	 * Display the form.
	 *
	 * @return void
	 */
	public function display_custom_content() {

		?>

		<div class="daextrevo-admin-body">

			<?php

			// Display the dismissible notices.
			$this->shared->display_dismissible_notices();

			?>

			<div class="daextrevo-main-form">

				<form id="form-maintenance" method="POST"
						action="admin.php?page=<?php echo esc_attr( $this->shared->get( 'slug' ) ); ?>-maintenance"
						autocomplete="off">

					<div class="daextrevo-main-form__daext-form-section">

						<div class="daextrevo-main-form__daext-form-section-body">

							<input type="hidden" value="1" name="form_submitted">

							<?php wp_nonce_field( 'daextrevo_execute_task', 'daextrevo_execute_task_nonce' ); ?>

							<?php

							// Task.
							$this->select_field(
								'task',
								'Task',
								__( 'The task that should be performed.', 'real-voice'),
								array(
									'0' => __( 'Delete API Log Data', 'real-voice'),
									'1' => __( 'Reset Plugin Options', 'real-voice'),
								),
								null,
								'main'
							);

							?>

							<!-- submit button -->
							<div class="daext-form-action">
								<input id="execute-task" class="daextrevo-btn daextrevo-btn-primary" type="submit"
										value="<?php esc_attr_e( 'Execute Task', 'real-voice'); ?>">
							</div>

						</div>

					</div>

				</form>

			</div>

		</div>

		<!-- Dialog Confirm -->
		<div id="dialog-confirm" title="<?php esc_attr_e( 'Maintenance Task', 'real-voice'); ?>" class="daext-display-none">
			<p><?php esc_html_e( 'Do you really want to proceed?', 'real-voice'); ?></p>
		</div>

		<?php
	}
}
