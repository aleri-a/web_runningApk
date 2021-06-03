<?php 
    $title= 'Edit recors';
    require_once 'includes/header.php';
    require_once 'db/conn.php';

    $resultsSpecialties=$crud->getSpecialties();

    if(!isset($_GET['id']))
    {
        //echo 'error';
        include 'includes/errormessage.php';
        header("Location: viewallpeople.php");
    }
    else
    {
        $id=$_GET['id'];
        $person= $crud->getOnePersonDetails($id);
      //  echo "<h1>".$person['specialty_id'] ."</h1>";
    //} na kraju fajla, da ukoliko je usao u prvo if da ne ispisuje korisniku ove html elemente 

   
?>


    <h1 class="text-center">Edit Person</h1>

   <form method="post" action="editpersonPOST.php">
        <input type="hidden" name="person_idd" value="<?php echo $person['person_id'] ?>"   />
        <div class="mb-3">
            <label for="firstName" class="form-label">First name</label>
            <input type="text" class="form-control" id="firstName" value="<?php echo $person['firstname'] ?>"  name="firstName">
        </div>
        <div class="mb-3">
            <label for="lastName" class="form-label">last name</label>
            <input type="text" class="form-control" id="lastName" value="<?php echo $person['lastname'] ?>"  name="lastName">
        </div>
        <div class="mb-3">
            <label for="dob" class="form-label">Date of birth</label>
            <input type="text" class="form-control" id="dob"  value="<?php echo $person['dateofbirth'] ?>" name="dob" >
        </div>
        <div class="mb-3">
            <label for="specialty" class="form-label">Area of experties</label>
            <select class="form-select" aria-label="Default select example" id="specialty" name="specialty" >
               
                <?php while($rs = $resultsSpecialties->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option  value="<?php echo $rs['specialty_id']?>" <?php if($rs['specialty_id'] == $person['specialty_id']) echo 'selected' ?>>
                         <?php echo $rs['name_specialty']; ?>
                    </option>  

                <?php }?>

            </select>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone number</label>
            <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phoneHelp" value="<?php echo $person['contactnumber'] ?>" >
            <div id="phoneHelp" class="form-text">We'll never share your number with anyone else.</div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp"  value="<?php echo $person['emailaddress'] ?>"  name="email">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>


    <!--    <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
    -->
        <a href="viewallpeople.php"  class="btn btn-primary">Back to List </a>
        <button type="change" name="change" class="btn btn-success">Save changes</button>    
    </form>



<?php  } ?>
<br>
<br>
<br>
<br>
<br>
 
<?php require_once 'includes/footer.php' ?>