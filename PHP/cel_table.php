<?php
//Manages the structure for the data for each cel.
class CelTable
        {
            public array $cels;

            function __construct(array $cels)
            {
                //The array is created in load_cels.php.
                $this->cels = $cels;
            }

            function __destruct()
            {
            }

            public function displayCels($offset)
            {
                //For each Cel from the index indicated by $offset to $offset+24, but no higher than the maximum number of Cels, trigger the displayCel() function.
                for($i = $offset; ($i < ($offset + 24) && $i < count($this->cels)); ++$i)
                {
                    $this->cels[$i]->displayCel();
                }
            }
        }
?>