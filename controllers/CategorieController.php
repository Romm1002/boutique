<?php

class CategorieController extends CategorieManager{
    /**
     * Permet d'afficher toutes les catégories
     */
    public function getCategories(){
        ob_start();
        $categories = $this->findAll();
        require_once 'views/categories/list.php';
        $page = ob_get_clean();

        return $page;
    }

    /**
     * Permet d'afficher le formulaire d'ajout de catégorie
     */
    public function getFormAddCategorie(){
        ob_start();
        require_once 'views/categories/ajouter.php';
        $page = ob_get_clean();

        return $page;
    }

    /**
     * Permet d'ajouter une nouvelle catégorie
     */
    public function newCategorie(){
        if(!empty($_POST['nom'])){
            $this->save(htmlspecialchars($_POST['nom']));
            echo '
            <div class="container">
                <div class="alert alert-success alert-dismissible fade show"  role="alert">
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
     * Permet de modifier le nom d'une catégorie
     */
    public function updateCategorie(){
        if(!empty($_POST['newNom'])){
            $this->update(htmlspecialchars($_POST['newNom']), htmlspecialchars($_POST['idCategorie']));
            echo '
            <div class="container">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    La catégorie à bien été mise à jour
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
     * Permet de supprimer une catégorie
     */
    public function deleteCategorie(){
        if(isset($_POST['supprimerCategorie'])){
            $this->delete($_POST['idCategorie']);
            echo '
            <div class="container">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    La catégorie à bien été supprimé.
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