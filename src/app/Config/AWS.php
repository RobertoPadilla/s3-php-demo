<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class AWS extends Config
{
    public $s3_security = [
        'access_key_id' => '',
        'secret_access_key' => ''
    ];

    public $s3_bucket = [
        'name' => '',
        'ftp_path' => ''
    ];
}