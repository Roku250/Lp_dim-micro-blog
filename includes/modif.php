<?php 

include("includes/connexion.inc.php");
$query="SELECT id FROM messages(contenue, date) VALUES(:contenue, :date)";

?>