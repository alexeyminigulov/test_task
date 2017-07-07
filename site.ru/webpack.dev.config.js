var path = require('path');

module.exports = {
	entry: './resources/assets/src/index.js',
	output: {
		path: path.join(__dirname, 'public/dist'),
		publicPath: '/dist/',
		filename:'bundle.js'
	},
	plugins: [

	],
	module: {
		loaders: [
			{
				test: /\.js$/,
				exclude: /(node_modules)/,
				use: {
					loader: 'babel-loader'
				}
			},
			{
				test: /\.scss$/,
				use: [{
					loader: "style-loader" // creates style nodes from JS strings
				}, {
					loader: "css-loader" // translates CSS into CommonJS
				}, {
					loader: "sass-loader" // compiles Sass to CSS
				}]
			},
			{
				test: /\.(png|jpg|jpeg|gif|svg|woff|woff2|ttf|eot)(\?.*$|$)/,
				loader: 'file-loader'
			}
		]
	}
};