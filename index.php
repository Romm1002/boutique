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
</html>

<?php

require_once 'class/Autoload.php';
Autoload::load();

session_start();

if(isset($_GET['page'])){
    switch($_GET['page']){
        case 'produits':
            $ctrl = new ProduitController();

            if(isset($_POST['ajouterProduit'])){
                $ctrl->newProduit();
            }

            if(isset($_POST['supprimerProduit'])){
                $ctrl->deleteProduit();
            }
            
            echo $ctrl->getProduits($_GET['categorie']);
            break;

        case 'categories':
            $ctrl = new CategorieController();
            $ctrl2 = new UtilisateurController();

            if(isset($_POST['ajouterCategorie'])){
                $ctrl->newCategorie();
            }

            if(isset($_POST['modifierCategorie'])){
                $ctrl->updateCategorie();
            }

            if(isset($_POST['supprimerCategorie'])){
                $ctrl->deleteCategorie();
            }

            if(isset($_POST['deconnexion'])){
                $ctrl2->deconnexion();
            }

            echo $ctrl->getCategories();
            break;

        case 'utilisateurs':
            $ctrl = new UtilisateurController();

            switch($_GET['action']){
                case 'inscription':
                    echo $ctrl->getFormInscription();

                    if(!empty($_POST['email']) && !empty($_POST['mdp'])){
                        $ctrl->newUtilisateur();
                    }
                    break;

                case 'connexion':
                    echo $ctrl->getFormConnexion();

                    if(isset($_POST['connexion'])){
                        $ctrl->connexion();
                    }
                    break;
                
                case 'list':
                    if(isset($_POST['modifierRole'])){
                        $ctrl->updateRoleUtilisateur();
                    }

                    echo $ctrl->getUsers();

                    break;
            }

        default:
            // INDEX
            break;
    }
}else{
    // 404
    echo '<p>Page introuvable</p>';
}

?>

<script src="main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>