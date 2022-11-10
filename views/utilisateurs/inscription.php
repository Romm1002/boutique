<body>
    <div class="container">
        <form method="post" class="card p-4">
            <h1>Inscription</h1>
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control">

            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" name="prenom" id="prenom" class="form-control">

            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control">

            <label for="mdp" class="form-label">Mot de passe</label>
            <input type="password" name="mdp" id="mdp" class="form-control">

            <label for="repeatMdp" class="form-label">Répétez le mot de passe</label>
            <input type="password" name="repeatMdp" id="repeatMdp" class="form-control">

            <input type="submit" value="S'inscrire" class="btn btn-primary rounded-0 mt-3">
        </form>
    </div>
</body>