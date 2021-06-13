<?php 
    $title= 'Index';
    require_once 'includes/header.php';
    require_once 'db/conn.php';

    $resultsSpecialties=$crudDB->getSpecialties();
?>


    <h1 class="text-center">Registration for Running App</h1>

   <!-- <form method="get" action="successGET.php"> -->
   <form method="post" action="successPOST.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="firstName" class="form-label">First name</label>
            <input required type="text" class="form-control" id="firstName" placeholder="Enter First name " name="firstName">
        </div>
        <div class="mb-3">
            <label for="lastName" class="form-label">last name</label>
            <input required type="text" class="form-control" id="lastName" placeholder="Enter Last name " name="lastName">
        </div>
        <div class="mb-3">
            <label for="dob" class="form-label">Date of birth</label>
            <input required type="text" class="form-control" id="dob" name="dob" >
        </div>
        <div class="mb-3">
            <label for="specialty" class="form-label">Area of experties</label>
            <select   class="form-control"  id="specialty" name="specialty" required>
                <option label=" "></option>
                <?php while($rs = $resultsSpecialties->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $rs['specialty_id']?>"><?php echo $rs['name_specialty']?></option>  

                <?php }?>

            </select>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone number</label>
            <input required type="text" class="form-control" id="phone" name="phone" aria-describedby="phoneHelp">
            <div id="phoneHelp" class="form-text">We'll never share your number with anyone else.</div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input required type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="InputPassword" name="InputPassword">
        </div>


        </br>
        <div class="custom-file">
            <input type="file" accept="image/*" class="custom-file-input" id="avatar"  name="avatar">        
            <label class="custom-file-label" for="avatar"></label>                
            <div id="avatar" class="form-text text-danger">File Upload is Optional</div>

        </div>
        </br>


         
       
    <!--    <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
    -->
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>    
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