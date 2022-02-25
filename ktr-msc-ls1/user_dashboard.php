<?php require 'partials/header.php'; ?>
<body>
<?php 
    $username = $_SESSION['user'];
    $getFullInfos = "SELECT * FROM `user_details`, `user_cards` WHERE user_details.user_name=user_cards.user_name AND user_details.user_name='$username'";
    $result = mysqli_query($connexion, $getFullInfos); 
?>
<div class="container-fluid">
    <div class="container">
        <h1 class="text-center"><?= ucfirst($_SESSION['user']);?>'s Dashboard</h1>
        <div class="user_informations">
        <h3>Your informations :</h3>
            <ul>
                <?php $infos = mysqli_fetch_assoc($result);
                // if we fetch directly from the database via the register account form
                    if($infos) { ?>
                        <li><b>Name :</b> <?= $infos['user_name'];?></li>
                        <li><b>Company Name :</b> <?= $infos['user_company'];?></li>
                        <li><b>Email adress :</b> <?= $infos['user_email'];?></li>
                        <li><b>Phone Number :</b> <?= $infos['user_phone'];?></li>
                    <?php } 
                    // else fetch this data from the session.
                    else { ?>
                        <li><b>Name :</b> <?= $_SESSION['user'];?></li>
                        <li><b>Company Name :</b> <?= $_SESSION['company_name'];?></li>
                        <li><b>Email adress :</b> <?= $_SESSION['email_adress'];?></li>
                        <li><b>Phone Number :</b> <?= $_SESSION['phone_number'];?></li>
                   <?php }
                ?>

            </ul>
        </div>
        <div class="user_collections">
        <h3 class="text-center">My Collection :</h3>
        <div class="row justify-content-start my-5">
        <?php while($cards = mysqli_fetch_assoc($result)) : ?>
            <div class="card my-3 mx-3" style="width: 18rem;margin-right:1rem;">
                <div class="card-body">
                    <h5 class="card-title"><?= $cards['card_user_name'];?></h5>
                    <ul>
                        <li class="card-text"> <?= $cards['card_user_company_name'];?></li>
                        <li class="card-text"> <?= $cards['card_user_email'];?></li>
                        <li class="card-text"> <?= $cards['card_user_phone_number'];?></li>
                    </ul>
                </div>
            </div>
        <?php 
            endwhile;?>
        </div>
        </div>
        <a href="add_card.php" class="btn btn-success">Add Card to my collection</a>
        <a href="logout.php">Logout</a>
    </div>
</div>
</body>
</html>