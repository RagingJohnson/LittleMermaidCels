<?php
    include 'search_query.php';

    $max = 0;

    if(isset($_POST['offset']))
    {
        $offset = intval($_POST['offset']);
    }

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db_name);

    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = getSQL();
    $result = $conn->query($sql);
            
    if (!$result) 
    {
        echo "\nInvalid Query: \n";
        echo $conn->error;
    }
    else
    {
        $max = mysqli_num_rows($result);
    }

    //Buttons
    echo "<div class=\"col-1\" style=\"text-align: center;\" method=\"post\">";
    echo "<button type=\"button\" class=\"button\" id=\"bckbutton\" onclick=\"navButt('bck')\"";
    echo "><</button>";
    echo "</div>";
    echo "<div class=\"col-1\" style=\"min-width: 150px; text-align: center; word-wrap: break-word;\">";
    if($max < 1)
    {
        echo "-";
    }
    else if($offset + 24 >= $max)
    {
        if ($offset < $max) 
        {
            echo "Cels ".($offset+1)." - ".$max." / ".$max;
        }
        else
        {
            echo "Cels ".$max." / ".$max;
        }
    }
    else
    {
        echo "Cels ".($offset+1)." - ".($offset+24)." / ".$max;
    }
    echo "</div>";
    echo "<div class=\"col-1\" style=\"text-align: center;\">";
    echo "<button type=\"button\" class=\"button\" id=\"fwdbutton\" onclick=\"navButt('fwd')\"";
    echo ">></button>";
    echo "</div>";
?>