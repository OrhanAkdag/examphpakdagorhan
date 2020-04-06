<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
  <a class="navbar-brand" href="articles-list.php">Le Dauphiné</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="articles-list.php">Articles <span class="sr-only">(current)</span></a>
      </li>
        <?php
        if (isset($_SESSION['login']) && !empty($_SESSION['login'])){
            if ($_SESSION['id']==1){
                echo '<a class="nav-link mx-2 text-white" href="user-list.php">Listes utilisateurs</a>';  
                echo '<a class="btn btn-primary nav-link font-weight-bold mx-2 text-white" href="admin.php">Page admin</a>';

            }
        }

        ?>
        <?php
        if (isset($_SESSION['login']) && !empty($_SESSION['login'])){
            if ($_SESSION['id']>1){
                echo '<a class="btn btn-primary nav-link font-weight-bold mx-2 text-white" href="article-add.php">Ajouter un article</a>';  
            }
        }

        ?>
        </li>
        <?php 
        if(isset($_SESSION['login']) && !empty($_SESSION['login'])) {
            echo '<a class="btn btn-success nav-link font-weight-bold mx-2 text-white" href="logout.php">Se déconnecter</a>';     
        }
        else {
            echo '<a class="btn btn-success font-weight-bold mx-2" href="login.php">Se connecter</a>';
        } 
        ?>
        <li>
    </ul>
  </div>
</nav>