![](img/pokedex_19_05_v2.jpg)
Screenshot of the current state of the project

# Goals:

- Making sure Apache is set up and running
- Making sure PHP is running
- Check if debug is working with XDebug browser extension and in PhpStorm
- Make a new repository and set up the repository's directory to display the content in a virtual host
- Create a basic form and get the input value back with php
- Fetch the data from API with php
- Get the data from the input field and use this as a variable in the fetch URL
- Search in the fetched data and only get the desired data and put them in variables
- Display the data in HTML
- Add CSS

# Title: The pokemon challenge - PHP style

- Repository: `challenge-pokemon-php`
- Type of Challenge: `Learning`
- Duration: `2 days`
- Deployment strategy : NA
	
- Team challenge : `solo`

## Learning objectives
- Starting with PHP
    * To be able to write a simple condition and a simple loop
    * To know how to access external resources (API)
- To know where to search for PHP documentation
- To find out how much easier it is to learn a second programming language

## The Mission
Remember the Pokemon challenge we did in Javascript?
Today we are going to re-create this challenge in PHP!

You will be surprised how easy it is to pick a new  language, once you know your first programming language (Javascript).

Take a deep breath, and remember: you can do this!

![](img/youcandoit.jpg)git a

## Tips
Here are a few functions you will need to help you on your way.

- [file_get_contents()](http://php.net/file_get_contents) 
- [json_decode()](http://php.net/json_decode) 
- [var_dump() - to help you debug](http://php.net/var_dump) 

Be careful to get an array, not an object, back from `json_decode()`. Read the documentation how to do this.
You could do it with objects, but it will be more difficult.

## How to search for PHP documentation
PHP has very good documentation available on www.php.net. There is a nice trick you can use to quickly get documentation on any php function. Just type in the browser php.net/FUNCTION_NAME and you will arrive at the correct documentation page. Also spend some time clicking on the "See Also" section at the bottom of each page, this will quickly get you a good overview of what is possible with PHP.

## PHP the right way
Another interesting read is https://phptherightway.com. This is not so much documentation over each separate function, but gives you more an overview of best practices and how different components work together.
