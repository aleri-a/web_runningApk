<?php 
//kod njega: view.php (video Viewing Record Details)
    $title= 'View One person at the time ';
    require_once 'includes/header.php';
    require_once 'includes/auth_check.php'; //da li je ta osoba autorizovana da vidi ovo, ako ne onda dugme i dalje postoji ali ce ga prebaciti na  stranicu za login
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
        //pristup crud imamo iz db/conn.php, na kraju tog dajla smo definisali $crud
        // $resut sada ima sve vrednosti iz baze tj to je array sa vrednostima 
        //dole uzimas parametre iz baze 
 // }   Ovu zagradu zatvaramo skroz dole, u suprutnom bi ukoliko je usao u prvo if ispisace poruku korisniku, i onda ce da mu iprikaze gde su greske 


?>

<img src="<?php echo empty($result['avatar_path']) ? "uploads/defaultProfile.png" :$result['avatar_path']; ?>" class="rounded-circle" style="width: 20%; height: 20%" />

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"> 
        <?php  echo $result['firstname'] . ' '. $result['lastname'];?>
    </h5>
    <h6 class="card-subtitle mb-2 text-muted">
    <?php echo $result['name_specialty'];?> 
    </h6>
    <p class="card-text">
       Phone: <?php echo $result['contactnumber']; ?>
    </p>

    <p class="card-text">
       Date of birth  <?php echo $result['dateofbirth']; ?>
    </p>

    <p class="card-text">
       Email: <?php echo $result['emailaddress']; ?>
    </p>

<!--   
    <a href="#" class="card-link">Card link</a> 
    <a href="#" class="card-link">Another link</a> -->

    </div>
</div>

    <br>
    <a href="viewallpeople.php"  class="btn btn-primary">Back to List </a>
    <a href="editoneperson.php?id=<?php echo $result['person_id']  ?>" class="btn btn-warning">Edit </a>
    <a  onclick="return confirm('Are you sure you want to delete this record?');"
        href="deleteoneperson.php?id=<?php echo $result['person_id']  ?>" class="btn btn-danger">Delete</a>



<?php } ?>
<br>
<br>
<br>
<br>
<br>
 
<?php require_once 'includes/footer.php' ?>