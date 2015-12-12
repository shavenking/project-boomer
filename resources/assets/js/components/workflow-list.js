var React = require('react')

function getWorkflows() {
    return $.getJSON('/api/v1/workflows')
}

export default class WorkflowList extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            workflows: []
        }

        getWorkflows().then(response => {
            this.setState({
                workflows: response.workflows
            })
        })
    }

    render() {
        var rows = this.state.workflows.map(workflow => {
            return (
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

