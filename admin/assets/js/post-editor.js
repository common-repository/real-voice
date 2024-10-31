/**
 * This file is used in the Classic editor to handle the fields of the "Audio File" meta box.
 */

window.postEditor = (function( $) {

  'use strict';

  // This object is used to save all the settings ---------------------------------------------------------------------.
  let settings = {};

  // This object is used to save all the variable states -----------------------------------------.
  let states = {
	value: null,
  };

  /**
   * Bind the event listeners.
   */
  function bindEventListeners() {

	'use strict';

	/**
	 * This script is only used in the classic editor. If the block editor is active, stop the script execution.
	 */
	if(isGutenbergActive() === true){
	  return;
	}

	// Handles the clicks on button use to generate a new audio file.
	const generateAudioFileButton = document.getElementById('daextrevo-generate-audio-file');

	if (generateAudioFileButton !== null) {

		generateAudioFileButton.addEventListener('click', function (event) {

			'use strict';

			const postId = parseInt(document.getElementById('post_ID').value, 10);
			const nonce = document.getElementById('daextrevo_create_audio_file_nonce').value;

			wp.apiFetch({
				path: '/real-voice/v1/create-audio-file',
				method: 'POST',
				data: {
					id: postId,
					nonce: nonce
				}
			}).then(response => {

				if(response.error !== undefined) {

					alert(response.message);

				}else{

					// Update the generation date field.
					const formattedDate = wp.date.dateI18n( 'F j, Y g:i a \\U\\T\\CP', parseInt(response.audio_file_creation_date, 10) * 1000 );
					document.getElementById('daextrevo-audio-file-creation-date-value').innerHTML = formattedDate;

					document.getElementById('daextrevo-audio-file-creation-date').classList.remove('daextrevo-display-none');
					document.getElementById('daextrevo-create-file-message').classList.add('daextrevo-display-none');
					document.getElementById('daextrevo-delete-audio-file').classList.remove('daextrevo-display-none');

				}

			});

		});

	}

	// Handles the clicks on the button used to delete an audio file.
	const deleteAudioFileButton = document.getElementById('daextrevo-delete-audio-file');

  if (deleteAudioFileButton !== null) {

	  deleteAudioFileButton.addEventListener('click', function (event) {

		  'use strict';

		  const postId = parseInt(document.getElementById('post_ID').value, 10)
		  const nonce = document.getElementById('daextrevo_delete_audio_file_nonce').value;

		  wp.apiFetch({
			  path: '/real-voice/v1/delete-audio-file',
			  method: 'POST',
			  data: {
				  id: postId,
				  nonce: nonce
			  }
		  }).then(response => {

			  document.getElementById('daextrevo-audio-file-creation-date').classList.add('daextrevo-display-none');
			  document.getElementById('daextrevo-create-file-message').classList.remove('daextrevo-display-none');
			  document.getElementById('daextrevo-delete-audio-file').classList.add('daextrevo-display-none');

		  });

	  });

  }

  }

  function isGutenbergActive() {
	return document.body.classList.contains( 'block-editor-page' );
  }

  /**
   * Add the cookie notice to the DOM and add the event listeners.
   */
  function bootstrap() {

	'use strict';

	// Bind the event listeners.
	window.addEventListener('DOMContentLoaded', function() {

	  bindEventListeners();

	});

  }

  // Return an object exposed to the public ---------------------------------------------------------------------------.
  return {

	initialize: function(configuration) {

	  'use strict';

	  // Merge the custom configuration provided by the user with the default configuration.
	  settings = configuration;

	  // Start the process.
	  bootstrap();

	},

  };

}());

// Init.
window.postEditor.initialize({});