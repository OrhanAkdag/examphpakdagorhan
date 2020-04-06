<?php
include 'model.php';
if(empty($_SESSION['login'])) {
    header('location: not-found.php');
}

if ($_SESSION['id'] !=1){
    header('location: not-found.php');
}

?>

<body>

<div class="content container">
<div class="text-dark text-center">
    <?php
    $res = $pdo->prepare('SELECT * FROM utilisateur WHERE id = :id');
    $res->execute(['id'=> $_GET['id']]);
    $fetchRes = $res->fetch();
    ?>
        <h1><?php echo($fetchRes['login']) ?></h1><br>
        <h2><u class="m-2">Nom :</u> <?php echo($fetchRes['nom']) ?></h2>
        <div><u class="m-2">Prénom :</u> <?php echo($fetchRes['prenom']) ?></div>
        <?php $res->closeCursor(); ?>
</div>
</div>    
    <?php include 'footer.php';?>
</body>