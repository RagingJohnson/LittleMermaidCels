<?php
//This file generates the DB search query based on conditions that are posted to it from Javascript.
	
	//The cedentials are separated into their own file for a) obfuscation and b) differences between creds on local machine and live server.
	include 'sql_auth.php';
	
	//This is used in PHP files in which this file is included, but it's important to initialise it first in this context.
	$offset = 0;

    function getSQL()
    {
    	//Outputs the final SQL line that will retrive Cels based on the posted query conditions

    	//In case nothing returns true, this is the minimum output, which 
    	$queries = "Characters LIKE '%%'";

    	//The key for each character and condition is the string for their _POST value; the corresponding value is the DB table column.
    	$characters = array(
			"ariel" => "Ariel",
			"eric" => "Eric",
			"ursula" => "Ursula",
			"triton" => "Triton",
			"sebastian" => "Sebastian",
			"flounder" => "Flounder",
			"scuttle" => "Scuttle",
			"max" => "Max",
			"flotsam" => "Flotsam",
			"grimsby" => "Grimsby",
			"louis" => "Louis",
			"carlotta" => "Carlotta",
			"sisters" => "Sisters",
			"misc" => "Misc"
		);

		$conditions = array(
			"seal" => "HasSeal",
			"cert" => "HasCert",
			"framed" => "IsFramed",
			"key" => "IsKey",
			"master" => "HasMaster",
			"damaged" => "Damaged"
		);
		
		//For each character and its corresponding value...
    	foreach($characters as $key=>$value)
		{
			//...if their value is posted...
			if (isset($_POST[$key]) && $_POST[$key] != '')
			{
				//...but is NOT 'true', add NOT before the LIKE in the SQL statement, excluding that character.
				$queries .= " AND Characters " . ($_POST[$key] == "true" ? "" : "NOT ") . "LIKE '%".$value."%'";
			}
		}

		//For each condition and its corresponding value...
		foreach($conditions as $key=>$value)
		{
			//...if that condition is set...
			if (isset($_POST[$key]) && $_POST[$key] != '')
			{
				//...but is NOT "Yes", assume it is "NO" and add NOT before the LIKE.
				$queries .= " AND ". $value . " " . ($_POST[$key] == "Yes" ? "" : "NOT ") . "LIKE '%Yes%'";
			}
		}

		//Take the results of the _POST queries, generate a SELECT statement string and order the reults by the time that Cel appears in the film.
    	$sql = "SELECT * FROM cels WHERE ".$queries." ORDER BY TimeInFilm";
    	return $sql;
    }
?>