<?php

class ProduitManager extends BDD{
    /**
     * Récupère les produits en fonction de l'id de la catégorie
     */
    public function findByCatgeorie($id){
        $sql = 'SELECT *
                FROM produit
                WHERE categorie = ?';
        $req = $this->co->prepare($sql);
        $req->execute([$id]);

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère les informations d'un produit en fonction de son id
     */
    public function getInfos($id){
        $sql = 'SELECT *
                FROM produit
                WHERE id = ?';
        $req = $this->co->prepare($sql);
        $req->execute([$id]);

        return $req->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Permet d'ajouter un produit
     */
    public function save($nom, $description, $qte, $prix, $categorie){
        $sql = 'INSERT INTO produit(nom, description, qte, prix, categorie)
                VALUES(?, ?, ?, ?, ?)';
        $req = $this->co->prepare($sql);
        $req->execute([$nom, $description, $qte, $prix, $categorie]);
    }

    /**
     * Permet d'éditer une produit
     */
    public function edit($nom, $description, $qte, $prix, $categorie, $id){
        $sql = 'UPDATE produit
                SET nom = ?, description = ?, qte = ?, prix = ?, categorie = ?
                WHERE id = ?';
        $req = $this->co->prepare($sql);
        $req->execute([$nom, $description, $qte, $prix, $categorie, $id]);
    }

    /**
     * Permet de supprimer un produit
     */
    public function delete($id){
        $sql = 'DELETE
                FROM produit
                WHERE id = ?';
        $req = $this->co->prepare($sql);
        $req->execute([$id]);
    }
}