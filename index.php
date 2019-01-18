<!DOCTYPE html>
        <html lang="fr">
        <body id="page-top" class="index">

            <?php 
                include("includes/connexion.inc.php");
                include("includes/haut.inc.php");
                if(isset($_GET['id'])){
                    $modif = $_GET['id'];

                }
            ?>
        <p><?php
            if (isset($_COOKIE['pseudo'])) {
                echo 'Bonjour '.$_COOKIE['pseudo'].' !';
            }else {
                echo 'Notre cookie n\'est pas déclaré.';
            }
        ?>
        </p>
            <section>
                <div class="container">
                    <div class="row">
                        <form action="message.php" method="POST">
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <textarea id="message" name="message" class="form-control" placeholder="Message"><?php 
                                        if(isset($_GET['id'])){
                                            $query="SELECT * FROM messages WHERE id=$modif ";
                                            $stmt=$pdo->query($query);
                                            while($data=$stmt->fetch()){
                                                echo $data['contenu'];
                                            }
                                        }else{
                                        }
                                    ?></textarea>
                                    <input type="hidden" id="id" name="id" value=" <?php if(isset($_GET['id'])){ echo $_GET['id'];}else{echo 0;} ?> "></input>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-success btn-lg">Envoyer</button>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <?php 
                            //Combien de message seront afficher
                            $result_per_page=5;
                            $query="SELECT * FROM messages";
                            $stmt=$pdo->query($query);
                            $number_of_results = $stmt->rowCount();/*
                                Vielle méthode d'affichage sans trie

                            while($data=$stmt->fetch()){  
                        ?>
                                <blockquote><?php echo $data['contenu']; ?></blockquote>
                                <a href='index.php?id=<?php echo $data['id']; ?>'>
                                    <button name='d' type='submit' class='btn btn-secondary'>Modifier</button>
                                </a> 
                                <a href=' <?php echo "includes\supprimer.php?id=".$data['id'];?>'> 
                                    <button name='dd' type='submit' class='btn btn-secondary'>supression</button>
                                </a>
                                <a href='#' data-value='<?php echo $data['jaime']; ?>' class='btn-secondary btn jaime' id='<?php echo $data['id'];?>'>
                                    <span id="vote<?php echo $data['id']?>" >J'aime <?php echo "(".$data['jaime'].")"; ?>
                                </a><br>
                              
                        <?php  echo gmdate("Y-m-d H:i:s",$data['date'] ); ?><br><br><?php
                            }*/
                            // determine le nombre de message disponible
                            $nombre_de_page = ceil($number_of_results/$result_per_page);

                            //Determine sur quel page le visiteur est 
                            if(!isset($_GET['page'])){
                                $page=1;
                            }else{
                                $page = $_GET['page'];
                            }
                            
                            // Calcule à partir de quand il faut afficher le message
                            $premier_message_de_la_page = ($page-1)*$result_per_page;
                            // Trie les message
                            $query='SELECT * FROM messages LIMIT ' . $premier_message_de_la_page . ',' .  $result_per_page;
                            $stmt=$pdo->query($query);
                            $number_result = $stmt->rowCount();
                            while($data=$stmt->fetch()){  
                                ?>
                                    
                                        <blockquote><?php echo $data['contenu']; ?></blockquote>
                                        <a href='index.php?id=<?php echo $data['id']; ?>'>
                                            <button name='d' type='submit' class='btn btn-secondary'>Modifier</button>
                                        </a> 
                                        <a href=' <?php echo "includes\supprimer.php?id=".$data['id'];?>'> 
                                            <button name='dd' type='submit' class='btn btn-secondary'>supression</button>
                                        </a>
                                        <a href='#' data-value='<?php echo $data['jaime']; ?>' class='btn-secondary btn jaime' id='<?php echo $data['id'];?>'>
                                            <span id="vote<?php echo $data['id']?>" >J'aime <?php echo "(".$data['jaime'].")"; ?>
                                        </a><br>
                                      
                                <?php  echo gmdate("Y-m-d H:i:s",$data['date'] ); ?><br><br><?php
                                    }
                            //Compteur de page?>
                            <div style="width:100%;text-align:center">
                            <?php
                            
                            for ($page=1;$page<=$nombre_de_page;$page++)
                            {
                                echo'<a style="font-size:18px" href="index.php?page='.$page.'">' .$page. '</a>';
                            }
                        ?> 
                        </div>
                    </div>
                </div>
                </div>
            </section>
            <?php include("includes/bas.inc.php"); ?>
            <!-- jQuery -->
            <script src="vendor/jquery/jquery.min.js"></script>
            <!-- Bootstrap Core JavaScript -->
            <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
            <!-- Plugin JavaScript -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
            <!-- Theme JavaScript -->
            <script src="js/freelancer.min.js"></script>
            <!--Javascript perso-->
            <script src="js/script.js"></script>
        </body>
</html>