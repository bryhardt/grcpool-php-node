  const path = require('path');
  const CleanWebpackPlugin = require('clean-webpack-plugin');

  var BUILD_DIR = path.resolve(__dirname, './assets/libs/react');
  var APP_DIR = path.resolve(__dirname, './src/app');
  
  module.exports = {
    entry: {
    	homeIndex: APP_DIR + '/homeIndex.tsx'
    },
    devtool: 'inline-source-map',
    plugins: [
      new CleanWebpackPlugin(['dist'])
    ],
    output: {
      filename: '[name].bundle.js',
      path: BUILD_DIR
    },
    resolve: {
        extensions: [".ts", ".tsx", ".js", ".jsx"]
    }, 
    module : {
        rules : [
        	{ test: /\.(t|j)sx?$/, use: { loader: 'awesome-typescript-loader' } },
        	{ enforce: "pre", test: /\.js$/, loader: "source-map-loader" }
        ]
    }
  };