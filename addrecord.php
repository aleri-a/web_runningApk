<?php 
    $title= 'Add team';
    require_once 'includes/header.php';
    require_once 'db/conn.php';

  //  $resultsTeams=$teamDB->getTeamsNames();
    $personId=$_SESSION['userid'];
    //participation za competition koje se zavrsilo i nije proslo vise od 10 dana 
    $person=$crudDB->getOnePersonDetails($personId);
    $parentTeams=$teamDB->getAncestorsTeamsOfTeam(57); //$person['team_id']
    //$childrenTeams=$teamDB->getChildrenAndGranchildren()
    $strParentTeams='';
   
    for($i=0;$i<count($parentTeams );$i++)
    {   $pt=$parentTeams[$i];              
        $strParentTeams.=$pt;
        if($i<count($parentTeams )-1)
            $strParentTeams.=',';
    }
        
    $participations=$ptDB->getPtforMoreTeams($strParentTeams);
    $individualParticipation=$ptDB->getIndividualParticipation($personId);
   // print_r($individualParticipation);


    //print_r($participations);
    
//SELECT pt.*,prsn.firstname,prsn.person_id FROM `participation` pt left JOIN persons prsn on pt.team_id=prsn.team_id where pt.person_id is null and pt.team_id in (57,55,53,47)
  
?>
<!--------------------------------------------------------  GETING DATA FROM   -------------------------------------------->
<?php


?>


<!-------------------------------------------------------- FORMA FOR INSERT DATA  -------------------------------------------->




    <h1 class="text-center">Insert record</h1>

   <form method="post" action="addrecordPOST.php" enctype="multipart/form-data">

    <div id='radioBtnsaddrecordmy'>
    <p> <h5>Select for participation in which competition you are entering recorods </h5>
            <?php if(!empty($participations)) {?>
            <?php  foreach($participations as $ptt){  ?>            
                <div class="form-check">
                <input class="form-check-input" type="radio" name="addrecordRdb" id="addrecordRdb" value=<?php echo $ptt['id'] ?>>
            
                    <div class="card" style="width: 40%">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo  $ptt['competitionname'] ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">Team competition</h6>
                        <p class="card-text">
                            <label>Start date: <?php echo  $ptt['startdate'] ?> </label><br>
                            <label>End date: <?php echo  $ptt['enddate'] ?></label>
                        </p>
                        <p class="card-text">You are participating as part of <b><i><?php echo  $ptt['teamname'] ?> </i></b>team </p>
                        
                    </div>
                    </div>
                </label>
                </div>
            <?php
            } 
        } //endif empty(array)
            ?>
     <?php if(!empty($individualParticipation)) {?>
        <?php  foreach($individualParticipation as $indv){  ?>            
            <div class="form-check" >
            <input required class="form-check-input" type="radio" name="addrecordRdb" id="addrecordRdb" value=<?php echo $indv['id'] ?>>
           
                <div class="card" style="width: 50%" >
                <div class="card-body">
                    <h5 class="card-title"><?php echo  $indv['competitionname'] ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Individual competition</h6>
                    <p class="card-text">
                        <label>Start date: <?php echo  $indv['startdate'] ?> </label><br>
                        <label>End date: <?php echo  $indv['enddate'] ?></label>
                    </p>
                    <p class="card-text">You are registred as part of <b><i><?php echo  $indv['teamname'] ?> </i></b>team </p>
                    
                </div>
                </div>
            </label>
            </div>
        <?php
        } 
    } //end if empty (inividualParticipation)
        ?>
        </p>
        </div> <!--id='radioBtnsaddrecordmy' -->
          
<!---------------------------------------------FORMA ZA UNOS RECORDA ------------------------------------------ -->
        <br><br>    
        <p> <h5>Insert data  </h5>
            <br>


        <!--<label  class="form-label" > Insert the values from .gpx file </label> 
         <div class="custom-file">
            <input type="file" accept=".gpx" class="custom-file-input" id="avatar"  name="avatar">        
            <label class="custom-file-label" for="avatar"></label>                
             <div id="avatar" class="form-text text-danger"></div>
        </div> -->

        <div class="mb-3">
            <label for="gpxfile" class="form-label"> Insert the values from .gpx file</label>
            <input class="form-control" type="file" name='gpxfile' id="gpxfile"  accept=".gpx">
        </div>
        
        <br>
        <br>
        <div id='recordDetails'>


            <div class="mb-3">
                <label for="length" class="form-label">Length of the track in km</label>
                <input  type="number" class="form-control" id="length"  name="length" step="0.001">
            </div>

            <div class="mb-3">
                <label for="nagib" class="form-label">the slope of the track in meters</label>
                <input  type="number" class="form-control" id="nagib"  name="nagib" step="0.001" >
            </div>

            <label  class="form-label"> Time for passing track </label>
            <div id='time_addrecord' class="form-inline">       
               
                    <div class="form-group" id="hh">
                        <input  type="number" class="form-control"   placeholder="HH" name="hh">
                    </div>
                    <div class="form-group" id='lblDveTacke'>   
                        <label  class="form-label" > : </label>  
                    </div>
                    <div class="form-group" id="mm" >   
                        <input  type="number" class="form-control"  placeholder="MM" name="mm">   
                    </div>
                    <div class="form-group" id='lblDveTacke'>   
                        <label  class="form-label" > : </label>  
                    </div>
                    <div class="form-group" id="ss">   
                        <input  type="number" class="form-control"   placeholder="SS" name="ss" step="0.001">   
                    </div>
                
            </div> <!--id=time_addrecord -->
        </div> <!--id=recorddetails -->
         






        <button  name="submitRecord" class="btn btn-primary">Submit</button>    
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