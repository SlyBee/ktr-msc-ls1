<?php require 'partials/header.php'; ?>
<body>
<?php
    // fill the name field from the first account register form
    $name_disabled = ($_SESSION['user']) ? 'value="'.$_SESSION["user"].'"required' : required; 

    if(isset($_POST['name_input']) && !empty($_POST['name_input'])
    && isset($_POST['company_name']) && !empty($_POST['company_name'])
    && isset($_POST['email_adress']) && !empty($_POST['email_adress'])
    && isset($_POST['phone_number']) && !empty($_POST['phone_number']) ) {
        $name = ($_SESSION['user']) ? $_SESSION['user'] : utf8_encode($_POST['name_input']);    
        $company_name = utf8_encode($_POST['company_name']);
        $email_adress = utf8_encode($_POST['email_adress']);
        $phone_number = utf8_encode($_POST['phone_number']);
        $_SESSION['company_name'] = $company_name;
        $_SESSION['email_adress'] = $email_adress;
        $_SESSION['phone_number'] = $phone_number;

            $insert = "INSERT INTO user_details (`user_name`, `user_company`, `user_email`, `user_phone`)
                        VALUES ('$name', '$company_name', '$email_adress', '$phone_number')";
            if(mysqli_query($connexion, $insert)) {
                echo "User added !";
                header('Location: ./user_dashboard.php');
                exit();
                
            } else {
                echo "Erreur :".$insert."<br>".mysqli_error($connexion);
            }
            mysqli_close($connexion);
        }
?>
    <div class="container-fluid">
        <div class="container">
            <h3><?=ucfirst( $_SESSION['user']);?>, please complete your profile informations below :</h3>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="name_input" class="form-label">Name *</label>
                    <input type="text" class="form-control"name="name_input"  id="name_input" <?php echo $name_disabled;?> >
                </div>
                <div class="mb-3">
                    <label for="company_name" class="form-label">Company Name</label>
                    <input type="text" class="form-control" name="company_name" id="company_name">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email_adress">Email address</label>
                    <input type="text" class="form-control" name="email_adress" id="email_adress">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="phone_number">Phone Number</label>
                    <input type="tel" pattern="[0-9]{10}" class="form-control" name="phone_number" id="phone_number" placeholder="format XXXXXXXXXX only">
                    
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>
</body>

</html>