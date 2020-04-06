<?php
include 'model.php';
$errors = [];
$imageUrl = null;
if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
    $returnValidation = validateArticleForm();
    $errors = $returnValidation['errors'];
    if( count($errors) === 0){
        addArticle($pdo, $returnValidation['image']);
        echo '<div class="container my-2 alert alert-success">ajout d\'un article réussi <a href="articles-list.php">voir les articles</a></div>';
    }
}

if(empty($_SESSION['login'])) {
    header('location: not-found.php');
}

?>

<body>

<div class="content container my-2">
    <h1 class="text-center shadow p-2 bg-light text-dark">Ajouter un article</h1>
        <form method="post" action="article-add.php" class="p-5 shadow bg-danger" enctype="multipart/form-data">
            <div class="form-group">
                <label class="text-white">Titre de l'article</label>
                <input type="text" name="titre" class="form-control" placeholder="Titre de l'article">
            </div>
            <div class="form-group">
                <label class="text-white">Contenu de l'article</label>
                <textarea class="form-control" name="contenu" rows="3" placeholder="Contenu de l'article"></textarea>
            </div>
            <div class="form-group">
                <label class="text-white">Image de l'article</label>
                <input type="file" name="image" class="text-white">
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
