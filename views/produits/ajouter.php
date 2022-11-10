<body>
    <div class="container">
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

            <label for="categorie" class="form-label">Catégorie</label>
            <select name="categorie" id="categorie" class="form-control">
                <?php
                foreach($categories as $categorie){
                    ?>
                    <option value="<?=$categorie['id'];?>"><?=$categorie['nom'];?></option>
                    <?php
                }
                ?>
            </select>
        
            <input type="submit" name="ajouterProduit" value="Ajouter" class="btn btn-primary rounded-0 mt-3">
        </form>
    </div>
</body>