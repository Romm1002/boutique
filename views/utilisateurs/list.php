<body>
    <div class="container">

        <a href="?page=categories" class="btn btn-secondary rounded-0 mb-4">Retour</a>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Email</th>
                    <th scope="col">Rôle</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($utilisateurs as $utilisateur){
                        ?>
                        <tr>
                            <td><?=$utilisateur['id'];?></td>
                            <td><?=$utilisateur['email'];?></td>
                            <td>
                                <form method="post" class="d-flex align-items-center justify-content-between">
                                    <input type="hidden" name="idUtilisateur" value="<?=$utilisateur['id'];?>">
                                    <select name="utilisateurs" id="utilisateurs" class="form-select rounded-0" style="width: 70%;">
                                        <option value="utilisateur" <?=$utilisateur['role'] == 'utilisateur' ? 'selected' : '';?>>Utilisateur</option>
                                        <option value="admin" <?=$utilisateur['role'] == 'admin' ? 'selected' : '';?>>Administrateur</option>
                                    </select>
                                    <input type="submit" name="modifierRole" value="Modifier" class="btn btn-success rounded-0">
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>