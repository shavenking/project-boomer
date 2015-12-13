var React = require('react')
var sortBy = require('lodash/collection/sortBy')
var pluck = require('lodash/collection/pluck')
var zipObject = require('lodash/array/zipObject')
var merge = require('lodash/object/merge')
var classNames = require('classnames')
var UnitSelect = require('./unit-select')
var CostTypeSelect = require('./cost-type-select')
var OrderNameInput = require('./order-name-input')

function getItems(workId) {
    return $.getJSON(`/api/v1/works/${workId}/work-items`)
}

function createItem(workId, item) {
    return $.post(`/api/v1/works/${workId}/work-items`, item)
}

function deleteItem(item) {
    return $.post(`/api/v1/works/${item.work_id}/work-items/${item.id}`, {
        _method: 'DELETE'
    })
}

export default class WorkItemList extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            items: [],
            hasError: false,
            errorMsg: '',
            newItem: {
                order: '',
                name: ''
            },
            inputValues: {
                orderName: '',
                amount: '',
                unitPrice: ''
            }
        }

        getItems(this.props.workId).then(response => {
            this.setState({
                items: response.work_items
            })
        })

        this.handleSubmit = this.handleSubmit.bind(this)
        this.handleDelete = this.handleDelete.bind(this)
        this.onValid = this.onValid.bind(this)
        this.onInValid = this.onInValid.bind(this)
        this.setError = this.setError.bind(this)
        this.clearError = this.clearError.bind(this)
    }

    setError(msg) {
        this.setState({
            hasError: true,
            errorMsg: msg
        })
    }

    clearError() {
        this.setState({
            hasError: false,
            errorMsg: ''
        })
    }

    clearForm() {
        this.clearError()

        this.setState({
            inputValues: {
                orderName: '',
                amount: '',
                unitPrice: ''
            }
        })

        $(this._form).find('.dropdown').dropdown('clear')
    }

    handleDelete(item, e) {
        e.preventDefault()

        deleteItem(item).then(() => {
            var items = this.state.items.filter(candidate => {
                return candidate.id !== item.id
            })

            this.setState({ items })
        })
    }

    handleSubmit(e) {
        e.preventDefault()

        var inputs = $(this._form).serializeArray()

        var item = merge(
            zipObject(pluck(inputs, 'name'), pluck(inputs, 'value')),
            this.state.newItem
        )

        createItem(this.props.workId, item).then(response => {
            this.clearForm()

            this.setState({
                items: this.state.items.concat(response.work_item)
            })
        }, () => {
            this.setError('請正確填寫欄位')
        })
    }

    onValid(data, originalValue) {
        this.clearError()

        this.setState({
            newItem: data,
            inputValues: {
                orderName: originalValue
            }
        })
    }

    onInValid(originalValue) {
        this.setState({
            inputValues: {
                orderName: originalValue
            }
        })
        this.setError('請輸入正確格式（ 1. 範例 ）')
    }

    render() {
        var rows = []

        sortBy(this.state.items, 'order').forEach(item => {
            rows.push(
                <tr>
                    <td>{ item.order }</td>
                    <td>{ item.name }</td>
                    <td>{ item.amount }</td>
                    <td>{ item.unit_price }</td>
                    <td>{ item.total_price }</td>
                    <td>{ item.unit_name }</td>
                    <td>{ item.cost_type_name }</td>
                    <td>
                        <button
                            className="ui basic red icon button"
                            onClick={ this.handleDelete.bind(this, item) }
                        >
                            <i className="remove icon"></i>
                        </button>
                    </td>
                </tr>
            )
        })

        if (0 === rows.length) {
            rows.push(
                <tr>
                    <td className="center aligned" colSpan="8">目前沒有工項</td>
                </tr>
            )
        }

        var errors = ''

        if (this.state.hasError) {
            errors = (
                <div className="ui error message">
                    <div className="header">錯誤！</div>
                    <p>{ this.state.errorMsg }</p>
                </div>
            )
        }

        var formClassName = classNames('ui equal width form', {
            error: this.state.hasError
        })

        return (
            <table className="ui celled padded table">
                <thead>
                    <tr>
                        <th className="collapsing">#</th>
                        <th>名稱</th>
                        <th>數量</th>
                        <th>單價</th>
                        <th>總價</th>
                        <th>單位</th>
                        <th>分類</th>
                        <th className="collapsing"></th>
                    </tr>
                </thead>
                <tbody>
                    { rows }

                </tbody>
                <tfoot>
                    <tr>
                        <th colSpan="8">
                            <form method="POST" action={"/works/" + this.props.workId + "/work-items"} className={formClassName} ref={ (c) => { this._form = c } } onSubmit={this.handleSubmit}>

                                <div className="fields">
                                    <UnitSelect />
                                    <CostTypeSelect />
                                </div>

                                <div className="fields">
                                    <div className="field">
                                        <label>名稱</label>
                                        <OrderNameInput onValid={this.onValid} onInValid={this.onInValid} value={this.state.inputValues.orderName}/>
                                    </div>
                                    <div className="field">
                                        <label>數量</label>
                                        <input type="text" name="amount" value={this.state.inputValues.amount} placeholder="數量" />
                                    </div>
                                    <div className="field">
                                        <label>單價</label>
                                        <input type="text" name="unit_price" value={this.state.inputValues.unitPrice} placeholder="單價" />
                                    </div>
                                </div>

                                { errors }

                                <button className="ui primary button" type="submit">新增</button>
                            </form>
                        </th>
                    </tr>
                </tfoot>
            </table>
        )
    }
}
