import Table from './components/Table';
import RefreshIcon from '../../../assets/img/icons/refresh-cw-01.svg';
import LoadingScreen from "../../shared-components/LoadingScreen";
import DateRangePicker from "../../shared-components/DateRangePicker";

const useState = wp.element.useState;
const useEffect = wp.element.useEffect;

const {__} = wp.i18n;

const App = () => {

    const [formData, setFormData] = useState(
        {
            converter: 0,
            searchString: '',
            searchStringChanged: false,
            sortingColumn: 'request_id',
            sortingOrder: 'desc',
            initialDate: window.DAEXTREVO_PARAMETERS.initial_date,
            finalDate: window.DAEXTREVO_PARAMETERS.final_date
        }
    );

    // DateRangePicker states.
    const [initialDateFormatted, setInitialDateFormatted] = useState('');
    const [finalDateFormatted, setFinalDateFormatted] = useState('');
    const [initialDateFormattedForInputField, setInitialDateFormattedForInputField] = useState('');
    const [finalDateFormattedForInputField, setFinalDateFormattedForInputField] = useState('');
    const [datePickerState, setDatePickerState] = useState(false);
    const [datePickerInitialDateState, setDatePickerInitialDateState] = useState(true);
    const [datePickerFinalDateState, setDatePickerFinalDateState] = useState(false);

    const [dataAreLoading, setDataAreLoading] = useState(true);

    const [dataUpdateRequired, setDataUpdateRequired] = useState(false);

    const [tableData, setTableData] = useState([]);
    const [statistics, setStatistics] = useState({
        totalRequests: 0,
        totalCharacters: 0,
        requestsPerDay: 0
    });

    useEffect(() => {

        setDataAreLoading(true);

        /**
         * Initialize the table with the data received from the REST API
         * endpoint provided by the plugin.
         */
        wp.apiFetch({
            path: '/real-voice/v1/requests',
            method: 'POST',
            data: {
                converter: formData.converter,
                search_string: formData.searchString,
                sorting_column: formData.sortingColumn,
                sorting_order: formData.sortingOrder,
                initial_date: formData.initialDate,
                final_date: formData.finalDate,
                data_update_required: dataUpdateRequired
            }
        }).then(data => {

                // Set the table data with setTableData().
                setTableData(data.table);

                // Set the statistics.
                setStatistics({
                    totalRequests: data.statistics.total_requests,
                    totalCharacters: data.statistics.total_characters,
                    requestsPerDay: data.statistics.requests_per_day
                });

                if (dataUpdateRequired) {

                    // Set the dataUpdateRequired state to false.
                    setDataUpdateRequired(false);

                    // Set the form data to the initial state.
                    setFormData({
                        converter: 0,
                        searchString: '',
                        searchStringChanged: false,
                        sortingColumn: 'request_id',
                        sortingOrder: 'desc',
                        initialDate: window.DAEXTREVO_PARAMETERS.initial_date,
                        finalDate: window.DAEXTREVO_PARAMETERS.final_date
                    });

                }

                setDataAreLoading(false);

        });

    }, [
        formData.converter,
        formData.searchStringChanged,
        formData.sortingColumn,
        formData.sortingOrder,
        formData.initialDate,
        formData.finalDate,
        dataUpdateRequired
    ]);

    // Function to format the date as "Aug 31"
    const formatDate = (isoString) => {
        const date = new Date(isoString);

        // Get the month name
        const options = { month: 'short', day: 'numeric', year: 'numeric' };
        return date.toLocaleDateString('en-US', options);
    };

    // Set the formatted date when the component mounts
    useEffect(() => {
        const initialDateFormatted = formatDate(formData.initialDate);
        setInitialDateFormatted(initialDateFormatted);
    }, [formData.initialDate]);

    // Set the formatted date when the component mounts
    useEffect(() => {
        const finalDateFormatted = formatDate(formData.finalDate);
        setFinalDateFormatted(finalDateFormatted);
    }, [formData.finalDate]);

    // Function to format the date as "08 / 31 / 2024"
    const formatDate2 = (isoString) => {
        const date = new Date(isoString);

        // Extract the month, day, and year
        const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-indexed
        const day = String(date.getDate()).padStart(2, '0');
        const year = date.getFullYear();

        // Return the formatted date
        return `${month} / ${day} / ${year}`;
    };

    useEffect(() => {
        const initialDateFormattedForInputField = formatDate2(formData.initialDate);
        setInitialDateFormattedForInputField(initialDateFormattedForInputField);
    }, [formData.initialDate]);

    useEffect(() => {
        const finalDateFormattedForInputField = formatDate2(formData.finalDate);
        setFinalDateFormattedForInputField(finalDateFormattedForInputField);
    }, [formData.finalDate]);

    /**
     * Function to handle key press events.
     *
     * @param event
     */
    function handleKeyUp(event) {

        // Check if Enter key is pressed (key code 13).
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent form submission.
            document.getElementById('daextrevo-search-button').click(); // Simulate click on search button.
        }

    }

    // Used by the Navigation component.
    function handleSortingChanges(e) {


        /**
         * Check if the sorting column is the same as the previous one.
         * If it is, change the sorting order.
         * If it is not, change the sorting column and set the sorting order to 'asc'.
         */
        let sortingOrder = formData.sortingOrder;
        if (formData.sortingColumn === e.target.value) {
            sortingOrder = formData.sortingOrder === 'asc' ? 'desc' : 'asc';
        }

        setFormData({
            ...formData,
            sortingColumn: e.target.value,
            sortingOrder: sortingOrder
        })

    }

    // Used to toggle the dataUpdateRequired value.
    function handleDataUpdateRequired(e) {
        setDataUpdateRequired(prevDataUpdateRequired => {
            return !prevDataUpdateRequired;
        });
    }

    // DateRangePicker toggle functions.
    function toggleDatePickerState() {
        setDatePickerState(prevDatePickerState => {
            return !prevDatePickerState;
        });
    }

    return (

        <>

            <React.StrictMode>

                {
                    !dataAreLoading ?

                        <>


                                <>

                                    <div className="daextrevo-admin-body">

                                        <div className={'daextrevo-react-table'}>

                                            <div className={'daextrevo-react-table-header'}>
                                                <div className={'statistics'}>
                                                    <div
                                                        className={'statistic-label'}>{__('Total Requests', 'real-voice')}:
                                                    </div>
                                                    <div className={'statistic-value'}>{statistics.totalRequests}</div>
                                                    <div
                                                        className={'statistic-label'}>{__('Total Characters', 'real-voice')}:
                                                    </div>
                                                    <div className={'statistic-value'}>{statistics.totalCharacters}</div>
                                                    <div
                                                        className={'statistic-label'}>{__('Requests per Day', 'real-voice')}:
                                                    </div>
                                                    <div className={'statistic-value'}>{statistics.requestsPerDay}</div>
                                                </div>
                                                <div className={'tools-actions'}>
                                                    <button
                                                        onClick={(event) => handleDataUpdateRequired(event)}
                                                    ><img src={RefreshIcon} className={'button-icon'}></img>
                                                        {__('Update metrics', 'real-voice')}
                                                    </button>
                                                </div>
                                            </div>

                                            <div
                                                className={'daextrevo-react-table__daextrevo-filters daextrevo-react-table__daextrevo-filters-api-log-menu'}>

                                                <div className={'daextrevo-react-table__daextrevo-filters-left-section'}>
                                                    <div className={'daextrevo-pills'}>
                                                        <button className={'daextrevo-pill'}
                                                                data-checked={formData.converter === 0 ? 'true' : 'false'}
                                                                onClick={() => setFormData({
                                                                    ...formData,
                                                                    converter: 0
                                                                })}
                                                        >{__('All', 'real-voice')}
                                                        </button>
                                                        <button className={'daextrevo-pill'}
                                                                data-checked={formData.converter === 1 ? 'true' : 'false'}
                                                                onClick={() => setFormData({
                                                                    ...formData,
                                                                    converter: 1
                                                                })}
                                                        >{__('Google TTS', 'real-voice')}
                                                        </button>
                                                        <button className={'daextrevo-pill'}
                                                                data-checked={formData.converter === 2 ? 'true' : 'false'}
                                                                onClick={() => setFormData({
                                                                    ...formData,
                                                                    converter: 2
                                                                })}
                                                        >{__('Azure TTS', 'real-voice')}
                                                        </button>
                                                    </div>
                                                    <DateRangePicker
                                                        formData={formData}
                                                        setFormData={setFormData}
                                                        initialDateFormatted={initialDateFormatted}
                                                        finalDateFormatted={finalDateFormatted}
                                                        initialDateFormattedForInputField={initialDateFormattedForInputField}
                                                        finalDateFormattedForInputField={finalDateFormattedForInputField}
                                                        datePickerState={datePickerState}
                                                        setDatePickerState={setDatePickerState}
                                                        datePickerInitialDateState={datePickerInitialDateState}
                                                        setDatePickerInitialDateState={setDatePickerInitialDateState}
                                                        datePickerFinalDateState={datePickerFinalDateState}
                                                        setDatePickerFinalDateState={setDatePickerFinalDateState}
                                                        toggleDatePickerState={toggleDatePickerState}
                                                    />
                                                </div>


                                                <div className={'daextrevo-search-container'}>
                                                    <input onKeyUp={handleKeyUp} type={'text'}
                                                           placeholder={__('Filter by ID', 'real-voice')}
                                                           value={formData.searchString}
                                                           onChange={(event) => setFormData({
                                                               ...formData,
                                                               searchString: event.target.value
                                                           })}
                                                    />
                                                    <input id={'daextrevo-search-button'}
                                                           className={'daextrevo-btn daextrevo-btn-secondary'}
                                                           type={'submit'}
                                                           value={__('Search', 'real-voice')}
                                                           onClick={() => setFormData({
                                                               ...formData,
                                                               searchStringChanged: formData.searchStringChanged ? false : true
                                                           })}
                                                    />
                                                </div>

                                            </div>

                                            <Table
                                                data={tableData}
                                                handleSortingChanges={handleSortingChanges}
                                                formData={formData}
                                            />

                                        </div>

                                    </div>
                                </>

                        </>

                        :

                        <LoadingScreen
                            loadingDataMessage={__('Loading data...', 'real-voice')}
                            generatingDataMessage={__('Data is being generated. For large sites, this process may take several minutes. Please wait...', 'real-voice')}
                            dataUpdateRequired={dataUpdateRequired}/>
                }

            </React.StrictMode>

        </>

    );

};
export default App;