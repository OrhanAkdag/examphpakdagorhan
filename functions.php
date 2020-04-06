<?php
function getArticle($pdo,$id)
{
    $res = $pdo->prepare('SELECT * FROM annonce WHERE id = :id');
    $res->execute(['id'=> $id]);
    return $res->fetch();
}

function getUser($pdo,$id)
{
    $res = $pdo->prepare('SELECT * FROM utilisateur WHERE id = :id');
    $res->execute(['id'=> $id]);
    return $res->fetch();
}

function EditArticle($pdo, $imageUrl, $id){
    if(!is_null($imageUrl)){
        $req = $pdo->prepare('UPDATE annonce SET titre = :titre, contenu = :contenu , image_link = :image WHERE id = :id');
        $req->execute([
            'titre' => $_POST['titre'],
            'contenu' => $_POST['contenu'],
            'image' => $imageUrl,
            'id'=> $id
        ]);
    } else {
        $req = $pdo->prepare('UPDATE annonce SET titre = :titre, contenu = :contenu WHERE id = :id');
        $req->execute([
            'titre' => $_POST['titre'],
            'contenu' => $_POST['contenu'],
            'id'=> $id
        ]);
    }
}

function EditUser($pdo, $id){
        $req = $pdo->prepare('UPDATE utilisateur SET login = :login , nom = :nom , prenom = :prenom  WHERE id = :id');
        $req->execute([
            'login' => $_POST['login'],
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'id'=> $id
        ]);
}

function validateEditForm() {
    $errors = [];
    $imageUrl = '';

    if($_FILES['image']['size'] != 0) {

        if ($_FILES['image']['type'] === 'image/png') {
            if ($_FILES['image']['size'] < 80000) {
                $extension = explode('/', $_FILES['image']['type'])[1];
                $imageUrl = uniqid() . '.' . $extension;
                move_uploaded_file($_FILES['image']['tmp_name'], 'images/upload/' . $imageUrl);
            } else {
                $errors[] = 'Fichier trop lourd impossible';
            }
        } else {
            $errors[] = 'Impossible : j\'accepte que les PNGS !';
        }
    }
    if (empty($_POST['titre'])) {
        $errors[] = 'Veuillez saisir le nom de la planète';
    }
    if ( empty($_POST['contenu'])) {
        $errors[] = 'Veuillez saisir le status de la planète';
    }

    return ['errors'=>$errors, 'image'=>$imageUrl];
}

function validateEditUserForm() {
    $errors = [];

    if (empty($_POST['login'])) {
        $errors[] = 'Veuillez saisir le pseudo de l\'utilisateur';
    }
    if ( empty($_POST['nom'])) {
        $errors[] = 'Veuillez saisir le nom de l\'utilisateur';
    }
    if ( empty($_POST['prenom'])) {
        $errors[] = 'Veuillez saisir le prenom de l\'utilisateur';
    }

    return ['errors'=>$errors];
}

