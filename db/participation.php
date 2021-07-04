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

        public function getPeopleforCtsql($competitionid,$teamId) //for competition between people of one team 
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


        public function getPtforMoreTeams($parentTeams) //first i get all teams  where the person belongs, and now i am cheking those teams for which competition they are  and i get every competition where he was participationg (as part of team, or subteam, or alone)
        {
            
            try
            {
               // $registredteams=$this->getAllPtFromListOfTeams($parentTeams);
                //team-:>getChildrenAndGranchildren
                $sql2="SELECT pt.*,ct.name as competitionname ,ct.startdate,ct.enddate,tm.*,tm.name as teamname
                FROM `participation`  pt  
                left join competition ct on pt.competition_id=ct.id 
                left join team tm on pt.team_id=tm.team_id
                where pt.person_id is null and pt.team_id in ($parentTeams)";

                $stmt= $this->db->prepare($sql2);
                $stmt->bindparam(':parentTeams',$parentTeams); //dobijem ct gde se takmice ti timovi 
                
                $result= $stmt->execute();
               $result=$stmt->fetchAll();
                return $result;

               
            $stmt-> bindparam (':id',$id); //tj bind parametar koji smo naveli u ovom $sql 
            $stmt->execute();
            $result=$stmt->fetch();
            return $result;
               
            }
            catch (PDOException $e)
            {
                echo '   usao u catch getAllPeopleNew ';
                echo $e->getMessage();
                return false;
            }       
            

        }

        
    public function getIndividualParticipation($personId)
    {
        try
        {
            echo"U individual participaion $personId";
           // $sql= "select pt.*, pt.id as ptid,tm.name as teamname from participation pt left join team tm on pt.team_id=tm.team_id where person_id=:personId " ;
            $sql="SELECT pt.*,ct.name as competitionname ,ct.startdate,ct.enddate,tm.*,tm.name as teamname
            FROM `participation`  pt  
            left join competition ct on pt.competition_id=ct.id 
            left join team tm on pt.team_id=tm.team_id
            where pt.person_id=:personId";
           $stmt=$this->db->prepare($sql);
            $stmt->bindparam(':personId',$personId);
           
            $stmt->execute();
            $result=$stmt->fetchAll();
           
            return $result;
        }
        catch (PDOException $e)
        {
            echo '   usao u catch getIndividualParticipation ';
            echo $e->getMessage();
            return false;
        }     

    }


       










    }

?>