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
	<h1>Pokedex</h1>

    <?php
    // First check if input field in the form is set, if not assign an id number of a pokemon to avoid error messages
    $input = $_GET["poke_input"];

    if (isset($_GET["poke_input"])) {

        // Get JSON data from API
        $get_poke_data = file_get_contents("https://pokeapi.co/api/v2/pokemon/$input");
        //$get_poke_ability = file_get_contents("https://pokeapi.co/api/v2/ability/$input");
        $get_poke_species = file_get_contents("https://pokeapi.co/api/v2/pokemon-species/$input");

        // Decode JSON data into PHP array
        $poke_data = json_decode($get_poke_data, true);
        //$poke_ability = json_decode($get_poke_ability, true);
        $poke_species = json_decode($get_poke_species, true);
    } else {
        $input = "20";
    }


    // Assign variables to selected data
    $poke_name = $poke_data["name"];
    $poke_id = $poke_data["id"];
    //$poke_experience = $poke_data["base_experience"];
    $poke_img = $poke_data["sprites"]["front_default"];
    $poke_text = $poke_species["flavor_text_entries"][0]["flavor_text"];


    // Check if previous species is present, if it returns null, echo a message, else show evolution name and image
    $poke_evolve_name = $poke_species["evolves_from_species"];
    if(is_null($poke_evolve_name)){
        echo "pokemon has no evolution";
    } else {
        $poke_evolve_name = $poke_species["evolves_from_species"]["name"];
        echo "<h2 class='poke-evo-text'>Evolved from: $poke_evolve_name </h2>";

        $get_poke_evolve = file_get_contents("https://pokeapi.co/api/v2/pokemon/$poke_evolve_name");
        $poke_evolve = json_decode($get_poke_evolve, true);
        $poke_evolve_image = $poke_evolve["sprites"]["front_default"];
        echo "<img class='poke-evo-img' src='$poke_evolve_image' alt='Pokemon previous form image'>";
    }

    // Loop to show four moves in a list
    function showMoves($moves){
        echo "<h2>Abilities:</h2>";
        for ($x = 0; $x < 4; $x++) {
            $poke_moves = $moves['moves'][$x]["move"]["name"];
            echo "<ol class='poke-moves-list'><li>$poke_moves</li></ol>";
        }
    }

    // Display data
    echo "<h2 class='poke-name'>Name: $poke_name </h2>";
    echo "<h2 class='poke-id'>ID: $poke_id </h2>";
    //echo "<h2>Base Experience: $poke_experience </h2>";
    echo "<img class='poke-img' src='$poke_img' alt='Pokemon image'>";
    echo "<p class='poke-text'>$poke_text </p>";

    showMoves($poke_data);
    ?>

    <!-- Form to get the required user input -->
    <form action="" method="get">
        <p class="input-field">Search for Pokemon name or ID: <input type="text" name="poke_input" value="" required></p>
        <p class="input-btn"><input name="submit" type="submit" value="Search"></p>
    </form>

</body>
</html>
