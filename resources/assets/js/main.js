var $ = require('jquery')
var each = require('lodash/collection/forEach')
var React = require('react')
var ReactDOM = require('react-dom')

var components = {
    '#workflow-list': require('./components/workflow-list'),
    '#workflow-node-list': require('./components/workflow-node-list'),
    '#flowtype-select': require('./components/flowtype-select'),
    '#unit-select': require('./components/unit-select'),
    '#cost-type-select': require('./components/cost-type-select'),
    '#work-item-list': require('./components/work-item-list'),
    '#workflow-select': require('./components/workflow-select'),
    '#work-select': require('./components/work-select'),
    '#project-work-list': require('./components/project-work-list')
}

each(components, (component, selector) => {
    var targetDOM = $(selector)
    var props = targetDOM.data()

    if (targetDOM.length) {
        ReactDOM.render(
            React.createElement(component, props),
            targetDOM.get(0)
        )
    }
})
