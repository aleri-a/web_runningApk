<?php 
    $title= 'Add team';
    require_once 'includes/header.php';
    require_once 'db/conn.php';

    $resultsTeams=$teamDB->getTeamsNames();

  
?>


    <h1 class="text-center">Add team</h1>

   <form method="post" action="addteamPOST.php" enctype="multipart/form-data">



        <div class="mb-3">
            <label for="teamName" class="form-label">Team name</label>
            <input required type="text" class="form-control" id="teamName" placeholder="Enter team name " name="teamName" >
        </div>
       
        
        
        <div class="mb-3">
            <label for="specialty" class="form-label">Subteam of the team(Parent Team)</label>
            <select   class="form-control"  id="perentTeam" name="perentTeam" >
                <option label=" "></option>
                <?php while($rs = $resultsTeams->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $rs['team_id']?>"><?php echo $rs['name']?></option>  

                <?php }?>
                

            </select>
        </div>

         
        <button  name="submitTeam" class="btn btn-primary">Submit</button>    
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