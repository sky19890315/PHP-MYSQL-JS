<?php

$client = new swoole_client( SWOOLE_SOCK_TCP, SWOOLE_SOCK_SYNC  );

$client->connect( '127.0.0.1', 9501 ) || exit( "
connect fail. Error: { $client->errCode  } \n
"  );

$client->send( "connect to server" );

$abc =  $client->recv();

echo $abc;

$client->close();
