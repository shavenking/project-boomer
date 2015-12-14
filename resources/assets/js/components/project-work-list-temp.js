var React = require('react')
var ReactDOM = require('react-dom')
var pluck = require('lodash/collection/pluck')
var zipObject = require('lodash/array/zipObject')
var merge = require('lodash/object/merge')
var ProjectWorkCard = require('./project-work-card')
var FlowtypeSelect = require('./flowtype-select')
var WorkSelect = require('./work-select')

function getWorks(projectId, detailingflowTypeId) {
    if (!detailingflowTypeId) {
        return $.getJSON(`/api/v1/projects/${projectId}/works`)
    }

    return $.getJSON(`/api/v1/projects/${projectId}/works?detailingflow_type_id=${detailingflowTypeId}`)
}

function getStandardWorks(detailingflowTypeId) {
    if (!detailingflowTypeId) {
        return $.getJSON('/api/v1/works')
    }
    return $.getJSON(`/api/v1/works?detailingflow_type_id=${detailingflowTypeId}`)
}

function getStandardWork(workId) {
    return $.getJSON(`/api/v1/works/${workId}`)
}

function createProjectWork(work) {
    return $.post(`/api/v1/projects/${work.project_id}/works`, work)
}

export default class ProjectWorkList extends React.Component {
    constructor(props) {
        super(props)

        this.state = {
            works: [],
            standardWorks: [],
            selectedId: null,
            nameInput: '',
            amountInput: '',
            unitPriceInput: ''
        }

        getWorks(this.props.projectId).then(response => {
            this.setState({
                works: response.works
            })
        })

        // getStandardWorks().then(response => {})
    }

    componentDidMount() {
        $(ReactDOM.findDOMNode(this._fakeCard)).dimmer({
            closable: false
        })
        $(this._dropdown).dropdown()
        $(this._modal).modal({
            detachable: false
        })
        $(this._workIdInput).change(this.onWorkIdSelected.bind(this))
    }

    onWorkIdSelected(e) {
        getStandardWork(e.target.value).then(response => {
            var work = response.work
            this.setState({
                nameInput: work.name,
                amountInput: work.amount,
                unitPriceInput: work.unit_price
            })
        })

    }

    onAddButtonClick(e) {
        $(this._modal).modal('show')
    }

    onValid(data) {
        getStandardWorks(data.detailingflowTypeId).then(response => {
            $(this._dropdown).dropdown('clear')
            this.setState({
                standardWorks: response.works
            })
        })
    }

    onWorkFormSubmit(e) {
        e.preventDefault()

        var inputs = $(e.target).serializeArray()

        var work = merge(
            zipObject(pluck(inputs, 'name'), pluck(inputs, 'value')),
            {
                'project_id': this.props.projectId
            }
        )

        createProjectWork(work).then(response => {
            (this.clearWorkCreateForm.bind(this))()
            this.setState({
                works: this.state.works.concat(response.work)
            }, () => {
                $(this._modal).modal('hide')
            })
        })
    }

    handleNameChange(e) {
        this.setState({
            nameInput: e.target.value
        })
    }

    handleAmountChange(e) {
        this.setState({
            amountInput: e.target.value
        })
    }

    clearWorkCreateForm() {
        $(this._dropdown).dropdown('clear')
        this.setState({
            nameInput: '',
            amountInput: '',
            unitPriceInput: '',
        })
    }

    onProjectWorkListFilterValid(data) {
        getWorks(this.props.projectId, data.detailingflowTypeId).then(response => {
            this.setState({
                works: response.works
            })
        })
    }

    onCardDelete(work) {
        var works = this.state.works.filter(candidate => {
            return candidate.id !== work.id
        })

        this.setState({
            works: works
        })
    }

    render() {
        var works = this.state.works.map(work => {
            return (
                <div className="column">
                    <ProjectWorkCard projectId={this.props.projectId} work={work} />
                </div>
            )
        })

        var fakeWork = {
            name: 'fake',
            total_price: 0,
            mainflow_type_name: 'fake',
            detailingflow_type_name: 'fake',
            amount: 0,
            unit_price: 0,
            unit_name: 'fake'
        }

        var dimmer = (
            <div className="ui active dimmer">
                <div className="content">
                    <div className="center">
                        <button className="ui primary button" onClick={ this.onAddButtonClick.bind(this) }>
                            <i className="plus icon"></i>新增專案工項
                        </button>
                    </div>
                </div>
            </div>
        )

        var options = this.state.standardWorks.map(work => {
            return <div className="item" data-value={work.id}>{work.name}</div>
        })

        var modal = (
            <div className="ui modal" ref={ c => { this._modal = c } }>
                <div className="header">新增專案工項</div>
                <div className="content">
                    <form className="ui form" onSubmit={this.onWorkFormSubmit.bind(this)}>
                        <FlowtypeSelect onValid={ this.onValid.bind(this) }/>

                        <div className="field">
                            <label>選擇工作項目</label>
                            <div className="ui selection dropdown" ref={c => {this._dropdown = c}}>
                                <input type="hidden" name="work_id" ref={c => {this._workIdInput = c}} />
                                <i className="dropdown icon"></i>
                                <div className="default text">選擇工作項目</div>
                                <div className="menu">
                                    { options }
                                </div>
                            </div>
                        </div>

                        <div className="field">
                            <label>名稱</label>
                            <input name="name" value={this.state.nameInput} onChange={this.handleNameChange.bind(this)} />
                        </div>

                        <div className="field">
                            <label>數量</label>
                            <input name="amount" value={this.state.amountInput} onChange={this.handleAmountChange.bind(this)} />
                        </div>

                        <div className="disabled field">
                            <label>單價</label>
                            <input name="unit_price" value={this.state.unitPriceInput} />
                        </div>

                        <button className="ui primary button">新增</button>
                    </form>
                </div>
            </div>
        )

        return (
            <div className="ui two column grid">
                <div className="one column row">
                    <div className="column">
                        <form className="ui form" style={{zIndex: 11}}>
                            <FlowtypeSelect onValid={this.onProjectWorkListFilterValid.bind(this)}/>
                        </form>
                    </div>
                </div>
                <div className="column">
                    <ProjectWorkCard onDelete={this.onCardDelete.bind(this)} projectId={this.props.projectId} work={fakeWork} ref={ c => { this._fakeCard = c } } dimmer={dimmer}/>
                </div>
                { works }

                { modal }
            </div>
        )
    }
}
