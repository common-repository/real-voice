const {TextareaControl} = wp.components;
const {SelectControl} = wp.components;
const {dispatch, select} = wp.data;
const {PluginDocumentSettingPanel} = wp.editPost;
const {Component} = wp.element;
const {__} = wp.i18n;

export default class Sidebar extends Component {

  constructor(props) {

    super(...arguments);

    //The state is used only to rerender the component with setState
    this.state = {
        textareaValue: '',
        documentType: 'text',
    };

  }

  render() {

    const meta = select('core/editor').getEditedPostAttribute('meta');
    const textToSpeech = meta['_daextrevo_text_to_speech'];
    const documentType = meta['_daextrevo_document_type'];

    return (
        <PluginDocumentSettingPanel
            name="real-voice"
            title={__('Text to Speech', 'real-voice')}
        >

          <TextareaControl
              label={__('Document (Text/SSML)', 'real-voice')}
              help={__('Enter the text/SSML to synthesize or leave this field empty to use the post content.')}
              value={textToSpeech}
              onChange={(value) => {

                dispatch('core/editor').editPost({
                  meta: {
                    '_daextrevo_text_to_speech': value,
                  },
                });

                //used to rerender the component
                this.setState({
                    textareaValue: value,
                });
              }}
          />

            <SelectControl
                label={__('Document Type', 'real-voice')}
                help={__('Select if you want to provide the document as plain text or in SSML.', 'real-voice')}
                value={ documentType }
                options={ [
                    { label: __('Text', 'real-voice'), value: 'text' },
                    { label: __('SSML', 'real-voice'), value: 'ssml' },
                ] }
                onChange={(value) => {

                    dispatch('core/editor').editPost({
                        meta: {
                            '_daextrevo_document_type': value,
                        },
                    });

                    //used to rerender the component
                    this.setState({
                        documentType: value,
                    });
                }}
            />

        </PluginDocumentSettingPanel>
    );
  }
}