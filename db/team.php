<?php
    
    class Team{

        private $db;

        function __construct($conn)
        {
            $this->db = $conn;
        }

        public function insertTeam( $teamName,$parentTeam)
        {
            try 
            {
                $numWithSameName=$this->getNumofTeams($teamName);
                if( $numWithSameName['num'] >0)
                {
                    return false;
                }
                else 
                {
                    $sql2="INSERT INTO team (name) VALUES (:teamName)"; //dodace tim i roditelj ce mu biti NULL
                    $stmt=$this->db->prepare($sql2);
                    $stmt->bindparam(':teamName',$teamName);                
                
                    $stmt->execute();
                
                    if($parentTeam!=NULL)
                    {
                        $this->updateTeamParent($teamName,$parentTeam);
                    }
                    return true;
                }    
            } 
            catch (PDOException $e) 
            {               
                echo '         U teamDB u insertTeam';
                echo $e->getMessage();
                return false;
            }
    
        }

        public function updateTeamName($oldTeamName,$newTeamName)
        {
            try
            {
                $numWithSameName=$this->getNumofTeams($newTeamName);
                if( $numWithSameName['num'] >0)
                {
                    echo "<div class='alert alert-danger' role='alert'>
                    Plese choose another new name for the team, team with that name already existr.
                  </div>";
                    return false;
                }
                else 
                {
                    $sql2="update team set name=:newTeamName where name=:oldTeamName";
                    $stmt= $this->db->prepare($sql2);
                    $stmt-> bindparam (':newTeamName',$newTeamName);
                    $stmt-> bindparam (':oldTeamName',$oldTeamName);
                    
                   
                    $stmt->execute();
                    $result=$stmt->fetch();               
                    return $true;
                }
                return false;               
                
            }
            catch (PDOException $e)
            {
                echo '   usao u catch updateTeamName u team.php ';
                echo $e->getMessage();
                return false;
            }
        }


        public function getOneTeamDetails($id)
        {
            try
            {
                $sql=  "SELECT t1.*,t2.name as parentname FROM team t1 left join team t2 on t2.team_id=t1.parentteam_id
                        where t1.team_id= :id"; 
                $stmt= $this->db->prepare($sql);
                $stmt-> bindparam (':id',$id); 
                $stmt->execute();
                $result=$stmt->fetch();
                return $result;
              
            }
            catch (PDOException $e)
            {
                echo '   usao u catch getOneTeamDetails  ';
                echo $e->getMessage();
                return false;
            }
        }

        public function getChildTeams($idParent)
        {
            try
            {
                $sql=  "SELECT * from team where parentteam_id=:idParent "; 
                $stmt= $this->db->prepare($sql);
                $stmt-> bindparam (':idParent',$idParent); 
                $result=$stmt->execute();
                $result=$stmt->fetchAll();
                
                return $result;
              
            }
            catch (PDOException $e)
            {
                echo '   usao u catch getChildTeams  ';
                echo $e->getMessage();
                return false;
            }
        }


        private function updateTeamParent($teamName,$parent)
        {
            try
            {
                
                $sql2="update team set parentteam_id=:parent where name=:teamName";
                $stmt= $this->db->prepare($sql2);
                $stmt-> bindparam (':parent',$parent);       
                $stmt-> bindparam (':teamName',$teamName);            
                   
                $stmt->execute();                            
                return true;       
                
            }
            catch (PDOException $e)
            {
                echo '   usao u catch updateTeamParent u team.php ';
                echo $e->getMessage();
                return false;
            }
        }


        public function updateOneTeam($id,$teamName,$parent)
        {
            try
            {
                
                $sql2="update team set parentteam_id=:parent, name=:teamName where team_id=:id";
                $stmt= $this->db->prepare($sql2);
                $stmt-> bindparam (':parent',$parent);       
                $stmt-> bindparam (':teamName',$teamName); 
                $stmt-> bindparam (':id',$id);              
                   
                $stmt->execute();                            
                return true;       
                
            }
            catch (PDOException $e)
            {
                echo '   usao u catch updateOneTeam ';
                echo $e->getMessage();
                return false;
            }
        }

        public function getNumofTeams($teamName) // to dont have team with 2 names
        {
            try
            {
                $sql=  "select count(*) as num from `team`  where  name =:teamName  ";
                $stmt= $this->db->prepare($sql);
                $stmt-> bindparam (':teamName',$teamName); //tj bind parametar koji smo naveli u ovom $sql 
               
                $stmt->execute();
                $result=$stmt->fetch();               
                return $result;
                //Ako vracas sve kolone iz baze onda samo execute() je okej, ali ako vracas samo jedan row onda moras fetch()
            }
            catch (PDOException $e)
            {
                echo '   usao u catch getNumOfTeams u team.php ';
                echo $e->getMessage();
                return false;
            }
        }


    public function getAllTeams()
    {
        try
        {
            //$sql= "SELECT t1.*, t2.name FROM `team` t1 left join team t2 on t2.team_id=t1.parentteam_id";
            $sql= "SELECT t1.*,t2.name as parentname FROM `team` t1 left join team t2 on t2.team_id=t1.parentteam_id";
            //$sql= "SELECT t1.* FROM `team` t1 ";
            $result= $this->db->query($sql);
            return $result;
        }
        catch (PDOException $e)
        {
            echo '   usao u catch getAllTeams ';
            echo $e->getMessage();
            return false;
        }       

    }

    
    public function getTeamsNames()
    {
        try
        {
            $sql= "SELECT * FROM `team`";
            $result= $this->db->query($sql);
            return $result;
        }
        catch (PDOException $e)
        {
            echo '   usao u catch delete ';
            echo $e->getMessage();
            return false;
        }     

    }


    public function deleteOneTeam($id) //ako obrises tim koji roditelj nekom drugom obrisace se i njegovi podtimovi 
    {
        try
        {            
            $sql="delete from team where team_id=:id";
            $stmt=$this->db->prepare($sql);
            $stmt->bindparam(':id',$id);
            $stmt->execute();
            return true;
        }
        catch (PDOException $e)
        {
            echo '   usao u catch deleteOneTeam ';
            echo $e->getMessage();
            return false;
        }

    }

     


        

    }

    ?>