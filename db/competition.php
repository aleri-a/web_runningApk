<?php
    
    class competition{

        private $db;

        function __construct($conn)
        {
            $this->db = $conn;
        }

        public function insertCt( $competitionName,$startDt,$endDt,$numPerTeam,$numBest,$distance,$admin_id,$typect)
        {
            try
            {

                $sql3=" INSERT INTO `competition`( `name`, `startdate`, `enddate`, `numperteam`, `numbest`, `distance`, `admin_id`,typect_id ) 
                VALUES (:name,:startDt,:endDt,:numPerTeam,:numbest,:distance,:admin_id,:typect)";
                $stmt=$this->db->prepare($sql3);
                $stmt->bindparam(':name',$competitionName);
                $stmt->bindparam(':startDt',$startDt);
                $stmt->bindparam(':endDt',$endDt);
                $stmt->bindparam(':numPerTeam',$numPerTeam);
                $stmt->bindparam(':numbest',$numBest);
                $stmt->bindparam(':distance',$distance);
                $stmt->bindparam(':admin_id',$admin_id);
                $stmt->bindparam(':typect',$typect);
                
                $stmt->execute();
                return true;
                

            } 
            catch (PDOException $e) {
                echo "Catch u insertCt";
                echo $e->getMessage();
                return false;
            }
        }


        public function getAllCt()
        {
            try
            {
                //$sql= "SELECT t1.*, t2.name FROM `team` t1 left join team t2 on t2.team_id=t1.parentteam_id";
                $sql2= "SELECT t1.*,t2.name as adminname FROM `competition` t1 left join users t2 on t2.id=t1.admin_id";
                $sql0="select * from competition";
                $sql="SELECT ct.*,t.type_name as typename FROM `competition` ct left join typect t on ct.typect_id=t.id";
                //$sql= "SELECT t1.* FROM `team` t1 ";
                $result= $this->db->query($sql);
                return $result;
            }
            catch (PDOException $e)
            {
                echo '   usao u catch getAllCt ';
                echo $e->getMessage();
                return false;
            }       
    
        }

        public function getOneCtDetails($id)
        {
            try
            {
                //$sql= "SELECT t1.*,t2.name as parentname FROM team t1 left join team t2 on t2.team_id=t1.parentteam_id        where t1.team_id= :id"; 
                $sql="SELECT ct.*,t.type_name as typename FROM `competition` ct left join typect t on ct.typect_id=t.id where ct.id=:id";
                $stmt= $this->db->prepare($sql);
                $stmt-> bindparam (':id',$id); 
                $stmt->execute();
                $result=$stmt->fetch();
                return $result;
              
            }
            catch (PDOException $e)
            {
                echo '   usao u catch getOneCtDetails  ';
                echo $e->getMessage();
                return false;
            }
        }

        public function updateOneCt($id, $competitionName,$startDt,$endDt,$numPerTeam,$numBest,$distance,$admin_id,$typect)
        {
            try
            {
                
                $sql2="UPDATE `competition` SET `name`=:name,`startdate`=:startDt,
                `enddate`=:endDt,`numperteam`=:numPerTeam,`numbest`=:numbest,`distance`=:distance,`admin_id`=:admin_id,typect_id=:typect WHERE id=:id";
                $stmt= $this->db->prepare($sql2);
                $stmt-> bindparam (':id',$id); 
                $stmt->bindparam(':name',$competitionName);
                $stmt->bindparam(':startDt',$startDt);
                $stmt->bindparam(':endDt',$endDt);
                $stmt->bindparam(':numPerTeam',$numPerTeam);
                $stmt->bindparam(':numbest',$numBest);
                $stmt->bindparam(':distance',$distance);
                $stmt->bindparam(':admin_id',$admin_id);       
                $stmt->bindparam(':typect',$typect);  
                   
                   
                $stmt->execute();                            
                return true;       
                
            }
            catch (PDOException $e)
            {
                echo ' adminid= '.$admin_id.',  usao u catch updateOneCts ';
                echo $e->getMessage();
                return false;
            }
        }

        
    public function deleteOneCt($id) //ako obrises tim koji roditelj nekom drugom obrisace se i njegovi podtimovi 
    {
        try
        {            
            $sql="delete from competition where id=:id";
            $stmt=$this->db->prepare($sql);
            $stmt->bindparam(':id',$id);
            $stmt->execute();
            return true;
        }
        catch (PDOException $e)
        {
            echo '   usao u catch deleteOneCt ';
            echo $e->getMessage();
            return false;
        }

    }

    public function getTypeCt()
    {
        try
        {
            $sql= "SELECT * FROM `typect`";
            $result= $this->db->query($sql);
            return $result;
        }
        catch (PDOException $e)
        {
            echo '   usao u catch get Type Ct ';
            echo $e->getMessage();
            return false;
        }     
    }





        
        


    }

?>