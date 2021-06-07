<?php
    require('data.base/connexion_bdd.php'); //connexion au serveur de base de données
    include('class/classhello.php');

    // instancier OU appeler une class (object)
    $hello = new hello();

    // =========================
    // gestion des boutons
    // =========================

    if (isset($_POST['btn'])) {

        // si bouton == supprimer
        if ($_POST['btn'] == "Supprimer") {
            $etat = "fermer";

            // je récupère les langues supprimer
            $id = $_POST['id_langue'];

            // j"execute ma requête supprimer
            // dans ma fonction deletelang
            $res_delete = $hello->deleteLang($id);

            if ($res_delete
             == true) {
                $notif_final = 'succes';
            }else{
                $notif_final = 'error';
            }
        }

        // si bouton == modifier
        if ($_POST['btn'] == "Modifier") {
            $etat = "ouvrir";
            $id_clique = $_POST['id_langue'];
        }

        if ($_POST['btn'] == "Confirmer") {
            $etat = "fermer";
            $new_name = $_POST['new_name'];
            $new_translate = $_POST['new_translate'];
            $id_langue = $_POST['id_langue'];

           $res_update = $hello->updateLang($new_name, $new_translate, $id_langue);

            if ($res_update == true) {
                $notif_final = 'succes';
            }else{
                $notif_final = 'error';
            }
        }

        // si bouton == valider
        if ($_POST['btn'] == "Valider") {

            $etat = "fermer";

            // récupérer les valeurs 
            $name = $_POST['name']; //Variable $nom contient les données de l'input 'nom'

            $translate = $_POST['translate']; //Variable $nom contient les données de l'input 'translate'

            $res_create = $hello->createLang($name, $translate);

            if ($res_create == true) {
                $notif_final = 'succes';
            }else{
                $notif_final = 'error';
            }
        }

    } else {

        $etat = "fermer";

    }

    // j'affiche ma liste
    $res_lang = $hello->getLang();

?>

<html>

    <head>

        <!-- META -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- CSS -->
        <link href="./assets/styles/style.css" rel="stylesheet">

        <title>Brief HELLO</title>

        <!-- BOOTSTRAP -->
        <!-- CSS -->
        <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">
        <!-- JS -->
        <script src="assets/bootstrap/js/popper.min.js"></script>
        <script src="assets/bootstrap/js/jquery-slim.min.js"></script>
        <!-- <script src="bootstrap/js/bootstrap.min.js"></script> -->
        <script src="assets/bootstrap/js/bootstrap.js"></script>
        <script src="assets/bootstrap/js/util.js"></script>

        <!-- JQ and JVS -->
        <script src="jquery.js"></script>
        <script language="javascript">
        
            // quand tous les element HTML sont executer
            // executer la function 
            $(document).ready(function(){

                    $('.success').delay(2000).hide('fast');
                    $('.error').delay(2000).hide('fast');

            })

        </script>

    </head>

    <body>

        <!-- affichage notification -->
        <div>
            <?php
                if(!empty($notif_final)){
                    
                    if($notif_final == 'succes'){

                        echo '<div style="background-color: green;" class="success">Réussi!</div>';

                    }else{

                        echo '<div style="background-color: red;" class="error">Quel échec :D !</div>';

                    }

                }
            ?>
        </div>

        <div class="row">

            <div class="col-md-9">

                <label>
                    <u>
                        <b>
                            Langue
                        </b>
                    </u>
                </label>

                <?php

                    // CONDITIONS \\
                    // Afficher la liste des langues
                    //si $res_lang contient au moins une données 
                    if ($res_lang->num_rows > 0) {
                        //faire ceci
                        echo "<table>";

                            echo "<th>";
                                echo "Name";
                            echo "</th>";

                            echo "<th>";
                                echo "Translate";
                            echo "</th>";

                            echo "<th>";
                                echo "Actions";
                            echo "</th>";

                        foreach ($res_lang as $valeur) { //Boucle : Pour chaque resultat 

                            if (($etat == "ouvrir") && ($id_clique == $valeur['id'])) {

                                echo '<form method="post">';
                                    echo "<input type='hidden' name='id_langue' value=" . $valeur['id'] . ">";
                                        echo "<tr>";

                                            echo "<td>";
                                                echo "<input type='text' name='new_name'  value='" . $valeur['name'] . "'>";
                                            echo "</td>";

                                            echo "<td>";
                                                echo "<input type='text' name='new_translate'  value='" . $valeur['translate'] . "'>";
                                            echo "</td>";

                                            echo "<td>";
                                                echo "<input type='submit' name='btn' value='Confirmer'/>";
                                            echo "</td>";

                                        echo "<tr>";
                                echo '</form>';

                                // -------------------------------------------------------
                            } else {

                                echo "<tr>";

                                    echo "<td>";
                                        echo $valeur['name'];
                                    echo "</td>";

                                    echo "<td>";
                                        echo $valeur['translate'];
                                    echo "</td>";

                                    echo "<td>";

                                        echo '<form method="post">';

                                            echo "<input type='submit' name='btn' value='Modifier'/>";
                                            echo "<input type='hidden' name='id_langue' value=" . $valeur['id'] . ">";

                                        echo '</form>';

                                        echo '<form method="post">';

                                            echo "<input type='hidden' name='id_langue' value=" . $valeur['id'] . ">";
                                            echo "<input type='submit' name='btn' value='Supprimer'/>";

                                        echo '</form>';

                                    echo "</td>";

                                echo "</tr>";
                            }
                        }

                        echo "</table>";
                        
                    } else { //sinon
                        //faire cela
                        echo "Il n'y a aucun résultats";
                    }

                ?>

            </div>

            <br>

            <div class="col-md-3">

                <label>
                    <u>
                        <b>
                            Ajouter une langue
                        </b>
                    </u>
                </label>

                    <?php

                        // <!-- AJOUTER UNE LANGUE  -->
                        // action="index.php" à placer juste en dessou 
                        echo '<form  method="POST">';

                            echo '<u>';
                                echo '<p>';
                                    echo 'Ajouter une langue:';
                                echo '</p>';
                            echo '</u>';

                            echo '<p>';
                                echo '<input type="text" name="name" placeholder="Nom">';
                            echo '</p>';

                            echo '<p>';
                                echo '<input type="text" name="translate" placeholder="translate">';
                            echo '</p>';

                            echo '<p>';
                                echo '<input type="submit" name="btn" value="Valider">';
                            echo '</p>';

                        echo '</form>';

                    ?>

            </div>

        </div>

    </body>

</html>