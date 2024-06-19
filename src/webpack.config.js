const webpack = require("webpack");
// var ExtractTextPlugin = require("extract-text-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const path = require('path');

module.exports = {
    entry: {
        "app" : "./src/scripts/App.ts"
    },
    output: {
        filename: "js/[name].bundle.js",
        chunkFilename: "js/[name].bundle.js",
        path: __dirname + "/../public/"
    },
    devtool: "source-map",
    resolve: {
        extensions: [".ts", ".tsx", ".js", ".json"],
    },
    optimization: {
        // minimize: true,
        // minimizer: [
        //   new CssMinimizerPlugin(),
        // ],
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: "css/[name].bundle.css",
            chunkFilename: "css/[id].bundle.css"
        }),
        // new webpack.ProvidePlugin({
        //     $: 'jquery',
        //     jQuery: 'jquery',
        //     'window.jQuery': 'jquery'
        // }),
    ],
    module: {
        rules: [
            {
				test: /\.(ts|tsx|js|jsx)$/,
				use: [
					{
						loader: 'ts-loader',
						options: {
							transpileOnly: true
						}
					}
				]
			},
            {
                test: /\.s[ac]ss$/i,
                use: [
                    // Creates `style` nodes from JS strings
                    // { loader: "style-loader", },
                    // Translates CSS into CommonJS
                    MiniCssExtractPlugin.loader,
                    { 
                      loader: "css-loader",
                        options: {
                            url: false
                        }
                    },
                    // Compiles Sass to CSS
                    'postcss-loader', // post process the compiled CSS
                    { 
                        loader: "sass-loader",
                        options: {
                            // Prefer `dart-sass`
                            implementation: require("sass"),
                            sourceMap: true,
                            sassOptions: {
                                outputStyle: "compressed",
                            },
                        },
                    },
                ],
                
            },
            {
                test: /\.css$/i,
                use: [MiniCssExtractPlugin.loader, "css-loader"],
            },
            {
                test: /\.(png|woff|woff2|eot|ttf|svg|jpeg)$/,
                use: [
                    {
                        loader: 'url-loader',
                        options: {
                            limit: 1000,
                            name : 'assets/img/[name].[ext]'
                        }
                    }
                ]
            },
        ]
    },
};