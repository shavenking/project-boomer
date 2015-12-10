class WorkflowList extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            workflows: []
        }

        window.$.getJSON('/api/v1/workflows', response => {
            this.setState({
                workflows: response.workflows
            })
        }.bind(this))
    }

    render() {
        var rows = []

        this.state.workflows.forEach(workflow => {
            rows.push(
                <tr>
                    <td className="selectable">
                        <a href={ '/workflows/' + workflow.id }>{ workflow.name }</a>
                    </td>
                </tr>
            )
        })

        if (0 === rows.length) {
            rows.push(
                <tr>
                    <td className="center aligned">目前沒有流程</td>
                </tr>
            )
        }

        return (
            <table className="ui celled padded table">
                <thead>
                    <tr>
                        <th>流程名稱</th>
                    </tr>
                </thead>
                <tbody>
                    { rows }
                </tbody>
                <tfoot className="full width">
                    <tr>
                        <th>
                            <a href="/workflows/create" className="ui primary labeled icon button">
                                <i className="plus icon"></i> 新增流程
                            </a>
                        </th>
                    </tr>
                </tfoot>
            </table>
        )
    }
}

ReactDOM.render(
  <WorkflowList />,
  document.getElementById('workflow-list')
)
