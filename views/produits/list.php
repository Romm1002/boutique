<body>
    <div class="container">
        <a href="?page=categories&action=list" class="btn btn-secondary rounded-0">Retour aux catégories</a>
        <div class="bg-secondary p-4 text-dark bg-opacity-25 border border-dark mt-3">
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
                                            <br>
                                            Quantité : <span class="none"><?=$produit['qte'];?></span>
                                        </i>
                                    </p>
                                </form>
                                    
                                    <?php
                                if(!empty($_SESSION) && $_SESSION['role'] != "utilisateur"){
                                    ?>
                                    <a href="?page=produits&action=edit&produit=<?=$produit['id'];?>" id="editerProduit" name="editerProduit" class="btn btn-primary rounded-0 none editerProduit">Modifier</a>

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