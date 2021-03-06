<?php 
    $title= 'User Login';
    require_once 'includes/header.php';
    require_once 'db/conn.php';

    //If data was submittes via a form POST requst, <then ... 
    if($_SERVER['REQUEST_METHOD']== 'POST')
    {
        $username=strtolower(trim($_POST['username']));
        $password=$_POST['password'];
        $new_password=md5($password.$username);

       $resultAdmin= $userDB->getUser($username,$new_password);
       if(!$resultAdmin) //deo za trkace
       {
           $resultRunner=$crudDB->getLogIn($username,$new_password);
           if( !$resultRunner)
           {
                echo '<div class="alert alert-danger"> Username or Password is incorrect! Please try again </div>';
           }
           else
           {
               
                $_SESSION['username']=$username;
                $_SESSION['userid']=$resultRunner['person_id'];
                $_SESSION['permission']='runner';
                echo "U delu za trkace u login.php";
                $runnerID=$resultRunner['person_id'];;
                header("Location: viewoneperson.php?id=$runnerID");
           }
           
       }
       else //deo za admine
       {
           $_SESSION['username']=$username;
           $_SESSION['userid']=$resultAdmin['id'];
           $_SESSION['permission']='admin';
           header("Location: viewallpeople.php");
       }
    }
?>

<h1 class="text-center"><?php echo $title ?> </h1>
    <br><br><br>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);  ?>" method="post">
        <!-- <table class="table table-sm">
            <tr>
                <td><label for= "username">Username: * </label></td>
                <td><input type="text" name="username" class="form-control" id="username" value="<?php if($_SERVER['REQUEST_METHOD']== 'POST') echo $_POST['username'];  ?>">
                </td>
            </tr>
            <tr> 
                <td><label for="password">Password: *</label></td>
                <td><input type="password" name="password" class="form-control" id="password">
                </td>
            </tr>
        </table><br/><br/> -->



        <div class="form-group">
            <label for="username">Email address</label>
            <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username" value="<?php if($_SERVER['REQUEST_METHOD']== 'POST') echo $_POST['username'];  ?>">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <br>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password"  name="password">
        </div>
        <br><br>

        <input type="submit" value="Login" class="btn btn-primary btn-block"><br/>
   

    </form><br/>


    <h5>Don't have account yet? </h5>
    <a href="signup.php"  class="btn btn-primary">SIGN UP </a>



    

<?php include_once 'includes/footer.php'?>    




                