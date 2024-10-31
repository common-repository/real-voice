const useState = wp.element.useState;
import Pagination from '../../../shared-components/pagination/Pagination';

const useMemo = wp.element.useMemo;
const {__} = wp.i18n;

let PageSize = 10;

const Chart = (props) => {

    //Pagination - START --------------------------------------------------------

    const [currentPage, setCurrentPage] = useState(1);

    const currentTableData = useMemo(() => {
        const firstPageIndex = (currentPage - 1) * PageSize;
        const lastPageIndex = firstPageIndex + PageSize;
        return props.data.slice(firstPageIndex, lastPageIndex);
    }, [currentPage, props.data]);

    //Pagination - END ----------------------------------------------------------

    function handleDataIcon(columnName) {

        return props.formData.sortingColumn === columnName ? props.formData.sortingOrder : '';

    }

    return (

        <div className="daextrevo-data-table-container">

            <table className="daextrevo-react-table__daextrevo-data-table daextrevo-react-table__daextrevo-data-table-api-log-menu">
                <thead>
                <tr>
                    <th>
                        <button
                            className={'daextrevo-react-table__daextrevo-sorting-button'}
                            onClick={props.handleSortingChanges}
                            value={'request_id'}
                            data-icon={handleDataIcon('request_id')}
                        >{__('ID', 'real-voice')}</button>
                    </th>
                    <th>
                        <button
                            className={'daextrevo-react-table__daextrevo-sorting-button'}
                            onClick={props.handleSortingChanges}
                            value={'request_date'}
                            data-icon={handleDataIcon('post_title')}
                        >{__('Timestamp', 'real-voice')}</button>
                    </th>
                    <th>
                        <button
                            className={'daextrevo-react-table__daextrevo-sorting-button'}
                            onClick={props.handleSortingChanges}
                            value={'converter'}
                            data-icon={handleDataIcon('value')}
                        >{__('API Name', 'real-voice')}</button>
                    </th>
                    <th>
                        <button
                            className={'daextrevo-react-table__daextrevo-sorting-button'}
                            onClick={props.handleSortingChanges}
                            value={'characters'}
                            data-icon={handleDataIcon('description')}
                        >{__('Characters', 'real-voice')}</button>
                    </th>
                    <th>
                        <button
                            className={'daextrevo-react-table__daextrevo-sorting-button'}
                            onClick={props.handleSortingChanges}
                            value={'error'}
                            data-icon={handleDataIcon('ip_address')}
                        >{__('Status', 'real-voice')}</button>
                    </th>
                </tr>
                </thead>
                <tbody>

                {currentTableData.map((row) => (
                    <tr key={row.request_id}>
                        <td>{row.request_id}</td>
                        <td>
                            <div className={'daextrevo-react-table__post-cell-container'}>
                                {row.request_date}
                            </div>
                        </td>
                        <td>
                            <div className={'daextrevo-react-table__post-cell-container'}>
                                {row.converter}
                            </div>
                        </td>
                        <td>{row.characters}</td>
                        <td>
                            <div className={'daextrevo-react-table__post-cell-container'}>
                                {parseInt(row.error, 10) === 1 ? __('Error', 'real-voice') + ': ' + row.error_message : __('Success', 'real-voice')}
                            </div>
                        </td>
                    </tr>
                ))}

                </tbody>
            </table>

            {props.data.length === 0 && <div
                className="daextrevo-no-data-found">{__('We couldn\'t find any results matching your filters. Try adjusting your criteria.', 'real-voice')}</div>}
            {props.data.length > 0 &&
                <div className="daextrevo-react-table__pagination-container">
                    <div className='daext-displaying-num'>{props.data.length + ' items'}</div>
                    <Pagination
                        className="pagination-bar"
                        currentPage={currentPage}
                        totalCount={props.data.length}
                        pageSize={PageSize}
                        onPageChange={page => setCurrentPage(page)}
                    />
                </div>
            }

        </div>

    );

};

export default Chart;
