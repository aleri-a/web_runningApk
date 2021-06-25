<?php 
    $title= 'Index';
    require_once 'includes/header.php';
    require_once 'db/conn.php';

    $resultTypeCt=$ctDB->getTypeCt();
?>


    <h1 class="text-center">Registration for Running App</h1>

   <!-- <form method="get" action="successGET.php"> -->
   <form method="post" action="addctPOST.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="competitionName" class="form-label">Name of competition</label>
            <input required type="text" class="form-control" id="competitionName" placeholder="Enter name of competition " name="competitionName">
        </div>
        
        <div class="mb-3">
            <label for="startDt" class="form-label">Start date </label>
            <input required type="text" class="form-control" id="startDt" name="startDt" >
        </div>

        <div class="mb-3">
            <label for="endDt" class="form-label">End date </label>
            <input required type="text" class="form-control" id="endDt" name="endDt" >
        </div>


        <div class="mb-3">
            <label for="distance" class="form-label">Distance in meters</label>
            <input required type="number" class="form-control" id="distance"  name="distance" min="1">
        </div>

        
        <div class="mb-3">
            <label for="numPeopleTeam" class="form-label">Number of people in the team</label>
            <input required type="number" class="form-control" id="numPeopleTeam"  name="numPeopleTeam" min="1">
        </div>

           
        <div class="mb-3">
            <label for="numBest" class="form-label">Result calculate based on best</label>
            <input required type="number" class="form-control" id="numBest"  name="numBest" min="1">
        </div>

        <div class="mb-3">
            <label for="typect" class="form-label">Type of competition</label>
            <select   class="form-control"  id="typect" name="typect" required>
                <option label=" "></option>
                <?php while($rs = $resultTypeCt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $rs['id']?>"><?php echo $rs['type_name']?></option>  

                <?php }?>

            </select>
        </div>





        <br>
        <br>
        <button type="submitCt" name="submitCt" class="btn btn-primary">Submit</button>    
    </form>



<!--Kad kliknemo Submit btn -> u success.php i preko POST cemo tamo uzeti te submited podatke
-> 
insert  taj conn.php -> uspostavljamo konekciju i tamo na kraju imamo pbjekat crud preko koga priztupamo fjama iz fajla crud.php  -->
<br>
<br>
<br>
<br>
<br>
 
<?php require_once 'includes/footer.php' ?>