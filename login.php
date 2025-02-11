<?php require('actions/loginAc.php'); ?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php';?>
<body>
    <br><br>
    <form class="container" method="POST">
        <?php if(isset($msgErreur)){ echo '<p>'.$msgErreur.'</p>'; } ?> 

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nom d'utilisateur</label>
            <input type="text" class="form-control" name="pseudo">
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="btn btn-primary" name="validate">Connexion</button>
        <br><br>
        <a href="inscription.php"><p>Nouveau ici?</p></a>
    </form>
   
</body>
</html>