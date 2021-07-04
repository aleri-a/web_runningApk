<?php 
//Ovaj koristimo tj u URL se ne vide info 
    $title= 'Add competition';
    require_once 'includes/header.php';
    require_once 'db/conn.php';


 if(isset($_POST['submitRecord'])){
    
        
        $personId=$_SESSION['userid'];
        $participation_id=$_POST['addrecordRdb']; //selected participation radiobntn
        $length=$_POST['length'];
        $nagib=$_POST['nagib'];
        $hh=$_POST['hh'];
        $mm=$_POST['mm'];
        $ss=$_POST['ss'];
       
        $personDetails=$crudDB->getOnePersonDetailsNew($personId); 
        $sex=$personDetails['sex'];

        $dateOfBirth=$personDetails['dateofbirth'];  
        $from = new DateTime($dateOfBirth);
        $to   = new DateTime('today');
        $age= $from->diff($to)->y;
   
        $ageFactor=$factorDB->getFactor($sex,$age); 
        //echo( $ageFactor[0]);
        $points=CalculatePoints($ageFactor,$sex, $length,$nagib,$hh,$mm,$ss);
        
        $issuccess=$recordDB->insertRecord($personId,$participation_id,$points,$hh,$mm,$ss,$length,$nagib) ;
        

        if($issuccess)
        {
            echo "<div class='alert alert-success' role='alert'>
                    Operation has been complited, you added $points points.
                    </div>";
           // header("Location: viewallct.php");                
        }
        else 
        {           
           // include 'includes/errormessage.php';
        }
    }





   function CalculatePoints($ageFactor,$sex, $length,$nagib,$hh,$mm,$ss)
   {
        echo "$ss, $mm, $hh";
        if($sex=='F')
        {
            $length=(float)$length/(float)$ageFactor;
            $length=$length+$length*0.1;
        }
        if($sex=='M')
        {
            $length=$length/$ageFactor;
        }

        $ap=0;
        $an=0;


        $p=pow(40*($length+(1.25*$ap+0.75*$an)/200),3.257)/(2*pow(3600*$hh+60*$mm+$ss,2.137));
        //$p=number_format((float)$p, 2, '.', ''); //zaokruziti br na dve decimale 
        return $p;
       
   }
?>




<br>
<br>
<br>
<br>
<br>
 
<?php require_once 'includes/footer.php' ?>