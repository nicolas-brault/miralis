<?php
/**
 * Created by PhpStorm.
 * User: c16000805
 * Date: 26/03/18
 * Time: 13:51
 */

 public function charger (){
     $json_source = file_get_contents(/dev/players.json);

     return $json_source;

}