<?php
// 创建 server
$server = new swoole_server( '127.0.0.1',9501  );

$server->set([ 'worker_num' => 2  ]);

$server->on( 'connect', function( $server,$uid  ) {
	echo "new client connected".PHP_EOL;
}  );

$server->on( 'receive', function ( $server, $uid, $fromId, $data  ) {
	$server->send($uid, 'server'.$data  );
}  );

$server->on( 'close', function( $server, $uid  ) {
	echo 'client close'.PHP_EOL;
}  );

$server->start();
