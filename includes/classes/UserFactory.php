<?php

class UserFactory
{

    /**
     * UserFactory constructor.
     */
    private function __construct()
    {

    }

    /**
     * @param $uid
     *
     * @return  \User returns user
     */
    public static function create($uid)
    {
        return new User($uid);
    }
}