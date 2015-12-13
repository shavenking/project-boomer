var React = require('react')
var ReactDOM = require('react-dom')

function getTypes() {
    return $.getJSON('/api/v1/cost-types')
}

export default class CostTypeSelect extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            types: [],
            selectedId: ''
        }

        getTypes().then(response => {
            this.setState({
                types: response.cost_types
            })
        })

        this.onSelected = this.onSelected.bind(this)
    }

    componentDidMount() {
        $(ReactDOM.findDOMNode(this)).find('.dropdown').dropdown()

        $(this._input).change(this.onSelected)
    }

    onSelected(e) {
        var selectedId = e.target.value

        this.setState({ selectedId })
    }

    render() {
        var options = this.state.types.map((type) => {
            return <option value={ type.id }>{ type.name }</option>
        })

        return (
            <div className="field">
                <label>費用分類</label>
                <select name="cost_type_id" className="ui selection dropdown" ref={ (c) => { this._input = c }}>
                    { options }
                </select>
            </div>
        )
    }
}
