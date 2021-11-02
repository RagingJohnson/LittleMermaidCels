<?php
	$characters = array(
		"ariel" => "Ariel",
		"eric" => "Eric",
		"ursula" => "Ursula",
		"triton" => "King Triton",
		"sebastian" => "Sebastian",
		"flounder" => "Flounder",
		"scuttle" => "Scuttle",
		"max" => "Max",
		"flotsam" => "Flotsam & Jetsam",
		"grimsby" => "Grimsby",
		"louis" => "Chef Louis",
		"carlotta" => "Carlotta",
		"sisters" => "Ariel's Sisters",
		"misc" => "Misc"
	);

	$charOptions = array(
		"Include" => "null",
		"Exclude" => "false",
		"ShowOnly" => "true"
	);

	$charOptionsMap = array(
		"Include" => "Include",
		"Exclude" => "Exclude",
		"ShowOnly" => "Must Have"
	);

	$conditions = array(
		"seal" => "Has Seal?",
		"cert" => "Has COA?",
		"framed" => "Is Framed?",
		"key" => "Is Key?",
		"master" => "Has Master BG?",
		"damaged" => "Damaged?"
	);

	$condOptions = array(
		"ShowAll" => "null",
		"Yes" => "Yes",
		"No" => "No"
	);

	$condOptionsMap = array(
		"ShowAll" => "Show All",
		"Yes" => "Yes/NA",
		"No" => "No/UnK"
	);

	$checked = array(
		"null" => "checked",
		"Yes" => "",
		"No" => "",
		"false" => "",
		"true" => ""
	);

	echo "<div class=\"btn-group\">";

	echo "<button class=\"btn btn-secondary dropdown-toggle\" type=\"button\" id=\"filterList\" data-bs-toggle=\"dropdown\" data-bs-auto-close=\"outside\" aria-expanded=\"false\">";
	echo "Filters:";
	echo "</button>";

	echo "<ul class=\"dropdown-menu p-3\" style=\"width: 500px;\" aria-labelledby=\"fliterList\">";
	echo "<li><h6 class=\"dropdown-header\">Characters</h6></li>";

	foreach ($characters as $key => $value)
	{
		echo "<li>";
		echo "<div class=\"dropdown-item\">";
		echo "<div class=\"row col-12\">";
		echo "<div class=\"col-3 text-wrap\">";
		echo $value;
		echo "</div>";

		foreach ($charOptions as $option => $setting)
		{
			echo "<div class=\"col-3\">";
			echo "<div class=\"form-check form-check-inline\">";
			echo "<input class=\"form-check-input\" type=\"radio\" name=\"" . $key . "RadioOptions\" id=\"" . $key . $option . "Radio\" value=\"" . $key . $option . "\" onclick=\"parChange('" . $key . "', '" . $setting . "');\"" . $checked[$setting] . ">";
			echo "<label class=\"form-check-label\" for=\"" . $key . $option . "Radio\">" . $charOptionsMap[$option] . "</label>";
			echo "</div>";
			echo "</div>";
		}
		echo "</div>";
		echo "</div>";
		echo "</li>";
	}

	echo "<li><hr class=\"dropdown-divider\"></li>";
	echo "<li><h6 class=\"dropdown-header\">Conditions</h6></li>";

	foreach ($conditions as $key => $value)
	{
		echo "<li>";
		echo "<div class=\"dropdown-item\">";
		echo "<div class=\"row col-12\">";
		echo "<div class=\"col-3 text-wrap\">";
		echo $value;
		echo "</div>";

		foreach ($condOptions as $option => $setting)
		{
			echo "<div class=\"col-3\">";
			echo "<div class=\"form-check form-check-inline\">";
			echo "<input class=\"form-check-input\" type=\"radio\" name=\"" . $key . "RadioOptions\" id=\"" . $key . $option . "Radio\" value=\"" . $key . $option . "\" onclick=\"parChange('" . $key . "', '" . $setting . "');\"" . $checked[$setting] . ">";
			echo "<label class=\"form-check-label\" for=" . $key . $option . "Radio\">" . $condOptionsMap[$option] . "</label>";
			echo "</div>";
			echo "</div>";
		}

		echo "</div>";
		echo "</div>";
		echo "</li>";
	}

	echo "<li><hr class=\"dropdown-divider\"></li>";
	echo "<div class=\"row col-12 text-wrap justify-content-center\">";
	echo "<button class=\"button col-6\" onclick=\"clearFilters()\" >Clear Filters</button>";
	echo "</div>";
	echo "</li>";
	echo "</ul>";
	echo "</div>";
?>