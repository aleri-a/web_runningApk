<?php 
    $title= 'Edit recors';
    require_once 'includes/header.php';
    require_once 'includes/auth_check.php'; //da li je ta osoba autorizovana da vidi ovo 
    require_once 'db/conn.php';

    $resultTypeCt=$ctDB->getTypeCt();
    
    if(!isset($_GET['id']))
    {
        //echo 'error';
        include 'includes/errormessage.php';
        header("Location: viewallct.php");
    }
    else
    {
        $id=$_GET['id'];
        $ct= $ctDB->getOneCtDetails($id);
   
?>



    <h1 class="text-center">Edit Competition</h1>

   <form method="post" action="editctPOST.php">
        <input type="hidden" name="ct_id" value="<?php echo $ct['id'] ?>"   />

        <div class="mb-3">
            <label for="competitionName" class="form-label">Name of competition</label>
            <input required type="text" class="form-control" id="competitionName" value="<?php echo $ct['name'] ?>" name="competitionName">
        </div>
        
        <div class="mb-3">
            <label for="startDt" class="form-label">Start date </label>
            <input required type="text" class="form-control" id="startDt"  value="<?php echo $ct['startdate'] ?>" name="startDt" >
        </div>

        <div class="mb-3">
            <label for="endDt" class="form-label">End date </label>
            <input required type="text" class="form-control" id="endDt"  value="<?php echo $ct['enddate'] ?>" name="endDt" >
        </div>


        <div class="mb-3">
            <label for="distance" class="form-label">Distance in meters</label>
            <input required type="number" class="form-control" id="distance"  value="<?php echo $ct['distance'] ?>" name="distance">
        </div>

        
        <div class="mb-3">
            <label for="numPeopleTeam" class="form-label">Number of people in the team</label>
            <input required type="number" class="form-control" id="numPeopleTeam"  value="<?php echo $ct['numperteam'] ?>" name="numPeopleTeam" min="1">
        </div>

           
        <div class="mb-3">
            <label for="numBest" class="form-label">Result calculate based on best</label>
            <input required type="number" class="form-control" id="numBest"  value="<?php echo $ct['numbest'] ?>" name="numBest" min="1">
        </div>

        
        <div class="mb-3">
            <label for="typect" class="form-label">Type of competition</label>
            <select   class="form-control"  id="typect" name="typect" required>
                <option label=" "></option>
                <?php while($rs = $resultTypeCt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option  value="<?php echo $rs['id']?>" <?php if($rs['id'] == $ct['typect_id']) echo 'selected' ?>>
                         <?php echo $rs['type_name']; ?>
                    </option>  
                <?php }?>

            </select>
        </div>







        <a href="viewallct.php"  class="btn btn-primary">Back to List </a>
        <button type="change" name="changeCt" class="btn btn-success">Save changes</button>    
    </form>



<?php  } ?>
<br>
<br>
<br>
<br>
<br>
 
<?php require_once 'includes/footer.php' ?>