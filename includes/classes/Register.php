<?php

class Register
{
    private $_Email;
    private $_Firstname;
    private $_Lastname;
    protected $_Password;
    private $_Username;
    protected $_ConfirmPassword;


    protected $_errors = array();

    const PASSWORD_LENGTH = 8;
    const USERNAME_LENGTH = 5;


    /**
     * @var PasswordHash
     */
    protected $PasswordHash;

    public function __construct()
    {
        $this->PasswordHash = new PasswordHash(8, false);
    }

    /**
     * @param mixed $ConfirmPassword
     */
    public function setConfirmPassword($ConfirmPassword)
    {
        $this->_ConfirmPassword = trim($ConfirmPassword);
    }

    /**
     * @param mixed $Email
     */
    public function setEmail($Email)
    {
        $this->_Email = trim($Email);
    }

    /**
     * @param mixed $Firstname
     */
    public function setFirstname($Firstname)
    {
        $this->_Firstname = trim($Firstname);
    }


    /**
     * @param mixed $Username
     */
    public function setUsername($Username)
    {
        $this->_Username = $Username;
    }
    /**
     * @param mixed $Lastname
     */
    public function setLastname($Lastname)
    {
        $this->_Lastname = trim($Lastname);
    }

    /**
     * @param mixed $Password
     */
    public function setPassword($Password)
    {
        $this->_Password = trim($Password);
    }

    public static function userNameExists($username)
    {
        $pdo = Registry::getConnection();
        $query = $pdo->prepare("SELECT Username FROM client WHERE Username = :username ");
        $query->execute(array(":username" => $username));
        return $query->rowCount() > 0;

    }

    public static function emailExists($email)
    {
        $pdo = Registry::getConnection();
        $query = $pdo->prepare("SELECT Email FROM client WHERE Email = :email ");
        $query->execute(array(":email" => $email));
        return $query->rowCount() > 0;

    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->_Username;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->_Lastname;
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
        return $this->_Email;
    }

    /**
     * @return mixed
     */
    public function getConfirmPassword()
    {
        return $this->_ConfirmPassword;
    }

    protected function validateName()
    {
        if(empty($this->_Firstname) && empty($this->_Lastname))
        {
            $this->_errors[] = "First and last name required";
        }
        return $this;
    }

    protected function validateEmail()
    {
        if (!filter_var($this->_Email, FILTER_VALIDATE_EMAIL)) {
            $this->_errors[] = "Email address not valid";
        }
        else if(self::emailExists($this->_Email))
        {
            $this->_errors[] = "Email address already exists";
        }
        return $this;
    }

    protected function validateUsername()
    {
        if(!empty($this->_Username))
        {
            if(strlen($this->_Username ) < self::USERNAME_LENGTH)
            {
                $this->_errors[] = "Username must be at least " . self::USERNAME_LENGTH . " characters in length";

            }
            else if(self::userNameExists($this->_Username))
            {
                $this->_errors[] = "Username already exists";

            }
        }
        else
        {
            $this->_errors[] = "Username is required";
        }
        return $this;
    }

    protected function validatePassword()
    {
        if(!empty($this->_Password) && !empty($this->_ConfirmPassword))
        {
            if(strlen($this->_Password) < self::PASSWORD_LENGTH)
            {
                $this->_errors[] = "Password must be at least " . self::PASSWORD_LENGTH . " characters in length";
            }
            else if(!strcasecmp($this->_Password, $this->_ConfirmPassword) == 0)
            {
                $this->_errors[] = "Passwords do not match";
            }

        }
        else
        {
            $this->_errors[] = "Password is required";
        }
        return $this;
    }

    protected function validate()
    {

        $this->validateName()
            ->validateEmail()
            ->validateUsername()
            ->validatePassword();
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->_Firstname;
    }

    public final function Register()
    {
        $this->validate();
        if(!empty($this->_errors))
            return false;


        $pdo = Registry::getConnection();
        try
        {

            $storedPassword = $this->PasswordHash->HashPassword($this->_Password);
            $query = $pdo->prepare("INSERT INTO client (Username, Firstname, Lastname, Password, Email) VALUES (:username, :firstname, :lastname, :password,:email)");
            $query->bindValue(":username", $this->_Username);
            $query->bindValue(":firstname", $this->_Firstname);
            $query->bindValue(":lastname", $this->_Lastname);
            $query->bindValue(":password", $storedPassword);
            $query->bindValue(":email", $this->_Email);

            return $query->execute();
        }
        catch (Exception $e)
        {
            $this->_errors[] = $e->getMessage();
            return false;
        }


    }

    public function getErrors()
    {
        return $this->_errors;
    }
}