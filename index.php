<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pokedex php</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="./js/script.js" defer></script>

</head>

<body>

<?php


// First check if input field in the form is set, if not assign an id number of a pokemon to avoid error messages
if (!empty($_GET["poke_input"])) {
    $input = $_GET["poke_input"];
    $input = strtolower($input);

    // Get JSON data from API
    $get_poke_data = file_get_contents("https://pokeapi.co/api/v2/pokemon/$input");
    $get_poke_species = file_get_contents("https://pokeapi.co/api/v2/pokemon-species/$input");

    // Decode JSON data into PHP array
    $poke_data = json_decode($get_poke_data, true);
    $poke_species = json_decode($get_poke_species, true);

    // Check for wrong input by checking if returned data gives an error, if this is the case show the first Pokemon
    if ($poke_data === null || $poke_species === null) {
        $get_poke_data = file_get_contents("https://pokeapi.co/api/v2/pokemon/1");
        $get_poke_species = file_get_contents("https://pokeapi.co/api/v2/pokemon-species/1");

        $poke_data = json_decode($get_poke_data, true);
        $poke_species = json_decode($get_poke_species, true);
    }

    // If there is no input show the first Pokemon
} else {
    $get_poke_data = file_get_contents("https://pokeapi.co/api/v2/pokemon/1");
    $get_poke_species = file_get_contents("https://pokeapi.co/api/v2/pokemon-species/1");

    $poke_data = json_decode($get_poke_data, true);
    $poke_species = json_decode($get_poke_species, true);
}

$get_poke_count = file_get_contents("https://pokeapi.co/api/v2/pokemon/");
$poke_count = json_decode($get_poke_count, true);

// Assign variables to selected data
$poke_name = ucfirst($poke_data["name"]);
$poke_id = $poke_data["id"];
$poke_img = $poke_data["sprites"]["front_default"];
$poke_text = $poke_species["flavor_text_entries"][0]["flavor_text"];
$poke_type = $poke_data["types"][0]["type"]["name"];
$poke_hp = $poke_data["stats"][0]["base_stat"];
$poke_attack = $poke_data["stats"][1]["base_stat"];

$poke_count = $poke_count["count"];
$poke_random = rand(1, $poke_count);


// Loop to show four moves in a list if there are more than one moves
function showMoves($poke_data)
{
    echo "<h2 class='abilities-title'>Abilities:</h2>";
    echo "<ol class='poke-moves-list'>";

    if (count($poke_data["moves"]) > 0) {

        if (count($poke_data["moves"]) < 2) {
            echo $poke_data['moves'][0]["move"]["name"];
        } else {
            for ($x = 0; $x < 4; $x++) {
                $poke_moves = $poke_data['moves'][$x]["move"]["name"];
                echo "<li>$poke_moves</li>";
            }
            echo "</ol>";
        }
    }
}

