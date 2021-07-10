<?php 
    //kod njega je ovo viewrecords.php
    $title= 'View all registred people';
    require_once 'includes/header.php';
    //require_once 'includes/auth_check.php'; //da li je ta osoba autorizovana da vidi ovo, imam dole na kraju proveru ko moze koje dugmice da vidi 
    require_once 'db/conn.php';

    //$resultsOld=$crudDB->getAllPeopleDB();
    $results=$crudDB->getAllPeopleNew();
?>

    <?php  if(isset($_SESSION['userid']) && $_SESSION['permission']=='admin'){                 ?>
                <a href="signup.php"  class="btn btn-primary">Add new runner </a>
    <?php }else if(!isset($_SESSION['userid'])) { ?>
        <a href="login.php"  class="btn btn-primary">Log in/ Create account </a>
    <?php } ?>

    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>                
                <th scope="col">Expiriance</th>
                <th scope="col">Team</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $counter=0; while($r= $results->fetch(PDO::FETCH_ASSOC))    {  $counter+=1;   ?>
                <tr>
                    <!-- <th scope="row"><?php echo $r['person_id']  ?></th> -->
                    <th><?php echo $counter  ?></th>
                    <td><?php echo $r['firstname']  ?></td>
                    <td><?php echo $r['lastname']  ?></td>                   
                    <td><?php echo $r['specialty'] ?></td>
                    <td><?php echo $r['teamname']  ?></td>       
                    <td>
                        <!-- JAVNO tj svi i admin i ulogovani -->
                        <a href="viewoneperson.php?id=<?php echo $r['person_id']  ?>" class="btn btn-primary">View </a>

                        <!-- ADMIN+ULOGOVANI --> 
                        <?php if(isset($_SESSION['userid'])){?>                          
                        

                        <!-- SAMO ADMIN -->
                        <?php  if($_SESSION['permission']=='admin'){                 ?>
                        <a href="editoneperson.php?id=<?php echo $r['person_id']  ?>" class="btn btn-warning">Edit </a>                        
                        <a href="addmemberinteam.php?id=<?php echo $r['person_id']  ?>?idTeam=<?php echo $r['team_id']  ?>"
                            class="btn btn-info">Add/Change team </a>     
                        <a  onclick="return confirm('Are you sure you want to delete this record?');"
                            href="deleteoneperson.php?id=<?php echo $r['person_id']  ?>" class="btn btn-danger">Delete
                        </a>
                       

                        
                        <!-- SAMO ULOGOVANI i sa svojim IDjom(tj mogu da brisu i menjaju smao svoj nalog)-->
                        <?php } else if($_SESSION['permission']=='runner'   && $_SESSION['userid']==$r['person_id']) {?>
                        <a href="editoneperson.php?id=<?php echo $r['person_id']  ?>" class="btn btn-warning">Edit </a>
                        <a href="addmemberinteam.php?id=<?php echo $r['person_id']  ?>?idTeam=<?php echo $r['team_id']  ?>"
                            class="btn btn-info">Add/Change team </a>
                        <a  onclick="return confirm('Are you sure you want to remove account ? All your data will be lost. ' );"
                            href="deleteoneperson.php?id=<?php echo $r['person_id']  ?>" class="btn btn-danger">Delete account
                        </a>
                        
                        <?php } }?>
                    </td>
                <tr>
            <?php }    ?>
        </tbody>
    
    </table>

<?php
//viewoneperson.php?id= i onda id , na ovaj nacin smo u tu stranicu prosledili id za koji zelimo info
// i onda kad si na toj strani viweoneperson.php gledaj za tu vrednost id, tj mora isto tako da se zove 


/*

                <!-- Ove podatke imamo kad kliknemo na dugme View, ne zaboravi da iz baze uzmes ove info 
                <th scope="col">Mail address</th>
                <th scope="col">Date of Birth</th>
                <th scope="col">Contact Number</th> -->



                 <!-- <td><php echo $r['emailaddress']  ?></td>
                    <td><php echo $r['dateofbirth']  ?></td>
                    <td><php echo $r['contactnumber']  ?></td> -->

*/
?>


<br>
<br>
<br>
<br>
<br>
 
<?php require_once 'includes/footer.php' ?>