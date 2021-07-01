<?php 
//Ovaj koristimo tj u URL se ne vide info 
    $title= 'Success';
    require_once 'includes/header.php';
    require_once 'db/conn.php';


    //checking does variable exist, ie does button exists,  if not then we dont have other necessary info 
    // $crudDB variabla nam je u fajlu db/conn.php' tj na kraju, i to je objekat nase classes crud.php koja ima te fje osnovne insert koje vracaju true/false
    if(isset($_POST['submit'])){
        $fname= $_POST['firstName'];
        $lname= $_POST['lastName'];
        $specialty= $_POST['specialty'];
        $contact= $_POST['phone'];
        $dob= $_POST['dob'];
        $email= $_POST['email'];
        $InputPassword= $_POST['InputPassword'];
        $sex= $_POST['sex'];

        $orig_file= $_FILES["avatar"]["tmp_name"];
        $destinationAvatar=NULL;
        if($orig_file) //ako je uneo fajl
        {
            $extension=pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
            $target_dir='uploads/';
            //$destination= $target_dir . basename($_FILES["avatar"]["name"]); //1 pokusaj, cista slika, ali posto vise osoba moze imati sliku 
            //koja se zove profile.jpg onda cemo ukljuciti njihove email adresse i oni treba da budu jedinstveni i sad ce se skl==like zvati onako kako 
            //je njihova email adressa 
            $destinationAvatar="$target_dir$email.$extension";
            //uzimamo iz nase FILES control(u index.php) koja ima name=avatar uzimamo atribut 'name'
            move_uploaded_file($orig_file,$destinationAvatar);
        }

       

        $availibleUsername=$crudDB->getNumofUsernames($email);
        
        if($availibleUsername == false)
        {

            echo '<div class="alert alert-danger" role="alert">
            Email address is already regristed.
         </div>';
         $issuccess=false;
           
        }
        else 
        {
           
            $issuccess = $crudDB->insertPersonDB($fname, $lname, $dob, $email, $contact, $specialty,$destinationAvatar,$sex);
            $specialtyName=$crudDB->getSpecialtyBySpecialtyId($specialty);      
                
    
            if($issuccess)
            {
                $insertPass=$crudDB->insertPassword($email,$InputPassword);                  
                //include 'includes/successmessage.php';
               echo'
                <div class="alert alert-success" role="alert" id="successmessage" >
                    Operation has been complited. Please Log In. 
                </div>';
                    
            }
            else 
            {
                //echo "<h1 class='text-center text-danger'> There was an error in processing <h1>";
                include 'includes/errormessage.php';
            }

        }
       
        
    }
?>




<br>
<br>
<br>
<br>
<br>
 
<?php require_once 'includes/footer.php' ?>