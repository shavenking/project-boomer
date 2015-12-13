var React = require('react')
var ReactDOM = require('react-dom')

function getUnits() {
    return $.getJSON('/api/v1/units')
}

export default class UnitSelect extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            units: [],
            selectedUnitId: ''
        }

        getUnits().then(response => {
            this.setState({
                units: response.units
            })
        })

        this.onUnitSelected = this.onUnitSelected.bind(this)
    }

    componentDidMount() {
        $(ReactDOM.findDOMNode(this)).find('.dropdown').dropdown()

        $(this._unitInput).change(this.onUnitSelected)
    }

    onUnitSelected(e) {
        var selectedId = e.target.value

        this.setState({
            selectedUnitId: selectedId
        })
    }

    render() {
        var options = this.state.units.map((unit) => {
            return <option value={ unit.id }>{ unit.name }</option>
        })

        return (
            <div className="field">
                <label>單位</label>
                <select name="unit_id" className="ui selection dropdown" ref={ (c) => { this._input = c }}>
                    { options }
                </select>
            </div>
        )
    }
}
