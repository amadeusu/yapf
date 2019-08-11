<?php

namespace Common\Models;

use System\Core\Model;

class Log extends Model {
    protected $table = 'logs';
    protected $primaryKey = 'log_id';
    public $timestamps = false;
}