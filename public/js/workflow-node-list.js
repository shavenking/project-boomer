class WorkflowNodeList extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            nodes: [],
            newNode: {
                title: ''
            }
        }

        window.$.getJSON('/api/v1/workflows/' + this.props.workflowId + '/items', response => {
            this.setState({
                nodes: response.nodes
            })
        }.bind(this))

        this.handleChange = this.handleChange.bind(this)
        this.handleClick = this.handleClick.bind(this)
        this.handleDelete = this.handleDelete.bind(this)
    }

    handleChange(e) {
        this.setState({
            newNode: {
                title: e.target.value
            }
        })
    }

    handleClick(e) {
        window.$.post('/api/v1/workflows/' + this.props.workflowId + '/items', {
            _token: this.props.csrfToken,
            order: Math.random(),
            title: this.state.newNode.title
        }).then(response => {
            var node = response.workflow

            this.setState({
                nodes: this.state.nodes.concat(node)
            })

            this.setState({
                newNode: {
                    title: ''
                }
            })
        })
    }

    handleDelete(node, e) {
        window.$.post(`/api/v1/workflows/${this.props.workflowId}/items/${node.id}`, {
            _token: this.props.csrfToken,
            _method: 'DELETE'
        }).then(response => {
            var nodes = this.state.nodes.filter(candidate => {
                return candidate.id !== node.id
            })

            this.setState({
                nodes: nodes
            })
        })
    }

    render() {
        var rows = []

        this.state.nodes.forEach(node => {
            rows.push(
                <tr>
                    <td>
                        { node.title }
                    </td>
                    <td className="collapsing">
                        <button className="ui basic red icon button" onClick={ this.handleDelete.bind(this, node) }><i className="remove icon"></i></button>
                    </td>
                </tr>
            )
        })

        if (0 === rows.length) {
            rows.push(
                <tr>
                    <td className="center aligned" colSpan="2">目前沒有作業項目</td>
                </tr>
            )
        }

        return (
            <table className="ui celled padded table">
                <thead>
                    <tr>
                        <th>作業項目</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    { rows }

                    <tr>
                        <td colSpan="2">
                            <div className="ui fluid action input">
                                <input type="text" name="title" value={ this.state.newNode.title } onChange={ this.handleChange } />
                                <button className="ui primary button" onClick={ this.handleClick }>新增</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        )
    }
}

ReactDOM.render(
  <WorkflowNodeList workflowId={ window.workflowId } csrfToken={ window.csrfToken } />,
  document.getElementById('workflow-node-list')
)
