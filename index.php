<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pokedex php</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php

    // First check if input field in the form is set, if not assign an id number of a pokemon to avoid error messages

    if (!empty($_GET["poke_input"])) {
        $input = $_GET["poke_input"];

        // Get JSON data from API
        @$get_poke_data = file_get_contents("https://pokeapi.co/api/v2/pokemon/$input");
        @$get_poke_species = file_get_contents("https://pokeapi.co/api/v2/pokemon-species/$input");

        // Decode JSON data into PHP array
        $poke_data = json_decode($get_poke_data, true);
        $poke_species = json_decode($get_poke_species, true);

        } else {
            @$get_poke_data = file_get_contents("https://pokeapi.co/api/v2/pokemon/1");
            @$get_poke_species = file_get_contents("https://pokeapi.co/api/v2/pokemon-species/1");

            $poke_data = json_decode($get_poke_data, true);
            $poke_species = json_decode($get_poke_species, true);
        }

    // Assign variables to selected data
    $poke_name = $poke_data["name"];
    $poke_id = $poke_data["id"];
    $poke_img = $poke_data["sprites"]["front_default"];
    $poke_text = $poke_species["flavor_text_entries"][0]["flavor_text"];

    // Loop to show four moves in a list
    function showMoves($moves){
        echo "<h2>Abilities:</h2>";
        echo "<ol class='poke-moves-list'>";
        for ($x = 0; $x < 4; $x++) {
            $poke_moves = $moves['moves'][$x]["move"]["name"];
            echo "<li>$poke_moves</li>";
        }
        echo "</ol>";
    }

    // Check if previous species is present, if it returns null, echo a message, else show evolution name and image
    function hasEvolved($poke_species){
        $poke_evolve_name = $poke_species["evolves_from_species"];
        if (is_null($poke_evolve_name)) {
            echo "<p class='no-evo-text'>pokemon has no evolution</p>";
        } else {
            $poke_evolve_name = $poke_species["evolves_from_species"]["name"];
            echo "<h2 class='poke-evo-text'>Evolved from: $poke_evolve_name </h2>";

            $get_poke_evolve = file_get_contents("https://pokeapi.co/api/v2/pokemon/$poke_evolve_name");
            $poke_evolve = json_decode($get_poke_evolve, true);
            $poke_evolve_image = $poke_evolve["sprites"]["front_default"];
            echo "<img class='poke-evo-img' src='$poke_evolve_image' alt='Pokemon previous form image'>";
        }
    }
    ?>


    <div class="container-main">
    <div class="container-top">
        <h1 class="pokedex-name">Pokedex</h1>
    </div>

    <div class="container-center">
        <div class="container-left">
        <?php
            echo "<h2 class='poke-name'>Name: $poke_name </h2>";
            echo "<h2 class='poke-id'>ID: $poke_id </h2>";
            echo "<img class='poke-img' src='$poke_img' alt='Pokemon image'>";
            hasEvolved($poke_species);
        ?>
        </div>

        <div class="container-right">
        <?php
        showMoves($poke_data);
        echo "<p class='poke-text'>$poke_text </p>";
        ?>
        </div>
    </div>

        <div class="container-bottom">
            <div class="container-bottom-left">
                <h2 class="search-text">Search for Pokemon name or ID:</h2>

                <form action="" method="get">
                <p class="input-field"><input type="text" name="poke_input" value="" required></p>
                <p class="input-btn"><input name="submit" type="submit" value="Search"></p>
                </form>
            </div>

            <div class="container-bottom-right">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 140 140" style="enable-background:new 0 0 140 140;" xml:space="preserve">
            <g>
                <path d="M138.3,92.4H1.7c-1,0-1.7-0.8-1.7-1.7V49.3c0-1,0.8-1.7,1.7-1.7h136.6c1,0,1.7,0.8,1.7,1.7v41.4
                    C140,91.6,139.2,92.4,138.3,92.4z"/>
                <path d="M92.4,1.7v136.6c0,1-0.8,1.7-1.7,1.7H49.3c-1,0-1.7-0.8-1.7-1.7V1.7c0-1,0.8-1.7,1.7-1.7h41.4C91.6,0,92.4,0.8,92.4,1.7z"
                />
            </g>
            </svg>
            </div>

        </div>
    </div>

</body>
</html>
