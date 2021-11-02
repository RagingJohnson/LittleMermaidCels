<?php

class CelTable
        {
            public array $cels;

            function __construct(array $cels)
            {
                $this->cels = $cels;
            }

            function __destruct()
            {
            }

            public function displayCels($offset)
            {
                for($i = $offset; ($i < ($offset + 24) && $i < count($this->cels)); ++$i)
                {
                    $this->cels[$i]->displayCel();
                }
            }
        }
?>