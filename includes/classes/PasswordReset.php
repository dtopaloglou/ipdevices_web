<?php

class PasswordReset
{


    /**
     * @var User
     */
    private $_User;

    private $_errors = array();

    public function __construct(User $user)
    {
        $this->_User = $user;

    }

    public static function GeneratePassword()
    {
        $length = Register::PASSWORD_LENGTH;
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $string = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, $max)];
        }

        return $string;
    }

    public function Reset()
    {
        $pdo = Registry::getConnection();
        try
        {

            $newpassword = self::GeneratePassword();

            $PasswordHash = new PasswordHash(8, FALSE);

            $pdo->beginTransaction();
            $query = $pdo->prepare("UPDATE client SET Password=:newpass WHERE uid=:uid");
            $query->bindValue(":newpass", $PasswordHash->HashPassword($newpassword));
            $query->bindValue(":uid", $this->_User->getUid());
            $query->execute();




            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->IsHTML();
            $mail->Host = CoreConfig::settings()['email']['outgoing_server'];
            $mail->SMTPAuth = CoreConfig::settings()['email']['smtp_auth'];
            $mail->Username = CoreConfig::settings()['email']['username'];
            $mail->Password = CoreConfig::settings()['email']['password'];
            $mail->Port = CoreConfig::settings()['email']['smtp_port'];


            $mail->From = CoreConfig::settings()['email']['username'];
            $mail->FromName = CoreConfig::settings()['appname'];
            $mail->AddAddress($this->_User->getEmail(), $this->_User->getFullName());
            $mail->Subject = CoreConfig::settings()['appname'] . ' - Password Reset';

            $body = '<!doctype html>';
            $body .= '<html>';
            $body .= '<body>';
            $body .= "Hello " . $this->_User->getFirstName() . ", <p>";
            $body .= "Here is your new password: <strong>" . $newpassword . "</strong><br>";
            $body .= "You may log in with this password right away. <p>";
            $body .= "Cheers!";
            $body .= '</body>';
            $body .= '</html>';

            $mail->Body = $body;

            if(!$mail->Send())
            {
                throw new Exception($mail->ErrorInfo);
            }

            $pdo->commit();

            return true;
        }
        catch(Exception $e)
        {
            $pdo->rollBack();
            $this->_errors[] = "An unknown error occurred.";

        }

        return false;

    }

    public function getErrors()
    {
        return $this->_errors;
    }

}