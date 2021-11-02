<?php
    include 'search_query.php';
    include 'cel_table.php';
    include 'cel.php';

	if(isset($_POST['offset']))
    {
        $offset = intval($_POST['offset']);

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

        $cels = array();
        $celTable = new CelTable($cels);
        $rowCount = mysqli_num_rows($result);

        if($rowCount > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $cels[] = new Cel($row, $conn);
            }
            unset($row);

            $celTable = new CelTable($cels);

            //Display Cels
            if($offset < $rowCount)
            {
                $celTable->displayCels($offset);
            }
            else
            {
                $celTable->displayCels($rowCount-1);
            }
        }
        else
        {
            echo "No Cels match your filter settings.";
        }
        
        
       unset($sql); 
	   unset($result);
	   unset($cels);
	   unset($celTable);

	   $conn->close();
    }
?>