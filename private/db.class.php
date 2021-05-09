<?php

class DB
{
    /// DB connection variable
    private $conn;
    private $startupKeyTemplate;

    public function GetCredentials()
    {
        $file = fopen("../private/access.json", "r");
        $rawData = fread($file,filesize("../private/access.json"));
        fclose($file);

        $data = json_decode($rawData);

        $this->startupKeyTemplate = $data->startupKeyTemplate;
        $servername = $data->servername;
        $dbname = $data->dbname;
        $username = $data->username;
        $password = $data->password;
        
        return array(
            'servername' => $servername,
            'dbname' => $dbname,
            'username' => $username,
            'password' => $password
         );
    }

    private function Connect()
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

    private function Close()
    {
        Global $conn;
        $conn = null;
        return array('responseCode' => "s101", 'msg' => "Connection Closed");
    }


    public function ActionReg($startupKey, $username)
    {
        Global $conn;

        $this->Connect();
        if ($startupKey = $this->startupKeyTemplate)
        {
            //Check DB for username availability.
            $stmt = $conn->prepare("SELECT id FROM users WHERE username = '$username';");
            $stmt->execute();

            $count = $stmt->rowCount();

            if ($count == 0)
            {
                try
                {
                    $unixTime = time();
                    $uniqueKeyRAW = $username.$unixTime;
                    $uniqueKey = hash('md5', $uniqueKeyRAW, false);
                    $sql = "INSERT INTO users (username, accessKey) VALUES ('$username','$uniqueKey');";
                    $conn->exec($sql);

                    $this->Close();
                    return array('responseCode' => "s110", 'msg' => "User created and key returned.", 'uniqueKey' => $uniqueKey);

                }
                catch (PDOException $e)
                {
                    $this->Close();
                    $msg = "UsernameReg Failed: ".$e->getMessage();
                    return array('responseCode' => "e111", 'msg' => $msg);
                }
            }
            else
            {
                $this->Close();
                return array('responseCode' => "e110", 'msg' => "Username already exists!");
            }   
        }

        $this->Close();
    }

    public function ActionLogin($startupKey, $uniqueKey)
    {
        Global $conn;

        $this->Connect();
        if ($startupKey = $this->startupKeyTemplate)
        {
            //Check DB for username with this uniqueKey.
            $stmt = $conn->prepare("SELECT id, username FROM users WHERE accessKey = '$uniqueKey';");
            $stmt->execute();

            $count = $stmt->rowCount();

            if ($count != 0)
            {
                try
                {
                    $data = $stmt->fetchAll()[0];
                    $userId = $data['id'];
                    $username = $data['username'];

                    // Score_Slow
                    $stmt = $conn->prepare("SELECT score FROM score_slow WHERE userId = $userId;");
                    $stmt->execute();
        
                    $score = "";

                    if ($count = $stmt->rowCount() == 0)
                    {
                        $score = $score."0 ";
                    }
                    else
                    {
                        $score = $score.$stmt->fetchAll()[0]['score']." ";
                    }

                    // Score_Normal
                    $stmt = $conn->prepare("SELECT score FROM score_norm WHERE userId = $userId;");
                    $stmt->execute();

                    if ($count = $stmt->rowCount() == 0)
                    {
                        $score = $score."0 ";
                    }
                    else
                    {
                        $score = $score.$stmt->fetchAll()[0]['score']." ";
                    }
                    
                    // Score_Fast
                    $stmt = $conn->prepare("SELECT score FROM score_fast WHERE userId = $userId;");
                    $stmt->execute();

                    if ($count = $stmt->rowCount() == 0)
                    {
                        $score = $score."0";
                    }
                    else
                    {
                        $score = $score.$stmt->fetchAll()[0]['score'];
                    }
                    
                    $this->Close();
                    return array('responseCode' => "s130", 'msg' => "User data and key returned.", 'username' => $username, 'score' => $score);

                }
                catch (PDOException $e)
                {
                    $this->Close();
                    $msg = "UsernameReg Failed: ".$e->getMessage();
                    return array('responseCode' => "e131", 'msg' => $msg);
                }
            }
            else
            {
                $this->Close();
                return array('responseCode' => "e130", 'msg' => "Username dose not exists!");
            }   
        }

        $this->Close();
    }

    public function ActionUpload($uniqueKey, $score, $diff)
    {
        Global $conn;

        $this->Connect();
        // Send unique key and get user id.
        // Insert score for selected  difficulty with user id and score.
        // Return result.

        //Check DB for username availability.
        $stmt = $conn->prepare("SELECT id FROM users WHERE accessKey = '$uniqueKey';");
        $stmt->execute();


        $count = $stmt->rowCount();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        

        if (!is_numeric($score))
        {
            $this->Close();
            return array('responseCode' => "e124", 'msg' => "Score is not a number!");
        }

        
        if (!is_numeric($diff))
        {
            $this->Close();
            return array('responseCode' => "e125", 'msg' => "Difficulty is not a number!"); 
        }


        if ($count != 0)
        {
            $userId = $stmt->fetchAll()[0]['id'];
            

            switch ($diff) {
                case 0:
                    $difficulty = "score_slow";
                    break;
                
                case 1:
                    $difficulty = "score_norm";
                    break;
                    
                case 2:
                    $difficulty = "score_fast";
                    break;
                default:
                    $this->Close();
                    return array('responseCode' => "e123", 'msg' => "Unknown score type.");
            }

            try
            {
                $sql = "DELETE FROM $difficulty WHERE userId = '$userId';";
                $conn->exec($sql);

                $sql = "INSERT INTO $difficulty (userId, score) VALUES ('$userId','$score');";
                $conn->exec($sql);

                $this->Close();
                return array('responseCode' => "s120", 'msg' => "Score was inserted!");

            }
            catch (PDOException $e)
            {
                $this->Close();
                $msg = "Score insert Failed: ".$e->getMessage();
                return array('responseCode' => "e121", 'msg' => $msg);
            }
        }
        else
        {
            $this->Close();
            return array('responseCode' => "e120", 'msg' => "User invalid!");
        }   
    }
}

?>