// Check if previous species is present; if it returns null, echo a message, else show evolution name and image
function hasEvolved($poke_species)
{
    $poke_evolve_name = $poke_species["evolves_from_species"];
    if (is_null($poke_evolve_name)) {
        echo "<p class='no-evo-text'>This Pokemon has no previous forms</p>";
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

<?php /*echo $poke_count */ ?><!--
--><?php /*echo $poke_random */ ?>

<div class="container-main">
    <div class="container-top">
        <div class="circles">
            <div class="circle-big-blue"></div>
            <div class="small-circles">
                <div class="circle-red"></div>
                <div class="circle-yellow"></div>
                <div class="circle-green"></div>
            </div>
        </div>
        <img class="poke-logo" src="img/pokemon-logo.png" alt="pokemon-logo">
    </div>

    <div class="container-center">
        <div class="container-left">
            <div class="poke-stats"></div>
            <?php
            echo "<p class='poke-stats'>
                        <span class='poke-hp'>Hp: $poke_hp </span>
                        <span class='poke-attack'>Attack: $poke_attack </span>
                        <span class='poke-type'>Type: $poke_type </span>
                     </p>";
            echo "<h2 class='poke-name-row'
                        <span class='poke-name'>Name: $poke_name </span>
                        <span class='poke-id'>ID: $poke_id </span>
                      </h2>";
            echo "<img class='poke-img' src='$poke_img' alt='Pokemon image'>";
            hasEvolved($poke_species);
            ?>
        </div>

        <div class="container-right">
            <div class="poke-abilities">
                <?php
                showMoves($poke_data);
                echo "<p class='poke-text'>$poke_text </p>";
                ?>
            </div>
            <div class="buttons-center-right">
                <div class="front-nav-align-right">
                    <form method="get">
                        <button id="button" class="arrow-left" name="poke_input" type="submit"
                                value="<?php echo $poke_id - 1 ?>"></button>
                        <h5 class="front-nav-subtext-align-right">Previous</h5>
                    </form>
                </div>
                <form class="front-nav-align-center" method="get">
                    <button id="button" class="square" name="poke_input" type="submit"
                            value="<?php echo $poke_random ?>"></button>
                    <h5 class="front-nav-subtext">Random</h5>


                </form>
                <form class="front-nav-align-left" method="get">
                    <button id="button" class="arrow-right" name="poke_input" type="submit"
                            value="<?php echo $poke_id + 1 ?>"></button>
                    <h5 class="front-nav-subtext">Next</h5>
                </form>


                <div class="front-nav-align-center open-close">
                    <div class="start-button"></div>
                    <h5 class="front-nav-subtext">Open/Close</h5>
                </div>
                <!-- <button class="bevel">▸</button> -->


            </div>
        </div>
    </div>

    <div class="container-bottom">
        <div class="container-bottom-left">
            <h2 class="search-text">Search for Pokemon name or ID:</h2>

            <form class="search-form" action="index.php" method="get">
                <input class="input-field" type="text" name="poke_input" id="poke-input" placeholder="Search"/>
                <input class="input-btn" type="submit" value="Submit">
            </form>
            <!-- <form class="randbut next" method="get">
                    <button class="input-btn" id="button" class="rand-button" name="poke_input" type="submit" value="<?php echo $poke_id + 1 ?>">Search</button>
                </form> -->
            <div class="yellow-button-bottom-row">
                <button class="yellow-button-bottom"></button>
                <button class="yellow-button-bottom"></button>
                <button class="yellow-button-bottom"></button>
                <button class="yellow-button-bottom"></button>
                <button class="yellow-button-bottom"></button>
                <button class="yellow-button-bottom"></button>
                <button class="yellow-button-bottom"></button>
                <button class="yellow-button-bottom"></button>
            </div>
            <div class="yellow-button-bottom-row">
                <button class="yellow-button-bottom"></button>
                <button class="yellow-button-bottom"></button>
                <button class="yellow-button-bottom"></button>
                <button class="yellow-button-bottom"></button>
                <button class="yellow-button-bottom"></button>
                <button class="yellow-button-bottom"></button>
                <button class="yellow-button-bottom"></button>
                <button class="yellow-button-bottom"></button>
            </div>
        </div>

        <div class="container-bottom-right">
            <div class="container-svg-cross">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 140 140"
                     style="enable-background:new 0 0 140 140;" xml:space="preserve">
                        <g>
                            <path d="M138.3,92.4H1.7c-1,0-1.7-0.8-1.7-1.7V49.3c0-1,0.8-1.7,1.7-1.7h136.6c1,0,1.7,0.8,1.7,1.7v41.4
                        C140,91.6,139.2,92.4,138.3,92.4z"/>
                            <path d="M92.4,1.7v136.6c0,1-0.8,1.7-1.7,1.7H49.3c-1,0-1.7-0.8-1.7-1.7V1.7c0-1,0.8-1.7,1.7-1.7h41.4C91.6,0,92.4,0.8,92.4,1.7z"/>
                        </g>
                    </svg>
            </div>
            <div class="container-lines-bottom">
                <div class="vertical-line"></div>
                <div class="vertical-line"></div>
                <div class="vertical-line"></div>
                <div class="vertical-line"></div>
                <div class="vertical-line"></div>
                <div class="vertical-line"></div>
                <div class="vertical-line"></div>
                <div class="vertical-line"></div>
                <div class="vertical-line"></div>
                <div class="vertical-line"></div>
            </div>
        </div>
    </div>
</div>

</body>

</html>