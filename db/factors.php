<?php
    
    class factors{

        private $db;

        function __construct($conn)
        {
            $this->db = $conn;
        }

        public function getFactor($sex,$age)
        {
            try
            {
                if($sex=='F')
                {
                    $sql=  "SELECT fagefactor FROM `factors` where age=:age ";
                }
                else
                {
                    $sql=  "SELECT magefactor FROM `factors` where age=:age ";
                }               
                $stmt= $this->db->prepare($sql);
                $stmt-> bindparam (':age',$age); //tj bind parametar koji smo naveli u ovom $sql 
                $stmt->execute();
                $result=$stmt->fetch();
                return $result;
                //Ako vracas sve kolone iz baze onda samo execute() je okej, ali ako vracas samo jedan row onda moras fetch()
            }
            catch (PDOException $e)
            {
                echo '   usao u catch getFactor ';
                echo $e->getMessage();
                return false;
            }
        }



    }

?>