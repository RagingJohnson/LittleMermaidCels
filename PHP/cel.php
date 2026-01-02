<?php
//Contains the data for each Cel as it's read from the database.
        class Cel
        {
            public $dirPath;
            public $modalImg;
            public $celID;
            public $timeInFilm;
            public $characters;
            public $hasSeal;
            public $hasCert;
            public $isKey;
            public $hasMaster;
            public $isFramed;
            public $comments;
            public $salesHistory;
            public $damaged;

            public $conn;

            function __construct(array $row, $conn)
            {
                //When a Cel is constructed, it is done as the data is being read from the database.
                //The constructor therefore takes in a row and uses it to initialise the attributes.
                $this->dirPath = "images/".$row['ID'];
                $this->modalImg = $this->dirPath."/".$row['PrimaryImg'];
                $this->celID = $row['ID'];
                $this->timeInFilm = $row['TimeInFilm'];
                $this->characters = $row['Characters'];
                $this->hasSeal = $row['HasSeal'];
                $this->hasCert = $row['HasCert'];
                $this->isFramed = $row['IsFramed'];
                $this->isKey = $row['IsKey'];
                $this->hasMaster = $row['HasMaster'];
                $this->comments = $row['Comments'];
                $this->salesHistory = $row['SalesHistory'];
                $this->damaged = $row['Damaged'];

                $this->conn = $conn;
            }

            function __destruct()
            {
                unset($this->dirPath);
                unset($this->modalImg);
                unset($this->celID);
                unset($this->timeInFilm);
                unset($this->characters);
                unset($this->hasSeal);
                unset($this->hasCert);
                unset($this->isFramed);
                unset($this->isKey);
                unset($this->hasMaster);
                unset($this->comments);
                unset($this->salesHistory);
                unset($this->damaged);
            }

            function displayCel()
            {
                //Displays a single tile on the grid that is a button, and has an image. The image is the "Primary" image of the Cel, and the button opens a corresponding modal.
                echo "
                <div class=\"col-lg-2 col-md-4 col-6\">";
                echo "<button type=\"button\" onclick=\"document.getElementById('currentModalImage".$this->celID."').src='".$this->modalImg."'\" class=\"btn btn-sm ratio ratio-4x3\" data-bs-toggle=\"modal\" data-bs-target=\"#celModal";
                echo $this->celID;
                echo "\"";
                echo "><img class=\"img-fluid img-thumbnail\" src=";
                echo $this->modalImg;
                echo " loading=\"lazy\"></button></div>
                ";
                $this->createModal();
            }

            function createModal()
            {
                //Creates a modal that presents the data for the Cel, with several divisions for film info, images, sales info and other comments.
                echo "
                <div class=\"modal fade\" id=\"celModal";
                echo $this->celID;
                echo "\" tabindex=\"-1\" aria-labelledby=\"celModalLabel\" aria-hidden=\"true\">
                    <div class=\"modal-dialog modal-dialog-centered modal-dialog-long\">
                        <div class=\"modal-content\">
                            <div class=\"modal-header\">
                                <h5 class=\"modal-title\" id=\"exampleModalLabel\">
                                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\">
                                    </button>
                                </h5>
                            </div>";
                            $this->createInfoTable();
                            echo "<div class=\"modal-header\">
                                <div class=\"container\">";
                            echo"<h5 class=\"modal-title\" id=\"SalesLabel\"><b>Sales History:</b> </h5>";
                            $this->getSalesHistory($this->conn);
                            echo"</div>
                            </div>";
                            $this->createComments();
                            echo "<div class=\"modal-footer\">
                                <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=\"modal fade\" id=\"enlargedImage".$this->celID."\" tabindex=\"-1\" aria-labelledby=\"enlargedImageLabel\" aria-hidden=\"true\">
                    <div class=\"modal-dialog modal-dialog-centered modal-lg modal-img\">
                        <div class=\"modal-content\">
                                <div class=\"modal-header\"><button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button></div>
                                <div class=\"modal-header\" style=\"display: block; margin-left: auto; margin-right: auto;\"><img class=\"img-fluid\" id=\"enlargedImage".$this->celID."img\" loading=\"lazy\"></div>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            }

            function getSalesHistory($conn)
            {
                //Retrieves the sales info from the Sales table of the database, using the ID(s) from the salesHistory list.
                if(strlen($this->salesHistory) > 0)
                    {
                        $saleQuery = "SELECT * FROM sales WHERE ID in (".$this->salesHistory.") ORDER BY date DESC";
                        $saleResults = $this->conn->query($saleQuery);

                        if(mysqli_num_rows($saleResults) > 0)
                        {
                        while($saleRows = $saleResults->fetch_assoc())
                        {
                            $saleList[] = $saleRows;
                        }
                    }

                    foreach($saleList as $listItem)
                    {
                        $this->createSalesTable($listItem);
                    }
                }
                else
                {
                    echo "No sales data available.";
                }

                unset($listItem);
                unset($sales);
                unset($saleQuery);
                unset($saleResults);
                unset($saleRows);
            }

            function createSalesTable($listItem)
            {
                //Creates a formatted table for each Sale item found in the salesHistory of each Cel.
                echo "
                <table class=\"table table-light table-bordered\">  
                    <tbody>
                        <tr>";
                            if($listItem['SaleDate'] == null)
                            {
                                echo "<th scope=\"row\">Date</th>
                                <td>Unknown</td>";
                            }
                            else
                            {
                                echo "<th scope=\"row\">".$listItem['SaleDate']."</th>
                                <td>".$listItem['Date']."</td>";
                            }
                            echo "</tr>
                            <tr>
                                <th scope=\"row\">".$listItem['Currency']."</th>
                                <td>".$listItem['Price']."</td>
                            </tr>
                            <tr>
                                <th scope=\"row\">".$listItem['SaleContext']."</th>
                                <td>".$listItem['Vendor']."</td>
                            </tr>
                            <tr>
                                <th scope=\"row\">Comments</th>
                                    <td>".$listItem['Comments']."</td>
                            </tr>
                    </tbody>
                </table>
                ";
                unset($listItem);
            }

            function createInfoTable()
            {
                //Ctreats a formatted table for the film info regarding the Cel, as well as the Cel conditions.
                echo "<div class=\"modal-header d-flex\">
                <table class=\"table table-light table-bordered\">  
                    <tbody>
                        <tr>
                            <th scope=\"row\">Time In Film</th>
                            <td>".$this->timeInFilm."</td>
                        </tr>
                        <tr>
                            <th scope=\"row\">Characters</th>
                                <td>".$this->characters."</td>
                        </tr>
                        <tr>
                            <th scope=\"row\">Has a seal?</th>
                            <td>".$this->hasSeal."</td>
                        </tr>
                        <tr>
                            <th scope=\"row\">Has a COA?</th>
                            <td>".$this->hasCert."</td>
                        </tr>
                        <tr>
                            <th scope=\"row\">Framed?</th>
                            <td>".$this->isFramed."</td>
                        </tr>
                        <tr>
                            <th scope=\"row\">Key Setup?</th>
                            <td>".$this->isKey."</td>
                        </tr>
                        <tr>
                            <th scope=\"row\">Master Background?</th>
                            <td>".$this->hasMaster."</td>
                        </tr>
                        <tr>
                            <th scope=\"row\">Damaged?</th>
                            <td>".$this->damaged."</td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <div class=\"modal-header d-flex\">
                    <div class=\"centerImage\">
                        <div>
                            <button type=\"button\" style=\"border: none;\"
                                onclick=\" window.open(document.getElementById('currentModalImage".$this->celID."').src,'_blank')\">
                                <img id=\"currentModalImage".$this->celID."\" src=\"";
                                    echo $this->modalImg;
                                    echo "\" loading=\"lazy\" class=\"img-fluid d-block mx-auto\" style=\"max-height: 465px;\"
                                >
                            </button>
                        </div>
                    </div>
                </div>
                <div class=\"modal-header\">
                    <div class=\"container\">";
                    foreach (glob("../".$this->dirPath."/*.{JPG,jpeg,jpg,gif,png,webp}", GLOB_BRACE) as $filename)
                    {
                        //For each image in the Cel's corresponding image directory, display in a list within the modal.
                        $filename = substr($filename, 3);
                        echo "<button type=\"button\" style=\"width:25%\" class=\"btn btn-sm\">";
                        echo "<img src=\"";
                        echo $filename;
                        
                        //Clicking an image will set the modal to display it as the primary image.
                        echo "\" loading=\"lazy\" class=\"img-fluid\"
                        onclick=\"document.getElementById('currentModalImage".$this->celID."').src='";
                        echo $filename;
                        echo "'\"
                        >
                        </button>";
                    }
                echo"</div>
                </div>";
                unset($filename);
            }

            function createComments()
            {
                //Any comments entered into the database are displayed at the bottom of the modal.
                //Comments are formatted using HTML within the database entry.
                echo "<div class=\"modal-body\">
                <div class=\"container\">";
                echo "<h5 class=\"modal-title\" id=\"CommentsLabel\">Notes: </h5>";
                echo $this->comments;
                echo "</div>
                </div>";
            }
        }
?>