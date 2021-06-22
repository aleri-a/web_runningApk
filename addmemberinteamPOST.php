<?php 
//Ovaj koristimo tj u URL se ne vide info 
    $title= 'Success';
    require_once 'includes/header.php';
    require_once 'db/conn.php';


    if(isset($_POST['submitMemberTeam']))
    {
        $person_id= $_POST['person_id'];        
        $id_Team= $_POST['memberofTeam'];  
        
    }
    
        $issuccess = $crudDB->updateTeam($person_id,$id_Team);
        if($issuccess)
        {
            header("Location: viewallpeople.php");
        }    
        else 
            include 'includes/errormessage.php';
    
           
?>

<h1 class="text-center text-success" >

</h1>

<br>
<br>
<br>
<br>
<br>
 
<?php require_once 'includes/footer.php' ?>