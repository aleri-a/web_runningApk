<?php 
//Ovaj koristimo tj u URL se ne vide info 
    $title= 'Add record';
    require_once 'includes/header.php';
    require_once 'db/conn.php';

    require 'vendor/autoload.php';
    use phpGPX\phpGPX;


 if(isset($_POST['submitRecord']))
 {           
        $personId=$_SESSION['userid'];
        $participation_id=$_POST['addrecordRdb'];                                                   //selected participation radiobntn
        $gpxFile= $_FILES["gpxfile"]["tmp_name"];

        $length=0;
        $nagib=0;
        $hh=0;
        $mm=0;
        $ss=0;
        echo 'Usao u addrecordPOst';

        if($gpxFile)                                                                                                    //Check if the gpx file is uploaded
        {
            echo'Postoji gpx file';
            $target_dir=dirname(__FILE__).'/';
            $extension=pathinfo($_FILES["gpxfile"]["name"], PATHINFO_EXTENSION);
            $fileName="gpxFile";
            $destination="$target_dir$fileName.$extension";
            echo'  line 31';
            move_uploaded_file($gpxFile,$destination);                                                                  //place the file in current directory with contant name
            echo'  line 33  ';
            $gpx = new phpGPX();	
            echo'  line 35';
            $file = $gpx->load($fileName.'.gpx');
            echo'  line 37';
            $oneLine=[];    
            echo'  line 39';
            //echo ('file: '.$file);
            foreach ($file->tracks as $track)
            {  echo ('line 42,  ');
                foreach ($track->segments as $segment)
                {
                    echo ('u jedan linija ');
                    $oneLine= $segment->stats->toArray();
                   print_r($oneLine);
                    $length=$oneLine['distance']; //in meters
                    $length=$length/1000;         //in km 
                    $nagib=$oneLine['minAltitude']; 
                    $nagibPozitivan=$oneLine['maxAltitude']; 
                    
                    $timeDuration=$oneLine['duration'];                    
                    $mmTotal=intdiv($timeDuration,60);
                    $ss=$timeDuration-(60*$mmTotal);
                    $hh=intdiv($mmTotal,60);
                    $mm=$mmTotal-($hh*60);
                    echo ("time>".$timeDuration. "lenghth ".$length);
                }
            }         
           
        }
        else
        {
           
            if(isset($_POST['length'])&& $_POST['nagib'] && $_POST['hh'] &&  $_POST['mm'] &&  $_POST['ss'])
            {
                $length=$_POST['length'];
                $nagib=$_POST['nagib'];
                $hh=$_POST['hh'];
                $mm=$_POST['mm'];
                $ss=$_POST['ss'];
            }
            else 
            {
               echo " <div class='alert alert-danger'role='alert'>
                        Operation encoutered an error. You didn't enter all necessary information. 
                    </div>";
                exit();
            }
        }
        
        $personDetails=$crudDB->getOnePersonDetailsNew($personId); 
        $sex=$personDetails['sex'];

        $dateOfBirth=$personDetails['dateofbirth'];  
        $from = new DateTime($dateOfBirth);
        $to   = new DateTime('today');
        $age= $from->diff($to)->y;
   
        $ageFactor=$factorDB->getFactor($sex,$age); 
        //echo( $ageFactor[0]);
        $points=CalculatePoints($ageFactor,$sex, $length,$nagib,$hh,$mm,$ss);
        echo "   poeni:$points";
        $issuccess=$recordDB->insertRecord($personId,$participation_id,$points,$hh,$mm,$ss,$length,$nagib) ;
        

        if($issuccess)
        {
            echo "<div class='alert alert-success' role='alert'>
                    Operation has been complited, you added $points points.
                    </div><br>";
                    if($gpxFile)  
                    {
                        myprint_r($oneLine);
                    }
           // header("Location: viewallct.php");                
        }
        else 
        {           
            include 'includes/errormessage.php';
        }
    }

    function myprint_r($my_array) {
        if (is_array($my_array)) {
            echo "<table border=1 cellspacing=0 cellpadding=3 width=100%>";
            echo '<tr><td colspan=2 style="background-color:#0f5132;"><strong><font color=white>Values from .gpx file</font></strong></td></tr>';
            foreach ($my_array as $k => $v) {
                    echo '<tr><td valign="top" style="width:40px;background-color:#d1e7dd;">';
                    echo '<strong>' . $k . "</strong></td><td>";
                    myprint_r($v);
                    echo "</td></tr>";
            }
            echo "</table>";
            return;
        }
        echo $my_array;
    }





   function CalculatePoints($ageFactor,$sex, $length,$nagib,$hh,$mm,$ss)
   {
       echo '             Racuna poene            ';
       echo "    $ageFactor, $sex $length, $nagib . $hh.$mm.$ss";
       $p=0;
        if($sex=='F')
        {
            $length=(float)$length/(float)$ageFactor;
            $length=$length+$length*0.1;
        }
        if($sex=='M')
        {
            $length=(float)$length/(float)$ageFactor;
        }

        $ap=0;
        $an=0;

        $p=pow(40*($length+(1.25*$ap+0.75*$an)/200),3.257)/(2*pow(3600*$hh+60*$mm+$ss,2.137));



        
        $p=number_format((float)$p, 2, '.', ''); //zaokruziti br na dve decimale 

        echo '            izracunao  poene            '.$p;
        return $p;
       
   }
?>




<br>
<br>
<br>
<br>
<br>
 
<?php require_once 'includes/footer.php' ?>