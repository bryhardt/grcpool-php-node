var express = require('express');
//var https = require('https');
var http = require('http');
var app = express();
var fs = require('fs');
var bodyParser = require('body-parser');

var server = http.createServer(app).listen(3002);
var io = require('socket.io').listen(server);
var poolBlockWaiting = false;
var poolBlockRequest = 1;

var fs = require('fs');
var obj = JSON.parse(fs.readFileSync('/var/www/properties/betagrcpool.props.json','utf8'));
var apiKey = obj.nodeKey;

app.use(bodyParser.json({
    verify: function(req, res, buf, encoding) {
        req.rawBody = buf.toString();
    }
}));

app.use("/", express.static(__dirname));

//app.post("/updateTicker",function(req,res) {
//	console.log("UPDATE TICKER");
//	res.contentType('text/html');
//	res.send('');
//	
//	io.sockets.in('tickerRoom').emit('updateTicker','1000');
//});

app.post("/updateBlock",function(req,res) {
	res.contentType('text/html');
	res.send('');
	if (req.get('APIKEY') === apiKey) {
		io.sockets.in('homeIndex').emit('updateBlock',req.rawBody);
	}
});

app.post("/updateSuperBlock",function(req,res) {
	res.contentType('text/html');
	res.send('');
	if (req.get('APIKEY') === apiKey) {
		io.sockets.in('homeIndex').emit('updateSuperBlock',req.rawBody);
	}
});

//app.post("/updatePoolBlocks",function(req,res) {
//	res.contentType('text/html');
//	res.send('');
//	//poolBlockRequest = req.rawBody;
//	if (!poolBlockWaiting) {
//		poolBlockWaiting = true;
//		setTimeout(function() {
//			io.sockets.emit('updatePoolBlocks',poolBlockRequest);
//			poolBlockWaiting = false;
//		},5000);
//	}
//});

io.sockets.on('connection', function (socket) {
	socket.on('disconnect', function(){

	});
	socket.on('room',function(room) {
		socket.join(room);
	})
});

