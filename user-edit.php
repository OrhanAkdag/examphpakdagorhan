<?php
include 'model.php';
$idUser = $_GET['id'];
$user = getUser($pdo, $idUser);
$errors = [];
if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
    $returnValidation = validateEditUserForm();
    $errors = $returnValidation['errors'];
    if( count($errors) === 0){
        editUser($pdo, $user['id']);
        echo '<div class="container my-2 alert alert-success">édition d\'un utilisateur réussi</div>';
        header('Location: user-list.php?edit='.$idUser);

    }
}

if(empty($_SESSION['login'])) {
    header('location: not-found.php');
}
if ($_SESSION['id'] !=1){
    header('location: not-found.php');
}
?>


<body>

<div class="content container adduser my-2">
    <h1 class="text-center shadow p-2 bg-light text-dark">Editer un utilisateur</h1>
        <form method="post" action="user-edit.php?id=<?php echo($user['id']);?>" class="p-5 shadow bg-danger" enctype="multipart/form-data">
            <div class="form-group">
                <label class="text-white">Pseudo</label>
                <input type="text" name="login" class="form-control" placeholder="Pseudo" value="<?php echo($user['login']) ?>">
            </div>
            <div class="form-group">
                <label class="text-white">Nom</label>
                <input type="text" name="nom" class="form-control" placeholder="Nom" value="<?php echo($user['nom']) ?>">
            </div>
            <div class="form-group">
                <label class="text-white">Prénom</label>
                <input type="text" name="prenom" class="form-control" placeholder="Prénom" value="<?php echo($user['prenom']) ?>">
            </div>
            <button type="submit" class="btn btn-primary">Valider</button>
            <?php
                if(count($errors) != 0){
                    echo('<h2 class="text-white">Erreurs lors de la dernière soumission du formulaire: </h2>');
                    foreach($errors as $error){
                        echo('<div class="error">'.$error.'</div>');
                    }
                }
            ?>
        </form>
</div>    
    <?php include 'footer.php';?>
</body>