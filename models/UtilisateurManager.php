<?php

class UtilisateurManager extends BDD{
    /**
     * Permet d'insérer un utilisateur en BDD
     */
    public function save($email, $mdp, $role){
        $sql = 'INSERT INTO utilisateur(email, mdp, role)
                VALUES(?, ?, ?)';
        $req = $this->co->prepare($sql);
        $req->execute([$email, $mdp, $role]);
    }

    /**
     * Récupère l'email, l'id et le rôle en BDD
     */
    public function getUser($email){
        $sql = 'SELECT *
                FROM utilisateur
                WHERE email = ?';
        $req = $this->co->prepare($sql);
        $req->execute([$email]);

        return $req->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère tout les utilisateurs
     */
    public function findAll(){
        $sql = 'SELECT *
                FROM utilisateur';
        $req = $this->co->prepare($sql);
        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Permet de modifier le rôle d'un utilisateur
     */
    public function updateRole($role, $id){
        $sql = 'UPDATE utilisateur
                SET role = ?
                WHERE id = ?';
        $req = $this->co->prepare($sql);
        $req->execute([$role, $id]);
    }
}