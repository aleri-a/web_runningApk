<?php
//create, read, update, delete 

class crud
{
    private $db;

    function __construct($conn)
    {
        $this->db = $conn;
    }

    public function insertPersonDB($fname, $lname, $dob, $email, $contact, $specialty,$avatar_path){
        try {

            $numUsers=$this->getNumofUsernames($email);
            if($numUsers['num']>0) //tj treba da ude samo jedna osoba sa tim usernamom
            {
                return false;
            }
            else
            {
                $sql = "INSERT INTO `persons`(firstname, lastname, dateofbirth, emailaddress, contactnumber, speciality_id,avatar_path) 
                VALUES (:fname,:lname,:dob,:email,:contact,:specialty,:avatar_path)";
                //we need to write on this way because ado it requers in order to dont get sql injectyions ie to dont be possible 
                $stmt = $this->db->prepare($sql);

                $stmt->bindparam(':fname',$fname);
                $stmt->bindparam(':lname',$lname);
                $stmt->bindparam(':dob',$dob);
                $stmt->bindparam(':email',$email);
                $stmt->bindparam(':contact',$contact);
                $stmt->bindparam(':specialty',$specialty);
                $stmt->bindparam(':avatar_path',$avatar_path);

                $stmt->execute();
                return true;
            }

        } 
        catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

    }

    public function insertPassword($username,$password) //$username je ustvari email, ovo je deo inser osobe ali isto i za update 
    {
        try
        {

            $numUsers=$this->getNumofUsernames($username);
            if($numUsers['num']>1) //tj treba da ude samo jedna osoba sa tim usernamom, zato sto smo pre toga ubacili ovu osobu, ovo je samo provera da li ta osob apostoji u bazi, ako ne postoji onda ne mozemo azurirati password
            {
                return false;
            }
            else
            {
                $new_pass=md5($password. $username); //u slucaju da dvoje imaju iste lozinke, md5 je encription ie hashing 
                
                $sql2="update persons set password = :pass where emailaddress= :username";
               // $sql = "UPDATE `persons` SET `password`=':pass' WHERE emailaddress = :username";
                //we need to write on this way because ado it requers in order to dont get sql injectyions ie to dont be possible 
                $stmt = $this->db->prepare($sql2);
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

    
    public function getNumofUsernames($username) //to dont have two users with same username //get Number of people with same usernames
    {
        try
        {
            $sql=  "select count(*) as num from `persons`  where  emailaddress =:username  ";
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






    public function getLogIn($username,$password)
        {
            try
            {               
                $sql2="select * from persons where  emailaddress = :username and password = :password ";
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
                echo '   usao u catch getLogIn u crud.php ';
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