<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/** set your paypal credential **/
//live
//$config['client_id'] = 'AezHxq8C5XgzVts1AsUmOxLf1vASpblzlGRVkKR3t1egIsaF_PxlluQEpiBelpEmLZGjLf3_RCXq31Fe';
//$config['secret'] = 'EMfn6javnfuUDnhygQw19InhUuQwx_yacxaHhzIwRi7-vf6CX5z-n3WoPMRAAVkbl4KKriJsg1YjmZYhYh';
//sandbox
$config['client_id'] = 'Ad-Z62pSAwyzvMAhfWLgubDb5ZGGD04tP3wiEH64MKUGU5r3FDSD97EXif1jW8WTngwl5EjlA-o1nV1U';
$config['secret'] = 'EASVI2naeJYa0mGvkKpHHKqIuTalKB5sftascqxqnHns6S2P8MNdA9qgmVUgoJUvBtItLa7gR0HMoTzB';

/**
 * SDK configuration
 */
/**
 * Available option 'sandbox' or 'live'
 */
$config['settings'] = array(

    'mode' => 'sandbox',
    /**
     * Specify the max request time in seconds
     */
    'http.ConnectionTimeOut' => 1000,
    /**
     * Whether want to log to a file
     */
    'log.LogEnabled' => true,
    /**
     * Specify the file that want to write on
     */
    'log.FileName' => 'application/logs/paypal.log',
    /**
     * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
     *
     * Logging is most verbose in the 'FINE' level and decreases as you
     * proceed towards ERROR
     */
    'log.LogLevel' => 'FINE'
);