<nav class="navbar bg-dark text-light fixed-top navbar-dark ml-auto">
    <div class="col">
        <span class="lead">Super Messenger</span>
        <div class="float-right">
            <span class="mr-4"><i class="fas fa-user"></i> <?=$user['username'] ?></span>
            <a name="" id="" class="btn btn-light" href="src/logout.php" role="button">Se déconnecter</a>
        </div>
    </div>
</nav>


<!-- MESSAGES -->
<ul class="messages list-unstyled" id="messages">

    <!-- TEMPLATE MES MESSAGES -->
    <li class="message me media d-none">
        <div class="avatar float-left">
            <img src="" class="rounded-circle img-thumbnail"/>
        </div>
        <div class="media-body">
            <small class="infos"></small>
            <div class="content bg-primary text-right text-light">
            </div>
        </div>    
    </li>

    <!-- TEMPLATE AUTRES MESSAGES -->
    <li class="message not-me media d-none">
        <div class="media-body">
            <small class="infos"></small>
            <div class="content bg-light text-left">
            </div>
        </div>
        <div class="avatar float-right">
            <img src="" class="rounded-circle img-thumbnail"/>
        </div>
    </li>
</ul>




<nav class="navbar bg-primary fixed-bottom navbar-dark">
    <form id="message-form" method="POST">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Entrez votre message" name="message"/>
            <div class="input-group-append">
                <button type="submit" class="btn btn-dark"><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
    </form>
</nav>