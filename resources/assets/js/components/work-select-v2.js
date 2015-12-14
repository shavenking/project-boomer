var React = require('react')
var FlowtypeSelect = require('./flowtype-select')

export default class WorkSelectV2 extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            works: []
        }

        $.getJSON('/api/v1/works').then(response => {
            this.setState({
                works: response.works
            })
        })
    }

    componentDidMount() {
        this.$dropdown.dropdown()

        $(this._input).change(this.onSelected.bind(this))
    }

    onSelected(e) {
        var workId = parseInt(e.target.value)

        var works = this.state.works.filter(candidate => {
            return candidate.id === workId
        })

        if (this.props.onSelected) {
            this.props.onSelected(works[0])
        }
    }

    onValid(data) {
        var query = ''

        if (data.mainflowTypeId) {
            query += `mainflow_type_id=${data.mainflowTypeId}`
        }

        if (data.detailingflowTypeId) {
            query += `&detailingflow_type_id=${data.detailingflowTypeId}`
        }

        $.getJSON(`/api/v1/works?${query}`).then(response => {
            this.setState({
                works: response.works
            })
        })
    }

    render() {
        var options = this.state.works.map(work => {
            return <div className="item" data-value={work.id}>{work.name}</div>
        })

        return (
            <div className="grouped fields">
                <FlowtypeSelect onValid={ this.onValid.bind(this) }/>

                <div className="field">
                    <label>{this.props.labelText}</label>
                    <div className="ui selection dropdown" ref={c => {this.$dropdown = $(c)}}>
                        <input type="hidden" name="work_id" ref={c => { this._input = c }} />
                        <i className="dropdown icon"></i>
                        <div className="default text">{this.props.defaultText}</div>
                        <div className="menu">
                            { options }
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}
