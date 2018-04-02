<?php
/**
 * Created by PhpStorm.
 * User: a15020769
 * Date: 26/03/18
 * Time: 14:16
 */
require ("json/liste.php");

$tableau= charger();
?>
<head>
    <meta charset="UTF-8">
    <title>miralis</title>
    <link rel="stylesheet" href="style.css">
</head>
<div id="titre">
    <h1>Liste des joueurs</h1>
</div>

<div id="cssmenu">
    <ul>
        <li class="active">
            <a href="index.html" data-title="Acceuil" >
                Acceuil
            </a>
        </li>
        <li>
            <a href="afficherJoueur.php" data-title="afficher liste Joueurs">
            afficher liste Joueurs
            </a>
        </li>
        <li>
            <a href="matchmaking.php" data-title="à toi de jouer">
                à toi de jouer
            </a>
        </li>
    </ul>
</div>

<div id="table">
<table align="center">
    <tr>
        <th>Pseudo</th>
        <th>ID</th>
        <th>HR</th>
        <th>role</th>
    </tr>

    <?php
    foreach($tableau as $ligne) {?>
        <tr>
            <td> <?php echo $ligne["playerID"] ; ?> </td>
            <td> <?php echo $ligne["id"] ; ?> </td>
            <td> <?php echo $ligne["HR"] ; ?> </td>
            <td> <?php echo $ligne["role"] ; ?> </td>
        </tr>
    <?php }?>

</table>
</div>