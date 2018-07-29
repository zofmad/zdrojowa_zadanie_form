// webpack.config.js
const webpack = require('webpack');
const path = require('path');
const ExtractTextPlugin = require("extract-text-webpack-plugin");


const WatchTimePlugin = require('webpack-watch-time-plugin');

module.exports = {
    

    entry: {
        app: [
            './assets/js/app.js',
            './assets/sass/app.scss'
        ]
    },

    output: {
        path: path.resolve(__dirname, 'assets/jsdist'),
        filename: '[name].js'
    },

    module: {

        rules: [
            {
                test: /\.js$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['env'],
                        plugins: ['transform-vue-jsx']
                    }
                }
            },
            {
                test: /\.vue$/,
                loader: 'vue-loader',
                include: __dirname,
                exclude: /node_modules/,
                options: {
                    postcss: [require('autoprefixer')({browsers: ['>0%']})]
                }
            },
            {
                test: /\.scss$/,
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: [
                        {
                            loader: 'css-loader',
                            options: {
                                   minimize: true
                            }
                        },
                        'postcss-loader',
                        'sass-loader'
                    ]
                })
            },
            {
                test: /.(jpg|png|gif|jpeg)(\?[a-z0-9=\.]+)?$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: '../css/[hash].[ext]'
                        }
                    }
                ]
            },
            {
                test: /.(woff(2)?|eot|ttf|svg)(\?[a-z0-9=\.]+)?$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: '../css/[hash].[ext]'
                        }
                    }
                ]
            },
            {
                test: /\.css$/,
                use: ['style-loader', 'css-loader']
            }
        ]
     

    },
    plugins: [
        new ExtractTextPlugin(path.join('..', 'css', 'app.css')),
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery'
        }),
        new webpack.DefinePlugin({
            'process.env': {
                NODE_ENV: JSON.stringify('development')
            }
        }),
        WatchTimePlugin
      

        
        
//            ,
//             new webpack.optimize.UglifyJsPlugin({
//             sourceMap: true,
//             compress: {
//             sequences: true,
//             conditionals: true,
//             booleans: true,
//             if_return: true,
//             join_vars: true,
//             drop_console: false
//             },
//             output: {
//             comments: false
//             },
//             minimize: true
//             })
             
    ]
    
    

}
;
