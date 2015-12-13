var React = require('react')

export default class OrderNameInput extends React.Component {
    constructor(props) {
        super(props)

        this.onChange = this.onChange.bind(this)
    }

    onChange(e) {
        var newValue = e.target.value

        var regex = /^([0-9]+)\.\s*(\S.*)/

        if (regex.test(newValue)) {
            var data = newValue.split(regex).filter(Boolean)

            this.props.onValid({
                order: data[0],
                name: data[1]
            }, newValue)
        } else {
            this.props.onInValid(newValue)
        }
    }

    render() {
        return (
            <input tyep="text" name="order_name" value={ this.props.value } placeholder="1. 範例" onChange={ this.onChange } />
        )
    }
}
