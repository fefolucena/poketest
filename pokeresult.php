<?php
    include ('pokeinfo.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Poketest</title>
        <meta name="viewport" content="width=device-widinitial-scale=1">
        <link rel="icon" type="image/png" href="fav-ic/pokeball.png" />
    </head>
    <body>
        <div class="poke-body">
        <h1><a href="/pokedex.php">POKEDEX</a></h1>
            <?php $pokeLocations = getPokemonLocations(validateGenerationPokemon(getGenerationPokemon($_POST["poke-generation"]),$_POST["poke-move"])); 
            if($pokeLocations == []) : ?>
                <h2><p>No Pokemons found for this filter: </p></h2>
                <div><p></p></div>
                <?php else : ?>
                    <?php foreach($pokeLocations as $pokeInfos) :?>
                        <button class="accordion"><?php echo $pokeInfos['pokemonName']?></button>
                        <div class="panel">
                            <span class="poke-locations">Location areas:</span>
                            <?php for($count = 0; $count < sizeof($pokeInfos['locations'][0]); $count++) : ?>
                                <p><?php echo $pokeInfos['locations'][0][$count] ?></p>
                            <?php endfor; ?>
                        </div>
                    <?php endforeach;?>
                <?php endif; ?>
        </div>
        <div class="return"><span><a href="/pokedex.php"><- Go back</a></span></div>
        <script src="script.js"></script>
    </body>
</html>