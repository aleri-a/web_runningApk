<?php 
    $title= 'Add team';
    require_once 'includes/header.php';
    require_once 'db/conn.php';

    $resultsTeams=$teamDB->getTeamsNames();


    
    if(!isset($_GET['id']) )
    {
        //echo 'error';
        include 'includes/errormessage.php';
        header("Location: viewallpeople.php");
    }
    else
    {
        $idPerson=$_GET['id'];
        $personDetails=$crudDB->getOnePersonDetailsNew($idPerson); 
        if(!isset($_GET['idTeam']))
            $idTeam=NULL;
        else
            $idTeam=$_GET['idTeam'];
       // $person= $crudDB->getOnePersonDetails($id);
       $allTeams=$teamDB->getTeamsNames(); 
  
?>


    <h1 class="text-center">Add  <?php  echo $personDetails['firstname'] . ' '. $personDetails['lastname'];?> in team</h1>

   <form method="post" action="addmemberinteamPOST.php" enctype="multipart/form-data">
   <input type="hidden" name="person_id" value="<?php echo $personDetails['person_id'] ?>"   />



        <div class="mb-3">            
            <h5 class="card-title"> 
                <?php  echo $personDetails['firstname'] . ' '. $personDetails['lastname'];?>
            </h5>
        </div>
       
        
        
        <div class="mb-3">
            <label for="specialty" class="form-label">Member of team</label>
            <select   class="form-control"  id="memberofTeam" name="memberofTeam" >
                <option label=" "></option>
                <?php while($rs = $allTeams->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $rs['team_id']?>" <?php if($rs['team_id'] == $personDetails['team_id']) echo 'selected'?>>
                    <?php echo $rs['name']?></option>  
                <?php }?>
                

            </select>
        </div>

         
        <button  name="submitMemberTeam" class="btn btn-primary">Submit</button>    
    </form>

<?php } ?>

<!--Kad kliknemo Submit btn -> u success.php i preko POST cemo tamo uzeti te submited podatke
-> 
insert  taj conn.php -> uspostavljamo konekciju i tamo na kraju imamo pbjekat crud preko koga priztupamo fjama iz fajla crud.php  -->
<br>
<br>
<br>
<br>
<br>
 
<?php require_once 'includes/footer.php' ?>