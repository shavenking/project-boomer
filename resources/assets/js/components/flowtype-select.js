var React = require('react')
var ReactDOM = require('react-dom')
var classNames = require('classnames')

function getMainflowTypes() {
    return $.getJSON('/api/v1/mainflow-types')
}

function getDetailingflowTypes(mainflowTypeId) {
    return $.getJSON(`/api/v1/mainflow-types/${mainflowTypeId}/detailingflow-types`)
}

export default class FlowtypeSelect extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            mainflowTypes: [],
            detailingflowTypes: [],
            selectedMainflowTypeId: '',
            selectedDetailingflowTypeId: ''
        }

        getMainflowTypes().then(response => {
            this.setState({
                mainflowTypes: response.mainflow_types
            })
        })

        this.onMainflowTypeSelected = this.onMainflowTypeSelected.bind(this)
        this.onDetailingflowTypesSelected = this.onDetailingflowTypesSelected.bind(this)
        this.clearDetailingSelection = this.clearDetailingSelection.bind(this)
    }

    componentDidMount() {
        $(ReactDOM.findDOMNode(this)).find('.dropdown').dropdown()

        $(this._mainflowTypeInput).change(this.onMainflowTypeSelected)
        $(this._detailingflowTypeInput).change(this.onDetailingflowTypesSelected)
    }

    onMainflowTypeSelected(e) {
        var selectedId = e.target.value

        this.setState({
            selectedMainflowTypeId: selectedId
        }, () => {
            this.clearDetailingSelection()

            if (this.props.onValid) {
                this.props.onValid({
                    mainflowTypeId: this.state.selectedMainflowTypeId ? this.state.selectedMainflowTypeId : null,
                    detailingflowTypeId: this.state.selectedDetailingflowTypeId ? this.state.selectedDetailingflowTypeId : null
                })
            }
        })

        getDetailingflowTypes(selectedId).then(response => {
            this.setState({
                detailingflowTypes: response.detailingflow_types
            }, () => {
                var firstTypeId = this.state.detailingflowTypes.length ? this.state.detailingflowTypes[0].id : ''
                $(ReactDOM.findDOMNode(this._detailDropdown)).dropdown('set selected', [firstTypeId])
            })
        })
    }

    onDetailingflowTypesSelected(e) {
        var selectedId = e.target.value

        this.setState({
            selectedDetailingflowTypeId: selectedId
        })

        if (this.props.onValid) {
                this.props.onValid({
                    mainflowTypeId: this.state.selectedMainflowTypeId ? this.state.selectedMainflowTypeId : null,
                    detailingflowTypeId: this.state.selectedDetailingflowTypeId ? this.state.selectedDetailingflowTypeId : null
                })
            }
    }

    clearDetailingSelection() {
        // line below will trigger change event on detailingflow_type_id input
        // so the state is updated
        $(ReactDOM.findDOMNode(this._detailDropdown)).dropdown('clear')
    }

    render() {
        var mainflowTypeItems = this.state.mainflowTypes.map((mainflowType) => {
            return <div className="item" data-value={ mainflowType.id }>{ mainflowType.name }</div>
        })

        var detailingflowTypeItems = this.state.detailingflowTypes.map(detailingflowType => {
            return <div className="item" data-value={ detailingflowType.id }>{ detailingflowType.name }</div>
        })

        return (
            <div className="grouped fields">
                <label>類別</label>
                <div className="field">
                    <div className="ui selection dropdown">
                        <input type="hidden" name="mainflow_type_id" ref={ (c) => { this._mainflowTypeInput = c }} />
                        <i className="dropdown icon"></i>
                        <div className="default text">工程類別</div>
                        <div className="menu">
                            { mainflowTypeItems }
                        </div>
                    </div>
                </div>

                <div className="field">
                    <div className={ classNames('ui', 'selection', 'dropdown', { disabled: !this.state.detailingflowTypes.length }) } ref={ (c) => { this._detailDropdown } }>
                        <input type="hidden" name="detailingflow_type_id" ref={ (c) => { this._detailingflowTypeInput = c }} />
                        <i className="dropdown icon"></i>
                        <div className="default text">工程順序</div>
                        <div className="menu">
                            { detailingflowTypeItems }
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}
