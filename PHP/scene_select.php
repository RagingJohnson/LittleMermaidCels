<?php
	include 'search_query.php';

	if(isset($_POST['timestamp']))
    {
        $timestamp = date_create($_POST['timestamp']);
        $time = date_format($timestamp,"H:i:s");

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
            $i = 0;
            $found = false;

            while(($row = $result->fetch_assoc()) && (!$found))
            {
                $nextStamp = date_create($row['TimeInFilm']);
                $nextTime = date_format($nextStamp,"H:i:s");
                if($nextTime < $time)
                {
                    $i++;
                }
                else
                {
                    $found = true;
                }
            }
        }
        echo "offset=".$i;
    }
?>