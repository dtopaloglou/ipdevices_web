<?php

class User
{

    /**
     * @var
     */
    protected $_uid;

    /**
     * @var
     */
    protected $_username;

    /**
     * @var
     */
    protected $_firstName;

    /**
     * @var
     */
    protected $_lastName;

    /**
     * @var
     */
    protected $_email;


    protected $_avatar;

    protected $_Password;


    /**
     * User constructor.
     *
     * @param $uid
     */
    public function __construct($uid)
    {
        if(!isset($uid) || !is_numeric($uid))
            exit;


        $this->_uid = $uid;
        $this->fetchUserInfo();
    }

    /**
     *
     */
    private function fetchUserInfo()
    {
        $pdo = Registry::getConnection();
        $query = $pdo->prepare("SELECT * FROM client WHERE uid=:uid LIMIT 1");
        $query->bindValue(":uid", $this->_uid);
        $query->execute();
        $user = $query->fetch();



        $this->_username = $user['Username'];
        $this->_firstName = $user['Firstname'];
        $this->_lastName = $user['Lastname'];
        $this->_email = $user['Email'];

        $this->_avatar = $user['avatar'];
        $this->_Password = $user['Password'];
    }




    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->_uid;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {

        return $this->_firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->_lastName;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_Password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }


    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

    public function getAvatarData()
    {
        return $this->_avatar;
    }


}