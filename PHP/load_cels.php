<?php
    //Include the strings and credentials required to execute the search query.
    include 'search_query.php';
    //Include the objects that are needed to create and organise the data structure.
    include 'cel_table.php';
    include 'cel.php';

    //If there already exists an offset (there should always be an offset posted through, even if it is 0)...
	if(isset($_POST['offset']))
    {
        //...Get the value of that offset as an int.
        $offset = intval($_POST['offset']);

        // Create connection
        $conn = new mysqli($servername, $username, $password, $db_name);

        // Check connection
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }
        //Generate the final string for the  SQL query and...
        $sql = getSQL();
        //Use that string to perform the query, loading the result into $result
        $result = $conn->query($sql);
        
        if (!$result) 
        {
            //If the query doesn't return a valid result, post an error.
            echo "\nInvalid Query: \n";
            echo $conn->error;
        }

        //Create the Cels array.
        $cels = array();
        //Create the Cel Table object with the empty Cel array.
        $celTable = new CelTable($cels);
        //...and count the total number of results from the query.
        $rowCount = mysqli_num_rows($result);

        if($rowCount > 0)
        {
            //For each row from the results...
            while($row = $result->fetch_assoc())
            {
                //populate the Cel array with the results.
                $cels[] = new Cel($row, $conn);
            }
            unset($row);

            //Re-initialise the Cel Table with the newly populated Cel array.
            $celTable = new CelTable($cels);

            //Display Cels based on the offset, mindful of the upper bound of the array.
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
        
        //Clean up as much stuff that could be left dangling...
        unset($sql); 
	    unset($result);
	    unset($cels);
	    unset($celTable);

        //...and close the database connection.
	    $conn->close();
    }
?>