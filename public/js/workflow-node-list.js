class WorkflowNodeList extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            nodes: [],
            inputValue: '',
            error: {
                message: ''
            },
            status: {
                deleting: false,
                creating: false
            }
        }

        window.$.getJSON('/api/v1/workflows/' + this.props.workflowId + '/nodes', response => {
            this.setState({
                nodes: response.nodes
            })
        }.bind(this))

        this.handleKeypress = this.handleKeypress.bind(this)
        this.handleChange = this.handleChange.bind(this)
        this.handleClick = this.handleClick.bind(this)
        this.handleDelete = this.handleDelete.bind(this)
        this.hasError = this.hasError.bind(this)
        this.testFormat = this.testFormat.bind(this)
        this.setErrorMsg = this.setErrorMsg.bind(this)
        this.setInputValue = this.setInputValue.bind(this)
        this.startCreating = this.startCreating.bind(this)
        this.stopCreating = this.stopCreating.bind(this)
        this.startDeleting = this.startDeleting.bind(this)
        this.stopDeleting = this.stopDeleting.bind(this)
        this.checkInput = this.checkInput.bind(this)
    }

    componentDidMount() {
        this.checkInput(this.state.inputValue)
    }

    handleKeypress(e) {
        if (13 === e.charCode) {
            this.handleClick(e)
        }
    }

    handleChange(e) {
        this.setInputValue(e.target.value)
        this.checkInput(e.target.value)
    }

    handleClick(e) {
        if (this.hasError()) {
            return false
        }

        var newNode = this.getNodeFromString(this.state.inputValue)

        this.startCreating()
        window.$.post('/api/v1/workflows/' + this.props.workflowId + '/nodes', {
            _token: this.props.csrfToken,
            order: newNode.order,
            title: newNode.title
        }).then(response => {
            var node = response.node

            this.setState({
                nodes: this.state.nodes.concat(node)
            })

            this.setInputValue('')
        }).always(() => {
            this.stopCreating()
        })
    }

    handleDelete(node, e) {
        this.startDeleting()
        window.$.post(`/api/v1/workflows/${this.props.workflowId}/nodes/${node.id}`, {
            _token: this.props.csrfToken,
            _method: 'DELETE'
        }).then(response => {
            var nodes = this.state.nodes.filter(candidate => {
                return candidate.id !== node.id
            })

            this.setState({
                nodes: nodes
            })
        }).always(() => {
            this.stopDeleting()
        })
    }

    hasError() {
        return !!this.state.error.message.length
    }

    checkInput(value) {
        if (!this.testFormat(value)) {
            this.setErrorMsg('請輸入正確格式，例如：「1. 行政作業」')
        } else {
            this.setErrorMsg('')
        }
    }

    testFormat(value) {
        return /^[0-9]+\.\s*\S.*/.test(value)
    }

    getNodeFromString(value) {
        var combination = this.state.inputValue.split(/^([0-9]+)\.\s*(\S.*)/).filter(Boolean)

        return {
            order: combination[0],
            title: combination[1]
        }
    }

    setErrorMsg(msg) {
        this.setState({
            error: {
                message: msg
            }
        })
    }

    setInputValue(value) {
        this.setState({
            inputValue: value
        })
    }

    startCreating() {
        this.setState({
            status: {
                creating: true
            }
        })
    }

    stopCreating() {
        this.setState({
            status: {
                creating: false
            }
        })
    }

    startDeleting() {
        this.setState({
            status: {
                deleting: true
            }
        })
    }

    stopDeleting() {
        this.setState({
            status: {
                deleting: false
            }
        })
    }

    render() {
        var rows = []

        window._.sortBy(this.state.nodes, 'order').forEach(node => {
            rows.push(
                <tr>
                    <td>{ node.order }</td>
                    <td>
                        { node.title }
                    </td>
                    <td>
                        <button className={ classNames('ui', 'basic', 'red', 'icon', 'button', { loading: this.state.status.deleting }) } onClick={ this.handleDelete.bind(this, node) }><i className="remove icon"></i></button>
                    </td>
                </tr>
            )
        })

        if (0 === rows.length) {
            rows.push(
                <tr>
                    <td className="center aligned" colSpan="3">目前沒有作業項目</td>
                </tr>
            )
        }

        var inputClassName = classNames('ui', 'fluid', 'action', 'input', {
            error: !!this.state.error.message.length
        })

        var errorMsg = []
        if (this.hasError()) {
            errorMsg.push(
                <div className="ui error message">
                    <div className="header">格式錯誤！</div>
                    <p>{ this.state.error.message }</p>
                </div>
            )
        }

        return (
            <table className="ui celled padded table">
                <thead>
                    <tr>
                        <th className="collapsing">#</th>
                        <th>作業項目</th>
                        <th className="collapsing"></th>
                    </tr>
                </thead>
                <tbody>
                    { rows }

                    <tr>
                        <td colSpan="3">
                            <div className={ inputClassName }>
                                <input type="text" name="title" value={ this.state.inputValue } onChange={ this.handleChange } onKeyPress={ this.handleKeypress } />
                                <button className={ classNames('ui', 'primary', 'button', { disabled: this.hasError(), loading: this.state.status.creating }) } onClick={ this.handleClick }>新增</button>
                            </div>
                            { errorMsg }
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
