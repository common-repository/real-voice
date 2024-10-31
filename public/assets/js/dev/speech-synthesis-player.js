/**
 * This file is used to handle the speechsynthesis player.
 *
 * @package real-voice
 */
window.daextrevoGeneral = (function () {

	'use strict';

	// This object is used to save all the settings -------------------------------------------------------------------.
	let settings = {};

	// This object is used to save all the variable states ---------------------------------------.
	let states = {
		value: null,
		utterance: null,
		synth: null
	};

	/**
	 * Bind the event listeners.
	 */
	function bindEventListeners() {

		'use strict';

		// Save the elements in the states.
		states.playIcon    = document.getElementById( 'daextrevo-play-icon' );
		states.playCircle  = document.getElementById( 'daextrevo-play-circle' );
		states.pauseCircle = document.getElementById( 'daextrevo-pause-circle' );
		states.currentTime = document.getElementById( 'daextrevo-current-time' );

		/**
		 * Stop the script if the states.playIcon element is not found. This occurs when the player is not present. For
		 * example in archive pages, homepage, etc.
		 */
		if (typeof(states.playIcon) == 'undefined' || states.playIcon == null){
			return;
		}

		// Prepare the utterance.
		prepareUtterance();

		// Add the click event listeners on the play icon
		states.playIcon.addEventListener(
			'click',
			() => {
				if (states.synth.speaking === false) {

					states.synth.speak( states.utterance );

					states.playCircle.classList.add( 'daextrevo-display-none' );
					states.pauseCircle.classList.remove( 'daextrevo-display-none' );

				} else {
					if (window.speechSynthesis.paused) {

						states.synth.resume( states.utterance );

						states.playCircle.classList.add( 'daextrevo-display-none' );
						states.pauseCircle.classList.remove( 'daextrevo-display-none' );

						} else {
						states.synth.pause( states.utterance );
						states.pauseCircle.classList.add( 'daextrevo-display-none' );
						states.playCircle.classList.remove( 'daextrevo-display-none' );
						}
				}

			}
		);

	}

    /**
     * Prepare the utterance.
     */
	function prepareUtterance() {

		window.speechSynthesis.cancel();

		states.synth = window.speechSynthesis;

		const phrase = window.daextrevo_content;

		// Create a new SpeechSynthesisUtterance object.
		states.utterance = new SpeechSynthesisUtterance();

		// Set the text to be spoken ----------------------------------------------------------------------------------.
		states.utterance.text = phrase;

		// Language ---------------------------------------------------------------------------------------------------.
		if (window.DAEXTREVO_PHPDATA.speechSynthesisLang !== '') {
			states.utterance.lang = window.DAEXTREVO_PHPDATA.speechSynthesisLang;
		}

		// pitch ------------------------------------------------------------------------------------------------------.
		states.utterance.pitch = window.DAEXTREVO_PHPDATA.speechSynthesisPitch;

		// rate -------------------------------------------------------------------------------------------------------.
		states.utterance.rate = window.DAEXTREVO_PHPDATA.speechSynthesisRate;

		// volume -----------------------------------------------------------------------------------------------------.
		states.utterance.volume = window.DAEXTREVO_PHPDATA.speechSynthesisVolume;

		/**
		 * This event is triggered when the utterance has finished being spoken.
		 *
		 * When this event is triggered, we need to show again the play icon and reset the current time.
		 */
		states.utterance.addEventListener(
			"end",
			(event) => {
				states.playCircle.classList.remove( 'daextrevo-display-none' );
				states.pauseCircle.classList.add( 'daextrevo-display-none' );
				states.currentTime.textContent = '0:00';
			}
		);

		/**
		 * When the boundary event is triggered, we need to update the current time.
		 */
		states.utterance.addEventListener(
			"boundary",
			(event) => {

				// Update the current time.
				const time                     = Math.round( event.elapsedTime / 1000 );
                const minutes                  = Math.floor( time / 60 );
                const seconds                  = time - minutes * 60;
                const paddedSeconds            = seconds.toString().padStart( 2, '0' )
				states.currentTime.textContent = minutes + ':' + paddedSeconds;

			}
		);

	}

	/**
	 * Add the event listeners when the DOM content is loaded.
	 */
	function bootstrap() {

		'use strict';

		// Bind the event listeners.
		document.addEventListener(
			'DOMContentLoaded',
			() => {
            bindEventListeners();
			}
		);

	}

	// Return an object exposed to the public -------------------------------------------------------------------------.
	return {

		initialize: function (configuration) {

			'use strict';

			// Merge the custom configuration provided by the user with the default configuration.
			settings = configuration;

			// Start the process.
			bootstrap();

		},

	};

}());

// Init.
window.daextrevoGeneral.initialize( {} );