<?php 
//Ovaj koristimo tj u URL se ne vide info 
    $title= 'Add competition';
    require_once 'includes/header.php';
    require_once 'db/conn.php';


    if(isset($_POST['submitCt']))
    {
        $competitionId= $_POST['competition_id'];  
        if(isset($_POST['cxbteamsOnlyAll'])) //only between teams
        {
            
            $teamsOnlyAll=$_POST['cxbteamsOnlyAll'];
            
            foreach($teamsOnlyAll as $teamId)
            {
                $exist=$ptDB->ptExists($competitionId,$teamId,NULL); 
                $checked=false;
                if(isset($_POST['cxbTeamsOnly']))
                {
                    $teamsOnlyChecked=$_POST['cxbTeamsOnly'];
                    $checked=in_array($teamId,$teamsOnlyChecked); ////dobijemo  true ako je checkiran i false ako nije 
                }                    
                if($exist==null)
                {
                    if($checked)
                        $ptDB->insertInPt($competitionId,$teamId,NULL);
                    else continue;
                }   
                else
                {
                    if(!$checked)
                    {
                        $ptDB->deletePt($competitionId,$teamId,NULL); //tj unchkirao je dugme tj predomislio se 
                    }                        
                    else 
                        continue;
                }
            }
              
        }
    
      // -----------------------------------------------------------BETWEEN SUBTEAMS ----------------------------------------------------

      if(isset($_POST['cxbSubteamsAll'])) //only between teams
      {
          
          $subteamsAll=$_POST['cxbSubteamsAll']; //teamsOnlyAll
          //print_r($teamsOnlyAll);
          
          foreach($subteamsAll as $teamId)
          {
              $exist=$ptDB->ptExists($competitionId,$teamId,NULL); 
              $checked=false;             

              if(isset($_POST['cxbSubteams']))
              {
                  $subteamsChecked=$_POST['cxbSubteams'];
                  $checked=in_array($teamId,$subteamsChecked);  
              }  
              if($exist==null)
              {
                  if($checked)
                      $ptDB->insertInPt($competitionId,$teamId,NULL);
                  else continue;
              }   
              else
              {
                  if(!$checked)
                  {
                      $ptDB->deletePt($competitionId,$teamId,NULL); //tj unchkirao je dugme tj predomislio se 
                  }                        
                  else 
                      continue;
              }
          }
            
      }


      // ------------------------------------------------BETWEEN PEOPLE IN THE TEAM ----------------------------------------------------

          if(isset($_POST['peopleAll'])) //only between teams
          {
              $peopleAll=$_POST['peopleAll']; //id svih ljudi 
              $teamIdOfPeople=$_POST['teamOfPeople'];
             
            foreach($peopleAll as $pplId)
            {
                $exist=$ptDB->ptExists($competitionId,$teamIdOfPeople,$pplId); 
                $checked=false;

                if(isset($_POST['cxbPeople']))
                {
                    $cxbPeople=$_POST['cxbPeople']; 
                    $checked=in_array($pplId,$cxbPeople);  
                }
                if($exist==NULL)
                {
                    if($checked)
                       $ptDB->insertInPt($competitionId,$teamIdOfPeople,$pplId);
                    else continue;
                }
                else
                {
                    if(!$checked)
                    {
                        $ptDB->deletePt($competitionId,$teamIdOfPeople,$pplId); //tj unchkirao je dugme tj predomislio se 
                    }                        
                    else 
                        continue;
                }

            }
        }
    }

    header("Location: viewallct.php");

?>
