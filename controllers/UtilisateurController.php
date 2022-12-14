<?php

class UtilisateurController extends UtilisateurManager{
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
        if(!empty($_POST['nom']) && !empty($_POST['prenom']) &&!empty($_POST['email']) && !empty($_POST['mdp']) && !empty($_POST['repeatMdp'])){
            if(!is_array($this->getUser($_POST['email']))){
                if(preg_match('^\S*(?=\S{12,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$^', $_POST['mdp'])){
                    if($_POST['mdp'] === $_POST['repeatMdp']){
                        $mdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
                        $this->save(htmlspecialchars($_POST['nom']), htmlspecialchars($_POST['prenom']), htmlspecialchars($_POST['email']), $mdp, 'utilisateur');
                        echo '
                        <div class="container">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Vous avez bien été inscrit. Vous pouvez désormais vous connecter.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        ';
                    }else{
                        echo '
                        <div class="container">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Les mots de passe ne correspondent pas.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        ';
                    }
                }else{
                    echo '
                    <div class="container">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Le mot de passe n\'est pas assez long et/ou ne respecte pas le RGPD (12 caractères, 1 lettre miniscule, 1 lettre majuscule, 1 chiffre et 1 caractère spécial minimum)
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    ';
                }
            }else{
                echo '
                <div class="container">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Cette adresse e-mail est déjà utilisé pour un autre compte.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                ';
            }
        }else{
            echo '
            <div class="container">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Les champs ne peuvent pas être vide.
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
            if(is_array($connexion)){
                if(password_verify($_POST['mdp'], $connexion['mdp'])){
                    $_SESSION = $connexion;
                    echo '
                    <div class="container">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Vous êtes connecté, redirection en cours.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    ';
                    header('Refresh:3, url=?page=categories&action=list', true, 303);
                }else{
                    echo '
                    <div class="container">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            L\'adresse e-mail ou le mot de passe sont incorrect.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    ';
                }
            }else{
                echo '
                <div class="container">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Cette adresse e-mail n\'est associée à aucun compte.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                ';
            }
        }else{
            echo '
            <div class="container">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Les champs ne peuvent pas être vide.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        ';
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
            $this->updateRole(htmlspecialchars($_POST['utilisateurs']), htmlspecialchars($_POST['idUtilisateur']));
        }
    }

    /**
     * Permet de savoir si l'utilisateur connecté est Admin
     */
    public static function isNotAdmin(){
        if(!empty($_SESSION) && $_SESSION['role'] != 'admin'){
            header('location:?page=categories&action=list');
        }
        if(empty($_SESSION)){
            header('location:?page=categories&action=list');
        }
    }
}