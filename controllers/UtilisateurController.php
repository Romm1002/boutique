<?php

class UtilisateurController extends UtilisateurManager{
    /**
     * Permet de rediriger si l'utilisateur n'a pas le rôle requis
     */
    public function redirect($url){
        header($url);
    }


    /**
     * Permet d'afficher le formulaire d'inscription
     */
    public function getFormInscription(){
        ob_start();
        require_once 'views/utilisateurs/inscription.php';
        $page = ob_get_clean();

        return $page;
    }

    /**
     * Permet d'inscrire un utilisateur
     */
    public function newUtilisateur(){
        if(!empty($_POST['email']) && !empty($_POST['mdp'])){
            $mdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
            $this->save($_POST['nom'], $_POST['prenom'], $_POST['email'], $mdp, 'utilisateur');

            echo '
            <div class="container">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Vous avez bien été inscrit.
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
     * Permet d'afficher le formulaire de connexion
     */
    public function getFormConnexion(){
        ob_start();
        require_once 'views/utilisateurs/connexion.php';
        $page = ob_get_clean();

        return $page;
    }

    /**
     * Permet de se connecter
     */
    public function connexion(){
        $connexion = $this->getUser($_POST['email']);

        if(!empty($_POST['email']) && !empty($_POST['mdp'])){
            if(password_verify($_POST['mdp'], $connexion['mdp'])){
                $_SESSION = $connexion;
                echo '
                <div class="container">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Vous êtes connecté, redirection en cours
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                ';
                header('Refresh:3, url=?page=categories&action=list', true, 303);
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

    /**
     *  Permet de se déconnecter
     */    
    public function deconnexion(){
        unset($_SESSION);
        session_destroy();
    }

    /**
     * Permet de d'afficher tout les utilisateurs
     */
    public function getUsers(){
        ob_start();
        $utilisateurs = $this->findAll();
        require_once 'views/utilisateurs/list.php';
        $page = ob_get_clean();

        return $page;
    }

    /**
     * Permet de modifier le rôle d'un utilisateur
     */
    public function updateRoleUtilisateur(){
        if(isset($_POST['modifierRole'])){
            $this->updateRole($_POST['utilisateurs'], $_POST['idUtilisateur']);
        }
    }
}