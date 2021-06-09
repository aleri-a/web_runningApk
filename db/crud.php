<?php
//create, read, update, delete 

class crud
{
    private $db;

    function __construct($conn)
    {
        $this->db = $conn;
    }

    public function insertPersonDB($fname, $lname, $dob, $email, $contact, $specialty){
        try {
            $sql = "INSERT INTO `persons`(firstname, lastname, dateofbirth, emailaddress, contactnumber, speciality_id) 
            VALUES (:fname,:lname,:dob,:email,:contact,:specialty)";
            //we need to write on this way because ado it requers in order to dont get sql injectyions ie to dont be possible 
            $stmt = $this->db->prepare($sql);

            $stmt->bindparam(':fname',$fname);
            $stmt->bindparam(':lname',$lname);
            $stmt->bindparam(':dob',$dob);
            $stmt->bindparam(':email',$email);
            $stmt->bindparam(':contact',$contact);
            $stmt->bindparam(':specialty',$specialty);

            $stmt->execute();
            return true;

        } 
        catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

    }

       
    

    public function editOnePerson($id,$fname,$lname,$dob,$email,$contact,$specialty){
        try{
            $sql="update persons set lastname=:lname, firstname=:fname,dateofbirth=:dob, emailaddress=:email,contactnumber=:contact, speciality_id=:specialty where person_id=:id";
            $stmt=$this->db->prepare($sql);
            $stmt->bindparam(':id',$id);
            $stmt->bindparam(':fname',$fname);
            $stmt->bindparam(':lname',$lname);
            $stmt->bindparam(':dob',$dob);
            $stmt->bindparam(':contact',$contact);
            $stmt->bindparam(':email',$email);
            $stmt->bindparam(':specialty',$specialty);

            $stmt->execute();
            return true;
        }
        catch (PDOException $e)
        {
            echo '   usao u catch delete ';
            echo $e->getMessage();
            return false;
        }
    }



    public function getAllPeopleDB(){
        try
        {
            $sql= "SELECT * FROM `persons` a inner join specialties s on a.speciality_id = s.specialty_id";
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


    public function getSpecialties()
    {
        try
        {
            $sql= "SELECT * FROM `specialties`";
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


    public function getSpecialtyBySpecialtyId($idSpecialty)
    {
        try
        {
            $sql=  "SELECT * FROM `specialties` where specialty_id= :idSpec";
            $stmt= $this->db->prepare($sql);
            $stmt-> bindparam (':idSpec',$idSpecialty); 
            $stmt->execute();
            $result=$stmt->fetch();
            return $result;
           
        }
        catch (PDOException $e)
        {
            echo '   usao u catch getSpecialtyBySpecialtyId ';
            echo $e->getMessage();
            return false;
        }
    }

    public function getOnePersonDetails($id)
    {
        try
        {
            $sql=  "SELECT * FROM `persons` a inner join specialties s on a.speciality_id = s.specialty_id where person_id= :id";
            $stmt= $this->db->prepare($sql);
            $stmt-> bindparam (':id',$id); //tj bind parametar koji smo naveli u ovom $sql 
            $stmt->execute();
            $result=$stmt->fetch();
            return $result;
            //Ako vracas sve kolone iz baze onda samo execute() je okej, ali ako vracas samo jedan row onda moras fetch()
        }
        catch (PDOException $e)
        {
            echo '   usao u catch delete ';
            echo $e->getMessage();
            return false;
        }
    }


    public function deleteOnePerson($id)
    {
        try
        {            
        $sql="delete from persons where person_id=:id";
        $stmt=$this->db->prepare($sql);
        $stmt->bindparam(':id',$id);
        $stmt->execute();
        echo 'delete done';
        return true;
        }
        catch (PDOException $e)
        {
            echo '   usao u catch delete ';
            echo $e->getMessage();
            return false;
        }

    }






}

    






?>