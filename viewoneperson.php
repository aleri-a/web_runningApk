<?php 
//kod njega: view.php (video Viewing Record Details)
    $title= 'View One person at the time ';
    require_once 'includes/header.php';
    //require_once 'includes/auth_check.php'; //da li je ta osoba autorizovana da vidi ovo, ako ne onda dugme i dalje postoji ali ce ga prebaciti na  stranicu za login
    require_once 'db/conn.php';

    // Get person by id , proveravamo da li je taj parametar setovan tj da li ga ima u URLu
    if(!isset($_GET['id']))
    {
       // echo "<h1 class='text-danger'> Please check details and try again  </h1>";
       include 'includes/errormessage.php';
       header("Location: viewallpeople.php");
    }
    else
    {        
        $id=$_GET['id'];
        $result=$crudDB->getOnePersonDetails($id); 
        $recordsStatistic=$recordDB->getRecordForPerson($id);
        //echo ("personId $id  ");
       // print_r($recordsStatistic);
        $totalScore=0;
        foreach($recordsStatistic as $rcd)
        {
            $totalScore+=(float)$rcd['score'];
        }
       
 
?>

<br><br>
<img src="<?php echo empty($result['avatar_path']) ? "uploads/defaultProfile.png" :$result['avatar_path']; ?>" class="rounded" style="width: 30%; height: 30%" />
<br><br>
<div class="card" style="width: 30%;">
  <div class="card-body">
    <h5 class="card-title"> 
        <?php  echo $result['firstname'] . ' '. $result['lastname'];?>
    </h5>

    <h6 class="card-subtitle mb-2 text-muted">
    Expiriance: <?php echo $result['name_specialty'];?> 
    </h6>
    <p class="card-text">
       Date of birth: <?php echo $result['dateofbirth']; ?> 
    </p>
    <p class="card-text">
       Sex: <?php echo $result['sex']; ?>
    </p>   
    <p class="card-text">
       Phone: <?php echo $result['contactnumber']; ?>
    </p>

    <p class="card-text">
       Email: <?php echo $result['emailaddress']; ?>
    </p>

    </div>
 </div>  <!----------------------------------------  END FIRST CARD  --------------------------->
<br>
<br>
<br>
 <div class="card" style="width: 100%;">
 <div class="card-header">
    Total score <b><i> <?php echo $totalScore ?></i></b>
  </div>
  <div class="card-body">
    <?php if(!empty($recordsStatistic)) {?>
        <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th scope="col">Competition name</th>
                <th scope="col">Start date</th>                
                <th scope="col">End date</th>
                <th scope="col">Team name </th>
                <th scope="col">Length</th>
                <th scope="col">Nagib</th>
                <th scope="col">Time</th>
                <th scope="col">Score</th>
            </tr>
        </thead>
        <tbody>
            <?php  foreach($recordsStatistic as $rcdSt){  ?> 
                <tr>
                    <th scope="row"><?php echo $rcdSt['id']  ?></th>
                    <td><?php echo $rcdSt['competitionname']  ?></td>
                    <td><?php echo $rcdSt['startdate']  ?></td>
                    <td><?php echo $rcdSt['enddate']  ?></td>
                    <td><?php echo $rcdSt['teamname']  ?></td>
                    <td><?php echo $rcdSt['length']  ?></td>
                    <td><?php echo $rcdSt['nagib']  ?></td>
                    <td><?php echo $rcdSt['hour'].":".$rcdSt['min'].":".$rcdSt['sec']  ?></td>
                    <!-- <td><?php echo $rcdSt['score']  ?></td> -->
                    <td><?php echo number_format((float)$rcdSt['score'], 2, '.', '') ?></td>
                    

                </tr>
            <?php } //end foreach ?>
        </tbody>
        </table>
    <?php } //end if empty?>
  </div>
 </div>  <!----------------------------------------  END SECOND CARD  --------------------------->









    <br>
    <!-- JAVNO tj svi i admin i ulogovani -->
    <a href="viewallpeople.php"  class="btn btn-primary">Back to List </a>

    <!-- ADMIN+ULOGOVANI --> 
    <?php if(isset($_SESSION['userid'])){?>                          
    

    <!-- SAMO ADMIN -->
    <?php  if($_SESSION['permission']=='admin'){                 ?>                        
    <a href="editoneperson.php?id=<?php echo $result['person_id']  ?>" class="btn btn-warning">Edit </a>
    <a  onclick="return confirm('Are you sure you want to delete this record?');"
        href="deleteoneperson.php?id=<?php echo $result['person_id']  ?>" class="btn btn-danger">Delete</a>
    <a href="addmemberinteam.php?id=<?php echo $result['person_id']  ?>?idTeam=<?php echo $result['team_id']  ?>"
        class="btn btn-info">Add/Change team </a>


    <!-- SAMO ULOGOVANI   (tj da moze samo svoj epodatke da menja ) -->
    <?php } else if($_SESSION['permission']=='runner' && $_SESSION['userid']==$result['person_id'] ) {?> 
    <a href="editoneperson.php?id=<?php echo $result['person_id']  ?>" class="btn btn-warning">Edit </a>
    <a href="addmemberinteam.php?id=<?php echo $result['person_id']  ?>?idTeam=<?php echo $result['team_id']  ?>"
        class="btn btn-info">Add/Change team </a>

    <?php } }?>


<?php } ?>
<br>
<br>
<br>
<br>
<br>
 
<?php require_once 'includes/footer.php' ?>