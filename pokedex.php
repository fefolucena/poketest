<?php include ('pokeinfo.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="script.js"></script>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Poketest</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="fav-ic/pokeball.png" />
    </head>
    <body>
        <div class="poke-body">
            <h1><a href="/pokedex.php">POKEDEX</a></h1>
            <?php if(ISSET($_GET["generation"]) == false || ISSET($_GET["type"]) == false) : ?>
                <form action="pokefilter.php" method="get">
                    <span class="poke-span">Select the generation you wish to filter: </span>
                    <select name="poke-generation" class="poke-generation">
                        <?php $gen_num = getGenerations(); for($count = 1; $count <= $gen_num; $count++) : ?>
                            <option class="poke-option" value="<?php echo $count ?>"><?php echo $count ?></option>
                        <?php endfor ?>
                    </select>
                    <br><br>
                    <fieldset class="poke-fieldset">
                        <legend class="poke-span">Select the attack types you wish to filter: </legend>
                            <?php $attackTypes = getAttackTypes(); foreach($attackTypes as $attackType) : ?>
                                <div><input type="checkbox" name="poke-attack-type[]" id="<?php echo $attackType ?>" value="<?php echo $attackType ?>"><?php echo $attackType ?><div>
                            <?php endforeach; ?>
                    </fieldset>
                    <input type="submit" value="Submit" onClick="verificarCheckBox()">
                </form>
            <?php endif; ?>

            <?php if(ISSET($_GET["generation"]) == true && ISSET($_GET["type"]) == true) : ?>
                <form action="pokeresult.php" method="post">
                    <br><br>
                    <fieldset>
                        <legend class="poke-span">Select the move you'd like to learn for the filter: "Generation <?php echo($_GET["generation"]); ?>" and "Attack types: <?php echo($_GET["type"]); ?>"</legend>
                    <?php $moves = getMoves($_GET["type"]); foreach($moves as $move) : ?>
                        <div class="poke-move"><input type="radio" name="poke-move" id="<?php echo $move ?>" value="<?php echo $move ?>"><span><?php echo $move ?></span></div>
                    <?php endforeach ?>
                    </fieldset class="poke-fieldset">
                    <input type="hidden" name="poke-generation" value="<?php echo($_GET["generation"]); ?>">
                    <input type="submit" value="Submit">
                </form>
                <div class="return"><span><a href="/pokedex.php"><- Go back</a></span></div>
            <?php endif; ?>
        </div>
    </body>
</html>