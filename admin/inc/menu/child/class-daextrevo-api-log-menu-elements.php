<?php
/**
 * Class used to implement the back-end functionalities of the "Statistics" menu.
 *
 * @package daext-helpful
 */

/**
 * Class used to implement the back-end functionalities of the "Statistics" menu.
 */
class Daextrevo_Api_Log_Menu_Elements extends Daextrevo_Menu_Elements {

	/**
	 * Constructor.
	 *
	 * @param object $shared The shared class.
	 * @param string $page_query_param The page query parameter.
	 * @param string $config The config parameter.
	 */
	public function __construct( $shared, $page_query_param, $config ) {

		parent::__construct( $shared, $page_query_param, $config );

		$this->menu_slug      = 'api-log';
		$this->slug_plural    = 'api-log';
		$this->label_singular = __( 'API Log', 'real-voice');
		$this->label_plural   = __( 'API Log', 'real-voice');
	}

	/**
	 * Display the content of the body of the page.
	 *
	 * @return void
	 */
	public function display_custom_content() {

		?>

		<div id="react-root"></div>

		<?php
	}
}
