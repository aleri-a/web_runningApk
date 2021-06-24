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
       header("Location: viewallct.php");
    }
    else
    {        
        $id=$_GET['teamid'];
        
        $result=$ctDB->getOneCtDetails($id); 
     
        
?>


<div class="card" style="width: 25rem;"  >
  <div class="card-body">
    <h5 class="card-title">  
        <?php  echo $result['name'] ;?>
    </h5>

    <p class="card-text">
       Start date: <?php echo $result['startdate']; ?>
    </p>

    <p class="card-text">
       End date: <?php echo $result['enddate']; ?>
    </p>

    <p class="card-text">
       Distance: <?php echo $result['distance']; ?>
    </p>

    <p class="card-text">
       Max number of people per team: <?php echo $result['numperteam']; ?>
    </p>

    <p class="card-text">
       Results calculated by : <?php echo $result['numbest']; ?> best in the team
    </p>

   

    
    </div>
</div>

    <br>
    

    <!-- JAVNO tj svi i admin i ulogovani -->
    <a href="viewallct.php"  class="btn btn-primary">Back to List of Competitions </a>
    
    <!-- ADMIN+ULOGOVANI --> 
    <?php if(isset($_SESSION['userid'])){?>                          
    

    <!-- SAMO ADMIN - removing and updating teams -->
    <?php  if($_SESSION['permission']=='admin'){                 ?>   
    <a href="editonect.php?id=<?php echo $result['id']  ?>" class="btn btn-warning">Edit  </a>     
    <a  onclick="return confirm('Are you sure you want to remove competition ? All  data will be lost. ' );"
                            href="deleteonect.php?id=<?php echo $result['id']  ?>" class="btn btn-danger">Delete competition
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