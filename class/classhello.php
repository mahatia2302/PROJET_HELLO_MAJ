<?php

    include("data.base/connexion_bdd.php");

        class hello {
            
            /**
             * Delete lang selected from "langue"
             *
             * @param int $id 
             *
             */
            public function  deletelang($id){
                
                global $connect_bdd; 
                //sql to delete a record
                $sql_delete = "DELETE FROM langue WHERE id=".$id;

                // execute la requête précédente
                $res = $connect_bdd->query($sql_delete);
                return $res;

            }
            
            /**
             * Description of function 
             *
             * @return $res_listLivres
             */
            public function getLang(){
                global $connect_bdd; 

                $req_lang = "SELECT * from langue" ; //$sql : contient la requete sql 
                $res_lang = $connect_bdd->query($req_lang); //$result : execute la requete $sql

                return $res_lang;

            }

                
            /**
             * create hello into "langue"
             *
             * @param string $name
             * @param string $translate
             *
             */
            public function createLang($name,$translate){

                global $connect_bdd;
                $sql = "INSERT INTO `langue`(`name`,`translate`) VALUES ('$name' , '$translate' )";
                $res = $connect_bdd->query($sql);
                return $res;
            }

            
            
            /**
             * Update DbShoop "livres"
             *
             * @param string $new_name 
             * @param string $new_translate 
             * @param int $id_langue
             *
             */
            public function updateLang($new_name,$new_translate,$id_langue){
                global $connect_bdd;

                $sql_update = "UPDATE `langue` SET `name`= '$new_name',`translate`= '$new_translate'  WHERE id =".$id_langue;
                $res = $connect_bdd->query($sql_update);
                return $res;

            }

        }