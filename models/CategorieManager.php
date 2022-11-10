<?php

class CategorieManager extends BDD{
    /**
     * Récupère toutes les catégories
     */
    public function findAll(){
        $sql = 'SELECT * FROM categorie';
        $req = $this->co->prepare($sql);
        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Permet d'inserer une nouvelle catégorie en BDD
     */
    public function save($nom){
        $sql = 'INSERT INTO categorie(nom)
                VALUES(?)';
        $req = $this->co->prepare($sql);
        $req->execute([$nom]);
    }

    /**
     * Permet de modifier le nom d'une catégorie en BDD
     */
    public function update($nom, $id){
        $sql = 'UPDATE categorie
                SET nom = ?
                WHERE id = ?';
        $req = $this->co->prepare($sql);
        $req->execute([$nom, $id]);
    }

    /**
     * Permet de supprimer la catégorie en BDD
     */
    public function delete($id){
        $sql = 'DELETE
                FROM categorie
                WHERE id = ?';
        $req = $this->co->prepare($sql);
        $req->execute([$id]);
    }
}