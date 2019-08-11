<?php

namespace System\Interfaces;

interface IndentityInterface {
    /**
     * @param string $login
     * @param string $password
     * @return boolean
     */
    public function auth($login, $password);

    /**
     * @param string|int $id
     * @return object
     */
    public function findIdentity($id);

    /**
     * @return string|int
     */
    public function getId();
}