<?php
	include 'sql_auth.php';
	
	$offset = 0;

    function getSQL()
    {
    	$queries = "Characters LIKE '%%'";

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
		
    	foreach($characters as $key=>$value)
		{
			if (isset($_POST[$key]) && $_POST[$key] != '')
			{
				$queries .= " AND Characters " . ($_POST[$key] == "true" ? "" : "NOT ") . "LIKE '%".$value."%'";
			}
		}

		foreach($conditions as $key=>$value)
		{
			if (isset($_POST[$key]) && $_POST[$key] != '')
			{
				$queries .= " AND ". $value . " " . ($_POST[$key] == "Yes" ? "" : "NOT ") . "LIKE '%Yes%'";
			}
		}

    	$sql = "SELECT * FROM cels WHERE ".$queries." ORDER BY TimeInFilm";
    	return $sql;
    }
?>