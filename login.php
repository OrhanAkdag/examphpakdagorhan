<?php

include 'model.php';
$errors = [];
if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
    $returnValidation = validateLoginForm();
    $errors = $returnValidation['errors'];
    if( count($errors) === 0){
        logUser($pdo);
    }
}
if(isset($_SESSION['login']) && !empty($_SESSION['login'])) {
    if ($_SESSION['id'] == 1){
        header('location: admin.php?login=true');
    }
    else{
        header('location: articles-list.php?login=true');

    }
}
?>

<div class="content container my-2">
    <div class="p-2">
        <h2 class="text-center bg-light p-2">Se connecter</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-6 w-100 shadow my-5 p-5">
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <input class="form-control" type="text" name="login" id="login" placeholder="Pseudo ou email">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" id="password" placeholder="password">
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="rememberme" id="rememberme">
                        <b>Se rappeler de moi !</b>
                    </div>
                    <button type="submit" class="btn btn-primary">Se connecter</button>
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
        </div>
    </div>
    <div class="text-center">
        <p class="alert alert-success my-2">
            <span class="h3">partie admin</span><br>
            login: admin <br>
            password: admin <br>
        </p>
    </div>
    <div class="text-center">
        <p class="alert alert-success my-2">
            <span class="h3">partie utilisateur</span><br>
            login: journaliste <br>
            password: journaliste <br>
        </p>
    </div>
    <div class="text-center">
        <p class="alert alert-warning my-2">
            <span class="h4">La base de donné s'appel ledauphine</span><br>
            <span class="h4">Table utilisateur</span><br>
            <span class="h4">Table annonce</span><br>
            <span class="h4">le fichier sql se trouve dans le git hub git hub dossier sql</span><br>
        </p>
    </div>               
</div>
<?php include 'footer.php';?>