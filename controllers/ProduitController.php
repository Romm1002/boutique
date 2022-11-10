<?php

class ProduitController extends ProduitManager{
    /**
     * Permet d'afficher tout les produits d'une catégorie
     */
    public function getProduits($id){
        ob_start();
        $produits = $this->findByCatgeorie($id);
        require_once 'views/produits/index.php';
        $page = ob_get_clean();

        return $page;
    }

    /**
     * Permet l'ajout d'un produit
     */
    public function newProduit(){
        if(!empty($_POST['nom']) && !empty($_POST['description']) && !empty($_POST['qte']) && !empty($_POST['prix'])){
            $this->save($_POST['nom'], $_POST['description'], $_POST['qte'], $_POST['prix'], $_POST['idCategorie']);
            echo '
            <div class="container">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    '.$_POST["nom"].' à bien été ajouté.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            ';
        }else{
            echo '
            <div class="container">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Une erreur est survenue.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            ';
        }
    }

    /**
     * Permet de supprimer un produit
     */
    public function deleteProduit(){
        if(isset($_POST['supprimerProduit'])){
            $this->delete($_POST['idProduit']);
            echo '
            <div class="container">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Le produit a bien été supprimé.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            ';
        }else{
            echo '
            <div class="container">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Une erreur est survenue.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            ';
        }
    }
}