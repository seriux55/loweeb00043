
var fs   = require('fs');
var http = require('http');
var path = require('path');

httpServer = http.createServer(function (req, res) {

});
httpServer.listen(1338);

var io    = require('socket.io').listen(httpServer);
var md5   = require('md5');
var mysql = require('mysql');

console.log('Bonjour !!! ');

/**
 * Connection a la bdd
 */
var pool = mysql.createPool({
    connectionLimit : 200, //important
    host     : '151.80.155.184',
    user     : 'nroho',
    password : 'Chalgrin116',
    database : 'nroho',
    debug    :  false
});

var msg 		 = {}; // la liste des destinataires de messages pour chaque id

io.sockets.on('connection', function (socket) {
    console.log('Nouveau utlisateur !');
    socket.on('recupe', function(){
        socket.emit('allo', 'nadir');
    });
    
    
    /**
     * Recuperer la liste des paires d'amis et demandes d'amities
     */
    pool.getConnection(function(err, connection){
        if (err) { 
            console.log(err);
            connection.release();
            return;
        }
        
        /**
         * Recuperer la liste des paires de messages
         */
        connection.query("SELECT user_id AS aid, userDist_id AS bid FROM nroho_Message", function(err, rows){
            connection.release();
            if(!err) {
                for(var k in rows){
                    msg[rows[k].aid] = ( typeof msg[rows[k].aid] != 'undefined' && msg[rows[k].aid] instanceof Array ) ? msg[rows[k].aid] : [];
                    if(!in_array(rows[k].bid, msg[rows[k].aid])) msg[rows[k].aid].push(rows[k].bid);

                    msg[rows[k].bid] = ( typeof msg[rows[k].bid] != 'undefined' && msg[rows[k].bid] instanceof Array ) ? msg[rows[k].bid] : [];
                    if(!in_array(rows[k].aid, msg[rows[k].bid])) msg[rows[k].bid].push(rows[k].aid);
                }
            }
        });

        connection.on('error', function(err) { return; });
        
        console.log(msg);
    });
    
});




function trim (myString){
    return myString.replace(/^\s+/g,'').replace(/\s+$/g,'')
}
