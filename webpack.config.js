const webpack = require('webpack');  
const path = require('path');
  const CleanWebpackPlugin = require('clean-webpack-plugin');

  var BUILD_DIR = path.resolve(__dirname, './assets/libs/react');
  var APP_DIR = path.resolve(__dirname, './src/app');
  
  module.exports = {
    entry: {
    	homeIndex: APP_DIR + '/homeIndex.tsx'
    },
    plugins: [
      new CleanWebpackPlugin(['dist']),
      new webpack.optimize.CommonsChunkPlugin({
    	  name: 'common' // Specify the common bundle's name.
      })      
    ],
    output: {
      filename: '[name].bundle.js',
      path: BUILD_DIR
    }
  };