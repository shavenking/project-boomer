var $ = window.$ = window.jQuery = require('jquery')
window.raphael = require('raphael')
window.flowchart = require('./libs/flowchart.min')
require('semantic-ui/dist/semantic.min')

var React = require('react')
var ReactDOM = require('react-dom')
var WorkflowList = require('./components/workflow-list')
var WorkflowNodeList = require('./components/workflow-node-list')
var FlowtypeSelect = require('./components/flowtype-select')

if ($('#workflow-list').length) {
    ReactDOM.render(
      <WorkflowList />,
      document.getElementById('workflow-list')
    )
}

if ($('#workflow-node-list').length) {
    var workflowId = parseInt($('#workflow-node-list').attr('data-workflow-id'))

    ReactDOM.render(
      <WorkflowNodeList workflowId={ workflowId } />,
      document.getElementById('workflow-node-list')
    )
}
