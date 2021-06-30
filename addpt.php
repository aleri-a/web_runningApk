<?php 
    $title= 'Index';
    require_once 'includes/header.php';
    require_once 'db/conn.php';

    if(!$_GET['id'])
    {
        include 'includes/errormessage.php';        
        header("Location: viewallct.php");
    }
    else
    {
        $idCompetition=$_GET['id'];    
        $ctDetails=$ctDB->getOneCtDetails($idCompetition);
        $teamsParents=$teamDB->getParentTeams();
        
        $regTeamsForCt=$ptDB->getTeamsforCt2($idCompetition);//get all teams registred for that competition (for automatich checking cxb )
        //print_r($teamsParents);
        //$resultTypeCt=$ctDB->getTypeCt();
?>


<h1 class="text-center">Add participants in the competition </h1>
<h2 class="text-center" id="addPt_nameCompetition"> <?php  echo $ctDetails['name'] ;?> </h1>
<div id='addPtDIVispodNaslova'>
<h5 class="text-left" id="addPt_typeCompetition">Type of competition: <?php  echo $ctDetails['typename'] ;?> </h1>
<form method="post" action="addptPOST.php" enctype="multipart/form-data">
<input type="hidden" name="competition_id" id="participationCompetitionID"value="<?php echo $ctDetails['id'] ?>"   />


<!-------------------------------------------------- TAKMICENJE IZMEDJU TIMOVA  -------------------------------------------->
<?php
    if($ctDetails['typect_id']==1) 
    {   
        echo "<div id='addptSamoTimoviCXB'>";   
        foreach( $teamsParents as $tp )
        {      
?>

            <input type="hidden" id="cxbteamsOnlyAll" name="cxbteamsOnlyAll[]"  value="<?php echo $tp['team_id']?>">
            <div class="form-check">
            <input
                class="form-check-input"
                type="checkbox"
                value="<?php echo $tp['team_id']?>"
                name="cxbTeamsOnly[]"
                id="cxbTeamsOnly"
                <?php  
                    if(in_array($tp['team_id'] ,$regTeamsForCt)){
                        echo "checked";
                    }
                ?>
            />
            <label class="form-check-label" for="flexCheckDefault">
                <?php echo $tp['name']?>
            </label>
            </div>
                
<?php

        } //ctDetails=1, endForeach
        echo "</div>";

    }
    // -------------------------------------------------BETWEEN SUBTEAMS-------------------------------------------
    else if($ctDetails['typect_id']==2)
    {
        ?>
        <div class="mb-3">
        <label for="perentTeamOfSubteams" class="form-label">Subteams of the team:</label>
        <select   class="form-control"  id="perentTeamOfSubteams" name="perentTeamOfSubteams" >
            <option label=" "></option>
            <?php foreach( $teamsParents as $tp ) { ?>
                <option value="<?php echo $tp['team_id']?>"><?php echo $tp['name']?></option>  

            <?php }?>          
        </select>

        <div id='chldrenTeamscxb'>
        </div>        
        <!-- 
             inputHidden.setAttribute("type", "hidden");
        inputHidden.setAttribute("name", "cxbSubteamsAll[]");
        inputHidden.setAttribute("id", "cxbSubteamsAll");
        inputHidden.setAttribute("value", ch['team_id']); 
            
            
            
            cxbChild.setAttribute("type", "checkbox");
        cxbChild.setAttribute("class", "form-check-input");
        cxbChild.setAttribute("name", "cxbSubteams[]");
        cxbChild.setAttribute("id", "cxbSubteam");
        cxbChild.setAttribute("value", ch['team_id']); -->
        <script src="competitionBetweenSubteams.js"></script>

    </div>
    <?php   } //end of subteam of one team
    // -----------------------------------------------BETWEEN PEOPLE OF ONE TEAM ------------------------------------------------
    else if($ctDetails['typect_id']==3) 
    {
        ?>
        <div class="mb-3">
        <label for="teamOfPeople" class="form-label">Competition for the people from the team:</label>
        <select   class="form-control"  id="teamOfPeople" name="teamOfPeople" >
            <option label=" "></option>
            <?php foreach( $teamsParents as $tp ) { ?>
                <option value="<?php echo $tp['team_id']?>"><?php echo $tp['name']?></option>  

            <?php }?>          
        </select>


        <div id='peopleDivcxb'>
        </div>        
        <script src="competitionBetweenPeople.js"></script>
<?php
    }


?>
        



   

      
    
  
    <button  name="submitCt" class="btn btn-primary">Save </button>    
 </form>

</div>

<?php } ?>
<br>
<br>
<br>
<br>
<br>
 
<?php require_once 'includes/footer.php' ?>