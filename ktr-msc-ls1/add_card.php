<?php require 'partials/header.php'; ?>

<body>
<?php 
    if(isset($_POST['name_input']) && !empty($_POST['name_input'])
    && isset($_POST['company_name']) && !empty($_POST['company_name'])
    && isset($_POST['email_adress']) && !empty($_POST['email_adress'])
    && isset($_POST['phone_number']) && !empty($_POST['phone_number']) && is_numeric($_POST['phone_number'])) {
        $user_name = $_SESSION['user'];    
        $name = $_POST['name_input'];
        $company_name = utf8_encode($_POST['company_name']);
        $email_adress = utf8_encode($_POST['email_adress']);
        $phone_number = utf8_encode($_POST['phone_number']);

            $insert = "INSERT INTO user_cards (`user_name`, `card_user_name`, `card_user_company_name`, `card_user_email`, `card_user_phone_number`)
                        VALUES ('$user_name', '$name', '$company_name', '$email_adress', '$phone_number')";
            if(mysqli_query($connexion, $insert)) {
                header('Location: ./user_dashboard.php?status=card_created');
                exit();
            } else {
                echo "Erreur :".$insert."<br>".mysqli_error($connexion);
            }
            mysqli_close($connexion);
        }
?>
    <div class="container-fluid">
        <div class="container">
            <h3>Add card for your collection</h3>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="name_input" class="form-label">Name *</label>
                    <input type="text" class="form-control"name="name_input"  id="name_input"  >
                </div>
                <div class="mb-3">
                    <label for="company_name" class="form-label">Company Name</label>
                    <input type="text" class="form-control" name="company_name" id="company_name">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email_adress">Email address</label>
                    <input type="email" class="form-control" name="email_adress" id="email_adress" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="phone_number">Phone Number</label>
                    <input type="tel" type="tel" pattern="[0-9]{10}" class="form-control" name="phone_number" id="phone_number" placeholder="format XXXXXXXXXX only">
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>
</body>

</html>