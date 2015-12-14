var React = require('react')
var WorkSelect = require('./work-select-v2')
var pluck = require('lodash/collection/pluck')
var zipObject = require('lodash/array/zipObject')
var merge = require('lodash/object/merge')
var indexOf = require('lodash/array/indexOf')
var classNames = require('classnames')

function createWork (work) {
    return $.post(`/api/v1/projects/${work.project_id}/works`, work)
}

export default class ProjectWorkCreateModal extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            availableInputs: [],
            inputValues: {
                name: '',
                amount: '',
                unit_price: ''
            }
        }
    }

    componentDidMount() {}

    onWorkFormSubmit(e) {
        e.preventDefault()

        var inputs = this.$form.serializeArray()

        var work = merge(
            zipObject(pluck(inputs, 'name'), pluck(inputs, 'value')),
            {
                'project_id': this.props.projectId
            }
        )

        createWork(work).then(response => {
            if (this.props.onCreated) {
                this.props.onCreated(response.work)
            }

            this.$modal.modal('hide')
        })
    }

    onSelected(work) {
        this.setState({
            availableInputs: ['name', 'amount'],
            inputValues: {
                name: work.name,
                amount: work.amount,
                unit_price: work.unit_price
            }
        })
    }

    openModal() {
        this.$modal.modal({detachable: false, autofocus: false}).modal('show')
    }

    handleNameChange(e) {
        var inputValues = merge(this.state.inputValues, {
            name: e.target.value
        })

        this.setState({ inputValues })
    }

    handleAmountChange(e) {
        var inputValues = merge(this.state.inputValues, {
            amount: e.target.value
        })

        this.setState({ inputValues })
    }

    render() {
        var nameInputClassNames = classNames('field', {
            disabled: -1 === indexOf(this.state.availableInputs, 'name')
        })

        var amountInputClassNames = classNames('field', {
            disabled: -1 === indexOf(this.state.availableInputs, 'amount')
        })

        return (
            <div>
                <button className="ui primary button" onClick={this.openModal.bind(this)}><i className="plus icon"></i>新增專案工作項目</button>

                <div className="ui modal" ref={ c => { this.$modal = $(c) } }>
                    <div className="header">新增專案工項</div>
                    <div className="content">
                        <form className="ui form" onSubmit={this.onWorkFormSubmit.bind(this)} ref={ c => { this.$form = $(c) } }>
                            <WorkSelect onSelected={ this.onSelected.bind(this) } labelText="選擇參考工項" defaultText="選擇工作項目" />

                            <div className={nameInputClassNames}>
                                <label>名稱</label>
                                <input name="name" value={this.state.inputValues.name} onChange={this.handleNameChange.bind(this)} />
                            </div>

                            <div className={amountInputClassNames}>
                                <label>數量</label>
                                <input name="amount" value={this.state.inputValues.amount} onChange={this.handleAmountChange.bind(this)} />
                            </div>

                            <div className="disabled field">
                                <label>單價</label>
                                <input name="unit_price" value={this.state.inputValues.unit_price} />
                            </div>

                            <button className="ui primary button">新增</button>
                        </form>
                    </div>
                </div>
            </div>
        )
    }
}
