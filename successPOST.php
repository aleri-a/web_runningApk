<?php 
//Ovaj koristimo tj u URL se ne vide info 
    $title= 'Success';
    require_once 'includes/header.php';
    require_once 'db/conn.php';


    //checking does variable exist, ie does button exists,  if not then we dont have other necessary info 
    // $crudDB variabla nam je u fajlu db/conn.php' tj na kraju, i to je objekat nase classes crud.php koja ima te fje osnovne insert koje vracaju true/false
    if(isset($_POST['submit'])){
        $fname= $_POST['firstName'];
        $lname= $_POST['lastName'];
        $specialty= $_POST['specialty'];
        $contact= $_POST['phone'];
        $dob= $_POST['dob'];
        $email= $_POST['email'];
        $InputPassword= $_POST['InputPassword'];

        $orig_file= $_FILES["avatar"]["tmp_name"];
        $extension=pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
        $target_dir='uploads/';
        //$destination= $target_dir . basename($_FILES["avatar"]["name"]); //1 pokusaj, cista slika, ali posto vise osoba moze imati sliku 
        //koja se zove profile.jpg onda cemo ukljuciti njihove email adresse i oni treba da budu jedinstveni i sad ce se skl==like zvati onako kako 
        //je njihova email adressa 
        $destination="$target_dir$email.$extension";
        //uzimamo iz nase FILES control(u index.php) koja ima name=avatar uzimamo atribut 'name'
        move_uploaded_file($orig_file,$destination);

        

        $issuccess = $crudDB->insertPersonDB($fname, $lname, $dob, $email, $contact, $specialty,$destination);
        $specialtyName=$crudDB->getSpecialtyBySpecialtyId($specialty);

        if($issuccess)
        {
            //echo "<h1 class='text-center text-success'> You Have been Registered! <h1>";
            include 'includes/successmessage.php';
        }
        else 
        {
            //echo "<h1 class='text-center text-danger'> There was an error in processing <h1>";
            include 'includes/errormessage.php';
        }
        
    }
?>

<h1 class="text-center text-success" >

</h1>

<img src="<?php echo $destination; ?>" class="rounded-circle" style="width: 20%; height: 20%" />
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"> 
        <?php  echo $_POST['firstName'] . ' '. $_POST['lastName'];?>
    </h5>
    <h6 class="card-subtitle mb-2 text-muted">
    <?php echo $specialtyName['name_specialty'];?>
    </h6>
    <p class="card-text">
       Phone: <?php echo $_POST['phone']; ?>
    </p>

    <p class="card-text">
       Date of birth  <?php echo $_POST['dob']; ?>
    </p>

    <p class="card-text">
       Email: <?php echo $_POST['email']; ?>
    </p>

    <p class="card-text">
         <?php echo $_POST['InputPassword']; ?>
    </p>
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div>



<br>
<br>
<br>
<br>
<br>
 
<?php require_once 'includes/footer.php' ?>