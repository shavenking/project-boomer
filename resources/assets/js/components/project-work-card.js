var React = require('react')

function deleteWork(work) {
    return $.post(`/api/v1/projects/${work.project_id}/works/${work.id}`, {
        _method: 'DELETE'
    })
}

export default class ProjectWorkCard extends React.Component {
    constructor(props) {
        super(props)
    }

    handleDelete(e) {
        e.preventDefault()

        var work = this.props.work

        deleteWork(work).then(() => {
            if (this.props.onDelete) {
                this.props.onDelete(work)
            }
        })
    }

    render() {
        var work = this.props.work

        return (
            <div className="ui fluid card">
                { this.props.dimmer }

                <div className="content">

                    <div className="header">
                        <div className="ui right floated">$ { work.total_price }</div>
                        { work.name }
                    </div>

                    <div className="meta">
                        <span>{ work.mainflow_type_name } - { work.detailingflow_type_name }</span>
                    </div>

                </div>

                <div className="extra content">
                    <div className="ui right floated labels">
                        <button type="submit" className="ui right floated red label" onClick={this.handleDelete.bind(this)}>刪除</button>
                    </div>

                    <div className="ui labels">
                        <div className="ui label">數量 { work.amount }</div>
                        <div className="ui label">單價 { work.unit_price }</div>
                        <div className="ui label">{ work.unit_name }</div>
                    </div>
                </div>


            </div>
        )
    }
}
