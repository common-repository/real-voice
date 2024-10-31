<?php
/**
 * Used to generate the data used in the options menu powered by React.
 *
 * @package real-voice
 */

/**
 * This menu_options_configuration() method of this class is used to generate the data used in the options menu powered
 * by React.
 */
class Daextrevo_Menu_Options {

	/**
	 * The singleton instance of the class.
	 *
	 * @var null
	 */
	protected static $instance = null;

	/**
	 * Get the singleton instance of the class.
	 *
	 * @return self|null
	 */
	public static function get_instance() {

		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Returns an array with the data used by the React based options menu to initialize the options.
	 *
	 * @return array[]
	 */
	public function menu_options_configuration() {

		// Get the public post types that have a UI.
		$args               = array(
			'public'  => true,
			'show_ui' => true,
		);
		$post_types_with_ui = get_post_types( $args );
		unset( $post_types_with_ui['attachment'] );
		$post_types_select_options = array();
		foreach ( $post_types_with_ui as $post_type ) {
			$post_types_select_options[] = array(
				'value' => $post_type,
				'text'  => $post_type,
			);
		}

		// Get the default values for the "SpeechSynthesis (Web Speech API) -> Languages" option.
		$speech_synthesis_api_lang = array(
			array(
				'value' => '',
				'text'  => 'Auto',
			),
			array(
				'value' => 'ar-SA',
				'text'  => 'ar-SA',
			),
			array(
				'value' => 'bn-BD',
				'text'  => 'bn-BD',
			),
			array(
				'value' => 'bn-IN',
				'text'  => 'bn-IN',
			),
			array(
				'value' => 'cs-CZ',
				'text'  => 'cs-CZ',
			),
			array(
				'value' => 'da-DK',
				'text'  => 'da-DK',
			),
			array(
				'value' => 'de-AT',
				'text'  => 'de-AT',
			),
			array(
				'value' => 'de-CH',
				'text'  => 'de-CH',
			),
			array(
				'value' => 'de-DE',
				'text'  => 'de-DE',
			),
			array(
				'value' => 'el-GR',
				'text'  => 'el-GR',
			),
			array(
				'value' => 'en-AU',
				'text'  => 'en-AU',
			),
			array(
				'value' => 'en-CA',
				'text'  => 'en-CA',
			),
			array(
				'value' => 'en-GB',
				'text'  => 'en-GB',
			),
			array(
				'value' => 'en-IE',
				'text'  => 'en-IE',
			),
			array(
				'value' => 'en-IN',
				'text'  => 'en-IN',
			),
			array(
				'value' => 'en-NZ',
				'text'  => 'en-NZ',
			),
			array(
				'value' => 'en-US',
				'text'  => 'en-US',
			),
			array(
				'value' => 'en-ZA',
				'text'  => 'en-ZA',
			),
			array(
				'value' => 'es-AR',
				'text'  => 'es-AR',
			),
			array(
				'value' => 'es-CL',
				'text'  => 'es-CL',
			),
			array(
				'value' => 'es-CO',
				'text'  => 'es-CO',
			),
			array(
				'value' => 'es-ES',
				'text'  => 'es-ES',
			),
			array(
				'value' => 'es-MX',
				'text'  => 'es-MX',
			),
			array(
				'value' => 'es-US',
				'text'  => 'es-US',
			),
			array(
				'value' => 'fi-FI',
				'text'  => 'fi-FI',
			),
			array(
				'value' => 'fr-BE',
				'text'  => 'fr-BE',
			),
			array(
				'value' => 'fr-CA',
				'text'  => 'fr-CA',
			),
			array(
				'value' => 'fr-CH',
				'text'  => 'fr-CH',
			),
			array(
				'value' => 'fr-FR',
				'text'  => 'fr-FR',
			),
			array(
				'value' => 'he-IL',
				'text'  => 'he-IL',
			),
			array(
				'value' => 'hi-IN',
				'text'  => 'hi-IN',
			),
			array(
				'value' => 'hu-HU',
				'text'  => 'hu-HU',
			),
			array(
				'value' => 'id-ID',
				'text'  => 'id-ID',
			),
			array(
				'value' => 'it-CH',
				'text'  => 'it-CH',
			),
			array(
				'value' => 'it-IT',
				'text'  => 'it-IT',
			),
			array(
				'value' => 'jp-JP',
				'text'  => 'jp-JP',
			),
			array(
				'value' => 'ko-KR',
				'text'  => 'ko-KR',
			),
			array(
				'value' => 'nl-BE',
				'text'  => 'nl-BE',
			),
			array(
				'value' => 'nl-NL',
				'text'  => 'nl-NL',
			),
			array(
				'value' => 'no-NO',
				'text'  => 'no-NO',
			),
			array(
				'value' => 'pl-PL',
				'text'  => 'pl-PL',
			),
			array(
				'value' => 'pt-BR',
				'text'  => 'pt-BR',
			),
			array(
				'value' => 'pt-PT',
				'text'  => 'pt-PT',
			),
			array(
				'value' => 'ro-RO',
				'text'  => 'ro-RO',
			),
			array(
				'value' => 'ru-RU',
				'text'  => 'ru-RU',
			),
			array(
				'value' => 'sk-SK',
				'text'  => 'sk-SK',
			),
			array(
				'value' => 'sv-SE',
				'text'  => 'sv-SE',
			),
			array(
				'value' => 'ta-IN',
				'text'  => 'ta-IN',
			),
			array(
				'value' => 'ta-LK',
				'text'  => 'ta-LK',
			),
			array(
				'value' => 'th-TH',
				'text'  => 'th-TH',
			),
			array(
				'value' => 'tr-TR',
				'text'  => 'tr-TR',
			),
			array(
				'value' => 'zh-CN',
				'text'  => 'zh-CN',
			),
			array(
				'value' => 'zh-HK',
				'text'  => 'zh-HK',
			),
			array(
				'value' => 'zh-TW',
				'text'  => 'zh-TW',
			),
		);

		// Get the values for the "Advanced -> Voices" option.
		$speech_synthesis_api_voice = array(
			array(
				'value' => '',
				'text'  => 'Auto',
			),
			array(
				'value' => 'Daniel',
				'text'  => 'Daniel',
			),
			array(
				'value' => 'Albert',
				'text'  => 'Albert',
			),
			array(
				'value' => 'Alice',
				'text'  => 'Alice',
			),
			array(
				'value' => 'Alva',
				'text'  => 'Alva',
			),
			array(
				'value' => 'Amélie',
				'text'  => 'Amélie',
			),
			array(
				'value' => 'Amira',
				'text'  => 'Amira',
			),
			array(
				'value' => 'Anna',
				'text'  => 'Anna',
			),
			array(
				'value' => 'Bad News',
				'text'  => 'Bad News',
			),
			array(
				'value' => 'Bahh',
				'text'  => 'Bahh',
			),
			array(
				'value' => 'Bells',
				'text'  => 'Bells',
			),
			array(
				'value' => 'Boing',
				'text'  => 'Boing',
			),
			array(
				'value' => 'Bubbles',
				'text'  => 'Bubbles',
			),
			array(
				'value' => 'Carmit',
				'text'  => 'Carmit',
			),
			array(
				'value' => 'Cellos',
				'text'  => 'Cellos',
			),
			array(
				'value' => 'Damayanti',
				'text'  => 'Damayanti',
			),
			array(
				'value' => 'Daria',
				'text'  => 'Daria',
			),
			array(
				'value' => 'Wobble',
				'text'  => 'Wobble',
			),
			array(
				'value' => 'Eddy (German (Germany))',
				'text'  => 'Eddy (German (Germany))',
			),
			array(
				'value' => 'Eddy (English (UK))',
				'text'  => 'Eddy (English (UK)) ',
			),
			array(
				'value' => 'Eddy (English (US))',
				'text'  => 'Eddy (English (US))',
			),
			array(
				'value' => 'Eddy (Spanish (Spain))',
				'text'  => 'Eddy (Spanish (Spain))',
			),
			array(
				'value' => 'Eddy (Spanish (Mexico))',
				'text'  => 'Eddy (Spanish (Mexico))',
			),
			array(
				'value' => 'Eddy (Finnish (Finland))',
				'text'  => 'Eddy (Finnish (Finland))',
			),
			array(
				'value' => 'Eddy (French (Canada))',
				'text'  => 'Eddy (French (Canada))',
			),
			array(
				'value' => 'Eddy (French (France))',
				'text'  => 'Eddy (French (France))',
			),
			array(
				'value' => 'Eddy (Italian (Italy))',
				'text'  => 'Eddy (Italian (Italy))',
			),
			array(
				'value' => 'Eddy (Portuguese (Brazil))',
				'text'  => 'Eddy (Portuguese (Brazil))',
			),
			array(
				'value' => 'Ellen',
				'text'  => 'Ellen',
			),
			array(
				'value' => 'Flo (German (Germany))',
				'text'  => 'Flo (German (Germany))',
			),
			array(
				'value' => 'Flo (English (UK))',
				'text'  => 'Flo (English (UK))',
			),
			array(
				'value' => 'Flo (English (US))',
				'text'  => 'Flo (English (US))',
			),
			array(
				'value' => 'Flo (Spanish (Spain))',
				'text'  => 'Flo (Spanish (Spain))',
			),
			array(
				'value' => 'Flo (Spanish (Mexico))',
				'text'  => 'Flo (Spanish (Mexico))',
			),
			array(
				'value' => 'Flo (Finnish (Finland))',
				'text'  => 'Flo (Finnish (Finland))',
			),
			array(
				'value' => 'Flo (French (Canada))',
				'text'  => 'Flo (French (Canada))',
			),
			array(
				'value' => 'Flo (French (France))',
				'text'  => 'Flo (French (France))',
			),
			array(
				'value' => 'Flo (Italian (Italy))',
				'text'  => 'Flo (Italian (Italy))',
			),
			array(
				'value' => 'Flo (Portuguese (Brazil))',
				'text'  => 'Flo (Portuguese (Brazil))',
			),
			array(
				'value' => 'Fred',
				'text'  => 'Fred',
			),
			array(
				'value' => 'Good News',
				'text'  => 'Good News',
			),
			array(
				'value' => 'Grandma (German (Germany))',
				'text'  => 'Grandma (German (Germany))',
			),
			array(
				'value' => 'Grandma (English (UK))',
				'text'  => 'Grandma (English (UK))',
			),
			array(
				'value' => 'Grandma (English (US))',
				'text'  => 'Grandma (English (US))',
			),
			array(
				'value' => 'Grandma (Spanish (Spain))',
				'text'  => 'Grandma (Spanish (Spain))',
			),
			array(
				'value' => 'Grandma (Spanish (Mexico))',
				'text'  => 'Grandma (Spanish (Mexico))',
			),
			array(
				'value' => 'Grandma (Finnish (Finland))',
				'text'  => 'Grandma (Finnish (Finland))',
			),
			array(
				'value' => 'Grandma (French (Canada))',
				'text'  => 'Grandma (French (Canada))',
			),
			array(
				'value' => 'Grandma (French (France))',
				'text'  => 'Grandma (French (France))',
			),
			array(
				'value' => 'Grandma (Italian (Italy))',
				'text'  => 'Grandma (Italian (Italy))',
			),
			array(
				'value' => 'Grandma (Portuguese (Brazil))',
				'text'  => 'Grandma (Portuguese (Brazil))',
			),
			array(
				'value' => 'Grandpa (German (Germany))',
				'text'  => 'Grandpa (German (Germany))',
			),
			array(
				'value' => 'Grandpa (English (UK))',
				'text'  => 'Grandpa (English (UK))',
			),
			array(
				'value' => 'Grandpa (English (US))',
				'text'  => 'Grandpa (English (US))',
			),
			array(
				'value' => 'Grandpa (Spanish (Spain))',
				'text'  => 'Grandpa (Spanish (Spain))',
			),
			array(
				'value' => 'Grandpa (Spanish (Mexico))',
				'text'  => 'Grandpa (Spanish (Mexico))',
			),
			array(
				'value' => 'Grandpa (Finnish (Finland))',
				'text'  => 'Grandpa (Finnish (Finland))',
			),
			array(
				'value' => 'Grandpa (French (Canada))',
				'text'  => 'Grandpa (French (Canada))',
			),
			array(
				'value' => 'Grandpa (French (France))',
				'text'  => 'Grandpa (French (France))',
			),
			array(
				'value' => 'Grandpa (Italian (Italy))',
				'text'  => 'Grandpa (Italian (Italy))',
			),
			array(
				'value' => 'Grandpa (Portuguese (Brazil))',
				'text'  => 'Grandpa (Portuguese (Brazil))',
			),
			array(
				'value' => 'Jester',
				'text'  => 'Jester',
			),
			array(
				'value' => 'Ioana',
				'text'  => 'Ioana',
			),
			array(
				'value' => 'Jacques',
				'text'  => 'Jacques',
			),
			array(
				'value' => 'Joana',
				'text'  => 'Joana',
			),
			array(
				'value' => 'Junior',
				'text'  => 'Junior',
			),
			array(
				'value' => 'Kanya',
				'text'  => 'Kanya',
			),
			array(
				'value' => 'Karen',
				'text'  => 'Karen',
			),
			array(
				'value' => 'Kathy',
				'text'  => 'Kathy',
			),
			array(
				'value' => 'Kyoko',
				'text'  => 'Kyoko',
			),
			array(
				'value' => 'Lana',
				'text'  => 'Lana',
			),
			array(
				'value' => 'Laura',
				'text'  => 'Laura',
			),
			array(
				'value' => 'Lekha',
				'text'  => 'Lekha',
			),
			array(
				'value' => 'Lesya',
				'text'  => 'Lesya',
			),
			array(
				'value' => 'Linh',
				'text'  => 'Linh',
			),
			array(
				'value' => 'Luciana',
				'text'  => 'Luciana',
			),
			array(
				'value' => 'Majed',
				'text'  => 'Majed',
			),
			array(
				'value' => 'Tünde',
				'text'  => 'Tünde',
			),
			array(
				'value' => 'Meijia',
				'text'  => 'Meijia',
			),
			array(
				'value' => 'Melina',
				'text'  => 'Melina',
			),
			array(
				'value' => 'Milena',
				'text'  => 'Milena',
			),
			array(
				'value' => 'Moira',
				'text'  => 'Moira',
			),
			array(
				'value' => 'Mónica',
				'text'  => 'Mónica',
			),
			array(
				'value' => 'Montse',
				'text'  => 'Montse',
			),
			array(
				'value' => 'Nora',
				'text'  => 'Nora',
			),
			array(
				'value' => 'Organ',
				'text'  => 'Organ',
			),
			array(
				'value' => 'Paulina',
				'text'  => 'Paulina',
			),
			array(
				'value' => 'Superstar',
				'text'  => 'Superstar',
			),
			array(
				'value' => 'Ralph',
				'text'  => 'Ralph',
			),
			array(
				'value' => 'Reed (German (Germany))',
				'text'  => 'Reed (German (Germany))',
			),
			array(
				'value' => 'Reed (English (UK))',
				'text'  => 'Reed (English (UK))',
			),
			array(
				'value' => 'Reed (English (US))',
				'text'  => 'Reed (English (US))',
			),
			array(
				'value' => 'Reed (Spanish (Spain))',
				'text'  => 'Reed (Spanish (Spain))',
			),
			array(
				'value' => 'Reed (Spanish (Mexico))',
				'text'  => 'Reed (Spanish (Mexico))',
			),
			array(
				'value' => 'Reed (Finnish (Finland))',
				'text'  => 'Reed (Finnish (Finland))',
			),
			array(
				'value' => 'Reed (French (Canada))',
				'text'  => 'Reed (French (Canada))',
			),
			array(
				'value' => 'Reed (Italian (Italy))',
				'text'  => 'Reed (Italian (Italy))',
			),
			array(
				'value' => 'Reed (Portuguese (Brazil))',
				'text'  => 'Reed (Portuguese (Brazil))',
			),
			array(
				'value' => 'Rishi',
				'text'  => 'Rishi',
			),
			array(
				'value' => 'Rocko (German (Germany))',
				'text'  => 'Rocko (German (Germany))',
			),
			array(
				'value' => 'Rocko (English (UK))',
				'text'  => 'Rocko (English (UK))',
			),
			array(
				'value' => 'Rocko (English (US))',
				'text'  => 'Rocko (English (US))',
			),
			array(
				'value' => 'Rocko (Spanish (Spain))',
				'text'  => 'Rocko (Spanish (Spain))',
			),
			array(
				'value' => 'Rocko (Spanish (Mexico))',
				'text'  => 'Rocko (Spanish (Mexico))',
			),
			array(
				'value' => 'Rocko (Finnish (Finland))',
				'text'  => 'Rocko (Finnish (Finland))',
			),
			array(
				'value' => 'Rocko (French (Canada))',
				'text'  => 'Rocko (French (Canada))',
			),
			array(
				'value' => 'Rocko (French (France))',
				'text'  => 'Rocko (French (France))',
			),
			array(
				'value' => 'Rocko (Italian (Italy))',
				'text'  => 'Rocko (Italian (Italy))',
			),
			array(
				'value' => 'Rocko (Portuguese (Brazil))',
				'text'  => 'Rocko (Portuguese (Brazil))',
			),
			array(
				'value' => 'Samantha',
				'text'  => 'Samantha',
			),
			array(
				'value' => 'Sandy (German (Germany))',
				'text'  => 'Sandy (German (Germany))',
			),
			array(
				'value' => 'Sandy (English (UK))',
				'text'  => 'Sandy (English (UK))',
			),
			array(
				'value' => 'Sandy (English (US))',
				'text'  => 'Sandy (English (US))',
			),
			array(
				'value' => 'Sandy (Spanish (Spain))',
				'text'  => 'Sandy (Spanish (Spain))',
			),
			array(
				'value' => 'Sandy (Spanish (Mexico))',
				'text'  => 'Sandy (Spanish (Mexico))',
			),
			array(
				'value' => 'Sandy (Finnish (Finland))',
				'text'  => 'Sandy (Finnish (Finland))',
			),
			array(
				'value' => 'Sandy (French (Canada))',
				'text'  => 'Sandy (French (Canada))',
			),
			array(
				'value' => 'Sandy (French (France))',
				'text'  => 'Sandy (French (France))',
			),
			array(
				'value' => 'Sandy (Italian (Italy))',
				'text'  => 'Sandy (Italian (Italy))',
			),
			array(
				'value' => 'Sandy (Portuguese (Brazil))',
				'text'  => 'Sandy (Portuguese (Brazil))',
			),
			array(
				'value' => 'Sara',
				'text'  => 'Sara',
			),
			array(
				'value' => 'Satu',
				'text'  => 'Satu',
			),
			array(
				'value' => 'Shelley (German (Germany))',
				'text'  => 'Shelley (German (Germany))',
			),
			array(
				'value' => 'Shelley (English (UK))',
				'text'  => 'Shelley (English (UK))',
			),
			array(
				'value' => 'Shelley (English (US))',
				'text'  => 'Shelley (English (US))',
			),
			array(
				'value' => 'Shelley (Spanish (Spain))',
				'text'  => 'Shelley (Spanish (Spain))',
			),
			array(
				'value' => 'Shelley (Spanish (Mexico))',
				'text'  => 'Shelley (Spanish (Mexico))',
			),
			array(
				'value' => 'Shelley (Finnish (Finland))',
				'text'  => 'Shelley (Finnish (Finland))',
			),
			array(
				'value' => 'Shelley (French (Canada))',
				'text'  => 'Shelley (French (Canada))',
			),
			array(
				'value' => 'Shelley (French (France))',
				'text'  => 'Shelley (French (France))',
			),
			array(
				'value' => 'Shelley (Italian (Italy))',
				'text'  => 'Shelley (Italian (Italy))',
			),
			array(
				'value' => 'Shelley (Portuguese (Brazil))',
				'text'  => 'Shelley (Portuguese (Brazil))',
			),
			array(
				'value' => 'Sinji',
				'text'  => 'Sinji',
			),
			array(
				'value' => 'Tessa',
				'text'  => 'Tessa',
			),
			array(
				'value' => 'Thomas',
				'text'  => 'Thomas',
			),
			array(
				'value' => 'Tingting',
				'text'  => 'Tingting',
			),
			array(
				'value' => 'Trinoids',
				'text'  => 'Trinoids',
			),
			array(
				'value' => 'Whisper',
				'text'  => 'Whisper',
			),
			array(
				'value' => 'Xander',
				'text'  => 'Xander',
			),
			array(
				'value' => 'Yelda',
				'text'  => 'Yelda',
			),
			array(
				'value' => 'Yuna',
				'text'  => 'Yuna',
			),
			array(
				'value' => 'Zarvox',
				'text'  => 'Zarvox',
			),
			array(
				'value' => 'Zosia',
				'text'  => 'Zosia',
			),
			array(
				'value' => 'Zuzana',
				'text'  => 'Zuzana',
			),
			array(
				'value' => 'Google Deutsch',
				'text'  => 'Google Deutsch',
			),
			array(
				'value' => 'Google US English',
				'text'  => 'Google US English',
			),
			array(
				'value' => 'Google UK English Female',
				'text'  => 'Google UK English Female',
			),
			array(
				'value' => 'Google UK English Male',
				'text'  => 'Google UK English Male',
			),
			array(
				'value' => 'Google español',
				'text'  => 'Google español',
			),
			array(
				'value' => 'Google español de Estados Unidos',
				'text'  => 'Google español de Estados Unidos',
			),
			array(
				'value' => 'Google français',
				'text'  => 'Google français',
			),
			array(
				'value' => 'Google हिन्दी',
				'text'  => 'Google हिन्दी',
			),
			array(
				'value' => 'Google Bahasa Indonesia',
				'text'  => 'Google Bahasa Indonesia',
			),
			array(
				'value' => 'Google italiano',
				'text'  => 'Google italiano',
			),
			array(
				'value' => 'Google 日本語',
				'text'  => 'Google 日本語',
			),
			array(
				'value' => 'Google 한국의',
				'text'  => 'Google 한국의',
			),
			array(
				'value' => 'Google Nederlands',
				'text'  => 'Google Nederlands',
			),
			array(
				'value' => 'Google polski',
				'text'  => 'Google polski',
			),
			array(
				'value' => 'Google português do Brasil',
				'text'  => 'Google português do Brasil',
			),
			array(
				'value' => 'Google русский',
				'text'  => 'Google русский',
			),
			array(
				'value' => 'Google 普通话（中国大陆）',
				'text'  => 'Google 普通话（中国大陆）',
			),
			array(
				'value' => 'Google 粤語（香港）',
				'text'  => 'Google 粤語（香港）',
			),
			array(
				'value' => 'Google 國語（臺灣）',
				'text'  => 'Google 國語（臺灣）',
			),
		);

		// Get the values of the "Google Cloud Text-to-speech -> Language Code" option.
		$google_cloud_language_code = array(
			array(
				'value' => 'af-ZA',
				'text'  => 'af-ZA',
			),
			array(
				'value' => 'ar-XA',
				'text'  => 'ar-XA',
			),
			array(
				'value' => 'eu-ES',
				'text'  => 'eu-ES',
			),
			array(
				'value' => 'bn-IN',
				'text'  => 'bn-IN',
			),
			array(
				'value' => 'bg-BG',
				'text'  => 'bg-BG',
			),
			array(
				'value' => 'ca-ES',
				'text'  => 'ca-ES',
			),
			array(
				'value' => 'yue-HK',
				'text'  => 'yue-HK',
			),
			array(
				'value' => 'cs-CZ',
				'text'  => 'cs-CZ',
			),
			array(
				'value' => 'da-DK',
				'text'  => 'da-DK',
			),
			array(
				'value' => 'nl-BE',
				'text'  => 'nl-BE',
			),
			array(
				'value' => 'nl-NL',
				'text'  => 'nl-NL',
			),
			array(
				'value' => 'en-AU',
				'text'  => 'en-AU',
			),
			array(
				'value' => 'en-IN',
				'text'  => 'en-IN',
			),
			array(
				'value' => 'en-GB',
				'text'  => 'en-GB',
			),
			array(
				'value' => 'en-US',
				'text'  => 'en-US',
			),
			array(
				'value' => 'fil-PH',
				'text'  => 'fil-PH',
			),
			array(
				'value' => 'fi-FI',
				'text'  => 'fi-FI',
			),
			array(
				'value' => 'fr-CA',
				'text'  => 'fr-CA',
			),
			array(
				'value' => 'fr-FR',
				'text'  => 'fr-FR',
			),
			array(
				'value' => 'gl-ES',
				'text'  => 'gl-ES',
			),
			array(
				'value' => 'de-DE',
				'text'  => 'de-DE',
			),
			array(
				'value' => 'el-GR',
				'text'  => 'el-GR',
			),
			array(
				'value' => 'gu-IN',
				'text'  => 'gu-IN',
			),
			array(
				'value' => 'he-IL',
				'text'  => 'he-IL',
			),
			array(
				'value' => 'hu-HU',
				'text'  => 'hu-HU',
			),
			array(
				'value' => 'is-IS',
				'text'  => 'is-IS',
			),
			array(
				'value' => 'id-ID',
				'text'  => 'id-ID',
			),
			array(
				'value' => 'it-IT',
				'text'  => 'it-IT',
			),
			array(
				'value' => 'ja-JP',
				'text'  => 'ja-JP',
			),
			array(
				'value' => 'kn-IN',
				'text'  => 'kn-IN',
			),
			array(
				'value' => 'ko-KR',
				'text'  => 'ko-KR',
			),
			array(
				'value' => 'lv-LV',
				'text'  => 'lv-LV',
			),
			array(
				'value' => 'lt-LT',
				'text'  => 'lt-LT',
			),
			array(
				'value' => 'ms-MY',
				'text'  => 'ms-MY',
			),
			array(
				'value' => 'ml-IN',
				'text'  => 'ml-IN',
			),
			array(
				'value' => 'cmn-CN',
				'text'  => 'cmn-CN',
			),
			array(
				'value' => 'cmn-TW',
				'text'  => 'cmn-TW',
			),
			array(
				'value' => 'mr-IN',
				'text'  => 'mr-IN',
			),
			array(
				'value' => 'nb-NO',
				'text'  => 'nb-NO',
			),
			array(
				'value' => 'pl-PL',
				'text'  => 'pl-PL',
			),
			array(
				'value' => 'pt-BR',
				'text'  => 'pt-BR',
			),
			array(
				'value' => 'pt-PT',
				'text'  => 'pt-PT',
			),
			array(
				'value' => 'pa-IN',
				'text'  => 'pa-IN',
			),
			array(
				'value' => 'ro-RO',
				'text'  => 'ro-RO',
			),
			array(
				'value' => 'ru-RU',
				'text'  => 'ru-RU',
			),
			array(
				'value' => 'sr-RS',
				'text'  => 'sr-RS',
			),
			array(
				'value' => 'sk-SK',
				'text'  => 'sk-SK',
			),
			array(
				'value' => 'es-ES',
				'text'  => 'es-ES',
			),
			array(
				'value' => 'es-US',
				'text'  => 'es-US',
			),
			array(
				'value' => 'sv-SE',
				'text'  => 'sv-SE',
			),
			array(
				'value' => 'ta-IN',
				'text'  => 'ta-IN',
			),
			array(
				'value' => 'te-IN',
				'text'  => 'te-IN',
			),
			array(
				'value' => 'th-TH',
				'text'  => 'th-TH',
			),
			array(
				'value' => 'tr-TR',
				'text'  => 'tr-TR',
			),
			array(
				'value' => 'uk-UA',
				'text'  => 'uk-UA',
			),
			array(
				'value' => 'vi-VN',
				'text'  => 'vi-VN',
			),
		);

		// Get the value of the "Google Cloud Text-to-speech -> Voice Name" option.
		$google_cloud_voice_name = array(
			array(
				'value' => 'af-ZA-Standard-A',
				'text'  => 'af-ZA-Standard-A',
			),
			array(
				'value' => 'ar-XA-Standard-A',
				'text'  => 'ar-XA-Standard-A',
			),
			array(
				'value' => 'ar-XA-Standard-B',
				'text'  => 'ar-XA-Standard-B',
			),
			array(
				'value' => 'ar-XA-Standard-C',
				'text'  => 'ar-XA-Standard-C',
			),
			array(
				'value' => 'ar-XA-Standard-D',
				'text'  => 'ar-XA-Standard-D',
			),
			array(
				'value' => 'ar-XA-Wavenet-A',
				'text'  => 'ar-XA-Wavenet-A',
			),
			array(
				'value' => 'ar-XA-Wavenet-B',
				'text'  => 'ar-XA-Wavenet-B',
			),
			array(
				'value' => 'ar-XA-Wavenet-C',
				'text'  => 'ar-XA-Wavenet-C',
			),
			array(
				'value' => 'ar-XA-Wavenet-D',
				'text'  => 'ar-XA-Wavenet-D',
			),
			array(
				'value' => 'eu-ES-Standard-A',
				'text'  => 'eu-ES-Standard-A',
			),
			array(
				'value' => 'bn-IN-Standard-A',
				'text'  => 'bn-IN-Standard-A',
			),
			array(
				'value' => 'bn-IN-Standard-B',
				'text'  => 'bn-IN-Standard-B',
			),
			array(
				'value' => 'bn-IN-Wavenet-A',
				'text'  => 'bn-IN-Wavenet-A',
			),
			array(
				'value' => 'bn-IN-Wavenet-B',
				'text'  => 'bn-IN-Wavenet-B',
			),
			array(
				'value' => 'bg-BG-Standard-A',
				'text'  => 'bg-BG-Standard-A',
			),
			array(
				'value' => 'ca-ES-Standard-A',
				'text'  => 'ca-ES-Standard-A',
			),
			array(
				'value' => 'yue-HK-Standard-A',
				'text'  => 'yue-HK-Standard-A',
			),
			array(
				'value' => 'yue-HK-Standard-B',
				'text'  => 'yue-HK-Standard-B',
			),
			array(
				'value' => 'yue-HK-Standard-C',
				'text'  => 'yue-HK-Standard-C',
			),
			array(
				'value' => 'yue-HK-Standard-D',
				'text'  => 'yue-HK-Standard-D',
			),
			array(
				'value' => 'cs-CZ-Standard-A',
				'text'  => 'cs-CZ-Standard-A',
			),
			array(
				'value' => 'cs-CZ-Wavenet-A',
				'text'  => 'cs-CZ-Wavenet-A',
			),
			array(
				'value' => 'da-DK-Neural2-D',
				'text'  => 'da-DK-Neural2-D',
			),
			array(
				'value' => 'da-DK-Standard-A',
				'text'  => 'da-DK-Standard-A',
			),
			array(
				'value' => 'da-DK-Standard-C',
				'text'  => 'da-DK-Standard-C',
			),
			array(
				'value' => 'da-DK-Standard-D',
				'text'  => 'da-DK-Standard-D',
			),
			array(
				'value' => 'da-DK-Standard-E',
				'text'  => 'da-DK-Standard-E',
			),
			array(
				'value' => 'da-DK-Wavenet-A',
				'text'  => 'da-DK-Wavenet-A',
			),
			array(
				'value' => 'da-DK-Wavenet-C',
				'text'  => 'da-DK-Wavenet-C',
			),
			array(
				'value' => 'da-DK-Wavenet-D',
				'text'  => 'da-DK-Wavenet-D',
			),
			array(
				'value' => 'da-DK-Wavenet-E',
				'text'  => 'da-DK-Wavenet-E',
			),
			array(
				'value' => 'nl-BE-Standard-A',
				'text'  => 'nl-BE-Standard-A',
			),
			array(
				'value' => 'nl-BE-Standard-B',
				'text'  => 'nl-BE-Standard-B',
			),
			array(
				'value' => 'nl-BE-Wavenet-A',
				'text'  => 'nl-BE-Wavenet-A',
			),
			array(
				'value' => 'nl-BE-Wavenet-B',
				'text'  => 'nl-BE-Wavenet-B',
			),
			array(
				'value' => 'nl-NL-Standard-A',
				'text'  => 'nl-NL-Standard-A',
			),
			array(
				'value' => 'nl-NL-Standard-B',
				'text'  => 'nl-NL-Standard-B',
			),
			array(
				'value' => 'nl-NL-Standard-C',
				'text'  => 'nl-NL-Standard-C',
			),
			array(
				'value' => 'nl-NL-Standard-D',
				'text'  => 'nl-NL-Standard-D',
			),
			array(
				'value' => 'nl-NL-Standard-E',
				'text'  => 'nl-NL-Standard-E',
			),
			array(
				'value' => 'nl-NL-Wavenet-A',
				'text'  => 'nl-NL-Wavenet-A',
			),
			array(
				'value' => 'nl-NL-Wavenet-B',
				'text'  => 'nl-NL-Wavenet-B',
			),
			array(
				'value' => 'nl-NL-Wavenet-C',
				'text'  => 'nl-NL-Wavenet-C',
			),
			array(
				'value' => 'nl-NL-Wavenet-D',
				'text'  => 'nl-NL-Wavenet-D',
			),
			array(
				'value' => 'nl-NL-Wavenet-E',
				'text'  => 'nl-NL-Wavenet-E',
			),
			array(
				'value' => 'en-AU-Neural2-A',
				'text'  => 'en-AU-Neural2-A',
			),
			array(
				'value' => 'en-AU-Neural2-B',
				'text'  => 'en-AU-Neural2-B',
			),
			array(
				'value' => 'en-AU-Neural2-C',
				'text'  => 'en-AU-Neural2-C',
			),
			array(
				'value' => 'en-AU-Neural2-D',
				'text'  => 'en-AU-Neural2-D',
			),
			array(
				'value' => 'en-AU-News-E',
				'text'  => 'en-AU-News-E',
			),
			array(
				'value' => 'en-AU-News-F',
				'text'  => 'en-AU-News-F',
			),
			array(
				'value' => 'en-AU-News-G',
				'text'  => 'en-AU-News-G',
			),
			array(
				'value' => 'en-AU-Polyglot-1',
				'text'  => 'en-AU-Polyglot-1',
			),
			array(
				'value' => 'en-AU-Standard-A',
				'text'  => 'en-AU-Standard-A',
			),
			array(
				'value' => 'en-AU-Standard-B',
				'text'  => 'en-AU-Standard-B',
			),
			array(
				'value' => 'en-AU-Standard-C',
				'text'  => 'en-AU-Standard-C',
			),
			array(
				'value' => 'en-AU-Standard-D',
				'text'  => 'en-AU-Standard-D',
			),
			array(
				'value' => 'en-AU-Wavenet-A',
				'text'  => 'en-AU-Wavenet-A',
			),
			array(
				'value' => 'en-AU-Wavenet-B',
				'text'  => 'en-AU-Wavenet-B',
			),
			array(
				'value' => 'en-AU-Wavenet-C',
				'text'  => 'en-AU-Wavenet-C',
			),
			array(
				'value' => 'en-AU-Wavenet-D',
				'text'  => 'en-AU-Wavenet-D',
			),
			array(
				'value' => 'en-IN-Standard-A',
				'text'  => 'en-IN-Standard-A',
			),
			array(
				'value' => 'en-IN-Standard-B',
				'text'  => 'en-IN-Standard-B',
			),
			array(
				'value' => 'en-IN-Standard-C',
				'text'  => 'en-IN-Standard-C',
			),
			array(
				'value' => 'en-IN-Standard-D',
				'text'  => 'en-IN-Standard-D',
			),
			array(
				'value' => 'en-IN-Wavenet-A',
				'text'  => 'en-IN-Wavenet-A',
			),
			array(
				'value' => 'en-IN-Wavenet-B',
				'text'  => 'en-IN-Wavenet-B',
			),
			array(
				'value' => 'en-IN-Wavenet-C',
				'text'  => 'en-IN-Wavenet-C',
			),
			array(
				'value' => 'en-IN-Wavenet-D',
				'text'  => 'en-IN-Wavenet-D',
			),
			array(
				'value' => 'en-GB-Neural2-A',
				'text'  => 'en-GB-Neural2-A',
			),
			array(
				'value' => 'en-GB-Neural2-B',
				'text'  => 'en-GB-Neural2-B',
			),
			array(
				'value' => 'en-GB-Neural2-C',
				'text'  => 'en-GB-Neural2-C',
			),
			array(
				'value' => 'en-GB-Neural2-D',
				'text'  => 'en-GB-Neural2-D',
			),
			array(
				'value' => 'en-GB-Neural2-F',
				'text'  => 'en-GB-Neural2-F',
			),
			array(
				'value' => 'en-GB-News-G',
				'text'  => 'en-GB-News-G',
			),
			array(
				'value' => 'en-GB-News-H',
				'text'  => 'en-GB-News-H',
			),
			array(
				'value' => 'en-GB-News-I',
				'text'  => 'en-GB-News-I',
			),
			array(
				'value' => 'en-GB-News-J',
				'text'  => 'en-GB-News-J',
			),
			array(
				'value' => 'en-GB-News-K',
				'text'  => 'en-GB-News-K',
			),
			array(
				'value' => 'en-GB-News-L',
				'text'  => 'en-GB-News-L',
			),
			array(
				'value' => 'en-GB-News-M',
				'text'  => 'en-GB-News-M',
			),
			array(
				'value' => 'en-GB-Standard-A',
				'text'  => 'en-GB-Standard-A',
			),
			array(
				'value' => 'en-GB-Standard-B',
				'text'  => 'en-GB-Standard-B',
			),
			array(
				'value' => 'en-GB-Standard-C',
				'text'  => 'en-GB-Standard-C',
			),
			array(
				'value' => 'en-GB-Standard-D',
				'text'  => 'en-GB-Standard-D',
			),
			array(
				'value' => 'en-GB-Standard-F',
				'text'  => 'en-GB-Standard-F',
			),
			array(
				'value' => 'en-GB-Wavenet-A',
				'text'  => 'en-GB-Wavenet-A',
			),
			array(
				'value' => 'en-GB-Wavenet-B',
				'text'  => 'en-GB-Wavenet-B',
			),
			array(
				'value' => 'en-GB-Wavenet-C',
				'text'  => 'en-GB-Wavenet-C',
			),
			array(
				'value' => 'en-GB-Wavenet-D',
				'text'  => 'en-GB-Wavenet-D',
			),
			array(
				'value' => 'en-GB-Wavenet-F',
				'text'  => 'en-GB-Wavenet-F',
			),
			array(
				'value' => 'en-US-Neural2-A',
				'text'  => 'en-US-Neural2-A',
			),
			array(
				'value' => 'en-US-Neural2-C',
				'text'  => 'en-US-Neural2-C',
			),
			array(
				'value' => 'en-US-Neural2-D',
				'text'  => 'en-US-Neural2-D',
			),
			array(
				'value' => 'en-US-Neural2-E',
				'text'  => 'en-US-Neural2-E',
			),
			array(
				'value' => 'en-US-Neural2-F',
				'text'  => 'en-US-Neural2-F',
			),
			array(
				'value' => 'en-US-Neural2-G',
				'text'  => 'en-US-Neural2-G',
			),
			array(
				'value' => 'en-US-Neural2-H',
				'text'  => 'en-US-Neural2-H',
			),
			array(
				'value' => 'en-US-Neural2-I',
				'text'  => 'en-US-Neural2-I',
			),
			array(
				'value' => 'en-US-Neural2-J',
				'text'  => 'en-US-Neural2-J',
			),
			array(
				'value' => 'en-US-News-K',
				'text'  => 'en-US-News-K',
			),
			array(
				'value' => 'en-US-News-L',
				'text'  => 'en-US-News-L',
			),
			array(
				'value' => 'en-US-News-M',
				'text'  => 'en-US-News-M',
			),
			array(
				'value' => 'en-US-News-N',
				'text'  => 'en-US-News-N',
			),
			array(
				'value' => 'en-US-Polyglot-1',
				'text'  => 'en-US-Polyglot-1',
			),
			array(
				'value' => 'en-US-Standard-A',
				'text'  => 'en-US-Standard-A',
			),
			array(
				'value' => 'en-US-Standard-B',
				'text'  => 'en-US-Standard-B',
			),
			array(
				'value' => 'en-US-Standard-C',
				'text'  => 'en-US-Standard-C',
			),
			array(
				'value' => 'en-US-Standard-D',
				'text'  => 'en-US-Standard-D',
			),
			array(
				'value' => 'en-US-Standard-E',
				'text'  => 'en-US-Standard-E',
			),
			array(
				'value' => 'en-US-Standard-F',
				'text'  => 'en-US-Standard-F',
			),
			array(
				'value' => 'en-US-Standard-G',
				'text'  => 'en-US-Standard-G',
			),
			array(
				'value' => 'en-US-Standard-H',
				'text'  => 'en-US-Standard-H',
			),
			array(
				'value' => 'en-US-Standard-I',
				'text'  => 'en-US-Standard-I',
			),
			array(
				'value' => 'en-US-Standard-J',
				'text'  => 'en-US-Standard-J',
			),
			array(
				'value' => 'en-US-Studio-M',
				'text'  => 'en-US-Studio-M',
			),
			array(
				'value' => 'en-US-Studio-O',
				'text'  => 'en-US-Studio-O',
			),
			array(
				'value' => 'en-US-Wavenet-A',
				'text'  => 'en-US-Wavenet-A',
			),
			array(
				'value' => 'en-US-Wavenet-B',
				'text'  => 'en-US-Wavenet-B',
			),
			array(
				'value' => 'en-US-Wavenet-C',
				'text'  => 'en-US-Wavenet-C',
			),
			array(
				'value' => 'en-US-Wavenet-D',
				'text'  => 'en-US-Wavenet-D',
			),
			array(
				'value' => 'en-US-Wavenet-E',
				'text'  => 'en-US-Wavenet-E',
			),
			array(
				'value' => 'en-US-Wavenet-F',
				'text'  => 'en-US-Wavenet-F',
			),
			array(
				'value' => 'en-US-Wavenet-G',
				'text'  => 'en-US-Wavenet-G',
			),
			array(
				'value' => 'en-US-Wavenet-H',
				'text'  => 'en-US-Wavenet-H',
			),
			array(
				'value' => 'en-US-Wavenet-I',
				'text'  => 'en-US-Wavenet-I',
			),
			array(
				'value' => 'en-US-Wavenet-J',
				'text'  => 'en-US-Wavenet-J',
			),
			array(
				'value' => 'fil-PH-Standard-A',
				'text'  => 'fil-PH-Standard-A',
			),
			array(
				'value' => 'fil-PH-Standard-B',
				'text'  => 'fil-PH-Standard-B',
			),
			array(
				'value' => 'fil-PH-Standard-C',
				'text'  => 'fil-PH-Standard-C',
			),
			array(
				'value' => 'fil-PH-Standard-D',
				'text'  => 'fil-PH-Standard-D',
			),
			array(
				'value' => 'fil-PH-Wavenet-A',
				'text'  => 'fil-PH-Wavenet-A',
			),
			array(
				'value' => 'fil-PH-Wavenet-B',
				'text'  => 'fil-PH-Wavenet-B',
			),
			array(
				'value' => 'fil-PH-Wavenet-C',
				'text'  => 'fil-PH-Wavenet-C',
			),
			array(
				'value' => 'fil-PH-Wavenet-D',
				'text'  => 'fil-PH-Wavenet-D',
			),
			array(
				'value' => 'fil-ph-Neural2-A',
				'text'  => 'fil-ph-Neural2-A',
			),
			array(
				'value' => 'fil-ph-Neural2-D',
				'text'  => 'fil-ph-Neural2-D',
			),
			array(
				'value' => 'fi-FI-Standard-A',
				'text'  => 'fi-FI-Standard-A',
			),
			array(
				'value' => 'fi-FI-Wavenet-A',
				'text'  => 'fi-FI-Wavenet-A',
			),
			array(
				'value' => 'fr-CA-Neural2-A',
				'text'  => 'fr-CA-Neural2-A',
			),
			array(
				'value' => 'fr-CA-Neural2-B',
				'text'  => 'fr-CA-Neural2-B',
			),
			array(
				'value' => 'fr-CA-Neural2-C',
				'text'  => 'fr-CA-Neural2-C',
			),
			array(
				'value' => 'fr-CA-Neural2-D',
				'text'  => 'fr-CA-Neural2-D',
			),
			array(
				'value' => 'fr-CA-Standard-A',
				'text'  => 'fr-CA-Standard-A',
			),
			array(
				'value' => 'fr-CA-Standard-B',
				'text'  => 'fr-CA-Standard-B',
			),
			array(
				'value' => 'fr-CA-Standard-C',
				'text'  => 'fr-CA-Standard-C',
			),
			array(
				'value' => 'fr-CA-Standard-D',
				'text'  => 'fr-CA-Standard-D',
			),
			array(
				'value' => 'fr-CA-Wavenet-A',
				'text'  => 'fr-CA-Wavenet-A',
			),
			array(
				'value' => 'fr-CA-Wavenet-B',
				'text'  => 'fr-CA-Wavenet-B',
			),
			array(
				'value' => 'fr-CA-Wavenet-C',
				'text'  => 'fr-CA-Wavenet-C',
			),
			array(
				'value' => 'fr-CA-Wavenet-D',
				'text'  => 'fr-CA-Wavenet-D',
			),
			array(
				'value' => 'fr-FR-Neural2-A',
				'text'  => 'fr-FR-Neural2-A',
			),
			array(
				'value' => 'fr-FR-Neural2-B',
				'text'  => 'fr-FR-Neural2-B',
			),
			array(
				'value' => 'fr-FR-Neural2-C',
				'text'  => 'fr-FR-Neural2-C',
			),
			array(
				'value' => 'fr-FR-Neural2-D',
				'text'  => 'fr-FR-Neural2-D',
			),
			array(
				'value' => 'fr-FR-Neural2-E',
				'text'  => 'fr-FR-Neural2-E',
			),
			array(
				'value' => 'fr-FR-Polyglot-1',
				'text'  => 'fr-FR-Polyglot-1',
			),
			array(
				'value' => 'fr-FR-Standard-A',
				'text'  => 'fr-FR-Standard-A',
			),
			array(
				'value' => 'fr-FR-Standard-B',
				'text'  => 'fr-FR-Standard-B',
			),
			array(
				'value' => 'fr-FR-Standard-C',
				'text'  => 'fr-FR-Standard-C',
			),
			array(
				'value' => 'fr-FR-Standard-D',
				'text'  => 'fr-FR-Standard-D',
			),
			array(
				'value' => 'fr-FR-Standard-E',
				'text'  => 'fr-FR-Standard-E',
			),
			array(
				'value' => 'fr-FR-Wavenet-A',
				'text'  => 'fr-FR-Wavenet-A',
			),
			array(
				'value' => 'fr-FR-Wavenet-B',
				'text'  => 'fr-FR-Wavenet-B',
			),
			array(
				'value' => 'fr-FR-Wavenet-C',
				'text'  => 'fr-FR-Wavenet-C',
			),
			array(
				'value' => 'fr-FR-Wavenet-D',
				'text'  => 'fr-FR-Wavenet-D',
			),
			array(
				'value' => 'fr-FR-Wavenet-E',
				'text'  => 'fr-FR-Wavenet-E',
			),
			array(
				'value' => 'gl-ES-Standard-A',
				'text'  => 'gl-ES-Standard-A',
			),
			array(
				'value' => 'de-DE-Neural2-B',
				'text'  => 'de-DE-Neural2-B',
			),
			array(
				'value' => 'de-DE-Neural2-C',
				'text'  => 'de-DE-Neural2-C',
			),
			array(
				'value' => 'de-DE-Neural2-D',
				'text'  => 'de-DE-Neural2-D',
			),
			array(
				'value' => 'de-DE-Neural2-F',
				'text'  => 'de-DE-Neural2-F',
			),
			array(
				'value' => 'de-DE-Polyglot-1',
				'text'  => 'de-DE-Polyglot-1',
			),
			array(
				'value' => 'de-DE-Standard-A',
				'text'  => 'de-DE-Standard-A',
			),
			array(
				'value' => 'de-DE-Standard-B',
				'text'  => 'de-DE-Standard-B',
			),
			array(
				'value' => 'de-DE-Standard-C',
				'text'  => 'de-DE-Standard-C',
			),
			array(
				'value' => 'de-DE-Standard-D',
				'text'  => 'de-DE-Standard-D',
			),
			array(
				'value' => 'de-DE-Standard-E',
				'text'  => 'de-DE-Standard-E',
			),
			array(
				'value' => 'de-DE-Standard-F',
				'text'  => 'de-DE-Standard-F',
			),
			array(
				'value' => 'de-DE-Wavenet-A',
				'text'  => 'de-DE-Wavenet-A',
			),
			array(
				'value' => 'de-DE-Wavenet-B',
				'text'  => 'de-DE-Wavenet-B',
			),
			array(
				'value' => 'de-DE-Wavenet-C',
				'text'  => 'de-DE-Wavenet-C',
			),
			array(
				'value' => 'de-DE-Wavenet-D',
				'text'  => 'de-DE-Wavenet-D',
			),
			array(
				'value' => 'de-DE-Wavenet-E',
				'text'  => 'de-DE-Wavenet-E',
			),
			array(
				'value' => 'de-DE-Wavenet-F',
				'text'  => 'de-DE-Wavenet-F',
			),
			array(
				'value' => 'el-GR-Standard-A',
				'text'  => 'el-GR-Standard-A',
			),
			array(
				'value' => 'el-GR-Wavenet-A',
				'text'  => 'el-GR-Wavenet-A',
			),
			array(
				'value' => 'gu-IN-Standard-A',
				'text'  => 'gu-IN-Standard-A',
			),
			array(
				'value' => 'gu-IN-Standard-B',
				'text'  => 'gu-IN-Standard-B',
			),
			array(
				'value' => 'gu-IN-Wavenet-A',
				'text'  => 'gu-IN-Wavenet-A',
			),
			array(
				'value' => 'gu-IN-Wavenet-B',
				'text'  => 'gu-IN-Wavenet-B',
			),
			array(
				'value' => 'he-IL-Standard-A',
				'text'  => 'he-IL-Standard-A',
			),
			array(
				'value' => 'he-IL-Standard-B',
				'text'  => 'he-IL-Standard-B',
			),
			array(
				'value' => 'he-IL-Standard-C',
				'text'  => 'he-IL-Standard-C',
			),
			array(
				'value' => 'he-IL-Standard-D',
				'text'  => 'he-IL-Standard-D',
			),
			array(
				'value' => 'he-IL-Wavenet-A',
				'text'  => 'he-IL-Wavenet-A',
			),
			array(
				'value' => 'he-IL-Wavenet-B',
				'text'  => 'he-IL-Wavenet-B',
			),
			array(
				'value' => 'he-IL-Wavenet-C',
				'text'  => 'he-IL-Wavenet-C',
			),
			array(
				'value' => 'he-IL-Wavenet-D',
				'text'  => 'he-IL-Wavenet-D',
			),
			array(
				'value' => 'hi-IN-Neural2-A',
				'text'  => 'hi-IN-Neural2-A',
			),
			array(
				'value' => 'hi-IN-Neural2-B',
				'text'  => 'hi-IN-Neural2-B',
			),
			array(
				'value' => 'hi-IN-Neural2-C',
				'text'  => 'hi-IN-Neural2-C',
			),
			array(
				'value' => 'hi-IN-Neural2-D',
				'text'  => 'hi-IN-Neural2-D',
			),
			array(
				'value' => 'hi-IN-Standard-A',
				'text'  => 'hi-IN-Standard-A',
			),
			array(
				'value' => 'hi-IN-Standard-B',
				'text'  => 'hi-IN-Standard-B',
			),
			array(
				'value' => 'hi-IN-Standard-C',
				'text'  => 'hi-IN-Standard-C',
			),
			array(
				'value' => 'hi-IN-Standard-D',
				'text'  => 'hi-IN-Standard-D',
			),
			array(
				'value' => 'hi-IN-Wavenet-A',
				'text'  => 'hi-IN-Wavenet-A',
			),
			array(
				'value' => 'hi-IN-Wavenet-B',
				'text'  => 'hi-IN-Wavenet-B',
			),
			array(
				'value' => 'hi-IN-Wavenet-C',
				'text'  => 'hi-IN-Wavenet-C',
			),
			array(
				'value' => 'hi-IN-Wavenet-D',
				'text'  => 'hi-IN-Wavenet-D',
			),
			array(
				'value' => 'hu-HU-Standard-A',
				'text'  => 'hu-HU-Standard-A',
			),
			array(
				'value' => 'hu-HU-Wavenet-A',
				'text'  => 'hu-HU-Wavenet-A',
			),
			array(
				'value' => 'is-IS-Standard-A',
				'text'  => 'is-IS-Standard-A',
			),
			array(
				'value' => 'id-ID-Standard-A',
				'text'  => 'id-ID-Standard-A',
			),
			array(
				'value' => 'id-ID-Standard-B',
				'text'  => 'id-ID-Standard-B',
			),
			array(
				'value' => 'id-ID-Standard-C',
				'text'  => 'id-ID-Standard-C',
			),
			array(
				'value' => 'id-ID-Standard-D',
				'text'  => 'id-ID-Standard-D',
			),
			array(
				'value' => 'id-ID-Wavenet-A',
				'text'  => 'id-ID-Wavenet-A',
			),
			array(
				'value' => 'id-ID-Wavenet-B',
				'text'  => 'id-ID-Wavenet-B',
			),
			array(
				'value' => 'id-ID-Wavenet-C',
				'text'  => 'id-ID-Wavenet-C',
			),
			array(
				'value' => 'id-ID-Wavenet-D',
				'text'  => 'id-ID-Wavenet-D',
			),
			array(
				'value' => 'it-IT-Neural2-A',
				'text'  => 'it-IT-Neural2-A',
			),
			array(
				'value' => 'it-IT-Neural2-C',
				'text'  => 'it-IT-Neural2-C',
			),
			array(
				'value' => 'it-IT-Standard-A',
				'text'  => 'it-IT-Standard-A',
			),
			array(
				'value' => 'it-IT-Standard-B',
				'text'  => 'it-IT-Standard-B',
			),
			array(
				'value' => 'it-IT-Standard-C',
				'text'  => 'it-IT-Standard-C',
			),
			array(
				'value' => 'it-IT-Standard-D',
				'text'  => 'it-IT-Standard-D',
			),
			array(
				'value' => 'it-IT-Wavenet-A',
				'text'  => 'it-IT-Wavenet-A',
			),
			array(
				'value' => 'it-IT-Wavenet-B',
				'text'  => 'it-IT-Wavenet-B',
			),
			array(
				'value' => 'it-IT-Wavenet-C',
				'text'  => 'it-IT-Wavenet-C',
			),
			array(
				'value' => 'it-IT-Wavenet-D',
				'text'  => 'it-IT-Wavenet-D',
			),
			array(
				'value' => 'ja-JP-Neural2-B',
				'text'  => 'ja-JP-Neural2-B',
			),
			array(
				'value' => 'ja-JP-Neural2-C',
				'text'  => 'ja-JP-Neural2-C',
			),
			array(
				'value' => 'ja-JP-Neural2-D',
				'text'  => 'ja-JP-Neural2-D',
			),
			array(
				'value' => 'ja-JP-Standard-A',
				'text'  => 'ja-JP-Standard-A',
			),
			array(
				'value' => 'ja-JP-Standard-B',
				'text'  => 'ja-JP-Standard-B',
			),
			array(
				'value' => 'ja-JP-Standard-C',
				'text'  => 'ja-JP-Standard-C',
			),
			array(
				'value' => 'ja-JP-Standard-D',
				'text'  => 'ja-JP-Standard-D',
			),
			array(
				'value' => 'ja-JP-Wavenet-A',
				'text'  => 'ja-JP-Wavenet-A',
			),
			array(
				'value' => 'ja-JP-Wavenet-B',
				'text'  => 'ja-JP-Wavenet-B',
			),
			array(
				'value' => 'ja-JP-Wavenet-C',
				'text'  => 'ja-JP-Wavenet-C',
			),
			array(
				'value' => 'ja-JP-Wavenet-D',
				'text'  => 'ja-JP-Wavenet-D',
			),
			array(
				'value' => 'kn-IN-Standard-A',
				'text'  => 'kn-IN-Standard-A',
			),
			array(
				'value' => 'kn-IN-Standard-B',
				'text'  => 'kn-IN-Standard-B',
			),
			array(
				'value' => 'kn-IN-Wavenet-A',
				'text'  => 'kn-IN-Wavenet-A',
			),
			array(
				'value' => 'kn-IN-Wavenet-B',
				'text'  => 'kn-IN-Wavenet-B',
			),
			array(
				'value' => 'ko-KR-Neural2-A',
				'text'  => 'ko-KR-Neural2-A',
			),
			array(
				'value' => 'ko-KR-Neural2-B',
				'text'  => 'ko-KR-Neural2-B',
			),
			array(
				'value' => 'ko-KR-Neural2-C',
				'text'  => 'ko-KR-Neural2-C',
			),
			array(
				'value' => 'ko-KR-Standard-A',
				'text'  => 'ko-KR-Standard-A',
			),
			array(
				'value' => 'ko-KR-Standard-B',
				'text'  => 'ko-KR-Standard-B',
			),
			array(
				'value' => 'ko-KR-Standard-C',
				'text'  => 'ko-KR-Standard-C',
			),
			array(
				'value' => 'ko-KR-Standard-D',
				'text'  => 'ko-KR-Standard-D',
			),
			array(
				'value' => 'ko-KR-Wavenet-A',
				'text'  => 'ko-KR-Wavenet-A',
			),
			array(
				'value' => 'ko-KR-Wavenet-B',
				'text'  => 'ko-KR-Wavenet-B',
			),
			array(
				'value' => 'ko-KR-Wavenet-C',
				'text'  => 'ko-KR-Wavenet-C',
			),
			array(
				'value' => 'ko-KR-Wavenet-D',
				'text'  => 'ko-KR-Wavenet-D',
			),
			array(
				'value' => 'lv-LV-Standard-A',
				'text'  => 'lv-LV-Standard-A',
			),
			array(
				'value' => 'lt-LT-Standard-A',
				'text'  => 'lt-LT-Standard-A',
			),
			array(
				'value' => 'ms-MY-Standard-A',
				'text'  => 'ms-MY-Standard-A',
			),
			array(
				'value' => 'ms-MY-Standard-B',
				'text'  => 'ms-MY-Standard-B',
			),
			array(
				'value' => 'ms-MY-Standard-C',
				'text'  => 'ms-MY-Standard-C',
			),
			array(
				'value' => 'ms-MY-Standard-D',
				'text'  => 'ms-MY-Standard-D',
			),
			array(
				'value' => 'ms-MY-Wavenet-A',
				'text'  => 'ms-MY-Wavenet-A',
			),
			array(
				'value' => 'ms-MY-Wavenet-B',
				'text'  => 'ms-MY-Wavenet-B',
			),
			array(
				'value' => 'ms-MY-Wavenet-C',
				'text'  => 'ms-MY-Wavenet-C',
			),
			array(
				'value' => 'ms-MY-Wavenet-D',
				'text'  => 'ms-MY-Wavenet-D',
			),
			array(
				'value' => 'ml-IN-Standard-A',
				'text'  => 'ml-IN-Standard-A',
			),
			array(
				'value' => 'ml-IN-Standard-B',
				'text'  => 'ml-IN-Standard-B',
			),
			array(
				'value' => 'ml-IN-Wavenet-A',
				'text'  => 'ml-IN-Wavenet-A',
			),
			array(
				'value' => 'ml-IN-Wavenet-B',
				'text'  => 'ml-IN-Wavenet-B',
			),
			array(
				'value' => 'ml-IN-Wavenet-C',
				'text'  => 'ml-IN-Wavenet-C',
			),
			array(
				'value' => 'ml-IN-Wavenet-D',
				'text'  => 'ml-IN-Wavenet-D',
			),
			array(
				'value' => 'cmn-CN-Standard-A',
				'text'  => 'cmn-CN-Standard-A',
			),
			array(
				'value' => 'cmn-CN-Standard-B',
				'text'  => 'cmn-CN-Standard-B',
			),
			array(
				'value' => 'cmn-CN-Standard-C',
				'text'  => 'cmn-CN-Standard-C',
			),
			array(
				'value' => 'cmn-CN-Standard-D',
				'text'  => 'cmn-CN-Standard-D',
			),
			array(
				'value' => 'cmn-CN-Wavenet-A',
				'text'  => 'cmn-CN-Wavenet-A',
			),
			array(
				'value' => 'cmn-CN-Wavenet-B',
				'text'  => 'cmn-CN-Wavenet-B',
			),
			array(
				'value' => 'cmn-CN-Wavenet-C',
				'text'  => 'cmn-CN-Wavenet-C',
			),
			array(
				'value' => 'cmn-CN-Wavenet-D',
				'text'  => 'cmn-CN-Wavenet-D',
			),
			array(
				'value' => 'cmn-TW-Standard-A',
				'text'  => 'cmn-TW-Standard-A',
			),
			array(
				'value' => 'cmn-TW-Standard-B',
				'text'  => 'cmn-TW-Standard-B',
			),
			array(
				'value' => 'cmn-TW-Standard-C',
				'text'  => 'cmn-TW-Standard-C',
			),
			array(
				'value' => 'cmn-TW-Wavenet-A',
				'text'  => 'cmn-TW-Wavenet-A',
			),
			array(
				'value' => 'cmn-TW-Wavenet-B',
				'text'  => 'cmn-TW-Wavenet-B',
			),
			array(
				'value' => 'cmn-TW-Wavenet-C',
				'text'  => 'cmn-TW-Wavenet-C',
			),
			array(
				'value' => 'mr-IN-Standard-A',
				'text'  => 'mr-IN-Standard-A',
			),
			array(
				'value' => 'mr-IN-Standard-B',
				'text'  => 'mr-IN-Standard-B',
			),
			array(
				'value' => 'mr-IN-Standard-C',
				'text'  => 'mr-IN-Standard-C',
			),
			array(
				'value' => 'mr-IN-Wavenet-A',
				'text'  => 'mr-IN-Wavenet-A',
			),
			array(
				'value' => 'mr-IN-Wavenet-B',
				'text'  => 'mr-IN-Wavenet-B',
			),
			array(
				'value' => 'mr-IN-Wavenet-C',
				'text'  => 'mr-IN-Wavenet-C',
			),
			array(
				'value' => 'nb-NO-Standard-A',
				'text'  => 'nb-NO-Standard-A',
			),
			array(
				'value' => 'nb-NO-Standard-B',
				'text'  => 'nb-NO-Standard-B',
			),
			array(
				'value' => 'nb-NO-Standard-C',
				'text'  => 'nb-NO-Standard-C',
			),
			array(
				'value' => 'nb-NO-Standard-D',
				'text'  => 'nb-NO-Standard-D',
			),
			array(
				'value' => 'nb-NO-Standard-E',
				'text'  => 'nb-NO-Standard-E',
			),
			array(
				'value' => 'nb-NO-Wavenet-A',
				'text'  => 'nb-NO-Wavenet-A',
			),
			array(
				'value' => 'nb-NO-Wavenet-B',
				'text'  => 'nb-NO-Wavenet-B',
			),
			array(
				'value' => 'nb-NO-Wavenet-C',
				'text'  => 'nb-NO-Wavenet-C',
			),
			array(
				'value' => 'nb-NO-Wavenet-D',
				'text'  => 'nb-NO-Wavenet-D',
			),
			array(
				'value' => 'nb-NO-Wavenet-E',
				'text'  => 'nb-NO-Wavenet-E',
			),
			array(
				'value' => 'pl-PL-Standard-A',
				'text'  => 'pl-PL-Standard-A',
			),
			array(
				'value' => 'pl-PL-Standard-B',
				'text'  => 'pl-PL-Standard-B',
			),
			array(
				'value' => 'pl-PL-Standard-C',
				'text'  => 'pl-PL-Standard-C',
			),
			array(
				'value' => 'pl-PL-Standard-D',
				'text'  => 'pl-PL-Standard-D',
			),
			array(
				'value' => 'pl-PL-Standard-E',
				'text'  => 'pl-PL-Standard-E',
			),
			array(
				'value' => 'pl-PL-Wavenet-A',
				'text'  => 'pl-PL-Wavenet-A',
			),
			array(
				'value' => 'pl-PL-Wavenet-B',
				'text'  => 'pl-PL-Wavenet-B',
			),
			array(
				'value' => 'pl-PL-Wavenet-C',
				'text'  => 'pl-PL-Wavenet-C',
			),
			array(
				'value' => 'pl-PL-Wavenet-D',
				'text'  => 'pl-PL-Wavenet-D',
			),
			array(
				'value' => 'pl-PL-Wavenet-E',
				'text'  => 'pl-PL-Wavenet-E',
			),
			array(
				'value' => 'pt-BR-Neural2-A',
				'text'  => 'pt-BR-Neural2-A',
			),
			array(
				'value' => 'pt-BR-Neural2-B',
				'text'  => 'pt-BR-Neural2-B',
			),
			array(
				'value' => 'pt-BR-Neural2-C',
				'text'  => 'pt-BR-Neural2-C',
			),
			array(
				'value' => 'pt-BR-Standard-A',
				'text'  => 'pt-BR-Standard-A',
			),
			array(
				'value' => 'pt-BR-Standard-B',
				'text'  => 'pt-BR-Standard-B',
			),
			array(
				'value' => 'pt-BR-Standard-C',
				'text'  => 'pt-BR-Standard-C',
			),
			array(
				'value' => 'pt-BR-Wavenet-A',
				'text'  => 'pt-BR-Wavenet-A',
			),
			array(
				'value' => 'pt-BR-Wavenet-B',
				'text'  => 'pt-BR-Wavenet-B',
			),
			array(
				'value' => 'pt-BR-Wavenet-C',
				'text'  => 'pt-BR-Wavenet-C',
			),
			array(
				'value' => 'pt-PT-Standard-A',
				'text'  => 'pt-PT-Standard-A',
			),
			array(
				'value' => 'pt-PT-Standard-B',
				'text'  => 'pt-PT-Standard-B',
			),
			array(
				'value' => 'pt-PT-Standard-C',
				'text'  => 'pt-PT-Standard-C',
			),
			array(
				'value' => 'pt-PT-Standard-D',
				'text'  => 'pt-PT-Standard-D',
			),
			array(
				'value' => 'pt-PT-Wavenet-A',
				'text'  => 'pt-PT-Wavenet-A',
			),
			array(
				'value' => 'pt-PT-Wavenet-B',
				'text'  => 'pt-PT-Wavenet-B',
			),
			array(
				'value' => 'pt-PT-Wavenet-C',
				'text'  => 'pt-PT-Wavenet-C',
			),
			array(
				'value' => 'pt-PT-Wavenet-D',
				'text'  => 'pt-PT-Wavenet-D',
			),
			array(
				'value' => 'pa-IN-Standard-A',
				'text'  => 'pa-IN-Standard-A',
			),
			array(
				'value' => 'pa-IN-Standard-B',
				'text'  => 'pa-IN-Standard-B',
			),
			array(
				'value' => 'pa-IN-Standard-C',
				'text'  => 'pa-IN-Standard-C',
			),
			array(
				'value' => 'pa-IN-Standard-D',
				'text'  => 'pa-IN-Standard-D',
			),
			array(
				'value' => 'pa-IN-Wavenet-A',
				'text'  => 'pa-IN-Wavenet-A',
			),
			array(
				'value' => 'pa-IN-Wavenet-B',
				'text'  => 'pa-IN-Wavenet-B',
			),
			array(
				'value' => 'pa-IN-Wavenet-C',
				'text'  => 'pa-IN-Wavenet-C',
			),
			array(
				'value' => 'pa-IN-Wavenet-D',
				'text'  => 'pa-IN-Wavenet-D',
			),
			array(
				'value' => 'ro-RO-Standard-A',
				'text'  => 'ro-RO-Standard-A',
			),
			array(
				'value' => 'ro-RO-Wavenet-A',
				'text'  => 'ro-RO-Wavenet-A',
			),
			array(
				'value' => 'ru-RU-Standard-A',
				'text'  => 'ru-RU-Standard-A',
			),
			array(
				'value' => 'ru-RU-Standard-B',
				'text'  => 'ru-RU-Standard-B',
			),
			array(
				'value' => 'ru-RU-Standard-C',
				'text'  => 'ru-RU-Standard-C',
			),
			array(
				'value' => 'ru-RU-Standard-D',
				'text'  => 'ru-RU-Standard-D',
			),
			array(
				'value' => 'ru-RU-Standard-E',
				'text'  => 'ru-RU-Standard-E',
			),
			array(
				'value' => 'ru-RU-Wavenet-A',
				'text'  => 'ru-RU-Wavenet-A',
			),
			array(
				'value' => 'ru-RU-Wavenet-B',
				'text'  => 'ru-RU-Wavenet-B',
			),
			array(
				'value' => 'ru-RU-Wavenet-C',
				'text'  => 'ru-RU-Wavenet-C',
			),
			array(
				'value' => 'ru-RU-Wavenet-D',
				'text'  => 'ru-RU-Wavenet-D',
			),
			array(
				'value' => 'ru-RU-Wavenet-E',
				'text'  => 'ru-RU-Wavenet-E',
			),
			array(
				'value' => 'sr-RS-Standard-A',
				'text'  => 'sr-RS-Standard-A',
			),
			array(
				'value' => 'sk-SK-Standard-A',
				'text'  => 'sk-SK-Standard-A',
			),
			array(
				'value' => 'sk-SK-Wavenet-A',
				'text'  => 'sk-SK-Wavenet-A',
			),
			array(
				'value' => 'es-ES-Neural2-A',
				'text'  => 'es-ES-Neural2-A',
			),
			array(
				'value' => 'es-ES-Neural2-B',
				'text'  => 'es-ES-Neural2-B',
			),
			array(
				'value' => 'es-ES-Neural2-C',
				'text'  => 'es-ES-Neural2-C',
			),
			array(
				'value' => 'es-ES-Neural2-D',
				'text'  => 'es-ES-Neural2-D',
			),
			array(
				'value' => 'es-ES-Neural2-E',
				'text'  => 'es-ES-Neural2-E',
			),
			array(
				'value' => 'es-ES-Neural2-F',
				'text'  => 'es-ES-Neural2-F',
			),
			array(
				'value' => 'es-ES-Polyglot-1',
				'text'  => 'es-ES-Polyglot-1',
			),
			array(
				'value' => 'es-ES-Standard-A',
				'text'  => 'es-ES-Standard-A',
			),
			array(
				'value' => 'es-ES-Standard-B',
				'text'  => 'es-ES-Standard-B',
			),
			array(
				'value' => 'es-ES-Standard-C',
				'text'  => 'es-ES-Standard-C',
			),
			array(
				'value' => 'es-ES-Standard-D',
				'text'  => 'es-ES-Standard-D',
			),
			array(
				'value' => 'es-ES-Wavenet-B',
				'text'  => 'es-ES-Wavenet-B',
			),
			array(
				'value' => 'es-ES-Wavenet-C',
				'text'  => 'es-ES-Wavenet-C',
			),
			array(
				'value' => 'es-ES-Wavenet-D',
				'text'  => 'es-ES-Wavenet-D',
			),
			array(
				'value' => 'es-US-Neural2-A',
				'text'  => 'es-US-Neural2-A',
			),
			array(
				'value' => 'es-US-Neural2-B',
				'text'  => 'es-US-Neural2-B',
			),
			array(
				'value' => 'es-US-Neural2-C',
				'text'  => 'es-US-Neural2-C',
			),
			array(
				'value' => 'es-US-News-D',
				'text'  => 'es-US-News-D',
			),
			array(
				'value' => 'es-US-News-E',
				'text'  => 'es-US-News-E',
			),
			array(
				'value' => 'es-US-News-F',
				'text'  => 'es-US-News-F',
			),
			array(
				'value' => 'es-US-News-G',
				'text'  => 'es-US-News-G',
			),
			array(
				'value' => 'es-US-Polyglot-1',
				'text'  => 'es-US-Polyglot-1',
			),
			array(
				'value' => 'es-US-Standard-A',
				'text'  => 'es-US-Standard-A',
			),
			array(
				'value' => 'es-US-Standard-B',
				'text'  => 'es-US-Standard-B',
			),
			array(
				'value' => 'es-US-Standard-C',
				'text'  => 'es-US-Standard-C',
			),
			array(
				'value' => 'es-US-Studio-B',
				'text'  => 'es-US-Studio-B',
			),
			array(
				'value' => 'es-US-Wavenet-A',
				'text'  => 'es-US-Wavenet-A',
			),
			array(
				'value' => 'es-US-Wavenet-B',
				'text'  => 'es-US-Wavenet-B',
			),
			array(
				'value' => 'es-US-Wavenet-C',
				'text'  => 'es-US-Wavenet-C',
			),
			array(
				'value' => 'sv-SE-Standard-A',
				'text'  => 'sv-SE-Standard-A',
			),
			array(
				'value' => 'sv-SE-Standard-B',
				'text'  => 'sv-SE-Standard-B',
			),
			array(
				'value' => 'sv-SE-Standard-C',
				'text'  => 'sv-SE-Standard-C',
			),
			array(
				'value' => 'sv-SE-Standard-D',
				'text'  => 'sv-SE-Standard-D',
			),
			array(
				'value' => 'sv-SE-Standard-E',
				'text'  => 'sv-SE-Standard-E',
			),
			array(
				'value' => 'sv-SE-Wavenet-A',
				'text'  => 'sv-SE-Wavenet-A',
			),
			array(
				'value' => 'sv-SE-Wavenet-B',
				'text'  => 'sv-SE-Wavenet-B',
			),
			array(
				'value' => 'sv-SE-Wavenet-C',
				'text'  => 'sv-SE-Wavenet-C',
			),
			array(
				'value' => 'sv-SE-Wavenet-D',
				'text'  => 'sv-SE-Wavenet-D',
			),
			array(
				'value' => 'sv-SE-Wavenet-E',
				'text'  => 'sv-SE-Wavenet-E',
			),
			array(
				'value' => 'ta-IN-Standard-A',
				'text'  => 'ta-IN-Standard-A',
			),
			array(
				'value' => 'ta-IN-Standard-B',
				'text'  => 'ta-IN-Standard-B',
			),
			array(
				'value' => 'ta-IN-Standard-C',
				'text'  => 'ta-IN-Standard-C',
			),
			array(
				'value' => 'ta-IN-Standard-D',
				'text'  => 'ta-IN-Standard-D',
			),
			array(
				'value' => 'ta-IN-Wavenet-A',
				'text'  => 'ta-IN-Wavenet-A',
			),
			array(
				'value' => 'ta-IN-Wavenet-B',
				'text'  => 'ta-IN-Wavenet-B',
			),
			array(
				'value' => 'ta-IN-Wavenet-C',
				'text'  => 'ta-IN-Wavenet-C',
			),
			array(
				'value' => 'ta-IN-Wavenet-D',
				'text'  => 'ta-IN-Wavenet-D',
			),
			array(
				'value' => 'te-IN-Standard-A',
				'text'  => 'te-IN-Standard-A',
			),
			array(
				'value' => 'te-IN-Standard-B',
				'text'  => 'te-IN-Standard-B',
			),
			array(
				'value' => 'th-TH-Neural2-C',
				'text'  => 'th-TH-Neural2-C',
			),
			array(
				'value' => 'th-TH-Standard-A',
				'text'  => 'th-TH-Standard-A',
			),
			array(
				'value' => 'tr-TR-Standard-A',
				'text'  => 'tr-TR-Standard-A',
			),
			array(
				'value' => 'tr-TR-Standard-B',
				'text'  => 'tr-TR-Standard-B',
			),
			array(
				'value' => 'tr-TR-Standard-C',
				'text'  => 'tr-TR-Standard-C',
			),
			array(
				'value' => 'tr-TR-Standard-D',
				'text'  => 'tr-TR-Standard-D',
			),
			array(
				'value' => 'tr-TR-Standard-E',
				'text'  => 'tr-TR-Standard-E',
			),
			array(
				'value' => 'tr-TR-Wavenet-A',
				'text'  => 'tr-TR-Wavenet-A',
			),
			array(
				'value' => 'tr-TR-Wavenet-B',
				'text'  => 'tr-TR-Wavenet-B',
			),
			array(
				'value' => 'tr-TR-Wavenet-C',
				'text'  => 'tr-TR-Wavenet-C',
			),
			array(
				'value' => 'tr-TR-Wavenet-D',
				'text'  => 'tr-TR-Wavenet-D',
			),
			array(
				'value' => 'tr-TR-Wavenet-E',
				'text'  => 'tr-TR-Wavenet-E',
			),
			array(
				'value' => 'uk-UA-Standard-A',
				'text'  => 'uk-UA-Standard-A',
			),
			array(
				'value' => 'uk-UA-Wavenet-A',
				'text'  => 'uk-UA-Wavenet-A',
			),
			array(
				'value' => 'vi-VN-Neural2-A',
				'text'  => 'vi-VN-Neural2-A',
			),
			array(
				'value' => 'vi-VN-Neural2-D',
				'text'  => 'vi-VN-Neural2-D',
			),
			array(
				'value' => 'vi-VN-Standard-A',
				'text'  => 'vi-VN-Standard-A',
			),
			array(
				'value' => 'vi-VN-Standard-B',
				'text'  => 'vi-VN-Standard-B',
			),
			array(
				'value' => 'vi-VN-Standard-C',
				'text'  => 'vi-VN-Standard-C',
			),
			array(
				'value' => 'vi-VN-Standard-D',
				'text'  => 'vi-VN-Standard-D',
			),
			array(
				'value' => 'vi-VN-Wavenet-A',
				'text'  => 'vi-VN-Wavenet-A',
			),
			array(
				'value' => 'vi-VN-Wavenet-B',
				'text'  => 'vi-VN-Wavenet-B',
			),
			array(
				'value' => 'vi-VN-Wavenet-C',
				'text'  => 'vi-VN-Wavenet-C',
			),
			array(
				'value' => 'vi-VN-Wavenet-D',
				'text'  => 'vi-VN-Wavenet-D',
			),
		);

		// Get the values of the "Google Cloud Text-to-speech -> Effects Profile ID" option.
		$google_cloud_effects_profile_id = array(
			array(
				'value' => 'wearable-class-device',
				'text'  => 'wearable-class-device',
			),
			array(
				'value' => 'handset-class-device',
				'text'  => 'handset-class-device',
			),
			array(
				'value' => 'headphone-class-device',
				'text'  => 'headphone-class-device',
			),
			array(
				'value' => 'small-bluetooth-speaker-class-device',
				'text'  => 'small-bluetooth-speaker-class-device',
			),
			array(
				'value' => 'medium-bluetooth-speaker-class-device',
				'text'  => 'medium-bluetooth-speaker-class-device',
			),
			array(
				'value' => 'large-home-entertainment-class-device',
				'text'  => 'large-home-entertainment-class-device',
			),
			array(
				'value' => 'large-automotive-class-device',
				'text'  => 'large-automotive-class-device',
			),
			array(
				'value' => 'telephony-class-application',
				'text'  => 'telephony-class-application',
			),
		);

		// Get the value of the "Azure Text-to-speech -> Region" option.
		$azure_region = array(
			array(
				'value' => 'southafricanorth',
				'text'  => 'southafricanorth',
			),
			array(
				'value' => 'eastasia',
				'text'  => 'eastasia',
			),
			array(
				'value' => 'southeastasia',
				'text'  => 'southeastasia',
			),
			array(
				'value' => 'australiaeast',
				'text'  => 'australiaeast',
			),
			array(
				'value' => 'centralindia',
				'text'  => 'centralindia',
			),
			array(
				'value' => 'japaneast',
				'text'  => 'japaneast',
			),
			array(
				'value' => 'japanwest',
				'text'  => 'japanwest',
			),
			array(
				'value' => 'koreacentral',
				'text'  => 'koreacentral',
			),
			array(
				'value' => 'canadacentral',
				'text'  => 'canadacentral',
			),
			array(
				'value' => 'northeurope',
				'text'  => 'northeurope',
			),
			array(
				'value' => 'westeurope',
				'text'  => 'westeurope',
			),
			array(
				'value' => 'francecentral',
				'text'  => 'francecentral',
			),
			array(
				'value' => 'germanywestcentral',
				'text'  => 'germanywestcentral',
			),
			array(
				'value' => 'norwayeast',
				'text'  => 'norwayeast',
			),
			array(
				'value' => 'switzerlandnorth',
				'text'  => 'switzerlandnorth',
			),
			array(
				'value' => 'switzerlandwest',
				'text'  => 'switzerlandwest',
			),
			array(
				'value' => 'uksouth',
				'text'  => 'uksouth',
			),
			array(
				'value' => 'uaenorth',
				'text'  => 'uaenorth',
			),
			array(
				'value' => 'brazilsouth',
				'text'  => 'brazilsouth',
			),
			array(
				'value' => 'centralus',
				'text'  => 'centralus',
			),
			array(
				'value' => 'eastus',
				'text'  => 'eastus',
			),
			array(
				'value' => 'eastus2',
				'text'  => 'eastus2',
			),
			array(
				'value' => 'northcentralus',
				'text'  => 'northcentralus',
			),
			array(
				'value' => 'southcentralus',
				'text'  => 'southcentralus',
			),
			array(
				'value' => 'westcentralus',
				'text'  => 'westcentralus',
			),
			array(
				'value' => 'westus',
				'text'  => 'westus',
			),
			array(
				'value' => 'westus2',
				'text'  => 'westus2',
			),
			array(
				'value' => 'westus3',
				'text'  => 'westus3',
			),
		);

		// Get the value of the "Azure Text-to-speech -> Output Format" option.
		$azure_output_format = array(
			array(
				'value' => 'audio-16khz-32kbitrate-mono-mp3',
				'text'  => 'audio-16khz-32kbitrate-mono-mp3',
			),
			array(
				'value' => 'audio-16khz-64kbitrate-mono-mp3',
				'text'  => 'audio-16khz-64kbitrate-mono-mp3',
			),
			array(
				'value' => 'audio-16khz-128kbitrate-mono-mp3',
				'text'  => 'audio-16khz-128kbitrate-mono-mp3',
			),
			array(
				'value' => 'audio-24khz-48kbitrate-mono-mp3',
				'text'  => 'audio-24khz-48kbitrate-mono-mp3',
			),
			array(
				'value' => 'audio-24khz-96kbitrate-mono-mp3',
				'text'  => 'audio-24khz-96kbitrate-mono-mp3',
			),
			array(
				'value' => 'audio-24khz-160kbitrate-mono-mp3',
				'text'  => 'audio-24khz-160kbitrate-mono-mp3',
			),
			array(
				'value' => 'audio-48khz-96kbitrate-mono-mp3',
				'text'  => 'audio-48khz-96kbitrate-mono-mp3',
			),
			array(
				'value' => 'audio-48khz-192kbitrate-mono-mp3',
				'text'  => 'audio-48khz-192kbitrate-mono-mp3',
			),
			array(
				'value' => 'ogg-16khz-16bit-mono-opus',
				'text'  => 'ogg-16khz-16bit-mono-opus',
			),
			array(
				'value' => 'ogg-24khz-16bit-mono-opus',
				'text'  => 'ogg-24khz-16bit-mono-opus',
			),
			array(
				'value' => 'ogg-48khz-16bit-mono-opus',
				'text'  => 'ogg-48khz-16bit-mono-opus',
			),
		);

		// Get the value of the "Azure Text-to-speech -> Voice Short Name" option.
		$azure_voice_short_name = array(
			array(
				'value' => 'af-ZA-AdriNeural',
				'text'  => 'Adri - af-ZA',
			),
			array(
				'value' => 'af-ZA-WillemNeural',
				'text'  => 'Willem - af-ZA',
			),
			array(
				'value' => 'am-ET-MekdesNeural',
				'text'  => 'Mekdes - am-ET',
			),
			array(
				'value' => 'am-ET-AmehaNeural',
				'text'  => 'Ameha - am-ET',
			),
			array(
				'value' => 'ar-AE-FatimaNeural',
				'text'  => 'Fatima - ar-AE',
			),
			array(
				'value' => 'ar-AE-HamdanNeural',
				'text'  => 'Hamdan - ar-AE',
			),
			array(
				'value' => 'ar-BH-LailaNeural',
				'text'  => 'Laila - ar-BH',
			),
			array(
				'value' => 'ar-BH-AliNeural',
				'text'  => 'Ali - ar-BH',
			),
			array(
				'value' => 'ar-DZ-AminaNeural',
				'text'  => 'Amina - ar-DZ',
			),
			array(
				'value' => 'ar-DZ-IsmaelNeural',
				'text'  => 'Ismael - ar-DZ',
			),
			array(
				'value' => 'ar-EG-SalmaNeural',
				'text'  => 'Salma - ar-EG',
			),

			array(
				'value' => 'ar-EG-ShakirNeural',
				'text'  => 'Shakir - ar-EG',
			),

			array(
				'value' => 'ar-IQ-RanaNeural',
				'text'  => 'Rana - ar-IQ',
			),

			array(
				'value' => 'ar-IQ-BasselNeural',
				'text'  => 'Bassel - ar-IQ',
			),

			array(
				'value' => 'ar-JO-SanaNeural',
				'text'  => 'Sana - ar-JO',
			),

			array(
				'value' => 'ar-JO-TaimNeural',
				'text'  => 'Taim - ar-JO',
			),

			array(
				'value' => 'ar-KW-NouraNeural',
				'text'  => 'Noura - ar-KW',
			),

			array(
				'value' => 'ar-KW-FahedNeural',
				'text'  => 'Fahed - ar-KW',
			),

			array(
				'value' => 'ar-LB-LaylaNeural',
				'text'  => 'Layla - ar-LB',
			),

			array(
				'value' => 'ar-LB-RamiNeural',
				'text'  => 'Rami - ar-LB',
			),

			array(
				'value' => 'ar-LY-ImanNeural',
				'text'  => 'Iman - ar-LY',
			),

			array(
				'value' => 'ar-LY-OmarNeural',
				'text'  => 'Omar - ar-LY',
			),

			array(
				'value' => 'ar-MA-MounaNeural',
				'text'  => 'Mouna - ar-MA',
			),

			array(
				'value' => 'ar-MA-JamalNeural',
				'text'  => 'Jamal - ar-MA',
			),

			array(
				'value' => 'ar-OM-AyshaNeural',
				'text'  => 'Aysha - ar-OM',
			),

			array(
				'value' => 'ar-OM-AbdullahNeural',
				'text'  => 'Abdullah - ar-OM',
			),

			array(
				'value' => 'ar-QA-AmalNeural',
				'text'  => 'Amal - ar-QA',
			),

			array(
				'value' => 'ar-QA-MoazNeural',
				'text'  => 'Moaz - ar-QA',
			),

			array(
				'value' => 'ar-SA-ZariyahNeural',
				'text'  => 'Zariyah - ar-SA',
			),

			array(
				'value' => 'ar-SA-HamedNeural',
				'text'  => 'Hamed - ar-SA',
			),

			array(
				'value' => 'ar-SY-AmanyNeural',
				'text'  => 'Amany - ar-SY',
			),

			array(
				'value' => 'ar-SY-LaithNeural',
				'text'  => 'Laith - ar-SY',
			),

			array(
				'value' => 'ar-TN-ReemNeural',
				'text'  => 'Reem - ar-TN',
			),

			array(
				'value' => 'ar-TN-HediNeural',
				'text'  => 'Hedi - ar-TN',
			),

			array(
				'value' => 'ar-YE-MaryamNeural',
				'text'  => 'Maryam - ar-YE',
			),

			array(
				'value' => 'ar-YE-SalehNeural',
				'text'  => 'Saleh - ar-YE',
			),

			array(
				'value' => 'az-AZ-BanuNeural',
				'text'  => 'Banu - az-AZ',
			),

			array(
				'value' => 'az-AZ-BabekNeural',
				'text'  => 'Babek - az-AZ',
			),

			array(
				'value' => 'bg-BG-KalinaNeural',
				'text'  => 'Kalina - bg-BG',
			),

			array(
				'value' => 'bg-BG-BorislavNeural',
				'text'  => 'Borislav - bg-BG',
			),

			array(
				'value' => 'bn-BD-NabanitaNeural',
				'text'  => 'Nabanita - bn-BD',
			),

			array(
				'value' => 'bn-BD-PradeepNeural',
				'text'  => 'Pradeep - bn-BD',
			),

			array(
				'value' => 'bn-IN-TanishaaNeural',
				'text'  => 'Tanishaa - bn-IN',
			),

			array(
				'value' => 'bn-IN-BashkarNeural',
				'text'  => 'Bashkar - bn-IN',
			),

			array(
				'value' => 'bs-BA-VesnaNeural',
				'text'  => 'Vesna - bs-BA',
			),

			array(
				'value' => 'bs-BA-GoranNeural',
				'text'  => 'Goran - bs-BA',
			),

			array(
				'value' => 'ca-ES-JoanaNeural',
				'text'  => 'Joana - ca-ES',
			),

			array(
				'value' => 'ca-ES-EnricNeural',
				'text'  => 'Enric - ca-ES',
			),

			array(
				'value' => 'ca-ES-AlbaNeural',
				'text'  => 'Alba - ca-ES',
			),

			array(
				'value' => 'cs-CZ-VlastaNeural',
				'text'  => 'Vlasta - cs-CZ',
			),

			array(
				'value' => 'cs-CZ-AntoninNeural',
				'text'  => 'Antonin - cs-CZ',
			),

			array(
				'value' => 'cy-GB-NiaNeural',
				'text'  => 'Nia - cy-GB',
			),

			array(
				'value' => 'cy-GB-AledNeural',
				'text'  => 'Aled - cy-GB',
			),

			array(
				'value' => 'da-DK-ChristelNeural',
				'text'  => 'Christel - da-DK',
			),

			array(
				'value' => 'da-DK-JeppeNeural',
				'text'  => 'Jeppe - da-DK',
			),

			array(
				'value' => 'de-AT-IngridNeural',
				'text'  => 'Ingrid - de-AT',
			),

			array(
				'value' => 'de-AT-JonasNeural',
				'text'  => 'Jonas - de-AT',
			),

			array(
				'value' => 'de-CH-LeniNeural',
				'text'  => 'Leni - de-CH',
			),

			array(
				'value' => 'de-CH-JanNeural',
				'text'  => 'Jan - de-CH',
			),

			array(
				'value' => 'de-DE-KatjaNeural',
				'text'  => 'Katja - de-DE',
			),

			array(
				'value' => 'de-DE-ConradNeural',
				'text'  => 'Conrad - de-DE',
			),

			array(
				'value' => 'de-DE-AmalaNeural',
				'text'  => 'Amala - de-DE',
			),

			array(
				'value' => 'de-DE-BerndNeural',
				'text'  => 'Bernd - de-DE',
			),

			array(
				'value' => 'de-DE-ChristophNeural',
				'text'  => 'Christoph - de-DE',
			),

			array(
				'value' => 'de-DE-ElkeNeural',
				'text'  => 'Elke - de-DE',
			),

			array(
				'value' => 'de-DE-GiselaNeural',
				'text'  => 'Gisela - de-DE',
			),

			array(
				'value' => 'de-DE-KasperNeural',
				'text'  => 'Kasper - de-DE',
			),

			array(
				'value' => 'de-DE-KillianNeural',
				'text'  => 'Killian - de-DE',
			),

			array(
				'value' => 'de-DE-KlarissaNeural',
				'text'  => 'Klarissa - de-DE',
			),

			array(
				'value' => 'de-DE-KlausNeural',
				'text'  => 'Klaus - de-DE',
			),

			array(
				'value' => 'de-DE-LouisaNeural',
				'text'  => 'Louisa - de-DE',
			),

			array(
				'value' => 'de-DE-MajaNeural',
				'text'  => 'Maja - de-DE',
			),

			array(
				'value' => 'de-DE-RalfNeural',
				'text'  => 'Ralf - de-DE',
			),

			array(
				'value' => 'de-DE-TanjaNeural',
				'text'  => 'Tanja - de-DE',
			),

			array(
				'value' => 'el-GR-AthinaNeural',
				'text'  => 'Athina - el-GR',
			),

			array(
				'value' => 'el-GR-NestorasNeural',
				'text'  => 'Nestoras - el-GR',
			),

			array(
				'value' => 'en-AU-NatashaNeural',
				'text'  => 'Natasha - en-AU',
			),

			array(
				'value' => 'en-AU-WilliamNeural',
				'text'  => 'William - en-AU',
			),

			array(
				'value' => 'en-AU-AnnetteNeural',
				'text'  => 'Annette - en-AU',
			),

			array(
				'value' => 'en-AU-CarlyNeural',
				'text'  => 'Carly - en-AU',
			),

			array(
				'value' => 'en-AU-DarrenNeural',
				'text'  => 'Darren - en-AU',
			),

			array(
				'value' => 'en-AU-DuncanNeural',
				'text'  => 'Duncan - en-AU',
			),

			array(
				'value' => 'en-AU-ElsieNeural',
				'text'  => 'Elsie - en-AU',
			),

			array(
				'value' => 'en-AU-FreyaNeural',
				'text'  => 'Freya - en-AU',
			),

			array(
				'value' => 'en-AU-JoanneNeural',
				'text'  => 'Joanne - en-AU',
			),

			array(
				'value' => 'en-AU-KenNeural',
				'text'  => 'Ken - en-AU',
			),

			array(
				'value' => 'en-AU-KimNeural',
				'text'  => 'Kim - en-AU',
			),

			array(
				'value' => 'en-AU-NeilNeural',
				'text'  => 'Neil - en-AU',
			),

			array(
				'value' => 'en-AU-TimNeural',
				'text'  => 'Tim - en-AU',
			),

			array(
				'value' => 'en-AU-TinaNeural',
				'text'  => 'Tina - en-AU',
			),

			array(
				'value' => 'en-CA-ClaraNeural',
				'text'  => 'Clara - en-CA',
			),

			array(
				'value' => 'en-CA-LiamNeural',
				'text'  => 'Liam - en-CA',
			),

			array(
				'value' => 'en-GB-SoniaNeural',
				'text'  => 'Sonia - en-GB',
			),

			array(
				'value' => 'en-GB-RyanNeural',
				'text'  => 'Ryan - en-GB',
			),

			array(
				'value' => 'en-GB-LibbyNeural',
				'text'  => 'Libby - en-GB',
			),

			array(
				'value' => 'en-GB-AbbiNeural',
				'text'  => 'Abbi - en-GB',
			),

			array(
				'value' => 'en-GB-AlfieNeural',
				'text'  => 'Alfie - en-GB',
			),

			array(
				'value' => 'en-GB-BellaNeural',
				'text'  => 'Bella - en-GB',
			),

			array(
				'value' => 'en-GB-ElliotNeural',
				'text'  => 'Elliot - en-GB',
			),

			array(
				'value' => 'en-GB-EthanNeural',
				'text'  => 'Ethan - en-GB',
			),

			array(
				'value' => 'en-GB-HollieNeural',
				'text'  => 'Hollie - en-GB',
			),

			array(
				'value' => 'en-GB-MaisieNeural',
				'text'  => 'Maisie - en-GB',
			),

			array(
				'value' => 'en-GB-NoahNeural',
				'text'  => 'Noah - en-GB',
			),

			array(
				'value' => 'en-GB-OliverNeural',
				'text'  => 'Oliver - en-GB',
			),

			array(
				'value' => 'en-GB-OliviaNeural',
				'text'  => 'Olivia - en-GB',
			),

			array(
				'value' => 'en-GB-ThomasNeural',
				'text'  => 'Thomas - en-GB',
			),

			array(
				'value' => 'en-GB-MiaNeural',
				'text'  => 'Mia - en-GB',
			),

			array(
				'value' => 'en-HK-YanNeural',
				'text'  => 'Yan - en-HK',
			),

			array(
				'value' => 'en-HK-SamNeural',
				'text'  => 'Sam - en-HK',
			),

			array(
				'value' => 'en-IE-EmilyNeural',
				'text'  => 'Emily - en-IE',
			),

			array(
				'value' => 'en-IE-ConnorNeural',
				'text'  => 'Connor - en-IE',
			),

			array(
				'value' => 'en-IN-NeerjaNeural',
				'text'  => 'Neerja - en-IN',
			),

			array(
				'value' => 'en-IN-PrabhatNeural',
				'text'  => 'Prabhat - en-IN',
			),

			array(
				'value' => 'en-KE-AsiliaNeural',
				'text'  => 'Asilia - en-KE',
			),

			array(
				'value' => 'en-KE-ChilembaNeural',
				'text'  => 'Chilemba - en-KE',
			),

			array(
				'value' => 'en-NG-EzinneNeural',
				'text'  => 'Ezinne - en-NG',
			),

			array(
				'value' => 'en-NG-AbeoNeural',
				'text'  => 'Abeo - en-NG',
			),

			array(
				'value' => 'en-NZ-MollyNeural',
				'text'  => 'Molly - en-NZ',
			),

			array(
				'value' => 'en-NZ-MitchellNeural',
				'text'  => 'Mitchell - en-NZ',
			),

			array(
				'value' => 'en-PH-RosaNeural',
				'text'  => 'Rosa - en-PH',
			),

			array(
				'value' => 'en-PH-JamesNeural',
				'text'  => 'James - en-PH',
			),

			array(
				'value' => 'en-SG-LunaNeural',
				'text'  => 'Luna - en-SG',
			),

			array(
				'value' => 'en-SG-WayneNeural',
				'text'  => 'Wayne - en-SG',
			),

			array(
				'value' => 'en-TZ-ImaniNeural',
				'text'  => 'Imani - en-TZ',
			),

			array(
				'value' => 'en-TZ-ElimuNeural',
				'text'  => 'Elimu - en-TZ',
			),

			array(
				'value' => 'en-US-JennyMultilingualNeural',
				'text'  => 'Jenny Multilingual - en-US',
			),

			array(
				'value' => 'en-US-JennyNeural',
				'text'  => 'Jenny - en-US',
			),

			array(
				'value' => 'en-US-GuyNeural',
				'text'  => 'Guy - en-US',
			),

			array(
				'value' => 'en-US-AriaNeural',
				'text'  => 'Aria - en-US',
			),

			array(
				'value' => 'en-US-DavisNeural',
				'text'  => 'Davis - en-US',
			),

			array(
				'value' => 'en-US-AmberNeural',
				'text'  => 'Amber - en-US',
			),

			array(
				'value' => 'en-US-AnaNeural',
				'text'  => 'Ana - en-US',
			),

			array(
				'value' => 'en-US-AshleyNeural',
				'text'  => 'Ashley - en-US',
			),

			array(
				'value' => 'en-US-BrandonNeural',
				'text'  => 'Brandon - en-US',
			),

			array(
				'value' => 'en-US-ChristopherNeural',
				'text'  => 'Christopher - en-US',
			),

			array(
				'value' => 'en-US-CoraNeural',
				'text'  => 'Cora - en-US',
			),

			array(
				'value' => 'en-US-ElizabethNeural',
				'text'  => 'Elizabeth - en-US',
			),

			array(
				'value' => 'en-US-EricNeural',
				'text'  => 'Eric - en-US',
			),

			array(
				'value' => 'en-US-JacobNeural',
				'text'  => 'Jacob - en-US',
			),

			array(
				'value' => 'en-US-JaneNeural',
				'text'  => 'Jane - en-US',
			),

			array(
				'value' => 'en-US-JasonNeural',
				'text'  => 'Jason - en-US',
			),

			array(
				'value' => 'en-US-MichelleNeural',
				'text'  => 'Michelle - en-US',
			),

			array(
				'value' => 'en-US-MonicaNeural',
				'text'  => 'Monica - en-US',
			),

			array(
				'value' => 'en-US-NancyNeural',
				'text'  => 'Nancy - en-US',
			),

			array(
				'value' => 'en-US-RogerNeural',
				'text'  => 'Roger - en-US',
			),

			array(
				'value' => 'en-US-SaraNeural',
				'text'  => 'Sara - en-US',
			),

			array(
				'value' => 'en-US-SteffanNeural',
				'text'  => 'Steffan - en-US',
			),

			array(
				'value' => 'en-US-TonyNeural',
				'text'  => 'Tony - en-US',
			),

			array(
				'value' => 'en-US-AIGenerate1Neural',
				'text'  => 'AIGenerate1 - en-US',
			),

			array(
				'value' => 'en-US-AIGenerate2Neural',
				'text'  => 'AIGenerate2 - en-US',
			),

			array(
				'value' => 'en-US-AndrewNeural',
				'text'  => 'Andrew - en-US',
			),

			array(
				'value' => 'en-US-BlueNeural',
				'text'  => 'Blue - en-US',
			),

			array(
				'value' => 'en-US-BrianNeural',
				'text'  => 'Brian - en-US',
			),

			array(
				'value' => 'en-US-EmmaNeural',
				'text'  => 'Emma - en-US',
			),

			array(
				'value' => 'en-US-JennyMultilingualV2Neural',
				'text'  => 'Jenny Multilingual V2 - en-US',
			),

			array(
				'value' => 'en-US-RyanMultilingualNeural',
				'text'  => 'Ryan Multilingual - en-US',
			),

			array(
				'value' => 'en-ZA-LeahNeural',
				'text'  => 'Leah - en-ZA',
			),

			array(
				'value' => 'en-ZA-LukeNeural',
				'text'  => 'Luke - en-ZA',
			),

			array(
				'value' => 'es-AR-ElenaNeural',
				'text'  => 'Elena - es-AR',
			),

			array(
				'value' => 'es-AR-TomasNeural',
				'text'  => 'Tomas - es-AR',
			),

			array(
				'value' => 'es-BO-SofiaNeural',
				'text'  => 'Sofia - es-BO',
			),

			array(
				'value' => 'es-BO-MarceloNeural',
				'text'  => 'Marcelo - es-BO',
			),

			array(
				'value' => 'es-CL-CatalinaNeural',
				'text'  => 'Catalina - es-CL',
			),

			array(
				'value' => 'es-CL-LorenzoNeural',
				'text'  => 'Lorenzo - es-CL',
			),

			array(
				'value' => 'es-CO-SalomeNeural',
				'text'  => 'Salome - es-CO',
			),

			array(
				'value' => 'es-CO-GonzaloNeural',
				'text'  => 'Gonzalo - es-CO',
			),

			array(
				'value' => 'es-CR-MariaNeural',
				'text'  => 'Maria - es-CR',
			),

			array(
				'value' => 'es-CR-JuanNeural',
				'text'  => 'Juan - es-CR',
			),

			array(
				'value' => 'es-CU-BelkysNeural',
				'text'  => 'Belkys - es-CU',
			),

			array(
				'value' => 'es-CU-ManuelNeural',
				'text'  => 'Manuel - es-CU',
			),

			array(
				'value' => 'es-DO-RamonaNeural',
				'text'  => 'Ramona - es-DO',
			),

			array(
				'value' => 'es-DO-EmilioNeural',
				'text'  => 'Emilio - es-DO',
			),

			array(
				'value' => 'es-EC-AndreaNeural',
				'text'  => 'Andrea - es-EC',
			),

			array(
				'value' => 'es-EC-LuisNeural',
				'text'  => 'Luis - es-EC',
			),

			array(
				'value' => 'es-ES-ElviraNeural',
				'text'  => 'Elvira - es-ES',
			),

			array(
				'value' => 'es-ES-AlvaroNeural',
				'text'  => 'Alvaro - es-ES',
			),

			array(
				'value' => 'es-ES-AbrilNeural',
				'text'  => 'Abril - es-ES',
			),

			array(
				'value' => 'es-ES-ArnauNeural',
				'text'  => 'Arnau - es-ES',
			),

			array(
				'value' => 'es-ES-DarioNeural',
				'text'  => 'Dario - es-ES',
			),

			array(
				'value' => 'es-ES-EliasNeural',
				'text'  => 'Elias - es-ES',
			),

			array(
				'value' => 'es-ES-EstrellaNeural',
				'text'  => 'Estrella - es-ES',
			),

			array(
				'value' => 'es-ES-IreneNeural',
				'text'  => 'Irene - es-ES',
			),

			array(
				'value' => 'es-ES-LaiaNeural',
				'text'  => 'Laia - es-ES',
			),

			array(
				'value' => 'es-ES-LiaNeural',
				'text'  => 'Lia - es-ES',
			),

			array(
				'value' => 'es-ES-NilNeural',
				'text'  => 'Nil - es-ES',
			),

			array(
				'value' => 'es-ES-SaulNeural',
				'text'  => 'Saul - es-ES',
			),

			array(
				'value' => 'es-ES-TeoNeural',
				'text'  => 'Teo - es-ES',
			),

			array(
				'value' => 'es-ES-TrianaNeural',
				'text'  => 'Triana - es-ES',
			),

			array(
				'value' => 'es-ES-VeraNeural',
				'text'  => 'Vera - es-ES',
			),

			array(
				'value' => 'es-GQ-TeresaNeural',
				'text'  => 'Teresa - es-GQ',
			),

			array(
				'value' => 'es-GQ-JavierNeural',
				'text'  => 'Javier - es-GQ',
			),

			array(
				'value' => 'es-GT-MartaNeural',
				'text'  => 'Marta - es-GT',
			),

			array(
				'value' => 'es-GT-AndresNeural',
				'text'  => 'Andres - es-GT',
			),

			array(
				'value' => 'es-HN-KarlaNeural',
				'text'  => 'Karla - es-HN',
			),

			array(
				'value' => 'es-HN-CarlosNeural',
				'text'  => 'Carlos - es-HN',
			),

			array(
				'value' => 'es-MX-DaliaNeural',
				'text'  => 'Dalia - es-MX',
			),

			array(
				'value' => 'es-MX-JorgeNeural',
				'text'  => 'Jorge - es-MX',
			),

			array(
				'value' => 'es-MX-BeatrizNeural',
				'text'  => 'Beatriz - es-MX',
			),

			array(
				'value' => 'es-MX-CandelaNeural',
				'text'  => 'Candela - es-MX',
			),

			array(
				'value' => 'es-MX-CarlotaNeural',
				'text'  => 'Carlota - es-MX',
			),

			array(
				'value' => 'es-MX-CecilioNeural',
				'text'  => 'Cecilio - es-MX',
			),

			array(
				'value' => 'es-MX-GerardoNeural',
				'text'  => 'Gerardo - es-MX',
			),

			array(
				'value' => 'es-MX-LarissaNeural',
				'text'  => 'Larissa - es-MX',
			),

			array(
				'value' => 'es-MX-LibertoNeural',
				'text'  => 'Liberto - es-MX',
			),

			array(
				'value' => 'es-MX-LucianoNeural',
				'text'  => 'Luciano - es-MX',
			),

			array(
				'value' => 'es-MX-MarinaNeural',
				'text'  => 'Marina - es-MX',
			),

			array(
				'value' => 'es-MX-NuriaNeural',
				'text'  => 'Nuria - es-MX',
			),

			array(
				'value' => 'es-MX-PelayoNeural',
				'text'  => 'Pelayo - es-MX',
			),

			array(
				'value' => 'es-MX-RenataNeural',
				'text'  => 'Renata - es-MX',
			),

			array(
				'value' => 'es-MX-YagoNeural',
				'text'  => 'Yago - es-MX',
			),

			array(
				'value' => 'es-NI-YolandaNeural',
				'text'  => 'Yolanda - es-NI',
			),

			array(
				'value' => 'es-NI-FedericoNeural',
				'text'  => 'Federico - es-NI',
			),

			array(
				'value' => 'es-PA-MargaritaNeural',
				'text'  => 'Margarita - es-PA',
			),

			array(
				'value' => 'es-PA-RobertoNeural',
				'text'  => 'Roberto - es-PA',
			),

			array(
				'value' => 'es-PE-CamilaNeural',
				'text'  => 'Camila - es-PE',
			),

			array(
				'value' => 'es-PE-AlexNeural',
				'text'  => 'Alex - es-PE',
			),

			array(
				'value' => 'es-PR-KarinaNeural',
				'text'  => 'Karina - es-PR',
			),

			array(
				'value' => 'es-PR-VictorNeural',
				'text'  => 'Victor - es-PR',
			),

			array(
				'value' => 'es-PY-TaniaNeural',
				'text'  => 'Tania - es-PY',
			),

			array(
				'value' => 'es-PY-MarioNeural',
				'text'  => 'Mario - es-PY',
			),

			array(
				'value' => 'es-SV-LorenaNeural',
				'text'  => 'Lorena - es-SV',
			),

			array(
				'value' => 'es-SV-RodrigoNeural',
				'text'  => 'Rodrigo - es-SV',
			),

			array(
				'value' => 'es-US-PalomaNeural',
				'text'  => 'Paloma - es-US',
			),

			array(
				'value' => 'es-US-AlonsoNeural',
				'text'  => 'Alonso - es-US',
			),

			array(
				'value' => 'es-UY-ValentinaNeural',
				'text'  => 'Valentina - es-UY',
			),

			array(
				'value' => 'es-UY-MateoNeural',
				'text'  => 'Mateo - es-UY',
			),

			array(
				'value' => 'es-VE-PaolaNeural',
				'text'  => 'Paola - es-VE',
			),

			array(
				'value' => 'es-VE-SebastianNeural',
				'text'  => 'Sebastian - es-VE',
			),

			array(
				'value' => 'et-EE-AnuNeural',
				'text'  => 'Anu - et-EE',
			),

			array(
				'value' => 'et-EE-KertNeural',
				'text'  => 'Kert - et-EE',
			),

			array(
				'value' => 'eu-ES-AinhoaNeural',
				'text'  => 'Ainhoa - eu-ES',
			),

			array(
				'value' => 'eu-ES-AnderNeural',
				'text'  => 'Ander - eu-ES',
			),

			array(
				'value' => 'fa-IR-DilaraNeural',
				'text'  => 'Dilara - fa-IR',
			),

			array(
				'value' => 'fa-IR-FaridNeural',
				'text'  => 'Farid - fa-IR',
			),

			array(
				'value' => 'fi-FI-SelmaNeural',
				'text'  => 'Selma - fi-FI',
			),

			array(
				'value' => 'fi-FI-HarriNeural',
				'text'  => 'Harri - fi-FI',
			),

			array(
				'value' => 'fi-FI-NooraNeural',
				'text'  => 'Noora - fi-FI',
			),

			array(
				'value' => 'fil-PH-BlessicaNeural',
				'text'  => 'Blessica - fil-PH',
			),

			array(
				'value' => 'fil-PH-AngeloNeural',
				'text'  => 'Angelo - fil-PH',
			),

			array(
				'value' => 'fr-BE-CharlineNeural',
				'text'  => 'Charline - fr-BE',
			),

			array(
				'value' => 'fr-BE-GerardNeural',
				'text'  => 'Gerard - fr-BE',
			),

			array(
				'value' => 'fr-CA-SylvieNeural',
				'text'  => 'Sylvie - fr-CA',
			),

			array(
				'value' => 'fr-CA-JeanNeural',
				'text'  => 'Jean - fr-CA',
			),

			array(
				'value' => 'fr-CA-AntoineNeural',
				'text'  => 'Antoine - fr-CA',
			),

			array(
				'value' => 'fr-CH-ArianeNeural',
				'text'  => 'Ariane - fr-CH',
			),

			array(
				'value' => 'fr-CH-FabriceNeural',
				'text'  => 'Fabrice - fr-CH',
			),

			array(
				'value' => 'fr-FR-DeniseNeural',
				'text'  => 'Denise - fr-FR',
			),

			array(
				'value' => 'fr-FR-HenriNeural',
				'text'  => 'Henri - fr-FR',
			),

			array(
				'value' => 'fr-FR-AlainNeural',
				'text'  => 'Alain - fr-FR',
			),

			array(
				'value' => 'fr-FR-BrigitteNeural',
				'text'  => 'Brigitte - fr-FR',
			),

			array(
				'value' => 'fr-FR-CelesteNeural',
				'text'  => 'Celeste - fr-FR',
			),

			array(
				'value' => 'fr-FR-ClaudeNeural',
				'text'  => 'Claude - fr-FR',
			),

			array(
				'value' => 'fr-FR-CoralieNeural',
				'text'  => 'Coralie - fr-FR',
			),

			array(
				'value' => 'fr-FR-EloiseNeural',
				'text'  => 'Eloise - fr-FR',
			),

			array(
				'value' => 'fr-FR-JacquelineNeural',
				'text'  => 'Jacqueline - fr-FR',
			),

			array(
				'value' => 'fr-FR-JeromeNeural',
				'text'  => 'Jerome - fr-FR',
			),

			array(
				'value' => 'fr-FR-JosephineNeural',
				'text'  => 'Josephine - fr-FR',
			),

			array(
				'value' => 'fr-FR-MauriceNeural',
				'text'  => 'Maurice - fr-FR',
			),

			array(
				'value' => 'fr-FR-YvesNeural',
				'text'  => 'Yves - fr-FR',
			),

			array(
				'value' => 'fr-FR-YvetteNeural',
				'text'  => 'Yvette - fr-FR',
			),

			array(
				'value' => 'ga-IE-OrlaNeural',
				'text'  => 'Orla - ga-IE',
			),

			array(
				'value' => 'ga-IE-ColmNeural',
				'text'  => 'Colm - ga-IE',
			),

			array(
				'value' => 'gl-ES-SabelaNeural',
				'text'  => 'Sabela - gl-ES',
			),

			array(
				'value' => 'gl-ES-RoiNeural',
				'text'  => 'Roi - gl-ES',
			),

			array(
				'value' => 'gu-IN-DhwaniNeural',
				'text'  => 'Dhwani - gu-IN',
			),

			array(
				'value' => 'gu-IN-NiranjanNeural',
				'text'  => 'Niranjan - gu-IN',
			),

			array(
				'value' => 'he-IL-HilaNeural',
				'text'  => 'Hila - he-IL',
			),

			array(
				'value' => 'he-IL-AvriNeural',
				'text'  => 'Avri - he-IL',
			),

			array(
				'value' => 'hi-IN-SwaraNeural',
				'text'  => 'Swara - hi-IN',
			),

			array(
				'value' => 'hi-IN-MadhurNeural',
				'text'  => 'Madhur - hi-IN',
			),

			array(
				'value' => 'hr-HR-GabrijelaNeural',
				'text'  => 'Gabrijela - hr-HR',
			),

			array(
				'value' => 'hr-HR-SreckoNeural',
				'text'  => 'Srecko - hr-HR',
			),

			array(
				'value' => 'hu-HU-NoemiNeural',
				'text'  => 'Noemi - hu-HU',
			),

			array(
				'value' => 'hu-HU-TamasNeural',
				'text'  => 'Tamas - hu-HU',
			),

			array(
				'value' => 'hy-AM-AnahitNeural',
				'text'  => 'Anahit - hy-AM',
			),

			array(
				'value' => 'hy-AM-HaykNeural',
				'text'  => 'Hayk - hy-AM',
			),

			array(
				'value' => 'id-ID-GadisNeural',
				'text'  => 'Gadis - id-ID',
			),

			array(
				'value' => 'id-ID-ArdiNeural',
				'text'  => 'Ardi - id-ID',
			),

			array(
				'value' => 'is-IS-GudrunNeural',
				'text'  => 'Gudrun - is-IS',
			),

			array(
				'value' => 'is-IS-GunnarNeural',
				'text'  => 'Gunnar - is-IS',
			),

			array(
				'value' => 'it-IT-ElsaNeural',
				'text'  => 'Elsa - it-IT',
			),

			array(
				'value' => 'it-IT-IsabellaNeural',
				'text'  => 'Isabella - it-IT',
			),

			array(
				'value' => 'it-IT-DiegoNeural',
				'text'  => 'Diego - it-IT',
			),

			array(
				'value' => 'it-IT-BenignoNeural',
				'text'  => 'Benigno - it-IT',
			),

			array(
				'value' => 'it-IT-CalimeroNeural',
				'text'  => 'Calimero - it-IT',
			),

			array(
				'value' => 'it-IT-CataldoNeural',
				'text'  => 'Cataldo - it-IT',
			),

			array(
				'value' => 'it-IT-FabiolaNeural',
				'text'  => 'Fabiola - it-IT',
			),

			array(
				'value' => 'it-IT-FiammaNeural',
				'text'  => 'Fiamma - it-IT',
			),

			array(
				'value' => 'it-IT-GianniNeural',
				'text'  => 'Gianni - it-IT',
			),

			array(
				'value' => 'it-IT-ImeldaNeural',
				'text'  => 'Imelda - it-IT',
			),

			array(
				'value' => 'it-IT-IrmaNeural',
				'text'  => 'Irma - it-IT',
			),

			array(
				'value' => 'it-IT-LisandroNeural',
				'text'  => 'Lisandro - it-IT',
			),

			array(
				'value' => 'it-IT-PalmiraNeural',
				'text'  => 'Palmira - it-IT',
			),

			array(
				'value' => 'it-IT-PierinaNeural',
				'text'  => 'Pierina - it-IT',
			),

			array(
				'value' => 'it-IT-RinaldoNeural',
				'text'  => 'Rinaldo - it-IT',
			),

			array(
				'value' => 'ja-JP-NanamiNeural',
				'text'  => 'Nanami - ja-JP',
			),

			array(
				'value' => 'ja-JP-KeitaNeural',
				'text'  => 'Keita - ja-JP',
			),

			array(
				'value' => 'ja-JP-AoiNeural',
				'text'  => 'Aoi - ja-JP',
			),

			array(
				'value' => 'ja-JP-DaichiNeural',
				'text'  => 'Daichi - ja-JP',
			),

			array(
				'value' => 'ja-JP-MayuNeural',
				'text'  => 'Mayu - ja-JP',
			),

			array(
				'value' => 'ja-JP-NaokiNeural',
				'text'  => 'Naoki - ja-JP',
			),

			array(
				'value' => 'ja-JP-ShioriNeural',
				'text'  => 'Shiori - ja-JP',
			),

			array(
				'value' => 'jv-ID-SitiNeural',
				'text'  => 'Siti - jv-ID',
			),

			array(
				'value' => 'jv-ID-DimasNeural',
				'text'  => 'Dimas - jv-ID',
			),

			array(
				'value' => 'ka-GE-EkaNeural',
				'text'  => 'Eka - ka-GE',
			),

			array(
				'value' => 'ka-GE-GiorgiNeural',
				'text'  => 'Giorgi - ka-GE',
			),

			array(
				'value' => 'kk-KZ-AigulNeural',
				'text'  => 'Aigul - kk-KZ',
			),

			array(
				'value' => 'kk-KZ-DauletNeural',
				'text'  => 'Daulet - kk-KZ',
			),

			array(
				'value' => 'km-KH-SreymomNeural',
				'text'  => 'Sreymom - km-KH',
			),

			array(
				'value' => 'km-KH-PisethNeural',
				'text'  => 'Piseth - km-KH',
			),

			array(
				'value' => 'kn-IN-SapnaNeural',
				'text'  => 'Sapna - kn-IN',
			),

			array(
				'value' => 'kn-IN-GaganNeural',
				'text'  => 'Gagan - kn-IN',
			),

			array(
				'value' => 'ko-KR-SunHiNeural',
				'text'  => 'Sun-Hi - ko-KR',
			),

			array(
				'value' => 'ko-KR-InJoonNeural',
				'text'  => 'InJoon - ko-KR',
			),

			array(
				'value' => 'ko-KR-BongJinNeural',
				'text'  => 'BongJin - ko-KR',
			),

			array(
				'value' => 'ko-KR-GookMinNeural',
				'text'  => 'GookMin - ko-KR',
			),

			array(
				'value' => 'ko-KR-JiMinNeural',
				'text'  => 'JiMin - ko-KR',
			),

			array(
				'value' => 'ko-KR-SeoHyeonNeural',
				'text'  => 'SeoHyeon - ko-KR',
			),

			array(
				'value' => 'ko-KR-SoonBokNeural',
				'text'  => 'SoonBok - ko-KR',
			),

			array(
				'value' => 'ko-KR-YuJinNeural',
				'text'  => 'YuJin - ko-KR',
			),

			array(
				'value' => 'lo-LA-KeomanyNeural',
				'text'  => 'Keomany - lo-LA',
			),

			array(
				'value' => 'lo-LA-ChanthavongNeural',
				'text'  => 'Chanthavong - lo-LA',
			),

			array(
				'value' => 'lt-LT-OnaNeural',
				'text'  => 'Ona - lt-LT',
			),

			array(
				'value' => 'lt-LT-LeonasNeural',
				'text'  => 'Leonas - lt-LT',
			),

			array(
				'value' => 'lv-LV-EveritaNeural',
				'text'  => 'Everita - lv-LV',
			),

			array(
				'value' => 'lv-LV-NilsNeural',
				'text'  => 'Nils - lv-LV',
			),

			array(
				'value' => 'mk-MK-MarijaNeural',
				'text'  => 'Marija - mk-MK',
			),

			array(
				'value' => 'mk-MK-AleksandarNeural',
				'text'  => 'Aleksandar - mk-MK',
			),

			array(
				'value' => 'ml-IN-SobhanaNeural',
				'text'  => 'Sobhana - ml-IN',
			),

			array(
				'value' => 'ml-IN-MidhunNeural',
				'text'  => 'Midhun - ml-IN',
			),

			array(
				'value' => 'mn-MN-YesuiNeural',
				'text'  => 'Yesui - mn-MN',
			),

			array(
				'value' => 'mn-MN-BataaNeural',
				'text'  => 'Bataa - mn-MN',
			),

			array(
				'value' => 'mr-IN-AarohiNeural',
				'text'  => 'Aarohi - mr-IN',
			),

			array(
				'value' => 'mr-IN-ManoharNeural',
				'text'  => 'Manohar - mr-IN',
			),

			array(
				'value' => 'ms-MY-YasminNeural',
				'text'  => 'Yasmin - ms-MY',
			),

			array(
				'value' => 'ms-MY-OsmanNeural',
				'text'  => 'Osman - ms-MY',
			),

			array(
				'value' => 'mt-MT-GraceNeural',
				'text'  => 'Grace - mt-MT',
			),

			array(
				'value' => 'mt-MT-JosephNeural',
				'text'  => 'Joseph - mt-MT',
			),

			array(
				'value' => 'my-MM-NilarNeural',
				'text'  => 'Nilar - my-MM',
			),

			array(
				'value' => 'my-MM-ThihaNeural',
				'text'  => 'Thiha - my-MM',
			),

			array(
				'value' => 'nb-NO-PernilleNeural',
				'text'  => 'Pernille - nb-NO',
			),

			array(
				'value' => 'nb-NO-FinnNeural',
				'text'  => 'Finn - nb-NO',
			),

			array(
				'value' => 'nb-NO-IselinNeural',
				'text'  => 'Iselin - nb-NO',
			),

			array(
				'value' => 'ne-NP-HemkalaNeural',
				'text'  => 'Hemkala - ne-NP',
			),

			array(
				'value' => 'ne-NP-SagarNeural',
				'text'  => 'Sagar - ne-NP',
			),

			array(
				'value' => 'nl-BE-DenaNeural',
				'text'  => 'Dena - nl-BE',
			),

			array(
				'value' => 'nl-BE-ArnaudNeural',
				'text'  => 'Arnaud - nl-BE',
			),

			array(
				'value' => 'nl-NL-FennaNeural',
				'text'  => 'Fenna - nl-NL',
			),

			array(
				'value' => 'nl-NL-MaartenNeural',
				'text'  => 'Maarten - nl-NL',
			),

			array(
				'value' => 'nl-NL-ColetteNeural',
				'text'  => 'Colette - nl-NL',
			),

			array(
				'value' => 'pl-PL-AgnieszkaNeural',
				'text'  => 'Agnieszka - pl-PL',
			),

			array(
				'value' => 'pl-PL-MarekNeural',
				'text'  => 'Marek - pl-PL',
			),

			array(
				'value' => 'pl-PL-ZofiaNeural',
				'text'  => 'Zofia - pl-PL',
			),

			array(
				'value' => 'ps-AF-LatifaNeural',
				'text'  => 'Latifa - ps-AF',
			),

			array(
				'value' => 'ps-AF-GulNawazNeural',
				'text'  => 'Gul Nawaz - ps-AF',
			),

			array(
				'value' => 'pt-BR-FranciscaNeural',
				'text'  => 'Francisca - pt-BR',
			),

			array(
				'value' => 'pt-BR-AntonioNeural',
				'text'  => 'Antonio - pt-BR',
			),

			array(
				'value' => 'pt-BR-BrendaNeural',
				'text'  => 'Brenda - pt-BR',
			),

			array(
				'value' => 'pt-BR-DonatoNeural',
				'text'  => 'Donato - pt-BR',
			),

			array(
				'value' => 'pt-BR-ElzaNeural',
				'text'  => 'Elza - pt-BR',
			),

			array(
				'value' => 'pt-BR-FabioNeural',
				'text'  => 'Fabio - pt-BR',
			),

			array(
				'value' => 'pt-BR-GiovannaNeural',
				'text'  => 'Giovanna - pt-BR',
			),

			array(
				'value' => 'pt-BR-HumbertoNeural',
				'text'  => 'Humberto - pt-BR',
			),

			array(
				'value' => 'pt-BR-JulioNeural',
				'text'  => 'Julio - pt-BR',
			),

			array(
				'value' => 'pt-BR-LeilaNeural',
				'text'  => 'Leila - pt-BR',
			),

			array(
				'value' => 'pt-BR-LeticiaNeural',
				'text'  => 'Leticia - pt-BR',
			),

			array(
				'value' => 'pt-BR-ManuelaNeural',
				'text'  => 'Manuela - pt-BR',
			),

			array(
				'value' => 'pt-BR-NicolauNeural',
				'text'  => 'Nicolau - pt-BR',
			),

			array(
				'value' => 'pt-BR-ValerioNeural',
				'text'  => 'Valerio - pt-BR',
			),
			array(
				'value' => 'pt-BR-YaraNeural',
				'text'  => 'Yara - pt-BR',
			),
			array(
				'value' => 'pt-PT-RaquelNeural',
				'text'  => 'Raquel - pt-PT',
			),
			array(
				'value' => 'pt-PT-DuarteNeural',
				'text'  => 'Duarte - pt-PT',
			),
			array(
				'value' => 'pt-PT-FernandaNeural',
				'text'  => 'Fernanda - pt-PT',
			),
			array(
				'value' => 'ro-RO-AlinaNeural',
				'text'  => 'Alina - ro-RO',
			),
			array(
				'value' => 'ro-RO-EmilNeural',
				'text'  => 'Emil - ro-RO',
			),
			array(
				'value' => 'ru-RU-SvetlanaNeural',
				'text'  => 'Svetlana - ru-RU',
			),
			array(
				'value' => 'ru-RU-DmitryNeural',
				'text'  => 'Dmitry - ru-RU',
			),
			array(
				'value' => 'ru-RU-DariyaNeural',
				'text'  => 'Dariya - ru-RU',
			),
			array(
				'value' => 'si-LK-ThiliniNeural',
				'text'  => 'Thilini - si-LK',
			),
			array(
				'value' => 'si-LK-SameeraNeural',
				'text'  => 'Sameera - si-LK',
			),
			array(
				'value' => 'sk-SK-ViktoriaNeural',
				'text'  => 'Viktoria - sk-SK',
			),
			array(
				'value' => 'sk-SK-LukasNeural',
				'text'  => 'Lukas - sk-SK',
			),
			array(
				'value' => 'sl-SI-PetraNeural',
				'text'  => 'Petra - sl-SI',
			),
			array(
				'value' => 'sl-SI-RokNeural',
				'text'  => 'Rok - sl-SI',
			),
			array(
				'value' => 'so-SO-UbaxNeural',
				'text'  => 'Ubax - so-SO',
			),
			array(
				'value' => 'so-SO-MuuseNeural',
				'text'  => 'Muuse - so-SO',
			),
			array(
				'value' => 'sq-AL-AnilaNeural',
				'text'  => 'Anila - sq-AL',
			),
			array(
				'value' => 'sq-AL-IlirNeural',
				'text'  => 'Ilir - sq-AL',
			),
			array(
				'value' => 'sr-Latn-RS-NicholasNeural',
				'text'  => 'Nicholas - sr-Latn-RS',
			),
			array(
				'value' => 'sr-Latn-RS-SophieNeural',
				'text'  => 'Sophie - sr-Latn-RS',
			),
			array(
				'value' => 'sr-RS-SophieNeural',
				'text'  => 'Sophie - sr-RS',
			),
			array(
				'value' => 'sr-RS-NicholasNeural',
				'text'  => 'Nicholas - sr-RS',
			),
			array(
				'value' => 'su-ID-TutiNeural',
				'text'  => 'Tuti - su-ID',
			),
			array(
				'value' => 'su-ID-JajangNeural',
				'text'  => 'Jajang - su-ID',
			),
			array(
				'value' => 'sv-SE-SofieNeural',
				'text'  => 'Sofie - sv-SE',
			),
			array(
				'value' => 'sv-SE-MattiasNeural',
				'text'  => 'Mattias - sv-SE',
			),
			array(
				'value' => 'sv-SE-HilleviNeural',
				'text'  => 'Hillevi - sv-SE',
			),
			array(
				'value' => 'sw-KE-ZuriNeural',
				'text'  => 'Zuri - sw-KE',
			),
			array(
				'value' => 'sw-KE-RafikiNeural',
				'text'  => 'Rafiki - sw-KE',
			),
			array(
				'value' => 'sw-TZ-RehemaNeural',
				'text'  => 'Rehema - sw-TZ',
			),
			array(
				'value' => 'sw-TZ-DaudiNeural',
				'text'  => 'Daudi - sw-TZ',
			),
			array(
				'value' => 'ta-IN-PallaviNeural',
				'text'  => 'Pallavi - ta-IN',
			),
			array(
				'value' => 'ta-IN-ValluvarNeural',
				'text'  => 'Valluvar - ta-IN',
			),
			array(
				'value' => 'ta-LK-SaranyaNeural',
				'text'  => 'Saranya - ta-LK',
			),
			array(
				'value' => 'ta-LK-KumarNeural',
				'text'  => 'Kumar - ta-LK',
			),
			array(
				'value' => 'ta-MY-KaniNeural',
				'text'  => 'Kani - ta-MY',
			),
			array(
				'value' => 'ta-MY-SuryaNeural',
				'text'  => 'Surya - ta-MY',
			),
			array(
				'value' => 'ta-SG-VenbaNeural',
				'text'  => 'Venba - ta-SG',
			),
			array(
				'value' => 'ta-SG-AnbuNeural',
				'text'  => 'Anbu - ta-SG',
			),
			array(
				'value' => 'te-IN-ShrutiNeural',
				'text'  => 'Shruti - te-IN',
			),
			array(
				'value' => 'te-IN-MohanNeural',
				'text'  => 'Mohan - te-IN',
			),
			array(
				'value' => 'th-TH-PremwadeeNeural',
				'text'  => 'Premwadee - th-TH',
			),
			array(
				'value' => 'th-TH-NiwatNeural',
				'text'  => 'Niwat - th-TH',
			),
			array(
				'value' => 'th-TH-AcharaNeural',
				'text'  => 'Achara - th-TH',
			),
			array(
				'value' => 'tr-TR-EmelNeural',
				'text'  => 'Emel - tr-TR',
			),
			array(
				'value' => 'tr-TR-AhmetNeural',
				'text'  => 'Ahmet - tr-TR',
			),
			array(
				'value' => 'uk-UA-PolinaNeural',
				'text'  => 'Polina - uk-UA',
			),
			array(
				'value' => 'uk-UA-OstapNeural',
				'text'  => 'Ostap - uk-UA',
			),
			array(
				'value' => 'ur-IN-GulNeural',
				'text'  => 'Gul - ur-IN',
			),
			array(
				'value' => 'ur-IN-SalmanNeural',
				'text'  => 'Salman - ur-IN',
			),
			array(
				'value' => 'ur-PK-UzmaNeural',
				'text'  => 'Uzma - ur-PK',
			),
			array(
				'value' => 'ur-PK-AsadNeural',
				'text'  => 'Asad - ur-PK',
			),
			array(
				'value' => 'uz-UZ-MadinaNeural',
				'text'  => 'Madina - uz-UZ',
			),
			array(
				'value' => 'uz-UZ-SardorNeural',
				'text'  => 'Sardor - uz-UZ',
			),
			array(
				'value' => 'vi-VN-HoaiMyNeural',
				'text'  => 'HoaiMy - vi-VN',
			),
			array(
				'value' => 'vi-VN-NamMinhNeural',
				'text'  => 'NamMinh - vi-VN',
			),
			array(
				'value' => 'wuu-CN-XiaotongNeural',
				'text'  => 'Xiaotong - wuu-CN',
			),
			array(
				'value' => 'wuu-CN-YunzheNeural',
				'text'  => 'Yunzhe - wuu-CN',
			),
			array(
				'value' => 'yue-CN-XiaoMinNeural',
				'text'  => 'XiaoMin - yue-CN',
			),
			array(
				'value' => 'yue-CN-YunSongNeural',
				'text'  => 'YunSong - yue-CN',
			),
			array(
				'value' => 'zh-CN-XiaoxiaoNeural',
				'text'  => 'Xiaoxiao - zh-CN',
			),
			array(
				'value' => 'zh-CN-YunxiNeural',
				'text'  => 'Yunxi - zh-CN',
			),
			array(
				'value' => 'zh-CN-YunjianNeural',
				'text'  => 'Yunjian - zh-CN',
			),
			array(
				'value' => 'zh-CN-XiaoyiNeural',
				'text'  => 'Xiaoyi - zh-CN',
			),
			array(
				'value' => 'zh-CN-YunyangNeural',
				'text'  => 'Yunyang - zh-CN',
			),
			array(
				'value' => 'zh-CN-XiaochenNeural',
				'text'  => 'Xiaochen - zh-CN',
			),
			array(
				'value' => 'zh-CN-XiaohanNeural',
				'text'  => 'Xiaohan - zh-CN',
			),
			array(
				'value' => 'zh-CN-XiaomengNeural',
				'text'  => 'Xiaomeng - zh-CN',
			),
			array(
				'value' => 'zh-CN-XiaomoNeural',
				'text'  => 'Xiaomo - zh-CN',
			),
			array(
				'value' => 'zh-CN-XiaoqiuNeural',
				'text'  => 'Xiaoqiu - zh-CN',
			),
			array(
				'value' => 'zh-CN-XiaoruiNeural',
				'text'  => 'Xiaorui - zh-CN',
			),
			array(
				'value' => 'zh-CN-XiaoshuangNeural',
				'text'  => 'Xiaoshuang - zh-CN',
			),
			array(
				'value' => 'zh-CN-XiaoxuanNeural',
				'text'  => 'Xiaoxuan - zh-CN',
			),
			array(
				'value' => 'zh-CN-XiaoyanNeural',
				'text'  => 'Xiaoyan - zh-CN',
			),
			array(
				'value' => 'zh-CN-XiaoyouNeural',
				'text'  => 'Xiaoyou - zh-CN',
			),
			array(
				'value' => 'zh-CN-XiaozhenNeural',
				'text'  => 'Xiaozhen - zh-CN',
			),
			array(
				'value' => 'zh-CN-YunfengNeural',
				'text'  => 'Yunfeng - zh-CN',
			),
			array(
				'value' => 'zh-CN-YunhaoNeural',
				'text'  => 'Yunhao - zh-CN',
			),
			array(
				'value' => 'zh-CN-YunxiaNeural',
				'text'  => 'Yunxia - zh-CN',
			),
			array(
				'value' => 'zh-CN-YunyeNeural',
				'text'  => 'Yunye - zh-CN',
			),
			array(
				'value' => 'zh-CN-YunzeNeural',
				'text'  => 'Yunze - zh-CN',
			),
			array(
				'value' => 'zh-CN-XiaorouNeural',
				'text'  => 'Xiaorou - zh-CN',
			),
			array(
				'value' => 'zh-CN-YunjieNeural',
				'text'  => 'Yunjie - zh-CN',
			),
			array(
				'value' => 'zh-CN-guangxi-YunqiNeural',
				'text'  => 'Yunqi - zh-CN-guangxi',
			),
			array(
				'value' => 'zh-CN-henan-YundengNeural',
				'text'  => 'Yundeng - zh-CN-henan',
			),
			array(
				'value' => 'zh-CN-liaoning-XiaobeiNeural',
				'text'  => 'Xiaobei - zh-CN-liaoning',
			),
			array(
				'value' => 'zh-CN-shaanxi-XiaoniNeural',
				'text'  => 'Xiaoni - zh-CN-shaanxi',
			),
			array(
				'value' => 'zh-CN-shandong-YunxiangNeural',
				'text'  => 'Yunxiang - zh-CN-shandong',
			),
			array(
				'value' => 'zh-CN-sichuan-YunxiNeural',
				'text'  => 'Yunxi - zh-CN-sichuan',
			),
			array(
				'value' => 'zh-HK-HiuMaanNeural',
				'text'  => 'HiuMaan - zh-HK',
			),
			array(
				'value' => 'zh-HK-WanLungNeural',
				'text'  => 'WanLung - zh-HK',
			),
			array(
				'value' => 'zh-HK-HiuGaaiNeural',
				'text'  => 'HiuGaai - zh-HK',
			),
			array(
				'value' => 'zh-TW-HsiaoChenNeural',
				'text'  => 'HsiaoChen - zh-TW',
			),
			array(
				'value' => 'zh-TW-YunJheNeural',
				'text'  => 'YunJhe - zh-TW',
			),
			array(
				'value' => 'zh-TW-HsiaoYuNeural',
				'text'  => 'HsiaoYu - zh-TW',
			),
			array(
				'value' => 'zu-ZA-ThandoNeural',
				'text'  => 'Thando - zu-ZA',
			),
			array(
				'value' => 'zu-ZA-ThembaNeural',
				'text'  => 'Themba - zu-ZA',
			),
		);

		// This variable includes all the data used by the configuration options.
		$configuration = array(
			array(
				'title'       => __( 'Text-to-Speech', 'real-voice'),
				'description' => __( 'Configure the API or cloud service used to convert text into speech.', 'real-voice'),
				'cards'       => array(
					array(
						'title'   => __( 'General', 'real-voice'),
						'options' => array(
							array(
								'name'          => 'daextrevo_text_to_speech_converter',
								'label'         => __( 'Text-to-speech Converter', 'real-voice'),
								'type'          => 'select',
								'tooltip'       => __(
									'Select the text-to-speech converter used to create the audio version of your posts. Note that for the text-to-speech converters marked as "Cloud Service" you need to configure the credentials in the section dedicated to the specific service.',
									'real-voice'
								),
								'selectOptions' => array(
									array(
										'value' => 'speechsyntesis-api',
										'text'  => __( 'SpeechSynthesis (Browser)', 'real-voice'),
									),
									array(
										'value' => 'google-text-to-speech-ai',
										'text'  => __( 'Google Cloud Text-to-Speech AI (Cloud service)', 'real-voice'),
									),
									array(
										'value' => 'azure-text-to-speech',
										'text'  => __( 'Azure Text to Speech (Cloud service)', 'real-voice'),
									),
								),
								'help'          => __( 'Select the text-to-speech converter used to create the audio version of your posts.', 'real-voice'),
							),
						),
					),

					array(
						'title'   => __( 'SpeechSynthesis', 'real-voice'),
						'options' => array(
							array(
								'name'          => 'daextrevo_speech_synthesis_lang',
								'label'         => __( 'Language', 'real-voice'),
								'type'          => 'select',
								'tooltip'       => __(
									'Select the language of the utterance. If set to "Auto", the "lang" attributed value of the "html" tag will be used, or the user-agent default if that is unset too.',
									'real-voice'
								),
								'selectOptions' => $speech_synthesis_api_lang,
								'help'          => __( 'Select the language of the utterance.', 'real-voice'),
							),
							array(
								'name'      => 'daextrevo_speech_synthesis_pitch',
								'label'     => __( 'Pitch', 'real-voice'),
								'type'      => 'range',
								'tooltip'   => __(
									'A float representing the pitch value. It can range between 0 (lowest) and 2 (highest).',
									'real-voice'
								),
								'help'      => __( 'Select the pitch value.', 'real-voice'),
								'rangeMin'  => 0,
								'rangeMax'  => 2,
								'rangeStep' => 0.1,
							),
							array(
								'name'      => 'daextrevo_speech_synthesis_rate',
								'label'     => __( 'Rate', 'real-voice'),
								'type'      => 'range',
								'tooltip'   => __(
									'The speed at which the utterance will be spoken at. Enter a float representing the rate value. It can range between 0.1 (lowest) and 10 (highest).',
									'real-voice'
								),
								'help'      => __( 'Select the speed at which the utterance will be spoken at.', 'real-voice'),
								'rangeMin'  => 0.1,
								'rangeMax'  => 10,
								'rangeStep' => 0.1,
							),
							array(
								'name'      => 'daextrevo_speech_synthesis_volume',
								'label'     => __( 'Volume', 'real-voice'),
								'type'      => 'range',
								'tooltip'   => __(
									'A float that represents the volume value, between 0 (lowest) and 1 (highest.)',
									'real-voice'
								),
								'help'      => __( 'Select the volume value.', 'real-voice'),
								'rangeMin'  => 0,
								'rangeMax'  => 1,
								'rangeStep' => 0.1,
							),
						),
					),
					array(
						'title'   => __( 'Google Cloud Text-to-Speech AI', 'real-voice'),
						'options' => array(
							array(
								'name'    => 'daextrevo_google_cloud_text_to_speech_api_key',
								'label'   => __( 'Google Cloud Secret Access Key', 'real-voice'),
								'type'    => 'text',
								'tooltip' => __(
									'The Google Cloud Secret Access Key.',
									'real-voice'
								),
								'help'    => __( 'Enter the Google Cloud Secret Access Key.', 'real-voice'),
							),
							array(
								'name'          => 'daextrevo_google_cloud_audio_config_audio_encoding',
								'label'         => __( 'Audio Encoding', 'real-voice'),
								'type'          => 'select',
								'tooltip'       => __(
									'The Google Cloud Speech-to-Text API supports a number of different encodings.',
									'real-voice'
								),
								'tooltipLink'   => 'https://cloud.google.com/text-to-speech/docs/reference/rest/v1/AudioConfig#AudioEncoding',
								'selectOptions' => array(
									array(
										'value' => 'LINEAR16',
										'text'  => __( 'LINEAR16', 'real-voice'),
									),
									array(
										'value' => 'MP3',
										'text'  => __( 'MP3', 'real-voice'),
									),
									array(
										'value' => 'OGG_OPUS',
										'text'  => __( 'OGG_OPUS', 'real-voice'),
									),
									array(
										'value' => 'MULAW',
										'text'  => __( 'MULAW', 'real-voice'),
									),
									array(
										'value' => 'ALAW',
										'text'  => __( 'ALAW', 'real-voice'),
									),
								),
								'help'          => __( 'Select the Google Cloud Speech-to-Text API encoding.', 'real-voice'),
							),
							array(
								'name'        => 'daextrevo_google_cloud_audio_config_speaking_rate',
								'label'       => __( 'Speaking Rate', 'real-voice'),
								'type'        => 'range',
								'tooltip'     => __(
									'Speaking rate/speed, in the range [0.25, 4.0]. 1.0 is the normal native speed supported by the specific voice. 2.0 is twice as fast, and 0.5 is half as fast.',
									'real-voice'
								),
								'help'        => __( 'Select the speaking rate/speed.', 'real-voice'),
								'tooltipLink' => 'https://cloud.google.com/text-to-speech/docs/reference/rest/v1/AudioConfig#FIELDS',
								'rangeMin'    => 0.25,
								'rangeMax'    => 4,
								'rangeStep'   => 0.25,
							),
							array(
								'name'        => 'daextrevo_google_cloud_audio_config_pitch',
								'label'       => __( 'Pitch', 'real-voice'),
								'type'        => 'range',
								'tooltip'     => __(
									'Speaking pitch, in the range [-20.0, 20.0]. 20 means increase 20 semitones from the original pitch. -20 means decrease 20 semitones from the original pitch.',
									'real-voice'
								),
								'help'        => __( 'Select the speaking pitch.', 'real-voice'),
								'tooltipLink' => 'https://cloud.google.com/text-to-speech/docs/reference/rest/v1/AudioConfig#FIELDS',
								'rangeMin'    => -20,
								'rangeMax'    => 20,
								'rangeStep'   => 0.1,
							),
							array(
								'name'        => 'daextrevo_google_cloud_audio_config_volume_gain_db',
								'label'       => __( 'Volume Gain db', 'real-voice'),
								'type'        => 'range',
								'tooltip'     => __(
									'Volume gain (in dB) of the normal native volume supported by the specific voice, in the range [-96.0, 16.0].',
									'real-voice'
								),
								'help'        => __( 'Select the volume gain.', 'real-voice'),
								'tooltipLink' => 'https://cloud.google.com/text-to-speech/docs/reference/rest/v1/AudioConfig#FIELDS',
								'rangeMin'    => -96,
								'rangeMax'    => 16,
								'rangeStep'   => 0.1,
							),
							array(
								'name'          => 'daextrevo_google_cloud_audio_config_sample_rate_hertz',
								'label'         => __( 'Sample Rate', 'real-voice'),
								'type'          => 'select',
								'tooltip'       => __(
									'The synthesis sample rate (in hertz) for this audio.',
									'real-voice'
								),
								'help'          => __( 'Enter the synthesis sample rate.', 'real-voice'),
								'tooltipLink'   => 'https://cloud.google.com/text-to-speech/docs/reference/rest/v1/AudioConfig#FIELDS',
								'selectOptions' => array(
									array(
										'value' => '0',
										'text'  => __( 'Auto', 'real-voice'),
									),
									array(
										'value' => '8000 ',
										'text'  => __( '8000 Hz', 'real-voice'),
									),
									array(
										'value' => '16000',
										'text'  => __( '16000 Hz', 'real-voice'),
									),
									array(
										'value' => '22050',
										'text'  => __( '22050 Hz', 'real-voice'),
									),
									array(
										'value' => '24000',
										'text'  => __( '24000 Hz', 'real-voice'),
									),
									array(
										'value' => '32000',
										'text'  => __( '32000 Hz', 'real-voice'),
									),
									array(
										'value' => '44100',
										'text'  => __( '44100 Hz', 'real-voice'),
									),
									array(
										'value' => '48000',
										'text'  => __( '48000 Hz', 'real-voice'),
									),
								),
							),
							array(
								'name'          => 'daextrevo_google_cloud_audio_config_effects_profile_id',
								'label'         => __( 'Effects Profile ID', 'real-voice'),
								'type'          => 'select-multiple',
								'tooltip'       => __(
									'Optionally select one or more audio profiles. Effects are applied on top of each other in the order they are given.',
									'real-voice'
								),
								'help'          => __( 'Optionally select one or more audio profiles.', 'real-voice'),
								'tooltipLink'   => 'https://cloud.google.com/text-to-speech/docs/reference/rest/v1/AudioConfig#FIELDS',
								'selectOptions' => $google_cloud_effects_profile_id,
							),
							array(
								'name'          => 'daextrevo_google_cloud_voice_language_code',
								'label'         => __( 'Language Code', 'real-voice'),
								'type'          => 'select',
								'tooltip'       => __(
									'The language of the voice as a BCP-47 language tag. Note that this value should match the language code of the selected voice name.',
									'real-voice'
								),
								'help'          => __( 'Enter the language of the voice as a BCP-47 language tag.', 'real-voice'),
								'tooltipLink'   => 'https://cloud.google.com/text-to-speech/docs/voices',
								'selectOptions' => $google_cloud_language_code,
							),
							array(
								'name'          => 'daextrevo_google_cloud_voice_name',
								'label'         => __( 'Voice Name', 'real-voice'),
								'type'          => 'select',
								'tooltip'       => __(
									'Enter the voice that will be used to speak the utterance.',
									'real-voice'
								),
								'help'          => __( 'Enter the voice that will be used to speak the utterance.', 'real-voice'),
								'tooltipLink'   => 'https://cloud.google.com/text-to-speech/docs/voices',
								'selectOptions' => $google_cloud_voice_name,
							),
						),
					),
					array(
						'title'   => __( 'Azure Text-to-speech', 'real-voice'),
						'options' => array(
							array(
								'name'    => 'daextrevo_azure_speech_resource_key',
								'label'   => __( 'Azure Speech Resource Key', 'real-voice'),
								'type'    => 'text',
								'tooltip' => __(
									'The Azure Speech Resource Key.',
									'real-voice'
								),
								'help'    => __( 'Enter the Azure Speech Resource Key.', 'real-voice'),
							),
							array(
								'name'          => 'daextrevo_azure_region',
								'label'         => __( 'Region', 'real-voice'),
								'type'          => 'select',
								'tooltip'       => __(
									'Set the Azure region that best fits your needs.',
									'real-voice'
								),
								'help'          => __( 'Select the Azure region that best fits your needs.', 'real-voice'),
								'selectOptions' => $azure_region,
							),
							array(
								'name'    => 'daextrevo_azure_user_agent',
								'label'   => __( 'User Agent', 'real-voice'),
								'type'    => 'text',
								'tooltip' => __(
									'The application name. The provided value must be fewer than 255 characters.',
									'real-voice'
								),
								'help'    => __( 'Enter the application name.', 'real-voice'),
							),
							array(
								'name'          => 'daextrevo_azure_x_microsoft_output_format',
								'label'         => __( 'Output Format', 'real-voice'),
								'type'          => 'select',
								'tooltip'       => __(
									'Set one of the supported audio formats.',
									'real-voice'
								),
								'tooltipLink'   => 'https://learn.microsoft.com/en-us/azure/ai-services/speech-service/rest-text-to-speech?tabs=streaming#audio-outputs',
								'help'          => __( 'Select one of the supported audio formats.', 'real-voice'),
								'selectOptions' => $azure_output_format,
							),
							array(
								'name'          => 'daextrevo_azure_voice_short_name',
								'label'         => __( 'Voice Short Name', 'real-voice'),
								'type'          => 'select',
								'tooltip'       => __(
									'The short name of the voice to use for synthesis.',
									'real-voice'
								),
								'tooltipLink'   => 'https://learn.microsoft.com/en-us/azure/ai-services/speech-service/rest-text-to-speech?tabs=streaming#get-a-list-of-voices',
								'selectOptions' => $azure_voice_short_name,
								'help'          => __( 'The short name of the voice to use for synthesis.', 'real-voice'),
							),
						),
					),
				),
			),
			array(
				'title'       => __( 'Style', 'real-voice'),
				'description' => __( 'Customize the colors, typography, and general style of the audio player.', 'real-voice'),
				'cards'       => array(
					array(
						'title'   => __( 'Audio Player', 'real-voice'),
						'options' => array(
							array(
								'name'    => 'daextrevo_custom_player_background_color',
								'label'   => __( 'Background Color', 'real-voice'),
								'type'    => 'color-picker',
								'tooltip' => __(
									'The background color of the player.',
									'real-voice'
								),
								'help'    => __( 'Select the background color of the player.', 'real-voice'),
							),
							array(
								'name'    => 'daextrevo_custom_player_border_color',
								'label'   => __( 'Border Color', 'real-voice'),
								'type'    => 'color-picker',
								'tooltip' => __(
									'The border color of the player.',
									'real-voice'
								),
								'help'    => __( 'Select the border color of the player.', 'real-voice'),
							),
							array(
								'name'    => 'daextrevo_custom_player_icons_color',
								'label'   => __( 'Icons Color', 'real-voice'),
								'type'    => 'color-picker',
								'tooltip' => __(
									'The color of the icons of the player.',
									'real-voice'
								),
								'help'    => __( 'Select the color of the icons of the player.', 'real-voice'),
							),
							array(
								'name'    => 'daextrevo_custom_player_slider_thumb_color',
								'label'   => __( 'Slider Thumb Color', 'real-voice'),
								'type'    => 'color-picker',
								'tooltip' => __(
									'The color of the thumb of the sliders of the player.',
									'real-voice'
								),
								'help'    => __( 'Select the color of the thumb of the sliders of the player.', 'real-voice'),
							),
							array(
								'name'    => 'daextrevo_custom_player_slider_track_color',
								'label'   => __( 'Slider Track Color', 'real-voice'),
								'type'    => 'color-picker',
								'tooltip' => __(
									'The color of the track of the sliders of the player.',
									'real-voice'
								),
								'help'    => __( 'Select the color of the track of the sliders of the player.', 'real-voice'),
							),
							array(
								'name'    => 'daextrevo_custom_player_text_color',
								'label'   => __( 'Text Color', 'real-voice'),
								'type'    => 'color-picker',
								'tooltip' => __(
									'The color of the textual elements used in the player.',
									'real-voice'
								),
								'help'    => __( 'Select the color of the textual elements used in the player.', 'real-voice'),
							),
							array(
								'name'    => 'daextrevo_custom_player_font_family',
								'label'   => __( 'Font Family', 'real-voice'),
								'type'    => 'text',
								'tooltip' => __(
									'The font family of the textual elements used in the player.',
									'real-voice'
								),
								'help'    => __( 'Enter the font family of the textual elements used in the player.', 'real-voice'),
							),
							array(
								'name'    => 'daextrevo_custom_player_font_size',
								'label'   => __( 'Font Size', 'real-voice'),
								'type'    => 'text',
								'tooltip' => __(
									'The font size of the textual elements used in the player.',
									'real-voice'
								),
								'help'    => __( 'The font size of the textual elements used in the player.', 'real-voice'),
							),
							array(
								'name'          => 'daextrevo_custom_player_font_style',
								'label'         => __( 'Font Style', 'real-voice'),
								'type'          => 'select',
								'tooltip'       => __(
									'The font style of the textual elements used in the player.',
									'real-voice'
								),
								'selectOptions' => array(
									array(
										'value' => 'normal',
										'text'  => __( 'Normal', 'real-voice'),
									),
									array(
										'value' => 'italic',
										'text'  => __( 'Italic', 'real-voice'),
									),
									array(
										'value' => 'oblique',
										'text'  => __( 'Oblique', 'real-voice'),
									),
								),
								'help'          => __( 'The font style of the textual elements used in the player.', 'real-voice'),
							),
							array(
								'name'          => 'daextrevo_custom_player_font_weight',
								'label'         => __( 'Font Weight', 'real-voice'),
								'type'          => 'select',
								'tooltip'       => __(
									'The font weight of the textual elements used in the player.',
									'real-voice'
								),
								'selectOptions' => array(
									array(
										'value' => '100',
										'text'  => __( '100', 'real-voice'),
									),
									array(
										'value' => '200',
										'text'  => __( '200', 'real-voice'),
									),
									array(
										'value' => '300',
										'text'  => __( '300', 'real-voice'),
									),
									array(
										'value' => '400',
										'text'  => __( '400', 'real-voice'),
									),
									array(
										'value' => '500',
										'text'  => __( '500', 'real-voice'),
									),
									array(
										'value' => '600',
										'text'  => __( '600', 'real-voice'),
									),
									array(
										'value' => '700',
										'text'  => __( '700', 'real-voice'),
									),
									array(
										'value' => '800',
										'text'  => __( '800', 'real-voice'),
									),
									array(
										'value' => '900',
										'text'  => __( '900', 'real-voice'),
									),
								),
								'help'          => __( 'The font weight of the textual elements used in the player.', 'real-voice'),
							),
							array(
								'name'    => 'daextrevo_custom_player_line_height',
								'label'   => __( 'Line Height', 'real-voice'),
								'type'    => 'text',
								'tooltip' => __(
									'The line height of the textual elements used in the player.',
									'real-voice'
								),
								'help'    => __( 'The line height of the textual elements used in the player.', 'real-voice'),
							),
							array(
								'name'    => 'daextrevo_custom_player_drop_shadow',
								'label'   => __( 'Drop Shadow', 'real-voice'),
								'type'    => 'toggle',
								'tooltip' => __(
									'Whether to apply or not a drop shadow to the player.',
									'real-voice'
								),
								'help'    => __( 'Apply a drop shadow to the player.', 'real-voice'),
							),
							array(
								'name'    => 'daextrevo_custom_player_drop_shadow_color',
								'label'   => __( 'Drop Shadow Color', 'real-voice'),
								'type'    => 'color-picker',
								'tooltip' => __(
									'The color of the drop shadow applied to the player.',
									'real-voice'
								),
								'help'    => __( 'Select the color of the drop shadow applied to the player.', 'real-voice'),
							),
							array(
								'name'    => 'daextrevo_google_font_url',
								'label'   => __( 'Google Font URL', 'real-voice'),
								'type'    => 'text',
								'tooltip' => __(
									'The URL of a Google Font that should be loaded in your website.',
									'real-voice'
								),
								'help'    => __( 'Enter the URL of a Google Font that should be loaded in your website.', 'real-voice'),
							),
						),
					),
				),
			),

			array(
				'title'       => __( 'Misc', 'real-voice'),
				'description' => __( 'Create a custom experience by configuring the audio player location, additional messages, and more.', 'real-voice'),
				'cards'       => array(
					array(
						'title'   => __( 'Audio Player Location', 'real-voice'),
						'options' => array(
							array(
								'name'          => 'daextrevo_post_types',
								'label'         => __( 'Post Types', 'real-voice'),
								'type'          => 'select-multiple',
								'tooltip'       => __(
									'The post types where the text-to-speech player will be available.',
									'real-voice'
								),
								'selectOptions' => $post_types_select_options,
								'help'          => __( 'Select the post types where the text-to-speech player will be available.', 'real-voice'),
							),
						),
					),
					array(
						'title'   => __( 'Front-end Layout', 'real-voice'),
						'options' => array(
							array(
								'name'    => 'daextrevo_text_before',
								'label'   => __( 'Text Before', 'real-voice'),
								'type'    => 'textarea',
								'tooltip' => __(
									'The text displayed before the player.',
									'real-voice'
								),
								'help'    => __( 'Enter the message displayed before the player.', 'real-voice'),
							),
							array(
								'name'    => 'daextrevo_text_after',
								'label'   => __( 'Text After', 'real-voice'),
								'type'    => 'textarea',
								'tooltip' => __(
									'The text displayed after the player',
									'real-voice'
								),
								'help'    => __( 'Enter the message displayed after the player.', 'real-voice'),
							),
							array(
								'name'    => 'daextrevo_responsive_breakpoint',
								'label'   => __( 'Responsive Breakpoint (Compact)', 'real-voice'),
								'type'    => 'text',
								'tooltip' => __(
									'Below the specified screen width in pixels the responsive version (compact) of the audio player is generated.',
									'real-voice'
								),
								'help'    => __( 'Enter the screen width in pixels below which the responsive version (compact) of the audio player is generated.', 'real-voice'),
							),
							array(
								'name'    => 'daextrevo_responsive_breakpoint_2',
								'label'   => __( 'Responsive Breakpoint (Small)', 'real-voice'),
								'type'    => 'text',
								'tooltip' => __(
									'Below the specified screen width in pixels the responsive version (small) of the audio player is generated.',
									'real-voice'
								),
								'help'    => __( 'Enter the screen width in pixels below which the responsive version (small) of the audio player is generated.', 'real-voice'),
							),
						),
					),
					array(
						'title'   => __( 'Audio Content', 'real-voice'),
						'options' => array(
							array(
								'name'    => 'daextrevo_speech_text_before',
								'label'   => __( 'Speech Text Before', 'real-voice'),
								'type'    => 'textarea',
								'tooltip' => __(
									'The text to speak at the beginning of the audio file.',
									'real-voice'
								),
								'help'    => __( 'Enter the text to speak at the beginning of the audio file', 'real-voice'),
							),
							array(
								'name'    => 'daextrevo_speech_text_after',
								'label'   => __( 'Speech Text After', 'real-voice'),
								'type'    => 'textarea',
								'tooltip' => __(
									'The text to speak at the end of the audio file.',
									'real-voice'
								),
								'help'    => __( 'Enter the text to speak at the beginning of the audio file', 'real-voice'),
							),
							array(
								'name'    => 'daextrevo_read_title',
								'label'   => __( 'Read Title', 'real-voice'),
								'type'    => 'toggle',
								'tooltip' => __(
									'Whether to read or not the title of the post.',
									'real-voice'
								),
								'help'    => __( 'Read the title of the page before the page content.', 'real-voice'),
							),
						),
					),

				),
			),
			array(
				'title'       => __( 'Advanced', 'real-voice'),
				'description' => __( 'Manage advanced plugin settings.', 'real-voice'),
				'cards'       => array(
					array(
						'title'   => __( 'General', 'real-voice'),
						'options' => array(
							array(
								'name'    => 'daextrevo_development_mode',
								'label'   => __( 'Development Mode', 'real-voice'),
								'type'    => 'toggle',
								'tooltip' => __( 'With this option enabled the development version of JavaScript and style sheets files used by the plugin will be loaded on the front-end.', 'real-voice'),
								'help'    => __(
									'Load the development version of the assets loaded in the front-end.',
									'real-voice'
								),
							),
							array(
								'name'          => 'daextrevo_post_types_ui',
								'label'         => __( 'Post Types UI', 'real-voice'),
								'type'          => 'select-multiple',
								'tooltip'       => __(
									'The post types where the block editor sidebar sections and meta boxes should be displayed.',
									'real-voice'
								),
								'selectOptions' => $post_types_select_options,
								'help'          => __( 'Select the post types where the block editor sidebar sections and meta boxes should be displayed.', 'real-voice'),
							),
						),
					),
					array(
						'title'   => __( 'Capabilities', 'real-voice'),
						'options' => array(
							array(
								'name'    => 'daextrevo_api_log_menu_capability',
								'label'   => __( 'API Log Menu Capability', 'real-voice'),
								'type'    => 'text',
								'tooltip' => __(
									'The capability required to get access on the "API Log" menu.',
									'real-voice'
								),
								'help'    => __( 'Enter the capability required to get access on the "API Log" menu.', 'real-voice'),
							),
							array(
								'name'    => 'daextrevo_maintenance_menu_capability',
								'label'   => __( 'Maintenance Menu Capability', 'real-voice'),
								'type'    => 'text',
								'tooltip' => __(
									'The capability required to get access on the "Maintenance" menu.',
									'real-voice'
								),
								'help'    => __( 'Enter the capability required to get access on the "Maintenance" menu.', 'real-voice'),
							),
							array(
								'name'    => 'daextrevo_editor_tools_capability',
								'label'   => __( 'Editor Tools Capability', 'real-voice'),
								'type'    => 'text',
								'tooltip' => __(
									'The capability required to visualize and use the post editor tools. Specifically the "Audio File" and "Text to Speech" block editor sidebar sections.',
									'real-voice'
								),
								'help'    => __( 'Enter the capability required to visualize and use the post editor tools.', 'real-voice'),
							),
						),
					),

					array(
						'title'   => __( 'Segmented TTS Processing', 'real-voice'),
						'options' => array(
							array(
								'name'    => 'daextrevo_primary_chunk_separator',
								'label'   => __( 'Primary Chunk Separator', 'real-voice'),
								'type'    => 'text',
								'tooltip' => __(
									'The character/string used to separate chunks of text. Please select a character/string appropriate for the language and structure of the articles.',
									'real-voice'
								),
								'help'    => __( 'Enter the character/string used to separate chunks of text.', 'real-voice'),
							),
							array(
								'name'    => 'daextrevo_secondary_chunk_separator',
								'label'   => __( 'Secondary Chunk Separator', 'real-voice'),
								'type'    => 'text',
								'tooltip' => __(
									'The character/string used to separate chunks of text. Please select a character/string appropriate for the language and structure of the articles.',
									'real-voice'
								),
								'help'    => __( 'Enter the character/string used to separate chunks of text.', 'real-voice'),
							),
							array(
								'name'    => 'daextrevo_tertiary_chunk_separator',
								'label'   => __( 'Tertiary Chunk Separator', 'real-voice'),
								'type'    => 'text',
								'tooltip' => __(
									'The character/string used to separate chunks of text. Please select a character/string appropriate for the language and structure of the articles.',
									'real-voice'
								),
								'help'    => __( 'Enter the character/string used to separate chunks of text.', 'real-voice'),
							),
						),
					),

				),
			),

		);

		return $configuration;
	}
}
