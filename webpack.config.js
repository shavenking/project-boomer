var webpack = require('webpack')

module.exports = {
    watchOptions: {
        poll: true
    },
    entry: {
        main: './resources/assets/js/main.js',
        vendor: './resources/assets/js/vendor.js'
    },
    output: {
        path: './public/js',
        filename: 'bundle.js'
    },
    module: {
        loaders: [
            {
                test: /\.js$/,
                loader: 'babel',
                exclude: /node_modules/
            },
            {
                test: /\.vue$/,
                loader: 'vue'
            }
        ]
    },
    vue: {
        loaders: {
            js: 'babel'
        }
    },
    plugins: [
        new webpack.optimize.CommonsChunkPlugin("vendor", "vendor.bundle.js")
    ]
}
