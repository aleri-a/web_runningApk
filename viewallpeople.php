<?php 
    //kod njega je ovo viewrecords.php
    $title= 'View all registred people';
    require_once 'includes/header.php';
    require_once 'db/conn.php';

    $results=$crud->getAllPeopleDB();
?>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>                
                <th scope="col">Specilty</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php  while($r= $results->fetch(PDO::FETCH_ASSOC))    {     ?>
                <tr>
                    <th scope="row"><?php echo $r['person_id']  ?></th>
                    <td><?php echo $r['firstname']  ?></td>
                    <td><?php echo $r['lastname']  ?></td>                   
                    <td><?php echo $r['name_specialty']  ?></td>
                    <td>
                        <a href="viewoneperson.php?id=<?php echo $r['person_id']  ?>" class="btn btn-primary">View </a>
                        <a href="editoneperson.php?id=<?php echo $r['person_id']  ?>" class="btn btn-warning">Edit </a>
                        <a  onclick="return confirm('Are you sure you want to delete this record?');"
                            href="deleteoneperson.php?id=<?php echo $r['person_id']  ?>" class="btn btn-danger">Delete
                        </a>
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