<?php 
    $title= 'View all competitions';
    require_once 'includes/header.php';
    //require_once 'includes/auth_check.php'; 
    require_once 'db/conn.php';

    $results=$ctDB->getAllCt();
?>


            <?php  if(isset($_SESSION['userid']) && $_SESSION['permission']=='admin'){                 ?>
                <a href="addct.php"  class="btn btn-primary">Add new competition </a>
            <?php } ?>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th scope="col"> Name</th>
                <th scope="col"> Start date</th>
                <th scope="col"> End date </th>
                <th scope="col"> distance</th>
                <!-- <th scope="col"> Max number of people per team</th>
                <th scope="col">Result calculated by the x best</th> -->
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>

           
            <?php  while($r= $results->fetch(PDO::FETCH_ASSOC))    {     ?>
                <tr>
                    <th scope="row"><?php echo $r['id']  ?></th>
                    <td><?php echo $r['name']  ?></td>                                      
                    <td><?php echo $r['startdate']  ?></td>
                    <td><?php echo $r['enddate']  ?></td>
                    <td><?php echo $r['distance']  ?></td>
                    <!-- <td><?php echo $r['numperteam']  ?></td>
                    <td><?php echo $r['numbest']  ?></td>
                     -->
                   
                    <td>
                        <!-- JAVNO tj svi i admin i ulogovani -->
                        <a href="viewonect.php?teamid=<?php echo $r['id']  ?>" class="btn btn-primary">View </a>
                       


                        <!-- ADMIN+ULOGOVANI --> 
                        <?php if(isset($_SESSION['userid'])){?>                          
                        

                        <!-- SAMO ADMIN -->
                        <?php  if($_SESSION['permission']=='admin'){                 ?>
                        <a href="editonect.php?id=<?php echo $r['id']  ?>" class="btn btn-warning">Edit </a>
                        <a  onclick="return confirm('Are you sure you want to remove competition ? All  data will be lost. ' );"
                            href="deleteonect.php?id=<?php echo $r['id']  ?>" class="btn btn-danger">Delete team
                        </a>
                        
                        
                        
                        <!-- SAMO ULOGOVANI i sa svojim IDjom(tj mogu da brisu i menjaju smao svoj nalog)-->
                        <?php } else if($_SESSION['permission']=='runner'   && $_SESSION['userid']) {?>
                        
                       



                        <?php } }?>
                    </td>
                <tr>
            <?php }    ?>
        </tbody>
    
    </table>

<?php

?>


<br>
<br>
<br>
<br>
<br>
 
<?php require_once 'includes/footer.php' ?>