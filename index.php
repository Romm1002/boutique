<?php
session_start();
require_once 'class/Autoload.php';
Autoload::load();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MVC</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<nav class="navbar navbar-expand-lg bg-secondary mb-4">
    <div class="container">
        <a class="navbar-brand text-white" href="?page=categories&action=list">Boutique</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Catégories
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?page=categories&action=list">Liste</a></li>
                        <?php
                        if(!empty($_SESSION) && $_SESSION['role'] == 'admin'){
                        ?>
                            <li><a class="dropdown-item" href="?page=categories&action=ajouter">Ajouter</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
                <?php
                if(!empty($_SESSION) && $_SESSION['role'] == 'admin'){
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Produits
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?page=produits&action=ajouter">Ajouter</a></li>
                    </ul>
                </li>
                <?php
                }
                ?>
            </ul>
            <?php
            if(!empty($_SESSION) && $_SESSION['role'] == 'admin'){
                ?>
                <a href="?page=utilisateurs&action=list" class="btn btn-warning rounded-0">Gestion utilisateurs</a>
                <?php
            }
            if(!empty($_SESSION)){
                ?>
                <a href="?page=utilisateurs&action=deconnexion" class="btn btn-danger rounded-0" style="margin-left: 10px">Se déconnecter</a>
                <?php
            }else{
                ?>
                <div>
                    <a href="?page=utilisateurs&action=inscription" class="btn btn-primary rounded-0">S'inscrire</a>
                    <a href="?page=utilisateurs&action=connexion" class="btn btn-success rounded-0">Se connecter</a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</nav>
</html>

<?php
if(isset($_GET['page'])){
    switch($_GET['page']){
        case 'produits':
            $ctrl = new ProduitController();

            switch($_GET['action']){
                case 'list':
                    if(isset($_POST['supprimerProduit'])){
                        $ctrl->deleteProduit();
                    }

                    echo $ctrl->getProduits($_GET['categorie']);
                    break;

                case 'ajouter':
                    UtilisateurController::isNotAdmin();
                    
                    if(isset($_POST['ajouterProduit'])){
                        $ctrl->newProduit();
                    }

                    echo $ctrl->getFormAddProduit();
                    break;

                case 'edit':
                    UtilisateurController::isNotAdmin();

                    if(isset($_POST['modifierProduit'])){
                        $ctrl->editProduit();
                    }

                    echo $ctrl->getFormEditProduit();
                    break;
            }
            break;

        case 'categories':
            $ctrl = new CategorieController();

            switch($_GET['action']){
                case 'list':
                    if(isset($_POST['modifierCategorie'])){
                        $ctrl->updateCategorie();
                    }
                    
                    if(isset($_POST['supprimerCategorie'])){
                        $ctrl->deleteCategorie();
                    }

                    echo $ctrl->getCategories();
                    break;

                case 'ajouter':
                    UtilisateurController::isNotAdmin();

                    if(isset($_POST['ajouterCategorie'])){
                        $ctrl->newCategorie();
                    }

                    echo $ctrl->getFormAddCategorie();
                    break;
            }
            break;

        case 'utilisateurs':
            $ctrl = new UtilisateurController();

            switch($_GET['action']){
                case 'inscription':
                    if(!empty($_POST['email']) && !empty($_POST['mdp'])){
                        $ctrl->newUtilisateur();
                    }

                    echo $ctrl->getFormInscription();
                    break;

                case 'connexion':
                    if(isset($_POST['connexion'])){
                        $ctrl->connexion();
                    }

                    echo $ctrl->getFormConnexion();
                    break;
                
                case 'list':
                    UtilisateurController::isNotAdmin();

                    if(isset($_POST['modifierRole'])){
                        $ctrl->updateRoleUtilisateur();
                    }

                    echo $ctrl->getUsers();
                    break;

                case 'deconnexion':
                    $ctrl->deconnexion();
                    header('location:?page=categories&action=list');
                    break;
            }

        default:
            // INDEX
            break;
    }
}else{
    header('location:?page=categories&action=list');
}

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>