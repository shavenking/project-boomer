var React = require('react')
var ReactDOM = require('react-dom')

function getWorkflows() {
    return $.getJSON('/api/v1/workflows')
}

export default class CostTypeSelect extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            workflows: [],
            selectedId: ''
        }

        getWorkflows().then(response => {
            this.setState({
                workflows: response.workflows
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
        var options = this.state.workflows.map((workflow) => {
            return <option value={ workflow.id }>{ workflow.name }</option>
        })

        return (
            <div className="field">
                <label>流程</label>
                <select name="workflow_id" className="ui selection dropdown" ref={ (c) => { this._input = c }}>
                    { options }
                </select>
            </div>
        )
    }
}
