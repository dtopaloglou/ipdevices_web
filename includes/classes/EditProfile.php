<?php


class EditProfile extends Register
{


    protected $_currentPassword;


    protected $_User;

    public function __construct(User $user)
    {
        parent::__construct();

        $this->_User = $user;
    }

    public function setCurrentPassword($password)
    {
        $this->_currentPassword = $password;
    }

    protected function isPasswordCorrect()
    {
        $PasswordHash = new PasswordHash(8, FALSE);
        $stored = $this->_User->getPassword();
        return ($PasswordHash->CheckPassword($this->_currentPassword, $stored));
    }

    protected function validateUsername()
    {
        if(strcmp($this->getUsername(), $this->_User->getUsername())!=0)
        {
            return parent::validateUsername();
        }
        return $this;
    }

    protected function validateEmail()
    {
        if(strcmp($this->getEmail(), $this->_User->getEmail())!=0)
        {
            return parent::validateEmail();
        }
        return $this;

    }

    protected function validatePassword()
    {
        // if the user set his password, it means he can now modify it


        if(!empty($this->_Password) && !empty($this->_ConfirmPassword))
        {
            if(!empty($this->_currentPassword))
            {
                if($this->isPasswordCorrect())
                {
                    return parent::validatePassword();
                }
                else
                {
                    $this->_errors[] = "Password is incorrect";
                }
            }
            else
            {
                $this->_errors[] = "Please enter your current password";
            }

        }


        return $this;
    }

    public function Edit()
    {
        parent::validate();

        if(!empty($this->_errors))
            return false;


        $pdo = Registry::getConnection();
        try
        {

            $storedPassword = $this->PasswordHash->HashPassword($this->getPassword());

            $query = $pdo->prepare("UPDATE client SET Username=:username, Firstname=:firstname, Lastname=:lastname, Password=:password, Email=:email WHERE uid=:uid");
            $query->bindValue(":username", $this->getUsername());
            $query->bindValue(":firstname", $this->getFirstname());
            $query->bindValue(":lastname", $this->getLastname());
            $query->bindValue(":password", $storedPassword);
            $query->bindValue(":email", $this->getEmail());
            $query->bindValue(":uid", $this->_User->getUid());

            return $query->execute();
        }
        catch (Exception $e)
        {
            $this->_errors[] = $e->getMessage();
            return false;
        }
    }
}