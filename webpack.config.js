var WebpackNotifierPlugin = require('webpack-notifier')

module.exports = {
    entry: './resources/assets/js/main.js',
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
        new WebpackNotifierPlugin()
    ]
}
