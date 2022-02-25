<?php require 'partials/header.php'; ?>

<body>
    <?php 
        if(isset($_POST['username']) && isset($_POST['user_password'])) {
            // secure your input to prevent from SQL injections
            $username = mysqli_real_escape_string($connexion,htmlspecialchars($_POST['username'])); 
            $password = mysqli_real_escape_string($connexion,htmlspecialchars($_POST['user_password']));

            if($username !== "" && $password !== "") {
                $query = "SELECT count(*) FROM users WHERE user_name='$username' and user_password='$password'";
                $response = mysqli_query($connexion,$query);
        
                $result = mysqli_fetch_array($response); 
                $count = $result['count(*)'];
                if($count != 0) {
                    $_SESSION['user'] = $username;
                    header('Location:user_dashboard.php');
                } else {
                    header('Location:index.php?fail=1');
                }
            } else {
                header('Location:index.php?fail=2');
            }
        }
        // error message displaying
        if(isset($_GET['fail'])){
            $fail = $_GET['fail'];
            if($fail==1 || $fail==2) ?>
                <script>alert('Incorrect user or password');</script>
        <?php 
        }
        mysqli_close($connexion);
?>
    <div class="container-fluid">
        <div class="container">
            <h1>Hello</h1>
            <p>Please login or create an account to have access to your card collections and add your own informations :)</p>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Name *</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="user_password">Password *</label>
                    <input type="password" class="form-control" name="user_password" id="user_password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <p>No account yet ? <a href="register_account.php">Sign in</a></p>
            </form>
        </div>
    </div>
</body>

</html>