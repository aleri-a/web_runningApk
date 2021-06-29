<?php 
//Ovaj koristimo tj u URL se ne vide info 
    $title= 'Add competition';
    require_once 'includes/header.php';
    require_once 'db/conn.php';


    if(isset($_POST['submitCt']))
    {
        $competitionId= $_POST['competition_id'];  
        if(isset($_POST['cxbTeamsOnly'])) //only between teams
        {
            $teamsOnlyChecked=$_POST['cxbTeamsOnly'];
            $teamsOnlyAll=$_POST['cxbteamsOnlyAll'];
            //print_r($teamsOnlyAll);
            
            foreach($teamsOnlyAll as $teamId)
            {
                $exist=$ptDB->ptExists($competitionId,$teamId); 
                $checked=in_array($teamId,$teamsOnlyChecked);//dobijemo  true ako je checkiran i false ako nije 
                if($exist==null)
                {
                    if($checked)
                        $ptDB->insertInPt($competitionId,$teamId);
                    else continue;
                }   
                else
                {
                    echo 'kaze da taj objekat postoi DB';
                    echo 'checked: '.$checked;
                    if(!$checked)
                    {
                        echo 'usao da deletuje';
                        $ptDB->deletePt($competitionId,$teamId); //tj unchkirao je dugme tj predomislio se 
                    }                        
                    else 
                        continue;
                }
            }
              
        }
    
      // -----------------------------------------------------------BETWEEN SUBTEAMS ----------------------------------------------------

      if(isset($_POST['cxbSubteams'])) //only between teams
      {
          $subteamsChecked=$_POST['cxbSubteams']; //teamsOnlyChecked
          $subteamsAll=$_POST['cxbSubteamsAll']; //teamsOnlyAll
          //print_r($teamsOnlyAll);
          
          foreach($subteamsAll as $teamId)
          {
              $exist=$ptDB->ptExists($competitionId,$teamId); 
              $checked=in_array($teamId,$subteamsChecked);//dobijemo  true ako je checkiran i false ako nije 
              if($exist==null)
              {
                  if($checked)
                      $ptDB->insertInPt($competitionId,$teamId);
                  else continue;
              }   
              else
              {
                  echo 'kaze da  objekat postoi DB, id teama: '.$teamId;
                  echo 'checked: '.$checked;
                  if(!$checked)
                  {
                      echo 'usao da deletuje';
                      $ptDB->deletePt($competitionId,$teamId); //tj unchkirao je dugme tj predomislio se 
                  }                        
                  else 
                      continue;
              }
          }
            
      }









    }

?>
