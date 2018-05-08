var webpack = require('webpack');
var path = require('path');
const fs = require('fs');
const WebpackOnBuildPlugin = require('on-build-webpack'); 
const BUILD_DIR = path.resolve(__dirname, './../server/assets/libs/react-');
const APP_DIR = path.resolve(__dirname, './src/app');
const WebpackAssetsManifest = require('webpack-assets-manifest');
const UglifyJsPlugin = require("uglifyjs-webpack-plugin");


module.exports = (env,argv) => ({
    entry: {
        homeIndex: APP_DIR + '/homeIndex.tsx'
    },
    output: {
        path: BUILD_DIR+argv.mode,
        filename: ("production" === argv.mode)?"[name]-[hash].bundle.min.js" : "[name].bundle.js"
    },
    resolve: {
        extensions: [".ts", ".tsx", ".js"]
    },    
    module : {
        rules : [
        	{ test: /\.(tsx|ts|jsx)?$/, use: { loader: 'awesome-typescript-loader' } }
        ]
    },
    plugins: [
        new WebpackAssetsManifest({
        	output : './../../../assets/libs/react-'+argv.mode+'/manifest.json'
        }),
        new WebpackOnBuildPlugin(function(stats) {
            const newlyCreatedAssets = stats.compilation.assets;
            fs.readdir(path.resolve(BUILD_DIR+argv.mode), (err, files) => {
              files.forEach(file => {
                if (!newlyCreatedAssets[file]) {
                  fs.unlink(path.resolve(BUILD_DIR+argv.mode + '/'+ file),(err) => {});
                }
              });
          })
        })        
    ],
    optimization: {
//    	minimizer : [
//    		new UglifyJsPlugin()
//    	]
//        minimize: true
//        runtimeChunk: true,
//        splitChunks: {
//            chunks: "async",
//            minSize: 1000,
//            minChunks: 2,
//            maxAsyncRequests: 5,
//            maxInitialRequests: 3,
//            name: true,
//            cacheGroups: {
//                default: {
//                    minChunks: 1,
//                    priority: -20,
//                    reuseExistingChunk: true,
//                },
//                vendors: {
//                    test: /[\\/]node_modules[\\/]/,
//                    priority: -10
//                }
//            }
//        }
    },    
    externals: {
    	"react" : "React",
    	"react-dom" : "ReactDOM"
    }
});

