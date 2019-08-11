<?php

namespace System\Logger\routes;

use PDO;
use System\Logger\Route;
use System\Adapter\DB;

/**
 * CREATE TABLE 'logs' (
 *      'log_id' int(11) NOT NULL AUTO INCREMENT,
 *      'date' datetime DEFAULT NULL,
 *      'level' varchar(16) DEFAULT NULL,
 *      'message' text,
 *      'context' text,
 *      PRIMARY_KEY ('log_id')
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 */

class DatabaseRoute extends Route{
    /**
     * @var string
     */
    public $table;
    /**
     * @var PDO
     */
    public $db;
    /**
     * @inheritdoc
     */
    public function log($level, $message, array $context = []) {
        $smtm = $this->db->prepare(
            'INSERT INTO ' . $this->table . ' (date, level, message, context) ' .
            'VALUES (:date, :level, :message, :context)'
        );
        $date = $this->getDate('Y-m-d H:i:s');
        $context = $this->contextStringify($context);

        $smtm->bindParam(':date', $date);
        $smtm->bindParam(':level', $level);
        $smtm->bindParam(':message', $message);
        $smtm->bindParam(':context', $context);

        $smtm->execute();
    }
}