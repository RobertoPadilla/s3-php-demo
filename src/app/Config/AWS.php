<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class AWS extends Config
{
    public $s3 = [
        'access_key_id' => '',
        'secret_access_key' => ''
    ];
}