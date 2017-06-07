<?php

/**
 * Class Login
 */
class Login
{

    /**
     * @var array
     */
    protected $_credentials;

    /**
     * @var
     */
    protected $_error_messages;

    /**
     * @var User
     */
    protected $_user;

    /**
     * Login constructor.
     *
     * @param array $credentials
     */
    public function __construct(array $credentials)
    {

        $this->_credentials = array(
            'username' => '',
            'password' => ''
        );

        if ($credentials)
        {
            /* union of $credentials + $this->_credentials */
            $this->_credentials = $credentials + $this->_credentials;
        }
    }

    /**
     * @return bool
     */
    private function checkUser()
    {
        $pdo = Registry::getConnection();
        $query = $pdo->prepare("SELECT * FROM client WHERE  ( Username=:user OR Email=:email) LIMIT 1");
        $query->bindValue(":user", $this->_credentials['username']);
        $query->bindValue(":email", $this->_credentials['username']);
        $query->execute();
        $user = $query->fetch();

        $this->_user = new User($user['uid']);

        if ($query->rowCount() == 1)
        {

           // exit();
            $PasswordHash = new PasswordHash(16, FALSE);

            $stored = $user["Password"];

            if(!$PasswordHash->CheckPassword($this->_credentials['password'], $stored))
            {

                $this->_error_messages[] = "Username or password incorrect.";
            }


        }
        else
        {

            $this->_error_messages[] = "Username or password incorrect.";
        }
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->_error_messages;
    }

    /**
     * @return bool
     */
    public function login()
    {
        $this->checkUser();
        if (empty($this->_error_messages))
        {
            session_start();
            @session_regenerate_id(true);
            $_SESSION['username'] = $this->_credentials['username'];
            $_SESSION['uid'] = $this->_user->getUid();


            return true;

        }

        return false;

    }
}

