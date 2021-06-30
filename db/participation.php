<?php
    
    class participation{

        private $db;

        function __construct($conn)
        {
            $this->db = $conn;
        }


        public function insertInPt($competitionId,$teamId,$personId) //insert participant in match
        {
            try
            {
                $exist=$this->ptExists($competitionId,$teamId,$personId);                
                if($exist!=null)
                    return false; //ie it exist so we will not add it in db
                else
                {                    
                    $sql3=" INSERT INTO `participation`( `competition_id`, `team_id`,person_id) VALUES (:competitionId,:teamId,:personId)";
                    $stmt=$this->db->prepare($sql3);
                    $stmt->bindparam(':competitionId',$competitionId);
                    $stmt->bindparam(':teamId',$teamId);
                    $stmt->bindparam(':personId',$personId);
                
                    $stmt->execute();
                    return true;
                }

            } 
            catch (PDOException $e) {
                echo "Catch u insertParticipantinMethc";
                echo $e->getMessage();
                return false;
            }
        }

        public function getRegistredCt($idCompetition) 
        {
            try
            { 

                $sql3=" select * from `participation` where competition_id=:idCompetition";
                $stmt=$this->db->prepare($sql3);
                $stmt->bindparam(':idCompetition',$idCompetition);               
               
                $result= $this->db->query($sql3);
                return  $result;
                

            } 
            catch (PDOException $e) {
                echo "Catch u getRegistredCt";
                echo $e->getMessage();
                return false;
            }
        }

        public function ptExists($competitionid,$idteam,$personId)
        {
            try
            {
                $sql=null;
                if($personId==NULL)
                    $sql= "select * from participation where competition_id=:ctId and team_id=:idteam and person_id is :personId" ;
                else
                    $sql= "select * from participation where competition_id=:ctId and team_id=:idteam and person_id=:personId" ;

                $stmt=$this->db->prepare($sql);
                $stmt->bindparam(':ctId',$competitionid);
                $stmt->bindparam(':idteam',$idteam);
                $stmt->bindparam(':personId',$personId);
                $stmt->execute();
                $result=$stmt->fetchAll();
               
                return $result;
            }
            catch(PDOException $e) {
                echo "Catch u getTeamsforCt2 ,idteam:$idteam, id_competiiton=$competitionid,person_id= $personId \n";
                echo $e->getMessage();
                return false;
            }
        }

       

        public function getTeamsforCt2($competitionid)
        {
            try
            {

                $sql= "select team_id from participation where competition_id=:ctId" ;
                $stmt=$this->db->prepare($sql);
                $stmt->bindparam(':ctId',$competitionid);
                $stmt->execute();
                $result=$stmt->fetchAll();
                $arrayIds=array();
                
                foreach( $result as $rs ){ 
                    array_push($arrayIds,$rs['team_id']);
                }
                return $arrayIds;
            }
            catch(PDOException $e) {
                echo "Catch u getTeamsforCt2 , id_competiiton=$id_competition";
                echo $e->getMessage();
                return false;
            }


        }

        public function getTeamsforCtsql($competitionid)
        {
            try
            {
                $sql= "select team_id from participation where competition_id=:ctId" ;
                $stmt=$this->db->prepare($sql);
                $stmt->bindparam(':ctId',$competitionid);
                $stmt->execute();
                $result=$stmt->fetchAll();
               
                return $result;
            }
            catch(PDOException $e) {
                echo "Catch u getTeamsforCtsql.   ";
                echo $e->getMessage();
                return false;
            }


        }

        public function getPeopleforCtsql($competitionid,$teamId)
        {
            try
            {
                $sql= "select * from participation where competition_id=:ctId and team_id=:teamId  " ;
                $stmt=$this->db->prepare($sql);
                $stmt->bindparam(':ctId',$competitionid);
                $stmt->bindparam(':teamId',$teamId);
               
                $stmt->execute();
                $result=$stmt->fetchAll();
               
                return $result;
            }
            catch(PDOException $e) {
                echo "Catch u getPeopleforCtsql.   ";
                echo $e->getMessage();
                return false;
            }

        }




        public function deletePt($competitionId,$teamId,$personID)
        {                
            try
            {   
                 
                $sql=null;
                if($personID==NULL)     
                    $sql="DELETE FROM `participation` WHERE competition_id=:competitionId and team_id=:teamId and person_id is :personID" ;
                else     
                    $sql="DELETE FROM `participation` WHERE competition_id=:competitionId and team_id=:teamId and person_id=:personID" ;
                $stmt=$this->db->prepare($sql);
                $stmt->bindparam(':teamId',$teamId);
                $stmt->bindparam(':competitionId',$competitionId);
                $stmt->bindparam(':personID',$personID);
                $stmt->execute();
                return true;
            }
            catch (PDOException $e)
            {
                echo 'deletePt - participation';
                echo $e->getMessage();
                return false;
            }
        }
    }

?>