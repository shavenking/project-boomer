var React = require('react')
var WorkSelect = require('./work-select-v2')
var merge = require('lodash/object/merge')

export default class FormCreateProjectWork extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            inputValues: {
                name: '',
                amount: '',
                unit_price: ''
            }
        }
    }

    handleNameChange(e) {
        this.setState(merge(this.state, {
            inputValues: {
                name: e.target.value
            }
        }))
    }

    handleAmountChange(e) {
        this.setState(merge(this.state, {
            inputValues: {
                amount: e.target.value
            }
        }))
    }

    onSelected(work) {
        this.setState({
            inputValues: {
                name: work.name,
                amount: work.amount,
                unit_price: work.unit_price
            }
        })
    }

    render() {
        return (
            <form className="ui form" method="POST" action={ this.props.action }>
                <input type="hidden" name="_token" value={ this.props.csrfToken } />
                <WorkSelect onSelected={ this.onSelected.bind(this) } labelText="選擇參考工項" defaultText="選擇工作項目" />

                <div className="field">
                    <label>名稱</label>
                    <input name="name" value={this.state.inputValues.name} onChange={this.handleNameChange.bind(this)} />
                </div>

                <div className="field">
                    <label>數量</label>
                    <input name="amount" value={this.state.inputValues.amount} onChange={this.handleAmountChange.bind(this)} />
                </div>

                <div className="disabled field">
                    <label>單價</label>
                    <input name="unit_price" value={this.state.inputValues.unit_price} />
                </div>

                <button className="ui primary button">新增</button>
            </form>
        )
    }
}
