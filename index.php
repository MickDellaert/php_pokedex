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

    /* <form action="welcome" method="get">
        <p>Input: <input type="text" name="input" value=""></p>
        <p><input name="submit" type="submit" value="submit"></p>
    </form> */

    <?php
    $api_url = "https://pokeapi.co/api/v2/pokemon/ditto";
    $json_data = file_get_contents($api_url);
    $response_data = json_decode($json_data);
    print_r($json_data)
    ?>


</body>
</html>  
