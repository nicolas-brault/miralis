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
<table border="1px">

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