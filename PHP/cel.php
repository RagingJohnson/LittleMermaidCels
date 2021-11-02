<?php
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
                            <button type=\"button\" style=\"border: none;\" data-bs-toggle=\"modal\" data-bs-target=\"#enlargedImage".$this->celID."\"
                            onclick=\"document.getElementById('enlargedImage".$this->celID."img').src=document.getElementById('currentModalImage".$this->celID."').src\">
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
                    foreach (glob("../".$this->dirPath."/*.{JPG,jpeg,jpg,gif,png}", GLOB_BRACE) as $filename)
                    {
                        $filename = substr($filename, 3);
                        echo "<button type=\"button\" style=\"width:25%\" class=\"btn btn-sm\">";
                        echo "<img src=\"";
                        echo $filename;
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
                echo "<div class=\"modal-body\">
                <div class=\"container\">";
                echo "<h5 class=\"modal-title\" id=\"CommentsLabel\">Notes: </h5>";
                echo $this->comments;
                echo "</div>
                </div>";
            }
        }
?>