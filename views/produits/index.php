<body class="pt-3 pb-3">
    <div class="container">

        <a href="?page=categories" class="btn btn-secondary mb-3 rounded-0">Retour</a>

        <?php
        if(!empty($_SESSION) && $_SESSION['role'] != "utilisateur"){
        ?>
            <form method="post" class="bg-secondary p-4 text-dark bg-opacity-25 border border-dark">
                <h1 class="fs-2">Créer un nouveau produit</h1>
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control">

                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="description" rows="5"></textarea>

                <label for="qte" class="form-label">Quantité</label>
                <input type="number" name="qte" id="qte" class="form-control">

                <label for="prix" class="form-label">Prix</label>
                <input type="number" name="prix" id="prix" class="form-control">

                <input type="hidden" name="idCategorie" value="<?=$_GET['categorie'];?>">

                <input type="submit" name="ajouterProduit" value="Ajouter" class="btn btn-primary rounded-0 mt-3">
            </form>
        <?php
        }
        ?>

        <div class="bg-secondary p-4 text-dark bg-opacity-25 border border-dark mt-4">
            <h1 class="fs-2">Liste des produits</h1>
            <div class="d-flex justify-content-between flex-wrap">
                <?php
                if(!empty($produits)){
                    foreach($produits as $produit){
                        ?>
                            <div class="card rounded-0 p-3 mb-2" style="width: 300px">
                                <form method="post">
                                    <p class="d-flex">
                                        <span class="none">
                                            <b><?=$produit['nom'];?></b>&nbsp;- <?=$produit['prix'];?>€
                                        </span>
                                    </p>
                                    <p>
                                        <i>
                                            Informations : <span class="none"><?=$produit['description'];?></span>
                                            Quantité : <span class="none"><?=$produit['qte'];?></span>
                                        </i>
                                    </p>
                                    <input type="hidden" name="modifierProduit" value="Modifier" class="btn btn-primary rounded-0 input-submit">
                                </form>

                                <?php
                                if(!empty($_SESSION) && $_SESSION['role'] != "utilisateur"){
                                ?>
                                    <button type="button" id="editerProduit" name="editerProduit" class="btn btn-primary rounded-0 none editerProduit">Modifier</button>

                                    <form method="post">
                                        <input type="hidden" name="idProduit" value="<?=$produit['id'];?>">
                                        <button type="submit" name="supprimerProduit" class="btn btn-danger rounded-0 mt-2" style="width: 100%">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                    }
                }else{
                    echo'
                        <p>Il n\'y a aucun produit</p>
                    ';
                }
                ?>
            </div>
        </div>
    </div>
</body>