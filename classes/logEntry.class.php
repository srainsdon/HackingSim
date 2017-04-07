<?php

/**
 * Created by PhpStorm.
 * User: srainsdon
 * Date: 4/7/2017
 * Time: 2:08 AM
 */
class logEntry
{
    public $timestamp;
    public $logger;
    public $thread;
    public $file;
    public $line;
    public $level;
    public $message;
    
     function __construct($timestamp, $logger, $thread, $file, $line, $level, $message)
     {
         $this->timestamp = $timestamp;
         $this->logger = $logger;
         $this->thread = $thread;
         $this->file = $file;
         $this->line = $line;
         $this->level = $level;
         $this->message = $message;
     }
}