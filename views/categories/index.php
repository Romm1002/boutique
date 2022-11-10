<body class="pt-3 pb-3">
    <div class="container">
        <?php
        if(!empty($_SESSION)){
            ?>
            <div class="alert alert-warning d-flex align-items-center justify-content-between">
                Bienvenue <?=$_SESSION['email'];?>
                <form method="post">
                    <button type="submit" name="deconnexion" class="btn btn-danger rounded-0">Se déconnecter</button>
                </form>
            </div>
            <?php
        }else{
            ?>
            <div class="alert alert-secondary">
                <a href="?page=utilisateurs&action=inscription" class="btn btn-primary rounded-0">S'inscrire</a>
                <a href="?page=utilisateurs&action=connexion" class="btn btn-success rounded-0">Se connecter</a>
            </div>
            <?php
        }

        if(!empty($_SESSION) && $_SESSION['role'] != "utilisateur"){
            ?>
            <form method="post" class="bg-secondary p-4 text-dark bg-opacity-25 border border-dark">
                <h1 class="fs-2">Créer une nouvelle catégorie</h1>
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control rounded-0">
    
                <input type="submit" value="Ajouter" name="ajouterCategorie" class="btn btn-primary rounded-0 mt-3">
            </form>
            <?php
        }
        ?>

        <div class="bg-secondary p-4 text-dark bg-opacity-25 border border-dark mt-4">
            <h1 class="fs-2">Liste des catégories</h1>
            <div class="d-flex justify-content-between flex-wrap">
                <?php
                if(!empty($categories)){
                    foreach($categories as $categorie){
                        ?>
                            <div class="card rounded-0 p-3 mb-2" style="width: 300px">
                                <p style="display: flex; align-items: center; justify-content: space-between">
                                    <b><?=$categorie['nom']?></b>
                                    <a style="width: 20px; height: 20px; display: flex; justify-content: center; align-items: center" href="?page=produits&categorie=<?=$categorie['id'];?>" class="btn btn-warning p-0 rounded-circle">
                                        <i class="bi bi-info-lg"></i>
                                    </a>
                                </p>

                                <?php
                                if(!empty($_SESSION) && $_SESSION['role'] != "utilisateur"){
                                ?>
                                    <form method="post">
                                        <label for="newNom" class="form-label">Nouveau nom de la catégorie</label>
                                        <div class="d-flex">
                                            <input type="text" name="newNom" id="newNom" class="form-control rounded-0 border-end-0">
                                            <input type="hidden" name="idCategorie" value="<?=$categorie['id'];?>">
                                            <button type="submit" name="modifierCategorie" class="btn btn-primary rounded-0">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </div>
                                    </form>

                                    <form method="post" class="mt-3">
                                        <input type="hidden" name="idCategorie" value="<?=$categorie['id'];?>">
                                        <button type="submit" name="supprimerCategorie" class="btn btn-danger rounded-0">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                    }
                }else{
                    echo '
                        <p>Il n\'y a aucune catégorie.</p>
                    ';
                }
                ?>
            </div>
        </div>
    </div>
</body>