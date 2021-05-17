<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<h1>Php Form Test</h1>
   	<?php
		echo "Hello World!";
	?>

    <form action="" method="get">
        <p>Input: <input type="text" name="input" value="Name or ID of Pokemon"></p>
        <p><input name="submit" type="submit" value="submit"></p>
    </form>

    <?php
    $input = $_GET["input"];

    $api_url = "https://pokeapi.co/api/v2/pokemon/$input";

    // Read JSON file
    $json_data = file_get_contents($api_url);

    // Decode JSON data into PHP array
    $response_data = json_decode($json_data);

    // All user data exists in 'data' object
    $pokemon_name = $response_data->name;
    $pokemon_id = $response_data->id;
    $pokemon_ability = $response_data->base_experience;

    // Print data if need to debug
    echo "<h2>Name: " . $pokemon_name . "</h2>";
    echo "<h2>ID: " . $pokemon_id . "</h2>";
    echo "<h2>Base Experience: " . $pokemon_ability . "</h2>";
    print_r($response_data);

    // Traverse array and display user data
    /*foreach ($pokemon_data as $pokemon) {
        echo "name: " . $pokemon->name;
        echo "<br />";
        echo "url: " . $pokemon->url;
        echo "<br /> <br />";
    }*/

    ?>


</body>
</html>  
