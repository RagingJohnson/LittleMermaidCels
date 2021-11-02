<?php
	$scenes = array(
		"0:00:00" => "Fathoms Below",
		"0:02:17" => "Main Titles",
		"0:03:43" => "Fanfare",
		"0:04:50" => "Daughters Of Triton",
		"0:05:51" => "Intro Ariel",
		"0:07:43" => "Shark Chase",
		"0:08:54" => "Intro Scuttle",
		"0:10:48" => "Intro Ursula",
		"0:12:02" => "Triton Reprimands",
		"0:13:33" => "Sebastian's Dilemma",
		"0:15:01" => "Part Of Your World",
		"0:18:24" => "Fireworks",
		"0:19:37" => "Jig",
		"0:21:06" => "Prince Eric's Birthday",
		"0:22:18" => "The Storm",
		"0:24:53" => "Part Of Your World - Reprise",
		"0:27:14" => "Ursula Plots",
		"0:27:46" => "Ariel In Love",
		"0:28:26" => "He Loves Me",
		"0:29:06" => "Under The Sea",
		"0:32:30" => "Sebastian And Triton",
		"0:34:21" => "Destruction Of The Grotto",
		"0:36:51" => "Flotsam And Jetsam",
		"0:38:49" => "Ursula's Lair",
		"0:40:00" => "Poor Unfortunate Souls",
		"0:41:36" => "The Deal",
		"0:43:14" => "Poor Unfortunate Souls - Continued",
		"0:44:28" => "Ariel's Transformation",
		"0:45:40" => "She's Got Legs",
		"0:48:13" => "Have We Met?",
		"0:50:02" => "In The Palace",
		"0:50:57" => "A Lovely Dinner Guest",
		"0:52:22" => "Les Poissons",
		"0:54:55" => "Crab On A Plate",
		"0:55:29" => "Bedtime",
		"0:56:47" => "What Have I done?",
		"0:57:22" => "Tour Of The Kingdom",
		"0:58:44" => "The Lagoon",
		"0:59:35" => "Kiss The Girl",
		"1:02:25" => "Too Close!",
		"1:03:03" => "Vanessa",
		"1:04:16" => "Wedding Announcement",
		"1:05:44" => "Ariel Left Behind",
		"1:06:29" => "Poor Unfortunate Souls - Reprise",
		"01:07:04" => "Stall The Wedding",
		"01:09:43" => "The Sun Sets On The Third Day",
		"1:10:33" => "We Made A Deal",
		"1:11:26" => "Eric To The Rescue",
		"1:12:58" => "Pitiful, Insignificant Fools!",
		"1:14:15" => "So Much For True Love!",
		"1:15:11" => "She Really Does Love Him",
		"1:16:39" => "Wedding",
		"1:17:27" => "I love You, Daddy"
	);

	echo "<div class=\"btn-group\">";
	echo "<button class=\"btn btn-secondary dropdown-toggle\" type=\"button\" id=\"sceneSelect\" data-bs-toggle=\"dropdown\" data-bs-auto-close=\"outside\" aria-expanded=\"false\">";
	echo "Jump To Scene:";
	echo "</button>";
	echo "<ul class=\"dropdown-menu\" aria-labelledby=\"sceneSelect\">";
	foreach($scenes as $time=>$title)
	{
		echo "<li><button class=\"dropdown-item\" onclick=\"sceneSelect('" . $time . "')\"><div class=\"col-2 form-check form-check-inline\">(" . $time . ")</div><div class=\"form-check form-check-inline\">" . $title . "</div></button></li>";
	}
	echo "</ul>";
	echo "</div>";
?>