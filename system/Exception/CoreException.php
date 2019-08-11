<?php

namespace System\Exception;

use System\Logger\Logger;

class CoreException extends \Exception {
    public function logError() {
        $logger = new Logger();
        $logger->warning($this->getMessage());
    }
}