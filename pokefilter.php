<?php
    include ('pokeinfo.php');

    header("Location: /pokedex.php?generation=" . $_GET['poke-generation'] . '&type=' . attackTypesQuery($_GET['poke-attack-type']));