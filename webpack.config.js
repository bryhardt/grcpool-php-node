var webpack = require('webpack');
var path = require('path');
const fs = require('fs');
const WebpackOnBuildPlugin = require('on-build-webpack'); 
var BUILD_DIR = path.resolve(__dirname, './assets/libs/react');
var APP_DIR = path.resolve(__dirname, './src/app');
const WebpackAssetsManifest = require('webpack-assets-manifest');

var config = {
    entry: {
        homeIndex: APP_DIR + '/homeIndex.tsx',
        webPage: APP_DIR + '/webPage.tsx'
    },
    output: {
        path: BUILD_DIR,
        filename: ("production" === process.env.NODE_ENV)?"[name]-[hash].bundle.js" : "[name].bundle.js"
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
    plugins: [
        new WebpackAssetsManifest({
        	output : './../../../manifest.json'
        }),
        new WebpackOnBuildPlugin(function(stats) {
            const newlyCreatedAssets = stats.compilation.assets;
            fs.readdir(path.resolve(BUILD_DIR), (err, files) => {
              files.forEach(file => {
                if (!newlyCreatedAssets[file]) {
                  fs.unlink(path.resolve(BUILD_DIR + '/'+ file),(err) => {});
                }
              });
          })
        })        
    ],    
    devtool: "source-map"
};

module.exports = config;