<?php

    $server = array();

    $count = count($server);
    $server[$count]['host'] = '127.0.0.1';
    $server[$count]['user'] = 'root';
    $server[$count]['pass'] = 'pass';
    $server[$count]['directory'] = 'cstrike/'; // Directory in FTP with .dem files
    $server[$count]['prefix'] = 'test'; // Enter anything but it must be unique!
    $server[$count]['name'] = 'Test server'; // Server name in menu
