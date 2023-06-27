<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Panneau d'administration</title>
  <link rel="stylesheet" href="styles/style.css">
</head>
<body>
  <div class="container">
    <div class="header">
      <p>Panneau d'administration</p>
    </div>
    <div class="menu">
        <form action="index.php"  method="POST">
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="?page=user">Utilisateurs</a></li>
            <li><a href="?page=settings">Paramètres</a></li>
            
                <?php 
                if (isset($_SESSION) and !empty($_SESSION)){ ?>
                    <input class="deconnexion" type="submit" name="submitDeconnexion" value="Deconnexion">
                <?php } else { ?>
                    <li><a href="?page=connexion">Connexion</a></li>
                <?php }
                ?>
        </ul>
        </form>
        <br>
        <?php
        if (isset($_SESSION) && !empty($_SESSION)){ ?>
            <p>Bienvenue <?php echo $_SESSION['data']['prenom']; ?> <?php echo $_SESSION['data']['nom']; ?></p>
        <?php }
        

        ?>
    </div>
    <div class="content">

      <!-- Contenu de la page d'administration -->
      <?php 
        if ((isset($_GET['page']) && $_GET['page'] == "connexion") || (empty($_SESSION))){ ?>
        <div>
            <form action="index.php" class="formConnexion" method="POST">
                    <label for="identifiant">Identifiant</label>
                    <br>
                    <input type="text" name="identifiant">
                    <br>
                    <label for="identifiant">Mot de passe</label>
                    <br>
                    <input type="password" name="password" >
                    <br>
                    <input type="submit" name="submitConnexion" value="Se connecter">
            </form>
        </div>
        <?php }
        if (isset($_POST['submitDeconnexion'])){
            session_destroy(); ?>
            <p class="alert success">Vous êtes maintenant déconnecté</p>
            <?php 
        }

        if (isset($_POST['submitConnexion'])){
            if ($_POST['identifiant'] == "thomas" and $_POST['password'] == "123456"){
                $_SESSION['data'] = [
                                    'prenom' => "Thomas",
                                    'nom' => "Brandt",
                                    'age' => 34,
                                    'role' => 'Formateur'
                                ];
                                ?>
                <p class="alert success">Vous êtes maintenant connecté</p>
                <?php
            }
            else{ ?>
                <p class="alert error">Mot de passe ou identifiant incorrect</p> 
            <?php }
        }

        if (isset($_GET['page']) && $_GET['page'] == 'user' && empty($_SESSION)){ ?>
            <p class="alert warning">Vous devez être connecté pour pouvoir avoir accès à cette partie du site</p>
        <?php }

        if (isset($_GET['page']) && $_GET['page'] == 'user' && !empty($_SESSION)){ ?>
            <h1>Vos informations utilisateurs</h1>
            <p>Nom : <?php echo $_SESSION['data']['nom']; ?></p>
            <p>Prénom : <?php echo $_SESSION['data']['prenom']; ?></p>
            <p>Age : <?php echo $_SESSION['data']['age']; ?></p>
            <p>Rôle : <?php echo $_SESSION['data']['role']; ?></p>
        <?php }

        if (isset($_GET['page']) && $_GET['page'] == 'settings' && empty($_SESSION)){ ?>
            <p class="alert warning">Vous devez être connecté pour pouvoir avoir accès à cette partie du site</p>
        <?php }

        if (isset($_GET['page']) && $_GET['page'] == 'settings' && !empty($_SESSION)){ ?>
            <form action="index.php"  method="POST" class="formConnexion" >
                <h1>Modification de vos paramètres</h1>
                <label for="nom">Nom</label>
                <input type="text" name="nom" value="<?php echo $_SESSION['data']['nom']; ?>">
                <br>
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" value="<?php echo $_SESSION['data']['prenom']; ?>">
                <br>
                <label for="age">Age</label>
                <input type="number" name="age" value="<?php echo $_SESSION['data']['age']; ?>">
                <br>
                <label for="role">Rôle</label>
                <input type="text" name="role" value="<?php echo $_SESSION['data']['role']; ?>">
                <br>
                <input type="submit" name="submitUpdate" value="Modifier">
            </form>
        <?php }

        if (isset($_POST['submitUpdate'])){
            if (empty($_POST['prenom']) || empty($_POST['nom']) || empty($_POST['age']) || empty($_POST['role'])){ ?>
                <p class="alert error">Toutes les informations ont besoin d'être renseigné</p>
            <?php }
            else{
                $_SESSION['data']['prenom'] = $_POST['prenom'];
                $_SESSION['data']['nom'] = $_POST['nom'];
                $_SESSION['data']['age'] = $_POST['age'];
                $_SESSION['data']['role'] = $_POST['role'];
                ?>
                <p class="alert success">Les données utilisateurs ont bien été mis à jour</p>
            <?php }
        }



      ?>
    </div>
  </div>
</body>
</html>
