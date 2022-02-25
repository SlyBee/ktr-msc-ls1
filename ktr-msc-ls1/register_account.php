<?php require 'partials/header.php'; ?>
<body>
    
<?php 

    if(isset($_POST['username']) && !empty($_POST['username'])
    && isset($_POST['user_password']) && !empty($_POST['user_password'])) { 
        //check the data for the insert
        $name = utf8_encode($_POST['username']);    
        //check all the users already present in the database
        $checkName = "SELECT * from users WHERE user_name='$name'";
        $result = mysqli_query($connexion, $checkName); 
        // if the user already exists, abort and redirect on the same page with an error message
        if(mysqli_fetch_assoc($result) > 1) {
            header('Location: ./register_account.php?status=user_exists');
            exit;
        }

        $password = $_POST['user_password'];
        $insert = "INSERT INTO users (`user_name`,`user_password`)
                    VALUES ('$name', '$password')";
        // if the insert is successfull, lets define some session variables and redirect to an another page.
        if(mysqli_query($connexion, $insert)) {
            $_SESSION['user'] = $name;
            $_SESSION['user_password'] = $password;
            header('Location: ./user_infos.php?status=created');
            exit();
            
        } else {
            echo "Erreur :".$insert."<br>".mysqli_error($connexion);
        }
        mysqli_close($connexion);
    }
?>
    <div class="container-fluid">
        <div class="container">
            <h3>Please create your account : </h3>
           <?php include 'partials/register_login_form.php'; ?>
        </div>
    </div>
</body>

</html>