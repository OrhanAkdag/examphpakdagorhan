<?php
include 'model.php';
if ($_SESSION['id'] !=1){
    header('location: not-found.php');
}

?>

<body>

<div class="content container">
    <div class="row my-2">
        <div class="col-6">
            <div class="p-3 bg-success text-center">
                <a href="add-user.php" class="text-white">Ajouter un utilisateur</a>
            </div>
        </div>
        <div class="col-6">
            <div class="p-3 bg-primary text-center">
                <a href="article-add.php" class="text-white">Ajouter un nouvel article</a>
            </div>
        </div>
    </div>
</div>    
    <?php include 'footer.php';?>
</body>

