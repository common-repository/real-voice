const {Button} = wp.components;
const {dispatch, select} = wp.data;
const {PluginDocumentSettingPanel} = wp.editPost;
const {Component} = wp.element;
const {__} = wp.i18n;
const {dateI18n} = wp.date;

export default class Sidebar extends Component {

  constructor(props) {

    super(...arguments);

    //The state is used only to rerender the component with setState
    this.state = {
      audioFileCreationDate: '',
      dismissibleNoticeMessage: '',
      dismissibleNoticeEnabled: false,
      dismissibleNoticeColor: 'green',
    };

  }

  render() {

    const meta = select('core/editor').getEditedPostAttribute('meta');
    const audioFileCreationDate = meta['_daextrevo_audio_file_creation_date'];

    return (
        <PluginDocumentSettingPanel
            name="real-voice"
            title={__('Audio File', 'real-voice')}
        >

          {window.DAEXTREVO_PARAMETERS.textToSpeechConverter !== 'speechsyntesis-api' &&

              <div className="daextrevo-container">

                {audioFileCreationDate === '' &&

                    <div className="daextrevo-meta-message">

                      <p>{__('Click "Generate file" to create an audio file from the configured content.', 'real-voice')}</p>

                    </div>

                }

                {audioFileCreationDate !== '' &&

                    <div className="daextrevo-meta-container">

                      <div
                          className="components-panel__row edit-post-post-visibility daextrevo-row">
                        <span>{__('Timestamp', 'real-voice')}</span>
                        <div
                            className="components-dropdown daextrevo-column-2">{dateI18n( 'F j, Y g:i a \\U\\T\\C', parseInt(audioFileCreationDate, 10) * 1000 )}</div>
                      </div>

                    </div>

                }

                <div className="daextrevo-buttons-container">

                  <Button
                      variant="secondary"
                      className="editor-post-trash daextrevo-generate-file-button"
                      onClick={() => {

                        // Do not continue and display a message if the post is an auto-draft.
                        const postStatus = select( 'core/editor' ).getEditedPostAttribute( 'status' );
                        if(postStatus === 'auto-draft') {
                          const dismissibleNoticeMessage = __('Please save the post before creating the audio file. You are not allowed to generate a new audio file for an auto-draft post.', 'real-voice');
                          const dismissibleNoticeColor = 'orange';
                          this.setState({
                            dismissibleNoticeEnabled: true,
                            dismissibleNoticeMessage: dismissibleNoticeMessage,
                            dismissibleNoticeColor: dismissibleNoticeColor,
                          });
                          setTimeout(() => {
                            // After 3 seconds set the show value to false
                            this.setState({
                              dismissibleNoticeEnabled: false,
                            });
                          }, 3000)
                          return;
                        }

                        // Get the post ID.
                        const postId = parseInt(document.getElementById('post_ID').value, 10);

                        wp.apiFetch({
                          path: '/real-voice/v1/create-audio-file',
                          method: 'POST',
                          data: {
                            id: postId,
                            nonce: window.DAEXTREVO_PARAMETERS.create_audio_file_nonce
                          }
                        }).then(response => {

                          let dismissibleNoticeMessage;
                          let dismissibleNoticeColor;

                          if(response.error){

                            dismissibleNoticeMessage = __('The text-to-speech converter is unable to generate the audio file. Message', 'real-voice') + ': "' + response.message + '"';
                            dismissibleNoticeColor = 'orange';

                          }else{

                            response.audio_file_url = String(response.audio_file_url);
                            response.audio_file_creation_date = String(response.audio_file_creation_date);

                            dispatch('core/editor').editPost({
                              meta: {
                                '_daextrevo_audio_file_url': response.audio_file_url,
                              },
                            });

                            dispatch('core/editor').editPost({
                              meta: {
                                '_daextrevo_audio_file_creation_date': response.audio_file_creation_date,
                              },
                            });

                            //used to rerender the component
                            this.setState({
                              audioFileCreationDate: response.audio_file_creation_date,
                            });

                            //display the notification message
                            switch(parseInt(response.audio_file_status, 10)) {
                              case 0:
                                dismissibleNoticeMessage = __('New audio file successfully created.', 'real-voice');
                                dismissibleNoticeColor = 'green';
                                break;

                              case 1:
                                dismissibleNoticeMessage = __('The audio file has been successfully updated.', 'real-voice');
                                dismissibleNoticeColor = 'green';
                                break;

                              case 2:
                                dismissibleNoticeMessage = __('The existing audio file is already up to date.', 'real-voice');
                                dismissibleNoticeColor = 'orange';
                                break;
                            }

                          }

                          this.setState({
                            dismissibleNoticeEnabled: true,
                            dismissibleNoticeMessage: dismissibleNoticeMessage,
                            dismissibleNoticeColor: dismissibleNoticeColor,
                          });

                          setTimeout(() => {

                            // After 3 seconds set the show value to false
                            this.setState({
                              dismissibleNoticeEnabled: false,
                            });
                          }, 3000)

                        });

                      }}
                  >{__('Generate file', 'real-voice')}</Button>


                  {audioFileCreationDate !== '' &&

                      <Button
                          variant="secondary"
                          className="editor-post-trash is-destructive daextrevo-delete-file-button"
                          onClick={() => {

                            const postId = parseInt(
                                document.getElementById('post_ID').value, 10);

                            wp.apiFetch({
                              path: '/real-voice/v1/delete-audio-file',
                              method: 'POST',
                              data: {
                                id: postId,
                                nonce: window.DAEXTREVO_PARAMETERS.delete_audio_file_nonce
                              }
                            }).then(response => {

                              dispatch('core/editor').editPost({
                                meta: {
                                  '_daextrevo_audio_file_url': '',
                                },
                              });

                              dispatch('core/editor').editPost({
                                meta: {
                                  '_daextrevo_audio_file_creation_date': '',
                                },
                              });

                              //used to rerender the component
                              this.setState({
                                audioFileCreationDate: '',
                              });

                              this.setState({
                                dismissibleNoticeEnabled: true,
                                dismissibleNoticeMessage: __('The audio file has been successfully deleted.', 'real-voice'),
                                dismissibleNoticeColor: 'green'
                              });

                              setTimeout(() => {
                                // After 3 seconds set the show value to false
                                this.setState({
                                  dismissibleNoticeEnabled: false,
                                });
                              }, 3000)

                            });

                          }}
                      >{__('Delete file', 'real-voice')}</Button>

                  }

                </div>

                {this.state.dismissibleNoticeEnabled &&
                    <div id="daextrevo-dismissible-notice" className={"daextrevo-dismissible-notice-color-" + this.state.dismissibleNoticeColor}>{this.state.dismissibleNoticeMessage}</div>
                }

              </div>

          }

          {window.DAEXTREVO_PARAMETERS.textToSpeechConverter ===
              'speechsyntesis-api' &&

              <div>
                <p>{__('The selected text-to-speech converter is SpeechSynthesis (Web Speech API). The speech is generated on the device of the user.', 'real-voice')}</p>
              </div>

          }

        </PluginDocumentSettingPanel>
    );
  }
}