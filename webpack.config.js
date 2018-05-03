var webpack = require('webpack');
var path = require('path');
 
var BUILD_DIR = path.resolve(__dirname, '../assets/libs/react');
var APP_DIR = path.resolve(__dirname, 'src/app');
 
var config = {
    entry: {
        homeIndex: APP_DIR + '/homeIndex.tsx'
    },
    output: {
        path: BUILD_DIR,
        filename: "[name].bundle.js"
    },
    resolve: {
        extensions: [".ts", ".tsx", ".js", ".jsx"]
    },    
    module : {
        rules : [
        	{ test: /\.(t|j)sx?$/, use: { loader: 'awesome-typescript-loader' } },
        	{ enforce: "pre", test: /\.js$/, loader: "source-map-loader" }
        ]
    },
    devtool: "source-map"
};

module.exports = config;