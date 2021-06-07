<?php

    require('data.base/connexion_bdd.php'); //connexion au serveur de base de données
    include('class/classuser.php');
    $langue = new langues();
    $leslangues = $langue->getLangues();

?>

<html>

    <body>

        <form method="POST">

            <label>
                <u>
                    <b>
                        Choisir votre langue:
                    </b>
                </u>
            </label>


            <br>


            <!-- LISTE DEROULANTE  -->
            <?php
                if ($leslangues->num_rows > 0) { //si result affiche un nombre de ligne suppérieur à 0
                    echo "<select name='langues' >";
                    foreach ($leslangues as $k => $v) {
                        echo " <option value= '" . $v['translate'] . "'>";
                        echo $v['name'];
                        echo " </option>";
                    }
                    echo "</select>";
                }

                $connect_bdd->close();
            ?>
            <!-- fin
                LISTE DEROULANTE  -->


            <!-- INPUT POUR ENTRER UN PRENOM -->
            <input type='text' name='prenom' placeholder='Prénom'></input>
            <input type='submit' name='btnValider' value="Valider"></input>


            <br>


            <!-- BUTTON POUR VALIDER L'ACTION -->
            <?php
                if (isset($_POST['btnValider'])) {
                    $prenom = $_POST['prenom'];
                    $langue = $_POST['langues'];
                    echo $langue . "  ";
                    echo $prenom;
                }
            ?>

        </form>

    </body>

</html>