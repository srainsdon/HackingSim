<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/7/2017
 * Time: 4:03 AM
 */

class Runtime
{
    function __construct()
    {
        register_shutdown_function(array($this, 'shutdown'));
    }

    function shutdown()
    {
        $logger = Logger::getLogger('root');

        $e = error_get_last();

        if(is_null($e)) {
            $logger->debug('Script ended normally');
        } else {
            $logger->error($e['message']);
        }
    }

    function finish()
    {
        $logger = Logger::getLogger('root');
        $logger->debug('Script ended normally');
    }
}