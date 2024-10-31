/**
 * Implementation of the presentation of the audio player.
 *
 * This audio player has been inspired by the following sources:
 *
 * - https://css-tricks.com/lets-create-a-custom-audio-player/
 * - https://codepen.io/idorenyinudoh/pen/GRjBXER (the same above but in codepen)
 *
 * - https://www.smashingmagazine.com/2021/12/create-custom-range-input-consistent-browsers/
 *
 * Note that this audio player is used only when the converter is different from 'speechsynthesis-api' and actual
 * audio files are used.
 */
function daextrevoMain(){

	/**
	 * Create Element objects for the commonly used DOM elements.
	 */
	const playIconContainer    = document.getElementById( 'daextrevo-play-icon' );
	const audioPlayerContainer = document.getElementById( 'daextrevo-audio-player-container' );
	const seekSlider           = document.getElementById( 'daextrevo-seek-slider' );
	const volumeSlider         = document.getElementById( 'daextrevo-volume-slider' );
	const muteIconContainer    = document.getElementById( 'daextrevo-mute-icon' );
	const playCircle           = document.getElementById( 'daextrevo-play-circle' );
	const pauseCircle          = document.getElementById( 'daextrevo-pause-circle' );
	const volumeMax            = document.getElementById( 'daextrevo-volume-max' );
	const volumeX              = document.getElementById( 'daextrevo-volume-x' );

	/**
	 * Create variables for the play and mute states.
	 */
	let playState = 'play';
	let muteState = 'unmute';

	/**
	 * Stop the script if the play icon element is not found. This occurs when the player is not present. For
	 * example in archive pages, homepage, etc.
	 */
	if (typeof(playIconContainer) == 'undefined' || playIconContainer == null){
		return;
	}

	/**
	 * When the play icon is clicked the playState is checked and the audio is played or paused.
	 */
	playIconContainer.addEventListener('click', () => {

		if (playState === 'play') {

			audio.play();
			playCircle.classList.add('daextrevo-display-none');
			pauseCircle.classList.remove('daextrevo-display-none');
			requestAnimationFrame(whilePlaying);
			playState = 'pause';

		} else {

			audio.pause();
			playCircle.classList.remove('daextrevo-display-none');
			pauseCircle.classList.add('daextrevo-display-none');
			cancelAnimationFrame(raf);
			playState = 'play';

		}

	});

	/**
	 * When the mute icon is clicked the muteState is checked and the audio is muted or unmuted.
	 */
	muteIconContainer.addEventListener('click', () => {

		if (muteState === 'unmute') {

			volumeMax.classList.add( 'daextrevo-display-none' );
			volumeX.classList.remove( 'daextrevo-display-none' );
			audio.muted = true;
			muteState = 'mute';

		} else {

			volumeMax.classList.remove( 'daextrevo-display-none' );
			volumeX.classList.add( 'daextrevo-display-none' );
			audio.muted = false;
			muteState = 'unmute';

		}
	});


	/**
	 *
	 * Saves the position of the handle in the slider.
	 *
	 * @param rangeInput
	 */
	const showRangeProgress = (rangeInput) => {

		if (rangeInput === seekSlider) {
			audioPlayerContainer.style.setProperty( '--seek-before-width', rangeInput.value / rangeInput.max * 100 + '%' );
		} else {
			audioPlayerContainer.style.setProperty( '--volume-before-width', rangeInput.value / rangeInput.max * 100 + '%' );
		}

	}

	/**
	 * When the seek-slider is used via the UI the showRangeProgress() method is called.
	 */
	seekSlider.addEventListener(
		'input',
		(e) => {
			showRangeProgress( e.target );
		}
	);

	/**
	 * When the volume-slider is used via the UI the showRangeProgress() method is called.
	 */
	volumeSlider.addEventListener(
		'input',
		(e) => {
			showRangeProgress( e.target );
		}
	);

	/** Implementation of the functionality of the audio player */

	const audio                = document.querySelector( 'audio' );
	const durationContainer    = document.getElementById( 'daextrevo-duration' );
	const currentTimeContainer = document.getElementById( 'daextrevo-current-time' );
	const outputContainer      = document.getElementById( 'daextrevo-volume-output' );
	let raf                    = null;

	const calculateTime = (secs) => {

		const minutes         = Math.floor( secs / 60 );
		const seconds         = Math.floor( secs % 60 );
		const returnedSeconds = seconds < 10 ? `0${seconds}` : `${seconds}`;
		return `${minutes}:${returnedSeconds}`;

	}

	const displayDuration = () => {

		durationContainer.textContent = calculateTime( audio.duration );

	}

	const setSliderMax = () => {

		seekSlider.max = Math.floor( audio.duration );

	}

	const displayBufferedAmount = () => {

		if (audio.buffered.length > 0) {

			const bufferedAmount = Math.floor( audio.buffered.end( audio.buffered.length - 1 ) );
			audioPlayerContainer.style.setProperty( '--buffered-width', `${(bufferedAmount / seekSlider.max) * 100} % ` );

		}

	}

	const whilePlaying = () => {

		seekSlider.value                 = Math.floor( audio.currentTime );
		currentTimeContainer.textContent = calculateTime( seekSlider.value );
		audioPlayerContainer.style.setProperty( '--seek-before-width', `${seekSlider.value / seekSlider.max * 100} % ` );
		raf = requestAnimationFrame( whilePlaying );

	}

	if (audio.readyState > 0) {

		displayDuration();
		setSliderMax();
		displayBufferedAmount();

	} else {

		audio.addEventListener(
			'loadedmetadata',
			() => {
				displayDuration();
				setSliderMax();
				displayBufferedAmount();
			}
		);

	}

	audio.addEventListener( 'progress', displayBufferedAmount );

	/**
	 * When the audio is ended, the play icon is displayed again and the play stated is set to 'play'.
	 */
	audio.addEventListener(
		'ended',
		() => {
			playCircle.classList.remove( 'daextrevo-display-none' );
			pauseCircle.classList.add( 'daextrevo-display-none' );
			playState = 'play';
		}
	);

	/**
	 * When the seek-slider is used via the UI the current time text is updated.
	 */
	seekSlider.addEventListener(
		'input',
		() => {
			currentTimeContainer.textContent = calculateTime( seekSlider.value );
			if ( ! audio.paused) {
				cancelAnimationFrame( raf );
			}
		}
	);

	/**
	 * When the seek-slider is used via the UI the current time text is updated.
	 */
	seekSlider.addEventListener(
		'change',
		() => {
			audio.currentTime = seekSlider.value;
			if ( ! audio.paused) {
				requestAnimationFrame( whilePlaying );
			}
		}
	);

	/**
	 * When the volume-slider is used via the UI the volume text is updated.
	 */
	volumeSlider.addEventListener(
		'input',
		(e) => {
			const value                 = e.target.value;
			outputContainer.textContent = value;
			audio.volume                = value / 100;
		}
	);

}