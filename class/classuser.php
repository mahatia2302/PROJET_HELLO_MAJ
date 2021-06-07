<?php

    include("data.base/connexion_bdd.php");

        class langues {

            /**
             * Data recovery from "langue"
             *
             *
             */
            public function getLangues(){

                global $connect_bdd;
                $reqLangue = "select * From langue";
                $resLangue = $connect_bdd->query($reqLangue);

                return $resLangue;

            }

        }

?>