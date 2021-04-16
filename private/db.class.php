<?php

class DB
{
    /// DB connection variable
    private $conn;


    private function GetCredentials()
    {
        $servername = "localhost";
        $dbname = "sequence";
        $username = "sequence";
        $password = "rKZVpRUCEXNEzPg3";

        return array(
            'servername' => $servername,
            'dbname' => $dbname,
            'username' => $username,
            'password' => $password
         );
    }

    public function Connect()
    {
        Global $conn;

        $credentials = $this->GetCredentials();
        $a = $credentials['servername'];
        $b = $credentials['dbname'];
        $c = $credentials['username'];
        $d = $credentials['password'];

        try
        {
            $conn = new PDO("mysql:host=$a;dbname=$b", $c, $d);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return array('responseCode' => "s100", 'msg' => "Connection Successfull");
        }
        catch(PDOException $e)
        {
            $msg = "Connection Failed: ".$e->getMessage();
            return array('responseCode' => "e100", 'msg' => $msg);
        }
    }

    public function Close()
    {
        Global $conn;
        $conn = null;
        return array('responseCode' => "s101", 'msg' => "Connection Closed");
    }
}

?>