<?php
        $offset = 0;
        if(isset($_POST['offset']))
        {
            $offset = intval($_POST['offset']);
            $offset -= 24;
            if($offset < 0)
            {
                $offset = 0;
            }
            echo "offset=".$offset;
        }
?>