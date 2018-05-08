var webpack = require('webpack');
var path = require('path');
const fs = require('fs');
const WebpackOnBuildPlugin = require('on-build-webpack'); 
var BUILD_DIR = path.resolve(__dirname, './assets/libs/react');
var APP_DIR = path.resolve(__dirname, './src/app');
const WebpackAssetsManifest = require('webpack-assets-manifest');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

var config = {
    entry: {
        homeIndex: APP_DIR + '/homeIndex.tsx'
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
    	new webpack.EnvironmentPlugin(['NODE_ENV']),
        new webpack.DefinePlugin({
            'process.env': {
               NODE_ENV: JSON.stringify("production")
             }
        }),   

           new UglifyJsPlugin({
        	      uglifyOptions:{
        	        output: {
        	          comments: false, // remove comments
        	        },
        	        compress: {
        	          unused: true,
        	          dead_code: true, // big one--strip code that will never execute
        	          warnings: false, // good for prod apps so users can't peek behind curtain
        	          drop_debugger: true,
        	          conditionals: true,
        	          evaluate: true,
        	          drop_console: true, // strips console statements
        	          sequences: true,
        	          booleans: true,
        	        }
        	      },
        	    }),
        new webpack.optimize.AggressiveMergingPlugin(),
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