<?php
    include 'search_query.php';
        if(isset($_POST['offset']))
        {
            $offset = intval($_POST['offset']);

            $sql = getSQL();

            // Create connection
            $conn = new mysqli($servername, $username, $password, $db_name);

            // Check connection
            if ($conn->connect_error)
            {
                die("Connection failed: " . $conn->connect_error);
            }
            $result = $conn->query($sql);
            
            if (!$result) 
            {
                echo "\nInvalid Query: \n";
                echo $conn->error;
            }
            else if(($offset + 24) < mysqli_num_rows($result))
            {
                $offset += 24;
            }
            echo "offset=".$offset;
        }
?>