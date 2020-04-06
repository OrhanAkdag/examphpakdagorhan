<?php
include 'model.php';

if (isset($_GET['delete'])){

        echo '<div class="container alert alert-danger my-2" role="alert">L\'utilisateur '.$_GET['delete'].' a été supprimé</div>'; 

}
if (isset($_GET['edit'])){

    echo '<div class="container alert alert-success my-2" role="alert">L\'utilisateur '.$_GET['edit'].' a été édité</div>'; 

}

if ($_SESSION['id'] !=1){
    header('location: not-found.php');
}
?>

<body>

<div class="content container my-2">
    <h1 class="text-center shadow p-2 bg-light text-dark">Page qui liste nos utilisateurs</h1>
        <h2 class="text-center shadow p-2 bg-light text-dark">Les utilisateurs dans notre base de donnée :</h2>

        <table class="table shadow">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Pseudo</th>
                <th scope="col">nom</th>
                <th scope="col">prenom</th>
                <?php
                    if (isset($_SESSION['login']) && !empty($_SESSION['login'])){
                        echo'<th scope="col">Action</th>';
                        
                    }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            $reponse = $pdo->query('SELECT * FROM utilisateur');
            while ($data = $reponse->fetch())
            {
                ?>
                <tr>
                    <td><?php echo($data['id']); ?></td>
                    <td><?php echo($data['login']); ?></td>
                    <td><?php echo($data['nom']); ?></td>
                    <td><?php echo($data['prenom']); ?></td>

                    <td>
                        <?php
                            if (isset($_SESSION['login']) && !empty($_SESSION['login'])){
                            echo '<a title="Voir le détail" href="user-detail.php?id='.$data['id'].'"<i class="fa fa-eye text-primary mx-2"></i>
                            </a>';
                            echo '<a title="Editer" href="user-edit.php?id='.$data['id'].'"<i class="fa fa-edit text-warning mx-2"></i>
                            </a>';
                            echo '<a title="Supprimer" href="user-delete.php?id='.$data['id'].'"<i class="fa fa-trash text-danger mx-2"></i>
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
        <div class="row my-2">
            <div class="col-6">
                <div class="p-3 bg-success text-center">
                    <a href="add-user.php" class="text-white">Ajouter un utilisateur</a>
                </div>
            </div>
        </div>
</div>
   
    <?php include 'footer.php';?>
</body>

