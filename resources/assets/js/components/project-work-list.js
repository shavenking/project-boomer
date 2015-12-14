var React = require('react')
var ReactDOM = require('react-dom')
var pluck = require('lodash/collection/pluck')
var groupBy = require('lodash/collection/groupBy')
var zipObject = require('lodash/array/zipObject')
var merge = require('lodash/object/merge')
var mapValues = require('lodash/object/mapValues')
var forIn = require('lodash/object/forIn')
var ProjectWorkCard = require('./project-work-card')
var FlowtypeSelect = require('./flowtype-select')
var WorkSelect = require('./work-select')
var ModalButton = require('./project-work-create-modal')

function getWorks(projectId) {
    return $.getJSON(`/api/v1/projects/${projectId}/works`)
}

export default class ProjectWorkList extends React.Component {
    constructor(props) {
        super(props)

        this.state = {}

        getWorks(this.props.projectId).then(response => {
            this.setState({
                works: response.works
            })
        })
    }

    componentDidMount() {}

    onCreated(work) {
        this.setState({
            works: this.state.works.concat(work)
        })
    }

    render() {
        var worksSets = groupBy(this.state.works, 'mainflow_type.name')

        var mainList = []

        forIn(worksSets, (works, mainflowTypeName) => {
            var detailList = []

            forIn(groupBy(works, 'detailingflow_type.name'), (works, detailingflowTypeName) => {
                var works = works.map(work => {
                    return (
                        <div className="item">
                            <div className="content">
                                <div className="header">{work.name}</div>
                            </div>
                        </div>
                    )
                })

                detailList.push(
                    <div className="item">
                        <i className="folder icon"></i>

                        <div className="content">
                            <div className="header title">{detailingflowTypeName}</div>

                            <div className="list content">{works}</div>
                        </div>
                    </div>
                )
            })

            mainList.push(
                <div className="item">
                    <i className="folder icon"></i>

                    <div className="content">
                        <div className="header title">{mainflowTypeName}</div>
                        <div className="list content">{detailList}</div>
                    </div>
                </div>
            )
        })



        return (
            <div className="ui segments">
                <div className="ui segment">
                    <div className="ui list">
                        {mainList}
                    </div>
                </div>

                <div className="ui secondary segment">
                    <ModalButton onCreated={this.onCreated.bind(this)} projectId={this.props.projectId}/>
                </div>
            </div>
        )
    }
}