function addUser($pdo, $errors){
    try{
        $req = $pdo->prepare(
            'INSERT INTO utilisateur(login, nom, prenom , password)
        VALUES(:login, :nom, :prenom, :password)');
        $req->execute([
            'login' => $_POST['login'],
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'password' => md5($_POST['password']),
        ]);
    } catch (PDOException $exception){
        if($exception->getCode() === '23000'){
            $errors[] = 'login déjà utilisé';
        }
    }
    return $errors;
}


function addArticle($pdo, $imageUrl){
    $req = $pdo->prepare(
        'INSERT INTO annonce(titre, image_link, contenu, nom_prenom_utilisateur)
    VALUES(:titre, :image_link, :contenu, :nom_prenom_utilisateur)');
    $req->execute([
        'titre' => $_POST['titre'],
        'image_link' => $imageUrl,
        'contenu' => $_POST['contenu'],
        'nom_prenom_utilisateur' => $_SESSION['login'],
    ]);

}

function logUser($pdo){
    $password = $_POST['password'];
    $passwordEncode = md5($password);
    $res = $pdo->prepare('SELECT * FROM utilisateur WHERE login = :login');
    $res->execute([
        'login'=> $_POST['login'],
    ]);
    $user = $res->fetch();
    var_dump($user);
    if ($user  && $passwordEncode === $user['password'])
    {
        $_SESSION['login'] = $user['login'];
        $_SESSION['id'] = $user['id'];
        setcookie('rememberme',$_POST['rememberme'],time()+3600);
        setcookie("username", $_POST['login'], time()+3600);
        if ($user['id'] === 1){
            header('location: admin.php?login=true');
        }
        else{
            header('location: articles-list.php?login=true');

        }
    } else {
        echo '<div class=" container alert alert-danger my-2" role="alert">Identifiant erroné</div';

    }
}

function deleteArticle($pdo, $id)
{
 $res = $pdo->prepare('DELETE FROM annonce WHERE id = :id');
 $res->execute(['id'=> $id]);
}

function deleteUser($pdo, $id)
{
 $res = $pdo->prepare('DELETE FROM utilisateur WHERE id = :id');
 $res->execute(['id'=> $id]);
}


function validateAddUserForm(){
    $errors = [];
    if(empty($_POST['login'])){
        $errors[] = '<div class="alert alert-danger" role="alert">Veuillez saisir un pseudo</div>';
    }
    if(empty($_POST['nom'])){
        $errors[] = '<div class="alert alert-danger" role="alert">Veuillez saisir un nom</div>';
    }
    if(empty($_POST['prenom'])){
        $errors[] = '<div class="alert alert-danger" role="alert">
        Veuillez saisir un prénom</div>';
    }

    if(empty($_POST['password'])){
        $errors[] = '<div class="alert alert-danger" role="alert">Veuillez saisir un mot de passe</div>';
    }
    return ['errors'=>$errors];
}

function validateArticleForm(){
    $errors = [];
    $imageUrl = null;
    $allowedExtension = ['image/png','image/jpeg','image/gif'];
    if($_FILES['image']['size'] == 0){
        $errors[] = '<div class="alert alert-danger" role="alert">Veuillez ajouter une image</div>';
    }
    if(in_array($_FILES['image']['type'],$allowedExtension)){
        if($_FILES['image']['size'] < 8000000){
            $extension = explode('/', $_FILES['image']['type'])[1];
            $imageUrl = uniqid().'.'.$extension;
            move_uploaded_file($_FILES['image']['tmp_name'],'images/upload/'.$imageUrl);
        }
        else {
            $errors[] = '<div class="alert alert-danger" role="alert">Fichier trop lourd</div> ';
        }
    }    
    else {
        $errors[] = '<div class="alert alert-danger" role="alert">J\'accepte que les fichiers png, jpg, gif</div>';
    }
    if(empty($_POST['titre'])){
        $errors[] = '<div class="alert alert-danger" role="alert">Veuillez saisir le titre de l\'article</div>';
    }
    if(empty($_POST['contenu'])){
        $errors[] = '<div class="alert alert-danger" role="alert">Veuillez saisir le contenu de l\'article</div>';
    }
    return ['errors'=>$errors, 'image'=>$imageUrl];
}

function validateLoginForm(){
    $errors = [];
    $login = $_POST['login'];
    if(empty($login)){
        $errors[] = '<div class="alert alert-danger" role="alert">Veuillez saisir votre pseudo ou l\'email</div>';
    }
    if(empty($_POST['password'])){
        $errors[] = '<div class="alert alert-danger" role="alert">
        Veuillez saisir votre mot de passe</div>';
    }
    
    if(!empty($email)){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //$errors[] = '<div class="alert alert-success" role="alert">
            //L\'adresse email '.$email.' est considérée comme valide.</div>';
        } else {
            $errors[] = '<div class="alert alert-danger" role="alert">L\'adresse email '.$email.' est considérée comme invalide.</div>';
        }
    }
    return ['errors'=>$errors];
}


?>

