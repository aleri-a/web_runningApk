<?php 
    $title= 'View all teams';
    require_once 'includes/header.php';
    //require_once 'includes/auth_check.php'; 
    require_once 'db/conn.php';

    $results=$teamDB->getAllTeams();

?>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th scope="col"> Name</th>
                <!-- <th scope="col"> Parent team ID</th> -->
                <th scope="col"> Parent team name</th>
                <th scope="col"> Score</th>
                <th scope="col">Actions</th>
               
            </tr>
        </thead>
        <tbody>

        

        <?php  if(isset($_SESSION['userid']) && $_SESSION['permission']=='admin'){                 ?>
            <a href="addteam.php"  class="btn btn-primary">Add new team </a>
            <?php } ?>

            <br><br>

            
            <?php $counter=0; while($r= $results->fetch(PDO::FETCH_ASSOC))    { $counter+=1;    ?>
                <tr>
                    <!-- <th scope="row"><?php echo $r['team_id']  ?></th> -->
                    <th><?php echo $counter  ?></th>
                    <td><?php echo $r['name']  ?></td>                                      
                    <!-- <td><?php echo $r['parentteam_id']  ?></td> -->
                    <td><?php echo $r['parentname']  ?></td>
                    <td><?php 
                        $childTeams=$teamDB->getChildTeams($r['team_id']);
                        $recordsStatistic=$recordDB->getRecordForTeam($childTeams,$r['team_id']);
                       // echo"  child teams  ";
                       // print_r($childTeams);
                       // echo "   records   ";
                       // print_r($recordsStatistic);
   
                        $totalScore=0;
                        foreach($recordsStatistic as $rcd)
                        {
                            $totalScore+=(float)$rcd['score'];
                        }
                        echo $totalScore;
                    
                    
                    ?></td>
                    <td>
                        <!-- JAVNO tj svi i admin i ulogovani -->
                        <a href="viewoneteam.php?teamid=<?php echo $r['team_id']  ?>" class="btn btn-primary">View </a>
                       


                        <!-- ADMIN+ULOGOVANI --> 
                        <?php if(isset($_SESSION['userid'])){?>                          
                        

                        <!-- SAMO ADMIN -->
                        <?php  if($_SESSION['permission']=='admin'){                 ?>
                        <a href="editoneteam.php?id=<?php echo $r['team_id']  ?>" class="btn btn-warning">Edit </a>
                        <a  onclick="return confirm('Are you sure you want to remove team ? All your data will be lost. ' );"
                            href="deleteoneteam.php?id=<?php echo $r['team_id']  ?>" class="btn btn-danger">Delete team
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