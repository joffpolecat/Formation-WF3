<h1>Messagerie</h1>
<div class="row">
    <div class="col-6">
        <form action="" method="post">
            <div class="card">
                <div class="card-header">
                    <span class="lead">Se connecter</span>
                </div>
                <div class="card-body">
                    <div class="form-error badge badge-danger"></div>
                    <div class="form-group">
                        <label for="username">Nom d'utilisateur</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Nom d'utilisateur">
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-dark" name="login">Se connecter</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-6">
    <form action="" method="post" enctype="multipart/form-data" id="register-form">
            <div class="card">
                <div class="card-header">
                    <span class="lead">Créer un compte</span>
                </div>
                <div class="card-body">
                    <div class="form-error badge badge-danger"></div>
                    <div class="form-group">
                        <label for="username">Nom d'utilisateur</label>
                        <input type="text" class="form-control" name="username" id="user" placeholder="Nom d'utilisateur">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" name="password" id="pass" placeholder="Mot de passe">
                    </div>
                    <div class="form-group">
                        <label for="avatar">Avatar</label>
                        <input type="file" class="form-control-file" name="avatar" id="avatar">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-dark" name="register">S'enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>