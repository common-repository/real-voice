const {
    TextControl,
    DatePicker
} = wp.components;

const useEffect = wp.element.useEffect;
const useRef = wp.element.useRef;



const LoadingScreen = (props) => {

    const datePickerRef = useRef(null);

// Function to detect clicks outside the DatePicker
    const handleClickOutside = (event) => {
        console.log(event.target);
        if (
            datePickerRef.current &&
            !datePickerRef.current.contains(event.target)
        ) {
            props.setDatePickerState(false);
        }

        if(event.target.classList.contains('daextrevo-datepicker-trigger') === true){
            props.setDatePickerState(true);
        }

    };

// Add event listener when DatePicker is open
    useEffect(() => {
        if (props.datePickerState) {
            document.addEventListener('mouseup', handleClickOutside);
        } else {
            document.removeEventListener('mouseup', handleClickOutside);
        }

        // Cleanup event listener on component unmount
        return () => {
            document.removeEventListener('mouseup', handleClickOutside);
        };
    }, [props.datePickerState]);

  return (
      <div className={'daextrevo-datepicker-container'}>
          <button className={'daextrevo-datepicker-trigger'}
                  data-checked={props.formData.feedbackValueFilter === 2 ? 'true' : 'false'}
                  onClick={() => props.toggleDatePickerState()}
          >{props.initialDateFormatted + ' - ' + props.finalDateFormatted}
          </button>
          {props.datePickerState && (
              <div
                  ref={datePickerRef}
                  className={'daextrevo-datepicker-selection-container'}>
                  <div
                      className={'daextrevo-datepicker-date-input-fields'}>
                      <TextControl
                          className={props.datePickerInitialDateState ? 'daextrevo-datepicker-selected' : ''}
                          value={props.initialDateFormattedForInputField}
                          onFocus={() => {
                              props.setDatePickerInitialDateState(true);
                              props.setDatePickerFinalDateState(false);
                          }}
                      />
                      <TextControl
                          className={props.datePickerFinalDateState ? 'daextrevo-datepicker-selected' : ''}
                          value={props.finalDateFormattedForInputField}
                          onFocus={() => {
                              props.setDatePickerInitialDateState(false);
                              props.setDatePickerFinalDateState(true);
                          }}
                      />
                  </div>
                  {props.datePickerInitialDateState && (
                      <DatePicker
                          currentDate={props.formData.initialDate}
                          onChange={(newDate) => {
                              props.setFormData({
                                  ...props.formData,
                                  initialDate: newDate
                              });

                          }}
                      />
                  )}
                  {props.datePickerFinalDateState && (
                      <DatePicker
                          currentDate={props.formData.finalDate}
                          onChange={(newDate) => {
                              props.setFormData({
                                  ...props.formData,
                                  finalDate: newDate
                              });

                          }}
                      />
                  )}
              </div>
          )}
      </div>
  );
};

export default LoadingScreen;