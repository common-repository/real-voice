async function fetchAudio(url) {
    const response = await fetch(url);
    if (!response.ok) throw new Error(`Failed to fetch ${url}`);
    return response.arrayBuffer();
}

/**
 * This function does what follows:
 *
 * 1. Fetches all audio files based on the provided URLs.
 * 2. The audio files are decoded and stored in an array of AudioBuffer objects.
 * 3. The function checks if all buffers have the same sample rate.
 * 4. A new AudioBuffer object is created with the total length of all buffers.
 * 5. The audio data of each buffer is copied to the output buffer.
 * 6. The output buffer is converted to WAV format.
 * 7. The WAV data is stored in a Blob object.
 * 8. A URL is created for the Blob object.
 * 9. The audio player source is set to the URL.
 * 10. The download link href attribute is set to the URL.
 * 11. The main function is called to initialize the player and the download button.
 *
 * @param urls
 * @returns {Promise<void>}
 */
async function concatenateAudioFiles(urls) {

    let url = null;

    if(urls.length > 1) {

        const audioContext = new (window.AudioContext || window.webkitAudioContext)();

        // Fetch and decode all audio files.
        const audioBuffers = await Promise.all(urls.map(async url => {
            const arrayBuffer = await fetchAudio(url);
            return audioContext.decodeAudioData(arrayBuffer);
        }));

        // Check if all buffers have the same sample rate.
        const sampleRate = audioBuffers[0].sampleRate;
        if (!audioBuffers.every(buffer => buffer.sampleRate === sampleRate)) {
            throw new Error("Audio files have different sample rates");
        }

        // Create output buffer with total length.
        const totalLength = audioBuffers.reduce((sum, buffer) => sum + buffer.length, 0);
        const outputBuffer = audioContext.createBuffer(2, totalLength, sampleRate);

        let offset = 0;
        audioBuffers.forEach(buffer => {
            for (let channel = 0; channel < buffer.numberOfChannels; channel++) {
                outputBuffer.getChannelData(channel).set(buffer.getChannelData(channel), offset);
            }
            offset += buffer.length;
        });

        // Convert to WAV and create Blob.
        const wavData = audioBufferToWav(outputBuffer); // This function is provided by the library
        const blob = new Blob([wavData], { type: 'audio/wav' });
        url = URL.createObjectURL(blob);

    }else{

        url = urls[0];

    }

    // Set audio source and play.
    const audioPlayer = document.querySelector('#daextrevo-audio-player-container > audio');
    audioPlayer.src = url;

    daextrevoMain();

}

if (
    window.DAEXTREVO_PHPDATA.audioFileUrl &&
    Array.isArray(window.DAEXTREVO_PHPDATA.audioFileUrl) &&
    window.DAEXTREVO_PHPDATA.audioFileUrl.length > 0
) {

    concatenateAudioFiles(
        window.DAEXTREVO_PHPDATA.audioFileUrl
    );

}
