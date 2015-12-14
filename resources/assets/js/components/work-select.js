var React = require('react')
var ReactDOM = require('react-dom')

function getWorks() {
    return $.getJSON('/api/v1/works')
}

export default class WorkSelect extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            works: [],
            selectedId: ''
        }

        getWorks().then(response => {
            this.setState({
                works: response.works
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
        var options = this.state.works.map((work) => {
            return <div className="item" data-value={ work.id }>{ work.name }</div>
        })

        return (
            <div className="field">
                <label>選擇工作項目</label>
                <div className="ui multiple selection dropdown">
                    <input type="hidden" name="work_ids" ref={ (c) => { this._input = c }} />
                    <i className="dropdown icon"></i>
                    <div className="default text">選擇工作項目</div>
                    <div className="menu">
                        { options }
                    </div>
                </div>
            </div>
        )
    }
}
