<?php
    
    class Record{

        private $db;

        function __construct($conn)
        {
            $this->db = $conn;
        }

        public function insertRecord($person_id,$participation_id,$score,$hour,$min,$sec,$length,$nagib) 
        {
            try
            {

               
                $sql = "INSERT INTO `records`( `person_id`, `participation_id`, `score`, `hour`, `min`, `sec`, `length`, `nagib`) 
                    VALUES (:person_id,:participation_id,:score,:hour,:minn,:sec,:lengthh,:nagib)";
                   
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':person_id',$person_id);
                $stmt->bindparam(':participation_id',$participation_id);
                $stmt->bindparam(':score',$score);
                $stmt->bindparam(':hour',$hour);
                $stmt->bindparam(':minn',$min);
                $stmt->bindparam(':sec',$sec);
                $stmt->bindparam(':lengthh',$length);
                $stmt->bindparam(':nagib',$nagib);

                $stmt->execute();
                
                return true;
               

            } 
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        //SELECT pt.*,prsn.firstname,prsn.person_id FROM `participation` pt inner JOIN persons prsn on pt.team_id=prsn.team_id where pt.person_id is null

        public function getRecordForPerson($id)
        {
            try  
            {
                $sql=  "SELECT rc.*,tm.name as teamname ,ct.name as competitionname,ct.* FROM `records` rc 
                left join  participation pt on rc.participation_id=pt.id 
                left join team tm on pt.team_id=tm.team_id
                left join competition ct on pt.competition_id=ct.id
                where rc.person_id=  :id 
                order by ct.startdate";
                $stmt= $this->db->prepare($sql);
                $stmt-> bindparam (':id',$id); 
                $stmt->execute();
                $result=$stmt->fetchAll();
                return $result;
                //Ako vracas sve kolone iz baze onda samo execute() je okej, ali ako vracas samo jedan row onda moras fetch()
            }
            catch (PDOException $e)
            {
                echo '   usao u catch getRecordForPerson ';
                echo $e->getMessage();
                return false;
            }
        }


        public function getRecordForTeam($teams,$parentTeam)
        {
            try  
            {
                //print_r( $teams);
                $str='';
                for($i=0;$i<count($teams );$i++)
                {  $pt=$teams[$i]['team_id'];              
                    $str.=$pt;
                    
                        $str.=',';
                }
                $str.=$parentTeam;
                //print_r( $str);


                $sql=  "SELECT rc.*,tm.name as teamname ,ct.name as competitionname,ct.*,tm.team_id as idtima FROM `records` rc 
                left join  participation pt on rc.participation_id=pt.id 
                left join team tm on pt.team_id=tm.team_id
                left join competition ct on pt.competition_id=ct.id
                where pt.team_id in ($str )";
                $stmt= $this->db->prepare($sql);
               // $stmt-> bindparam (':id',$str); 
                $stmt->execute();
                $result=$stmt->fetchAll();
                return $result;
                //Ako vracas sve kolone iz baze onda samo execute() je okej, ali ako vracas samo jedan row onda moras fetch()
            }
            catch (PDOException $e)
            {
                echo '   usao u catch getRecordForTeam ';
                echo $e->getMessage();
                return false;
            }
        }


        
    

     



    }


?>