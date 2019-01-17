<?php 
if(isset($_POST['postid'])){
    include("includes/connexion.inc.php");

    $ip=$_SERVER['REMOTE_ADDR'];
    $id=$_POST['postid'];

    $query="SELECT dernierip FROM messages WHERE id=:id";
$prep=$pdo->prepare($query);
$prep->bindValue(':id', $id);
$prep->execute();
$lastIp = $prep->fetch();
$lastVote = $lastIp['0'];

    if ($ip =! $lastVote) {
        $query="UPDATE messages SET jaime = jaime+1,dernierip =:ip where id=:id";
        $prep=$pdo->prepare($query);
        $prep->bindValue(':ip',$ip);
        $prep->bindValue(':id',$id);
        $prep->execute();
    
    
        $query2="SELECT * FROM messages where id=:id";
        $prep2=$pdo->prepare($query2);
        $prep2->bindValue(':id',$id);
        $prep2->execute();
        $return = $prep2->fetch();
    
        echo(json_encode($return));
        
         
    }else {
        echo "vous avez déja voté";
    }
}