<?php 
//Ovaj koristimo tj u URL se ne vide info 
    $title= 'Success';
    require_once 'includes/header.php';
    require_once 'db/conn.php';


    if(isset($_POST['submitTeam']))
    {
        $teamName= $_POST['teamName'];        
        $parentTeam= $_POST['perentTeam'];  
        
    }
    $canGo=$teamDB->getNumofTeams($teamName);
    

    if($canGo['num']==0)
    {
        $issuccess = $teamDB->insertTeam( $teamName,$parentTeam);
        if($issuccess)
        {
            header("Location: viewallteams.php");
        }
    }
    else 
    echo "<div class='alert alert-danger' role='alert'>
    Plese choose another name for the team, team with that name already existe .
 </div>";

    
           
?>

<h1 class="text-center text-success" >

</h1>

<br>
<br>
<br>
<br>
<br>
 
<?php require_once 'includes/footer.php' ?>