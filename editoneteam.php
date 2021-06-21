<?php 
    $title= 'Edit recors';
    require_once 'includes/header.php';
    require_once 'includes/auth_check.php'; //da li je ta osoba autorizovana da vidi ovo 
    require_once 'db/conn.php';

    $resultsTeams=$teamDB->getTeamsNames(); 

    if(!isset($_GET['id']))
    {
        //echo 'error';
        include 'includes/errormessage.php';
        header("Location: viewallteams.php");
    }
    else
    {
        $id=$_GET['id'];
        $person= $teamDB->getOneTeamDetails($id);
   
?>


    <h1 class="text-center">Edit Team</h1>

   <form method="post" action="editteamPOST.php">
        <input type="hidden" name="team_id" value="<?php echo $person['team_id'] ?>"   />

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" value="<?php echo $person['name'] ?>"  name="name">
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

        <a href="viewallteams.php"  class="btn btn-primary">Back to List </a>
        <button type="change" name="changeTeam" class="btn btn-success">Save changes</button>    
    </form>



<?php  } ?>
<br>
<br>
<br>
<br>
<br>
 
<?php require_once 'includes/footer.php' ?>