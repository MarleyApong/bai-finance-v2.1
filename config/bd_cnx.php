<?php

    try {
        $database = new PDO('mysql:host=sql213.epizy.com; dbname=epiz_33872961_fi', 'epiz_33872961', 'naU1ncMuyPLKICa',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    } catch (PDOException $e) {
        die("Echec de la connexion : " . $e->getMessage());
        exit();
    }
    return $database;
