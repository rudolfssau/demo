const path = require('path')

const { VueLoaderPlugin } = require('vue-loader')

module.exports = {
    mode: 'development',
    entry: {
        post: "./src/frontend/post.ts",
        view: "./src/frontend/view.ts",
    },
    resolve: {
        alias: {
            modules: path.resolve(__dirname, 'src/frontend/modules/post')
        },
        extensions: ['.ts', '.js', '.json', ".vue"]
    },
    output: {
        path: path.resolve(__dirname + '/public', "dist"),
        filename: "[name].js"
    },
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {
                test: /\.ts$/,
                loader: 'ts-loader',
                options: {
                    appendTsSuffixTo: [/\.vue$/]
                },
                exclude: /node_modules/
            },
            {
                test: /\.scss$/,
                use : [ "style-loader", "css-loader", "sass-loader" ]
            }
        ],
    },
    plugins: [
        new VueLoaderPlugin()
    ],
    devtool: 'source-map'
}