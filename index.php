    <!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>report</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <section id="filterArea">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "transportacc";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        ?>

        <!--[if lt IE 7]>
        <p class="browsehappy">
          You are using an <strong>outdated</strong> browser. Please
          <a href="#">upgrade your browser</a> to improve your experience.
        </p>
      <![endif]-->
        <form action="" method="POST">
            <label for="account">Account : &nbsp;</label>
            <select name="account" id="account">
                <?php
                $sql = "SELECT id,`name` FROM ledger WHERE ledger.`status` = 1";
                $result = $conn->query($sql);
                $selectedOption = ($_POST["account"] &&  $_POST["account"]) ? $_POST["account"] : null;
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row["id"] . '" ';
                        echo ($selectedOption &&  $selectedOption == $row["id"]) ? 'selected' : '';
                        echo  '>' . $row["name"] . '</option>';
                    }
                } else {
                    echo "0 results";
                }

                ?>
            </select>
            <div class="col">From : &nbsp;<input type="date" /></div>
            <div class="col">To : &nbsp;<input type="date" /></div>
            <button type="submit">Go</button>
        </form>
        <div id="zoomFactor" style="display: flex">
            <span>zoom&nbsp;&nbsp;</span>
            <select id="zooming" onchange="zoomings()">
                <option value=".25">25%</option>
                <option value=".5">50%</option>
                <option value=".75">75%</option>
                <option value="1" selected="selected">100%</option>
                <option value="1.50">150%</option>
                <option value="2.00">200%</option>
                <option value="2.50">250%</option>
                <option value="3.00">300%</option>
            </select>
        </div>
    </section>
    <document id="document">
        <page class="a4">
            <docHeader>
                <?php
                $sql = "SELECT company.business_name ,  company.caption ,  company.email,  company.phone,  company.website FROM company";
                $result = $conn->query($sql);


                if ($result->num_rows > 0) {
                    // output data of each row
                    $row = $result->fetch_assoc();

                    echo '<h1>' . $row["business_name"] . '</h1>' .
                        '<h4>' . $row["caption"] . '</h4>' .
                        '<p>' . $row["phone"] . '<br>' . $row["email"] . '<br>' . $row["website"] . '</p>';
                }
                ?>
            </docHeader>

            <?php
            if ($_POST && $_POST["account"]) {

                $sql = "SELECT ledger.name FROM ledger WHERE ledger.id=" . $_POST["account"];
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    $row = $result->fetch_assoc();
                    echo '<p>Ledger statement of :<b>' . $row["name"] . '</b></p>';
                }
            ?>
                <table class="pageData">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Account</th>
                            <th class="currency">Debit</th>
                            <th class="currency">Credit</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $sql = "WITH  cte AS ( SELECT CASE WHEN journal.id IS NOT NULL THEN MAX(journal.date)  END `Date`, CASE WHEN journal.id IS NOT NULL THEN MAX(journal.`desc`) " .
                            " ELSE 'Total' END Description,  SUM(CASE WHEN journal.dracc = " . $_POST["account"] .
                            " THEN 0 ELSE amount END) Debit, SUM(CASE WHEN journal.dracc = " . $_POST["account"] .
                            " THEN amount ELSE 0 END) Credit FROM journal JOIN ledger ON (ledger.id, " . $_POST["account"] .
                            ") IN ((dracc, cracc), (cracc, dracc)) GROUP BY journal.id WITH ROLLUP) SELECT *  FROM cte  UNION ALL SELECT NULL, 'Balance', NULL, Credit - Debit" .
                            " FROM cte WHERE `Date` IS NULL;";


                        $result = $conn->query($sql);

                        setlocale(LC_MONETARY, 'en_IN');


                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["Date"] . "</td><td>" . $row["Description"] . "</td><td class=\"currency\">" .  number_format($row["Debit"], 2)  . "</td><td class=\"currency\">" . number_format($row["Credit"], 2) . "</td></tr>";
                            }
                        } else {
                            echo "<tr><td>0 results</td><tr>";
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } // if (post account) ends.

            ?>

        </page>
    </document>
    <docNav id="documentNavigator">
        <div id="pageNavigation">
            <div class="navAnchor" id="navAnchorFirst"><a href="#" onclick="navToPage(0)">&lt;</a></div>
            <div class="navAnchor"><a href="#" onclick="navToPage(1)">&lt;</a></div>
            <div class="navText" id="pageText">Page <span id="nav-currPage">xx</span> of <span id="nav-totalPage">xxx</span></div>
            <div class="navAnchor"><a href="#" onclick="navToPage(2)">&gt;</a> </div>
            <div class="navAnchor" id="navAnchorLast" onclick="navToPage(3)"><a href="#">&gt;</a></div>
            <div class="navText"><span> | </span></div>
            <div class="navAnchor"><a href="#" onclick="printPaged()">Print</a> </div>
        </div>
    </docNav>

    <script type="text/javascript" language="javascript" src="./jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript"  src="./pageIt.0.0.1.js"></script>
</body>

</html>