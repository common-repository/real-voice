/**
 * This file is used loaded in all WordPress back-end pages, and it's used to add the target="_blank" attribute to the
 * "Help & Support" link available as the last item in the Real Voice admin menu.
 *
 * @package real-voice
 */

(function ($) {

	'use strict';

	$( document ).ready(
		function () {

			const lastMenuItemLink = $( '#toplevel_page_daextrevo-api-log.toplevel_page_daextrevo-api-log .wp-submenu li:last-of-type a' );
			lastMenuItemLink.attr( 'target', '_blank' );

		}
	);

}(window.jQuery));
