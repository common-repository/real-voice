=== Real Voice - Text to Speech ===
Contributors: DAEXT
Tags: text to speech, speech, text to audio, tts, audio
Donate link: https://daext.com
Requires at least: 5.0
Tested up to: 6.6.2
Requires PHP: 7.4
Stable tag: 1.12
License: GPLv3

Real Voice is a text-to-speech plugin for WordPress that supports the Web Speech API, Google Text-to-Speech AI, and Azure Text to speech.

== Description ==

Real Voice is a text-to-speech plugin for WordPress that supports the Web Speech API, Google Text-to-Speech AI, and Azure Text to speech.

### Pro Version

A [Pro version of Real Voice](https://daext.com/real-voice/) is now available on our website. This upgraded edition includes more text-to-speech converters (other integrations for Amazon Polly and ElevenLabs are available), the ability to make the audio files downloadable by the visitors, customizable audio player placement using a shortcode, and more.

### Key Features

#### Automatically Add the Audio Player

The plugin automatically adds an audio player at the beginning of the articles. Note that from the plugin options, you can configure post types on which the audio player should be displayed.

#### Manually Generate the Audio Files

We have included a dedicated post sidebar section where you can create a new audio version of the post, update the existing audio version, or delete the audio data.

The website administrator, the editor, or other authorized users can at any time access to this area.

#### Monitor the Presence and State of the Audio Files

The plugin adds a new column named "Audio File" to the posts menu (and to the admin menu of all the other enabled post types). Here, you can verify if a specific post has its related audio version and if this version is up to date with the post.

#### Customizable HTML Audio Player

The plugin generates a custom audio player built with HTML and the browser API. You can customize the style of the player (color, typography, shadows, etc.) using the plugin options.

#### Responsive Audio Player

The audio player is responsive, and you can specify the breakpoint used to switch from the desktop to the mobile version with a dedicated option.

#### Supports Plain Text and SSML

You can generate the audio version of an article from plain text or SSML.

In the case of SSML, the supported tags vary depending on the selected text-to-speech converter.

#### Add Additional Text Before or After the Player

Use the dedicated options to configure the message displayed before (or after) the player. You can set messages like "Listen to this article", "This article is also available in an audio format", etc.

#### Optionally Read the Post Title

Do you want to use the post title as the first synthesized sentence? Then, use the dedicated settings option to apply this behavior.

### Knowledge Base

Get started with the plugin or explore the advanced features with the documentation available in the [Knowledge Base](https://daext.com/kb-category/real-voice/).

### This plugin can optionally use paid third-party services

This plugin can optionally use third-party services to perform the text-to-speech conversion. If you configure one of these services and perform a text-to-speech conversion using the tools provided by the plugin, the third-party service will charge you according to their terms.

#### When the third-party service "Text-to-Speech AI" from Google Cloud is enabled

The plugin will use the [Text-to-Speech AI from Google Cloud](https://cloud.google.com/text-to-speech/) third-party service to perform the text-to-speech conversion when both these conditions are met:

* **Google Cloud Text-to-Speech AI** is selected with the **Text-to-speech Converter** option available in the **Text-to-Speech -> General** section of the plugin.
* A valid key is provided in the **Google Cloud Secret Access Key** option available in the **Text-to-Speech -> Google Cloud Text-to-Speech AI** section of the plugin options.

The Terms of Service of the Google Cloud Platform are available in the link below:

[https://cloud.google.com/terms](https://cloud.google.com/terms)

#### When the third-party service "Text to speech" from Microsoft Azure is enabled

The plugin will use the [Text to speech from Microsoft Azure](https://azure.microsoft.com/en-us/products/ai-services/text-to-speech) third-party service to perform the text-to-speech conversion when both these conditions are met:

* **Azure Text to Speech (Cloud service)** is selected with the **Text-to-speech Converter** option available in the **Text-to-Speech -> General** section of the plugin.
* A valid key is provided in the **Azure Speech Resource Key** option available in the **Text-to-Speech -> Azure Text-to-speech** of the plugin options.

Legal information for Text to speech by Microsoft Azure:

[https://azure.microsoft.com/en-us/support/legal/](https://azure.microsoft.com/en-us/support/legal/)

#### When the plugin performs a text-to-speech conversion

In the contexts described below, the plugin performs a text-to-speech conversion. Note that with a third-party service enabled, this involves sending text/SSML to the third-party service API (on a remote server) to retrieve the audio data.

Text-to-speech conversions are performed when you click the **Generate file** button in the **Audio File** post sidebar section. For [Classic Editor](https://wordpress.org/plugins/classic-editor/) users, the text-to-speech conversions are performed when you click the **Generate file** button in the **Audio File** meta box.

#### Accessing the plugin options

You can access the plugin options anytime from the **Real Voice** menu on your WordPress dashboard. Please note that this menu is available only for WordPress users who own the [manage_options](https://wordpress.org/documentation/article/roles-and-capabilities/#manage_options) capability.

#### Disclaimer

To the extent permissible under applicable laws, in no event shall DAEXT di A. D. (the company that developed this plugin) or its employees be liable to you for problems associated with using the third-party services supported by this plugin (E.g., Unexpected charges, violations of the third-party terms of services, etc.).

We recommend that you enable the third-party services included in this plugin only under the following conditions:

* We do not guarantee an implementation free of errors, and this WordPress plugin (both in terms of features and codebase) should be evaluated by a professional before being configured to use a third-party service.
* Your site is secure, and only authorized users can access the WordPress administrative pages where the text-to-speech conversion is performed or configured.
* The third-party service is configured by a professional.
* This WordPress plugin is configured by a professional.
* The costs for the use of third-party services are constantly monitored by a professional.
* You can afford the costs associated with the use of a third-party service.

== Installation ==
= Installation (Single Site) =

With this procedure you will be able to install the Real Voice plugin on your WordPress website:

1. Visit the **Plugins -> Add New** menu
2. Click on the **Upload Plugin** button and select the zip file you just downloaded
3. Click on **Install Now**
4. Click on **Activate Plugin**

= Installation (Multisite) =

This plugin supports both a **Network Activation** (the plugin will be activated on all the sites of your WordPress Network) and a **Single Site Activation** in a **WordPress Network** environment (your plugin will be activate on single site of the network).

With this procedure you will be able to perform a **Network Activation**:

1. Visit the **Plugins -> Add New** menu
2. Click on the **Upload Plugin** button and select the zip file you just downloaded
3. Click on **Install Now**
4. Click on **Network Activate**

With this procedure you will be able to perform a **Single Site Activation** in a **WordPress Network** environment:

1. Visit the specific site of the **WordPress Network** where you want to install the plugin
2. Visit the **Plugins** menu
3. Click on the **Activate** button (just below the name of the plugin)

== Changelog ==

= 1.12 =

*September 19, 2024*

* Major back-end UI update
* Added segmented TTS processing
* The plugin now logs the API requests to the TTS services
* The "API Log" menu has been added

= 1.11 =

*April 8, 2024*

* Fixed a bug (started with WordPress version 6.5) that prevented the creation of the plugin database tables and the initialization of the plugin options during the plugin activation.

= 1.10 =

*March 29, 2024*

* An additional responsive breakpoint option has been added.
* Responsive breakpoints default values modified.

= 1.09 =

*February 20, 2024*

* Initial release.

== Screenshots ==

1. The audio player in the WordPress front end.
2. The post editor sidebar sections added by the Real Voice plugin.
3. Monitor the API requests performed by the plugin to the text-to-speech cloud services.
4. Perform bulk actions like deleting API log data, resetting options, and more.
5. Options menu in the "Text-to-Speech" tab.
6. Options menu in the "SpeechSynthesis" section.
7. Options menu in the "Google Text-to-Speech AI" section.
8. Options menu in the "Azure Text to Speech" section.
9. Options menu in the "Style" tab.
10. Options menu in the "Misc" tab.
11. Options menu in the "Front-end Layout" section.
12. Options menu in the "Audio Content" section.
13. Options menu in the "Advanced" tab.
14. Options menu in the "Capabilities" tab.