<?php 
//kod njega: view.php (video Viewing Record Details)
    $title= 'View One team at the time ';
    require_once 'includes/header.php';
    //require_once 'includes/auth_check.php'; //da li je ta osoba autorizovana da vidi ovo, ako ne onda dugme i dalje postoji ali ce ga prebaciti na  stranicu za login
    require_once 'db/conn.php';

    // Get person by id , proveravamo da li je taj parametar setovan tj da li ga ima u URLu
    if(!isset($_GET['teamid']))
    {
       // echo "<h1 class='text-danger'> Please check details and try again  </h1>";
       include 'includes/errormessage.php';
       header("Location: viewallteams.php");
    }
    else
    {        
        $id=$_GET['teamid'];
        
        $result=$teamDB->getOneTeamDetails($id); 
        $childrenTeams=$teamDB->getChildTeams($id);
        
?>


<div class="card" style="width: 18rem;"  >
  <div class="card-body">
    <h5 class="card-title">  
        <?php  echo $result['name'] ;?>
    </h5>

    <?php  //DEO KOJI PRIKAZUJE AKO IMA RODITELJSKI ILI DETE TIM 
        if($result['parentteam_id'] != NULL  || $childrenTeams != NULL)
        {
            if($result['parentteam_id'] != NULL ){
    ?>
        <p class="card-text">
            <!-- Parent team ID: <?php echo $result['parentteam_id']; ?> -->
        </p>
        <p class="card-text">
            Parent team: 
            <br>
                    <a href="viewoneteam.php?teamid=<?php echo $result['parentteam_id']  ?>" class="btn btn-link">
                        <?php echo $result['parentname']; ?>
                    </a>
        </p>

    <?php }  
            if($childrenTeams != NULL){     ?>

                <p class="card-text">
                     Subteams : 
                     <br>
                        <?php foreach( $childrenTeams as $ch ){ ?>
                            <a href="viewoneteam.php?teamid=<?php echo $ch['team_id']  ?>" class="btn btn-link">
                                <?php echo $ch['name']; ?>
                            </a>
                            <br>               
                        <?php } ?>
                        </p>
              
     <?php } }else { ?>
        <p class="card-text">
           Team doesn't have any subteam and doesn't belong to any other team.
        </p>


     <?php }  //KRAJ DELA ZA RODITELJSKI I DETE TIM ?>

    </div>
</div>

    <br>
    

    <!-- JAVNO tj svi i admin i ulogovani -->
    <a href="viewallteams.php"  class="btn btn-primary">Back to List of Teams </a>

    <!-- ADMIN+ULOGOVANI --> 
    <?php if(isset($_SESSION['userid'])){?>                          
    

    <!-- SAMO ADMIN - removing and updating teams -->
    <?php  if($_SESSION['permission']=='admin'){                 ?>                        
    <a href="editoneteam.php?id=<?php echo $result['team_id']  ?>" class="btn btn-warning">Edit  </a>
    <a  onclick="return confirm('Are you sure you want to remove team ? All your data will be lost. ' );"
                            href="deleteoneteam.php?id=<?php echo $result['team_id']  ?>" class="btn btn-danger">Delete team
    </a>
    


    <!-- SAMO ULOGOVANI   -->
    <?php } else if($_SESSION['permission']=='runner' && isset($_SESSION['userid'] )) {?> 
   


    <?php } }?>


<?php } ?>
<br>
<br>
<br>
<br>
<br>
 
<?php require_once 'includes/footer.php' ?>