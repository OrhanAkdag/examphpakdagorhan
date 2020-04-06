
<?php
include 'model.php';
$idArticle = $_GET['id'];
$article = getArticle($pdo, $idArticle);
$errors = [];
$imageUrl = null;
if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
    $returnValidation = validateEditForm();
    $errors = $returnValidation['errors'];
    $imageUrl = $returnValidation['image'];

    if( count($errors) === 0) {
        EditArticle($pdo, $imageUrl, $article['id']);
        header('Location: articles-list.php?edit='.$idArticle);

    }
}

if(empty($_SESSION['login'])) {
    header('location: not-found.php');
}

?>

<body>

<div class="content container my-2">
    <h1 class="text-center shadow p-2 bg-light text-dark">Editer un article</h1>
        <form method="post" action="article-edit.php?id=<?php echo($article['id']);?>" class="p-5 shadow bg-danger" enctype="multipart/form-data">
            <div class="form-group">
                <label class="text-white">Titre de l'article</label>
                <input type="text" name="titre" class="form-control" value="<?php echo($article['titre']) ?>" placeholder="Titre de l'article">
            </div>
            <div class="form-group">
                <label class="text-white">Contenu de l'article</label>
                <input type="text" name="contenu" class="form-control" value="<?php echo($article['contenu']) ?>" placeholder="Titre de l'article">
            </div>
            <label>Image :</label> <br>
            <img style="max-width: 150px" src="<?php echo('images/upload/'.$article['image_link']);?>"><br><br>
            <input type="file" name="image" value="<?php echo($article['image_link']) ?>"><br><br>
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
