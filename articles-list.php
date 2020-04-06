<?php
include 'model.php';

if (isset($_GET['delete'])){

        echo '<div class="container alert alert-danger my-2" role="alert">L\'article '.$_GET['delete'].' a été supprimé</div>'; 

}
if (isset($_GET['edit'])){

    echo '<div class="container alert alert-success my-2" role="alert">L\'article '.$_GET['edit'].' a été édité</div>'; 

}
?>

<body>

<div class="content container my-2">
    <h1 class="text-center shadow p-2 bg-light text-dark">Page qui liste nos articles</h1>
        <h2 class="text-center shadow p-2 bg-light text-dark">Les articles disponibles dans notre base de donnée :</h2>

        <table class="table shadow">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Titre</th>
                <th scope="col">Contenu</th>
                <th scope="col">Image</th>
                <th scope="col">Pseudo</th>
                <?php
                    if (isset($_SESSION['login']) && !empty($_SESSION['login'])){
                        echo'<th scope="col">Action</th>';
                        
                    }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            $reponse = $pdo->query('SELECT * FROM annonce');
            while ($data = $reponse->fetch())
            {
                ?>
                <tr>
                    <td><?php echo($data['id']); ?></td>
                    <td><?php echo($data['titre']); ?></td>
                    <td><?php echo($data['contenu']); ?></td>
                    <td>
                        <img style="max-width: 140px;" src="<?php echo('images/upload/'.$data['image_link']); ?>"
                            alt="Image de l'article <?php echo($data['image_link']); ?>"/>
                    </td>
                    <td><?php echo($data['nom_prenom_utilisateur']); ?></td>

                    <td>
                        <?php
                            if (isset($_SESSION['login']) && !empty($_SESSION['login'])){
                            echo '<a title="Voir le détail" href="article-detail.php?id='.$data['id'].'"<i class="fa fa-eye text-primary mx-2"></i>
                            </a>';
                            echo '<a title="Editer" href="article-edit.php?id='.$data['id'].'"<i class="fa fa-edit text-warning mx-2"></i>
                            </a>';
                            echo '<a title="Supprimer" href="article-delete.php?id='.$data['id'].'"<i class="fa fa-trash text-danger mx-2"></i>
                            </a>';
                        }

                ?>
                    </td>


                </tr>
                <?php
            }
            $reponse->closeCursor();
            ?>

            </tbody>
        </table>
        <?php
            if (isset($_SESSION['login']) && !empty($_SESSION['login'])){
                echo'
                <div class="row my-2">
                    <div class="col-6">
                        <div class="p-3 bg-primary text-center">
                            <a href="article-add.php" class="text-white">Ajouter un nouvel article</a>
                    </div>
                </div>
                </div>';
                        
            }
        ?>
</div>
   
    <?php include 'footer.php';?>
</body>

