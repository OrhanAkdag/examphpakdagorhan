<?php
include 'model.php';
?>

<body>

<div class="content container">
<div class="text-dark text-center">
    <?php
    $res = $pdo->prepare('SELECT * FROM annonce WHERE id = :id');
    $res->execute(['id'=> $_GET['id']]);
    $fetchRes = $res->fetch();
    ?>

        <h1><?php echo($fetchRes['titre']) ?></h1><br>
        <img style="max-width:300px;" src="<?php echo('images/upload/'.$fetchRes['image_link']); ?>"
              alt="Image de l'article' <?php echo($fetchRes['image_link']); ?>" > <br>
        <h2><u class="m-2">Contenu :</u> <?php echo($fetchRes['contenu']) ?></h2>
        <div><u class="m-2">Auteur :</u> <?php echo($fetchRes['nom_prenom_utilisateur']) ?></div>
        <?php $res->closeCursor(); ?>
</div>
</div>    
    <?php include 'footer.php';?>
</body>