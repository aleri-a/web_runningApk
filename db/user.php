<?php
    
    class User{

        private $db;

        function __construct($conn)
        {
            $this->db = $conn;
        }

        public function insertUser($username,$password) //dodaj $email
        {
            try
            {

                $numUsers=$this->getUserbyUsername($username);
                if($numUsers['num']>0)
                {
                    return false;
                }
                else
                {
                    $new_pass=md5($password. $username); //u slucaju da dvoje imaju iste lozinke, md5 je encription ie hashing 

                    $sql = "INSERT INTO `users`(username, password) 
                    VALUES (:username,:pass)";
                    //we need to write on this way because ado it requers in order to dont get sql injectyions ie to dont be possible 
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindparam(':username',$username);
                    $stmt->bindparam(':pass',$new_pass);

                    $stmt->execute();
                    return true;
                }

            } 
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }



        public function getUser($username,$password)
        {
            try
            {               
                $sql2="select * from users where  username = :username and password = :password ";
                $stmt= $this->db->prepare($sql2);
                $stmt-> bindparam (':username',$username); //tj bind parametar koji smo naveli u ovom $sql 
                $stmt-> bindparam(':password',$password);
                $stmt->execute();
                $result = $stmt->fetch();
               
                return $result;
                    //Ako vracas sve kolone iz baze onda samo execute() je okej, ali ako vracas samo jedan row onda moras fetch()                
                
            }
            catch (PDOException $e)
            {
                echo '   usao u catch getUser u user.php ';
                echo $e->getMessage();
                return false;
            }
        }


        public function getUserbyUsername($username) //to dont have two users with same username 
        {
            try
            {
                $sql=  "select count(*) as num from `users`  where  username =:username  ";
                $stmt= $this->db->prepare($sql);
                $stmt-> bindparam (':username',$username); //tj bind parametar koji smo naveli u ovom $sql 
               
                $stmt->execute();
                $result=$stmt->fetch();
                return $result;
                //Ako vracas sve kolone iz baze onda samo execute() je okej, ali ako vracas samo jedan row onda moras fetch()
            }
            catch (PDOException $e)
            {
                echo '   usao u catch getUserbyUsername u user.php ';
                echo $e->getMessage();
                return false;
            }
        }


        


    }

?>