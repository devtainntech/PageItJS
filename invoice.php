<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Invoice Report</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.invoice.css">
</head>

<body>
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

    <page class="a4">
        <table class="table">
            <?php
            $sql = "SELECT * FROM company";
            $result = $conn->query($sql);


            if ($result->num_rows > 0) {
                // output data of each row
                $row = $result->fetch_assoc();
            }
            ?>
            <tbody>
                <tr>
                    <td> <img src="srplogo.png" width="240" /></td>
                    <td class=" content-right content-top">
                        <h2>INVOICE</h2>
                    </td>
                </tr>
                <tr>
                    <td>3/89B, Near Kamachi Amman Kovil, <br />Somanthurai Chittur (Po),<br /> Pollachi, Coimbatore – 642134 <br />
                    Cell: <?php echo $row["contact_mobile"] ?> <br />Ph : <?php echo $row["phone"] ?><br /> GSTIN: <?php echo $row["gst"] ?></td>
                    <td class="content-right">Invoice No: XXXXXX<br /> Date: dd/mm/yyyy<br /> Due date: dd/mm/yyyy</td>
                </tr>
                <tr>
                    <td>&nbsp</td>
                </tr>
                <tr>
                    <td>Client: M/S XXXXXXXXXXXXXX
                    </td>
                    <td>GSTIN: XXXXXXXX </td>
                </tr>
                <tr>
                    <td>&nbsp</td>
                </tr>
                <tr>
                    <td><b> Address:</b><br /> <i>Billing Address:</i></td>
                    <td><b>Delivery Address:</b><br /><i>Delivery Address:</i></td>
                </tr>
            </tbody>
        </table>
        <table class="bordered">

            <tr>
                <th colspan="6">
                    <h4 style="margin: 0;">particulars</h4>
                </th>
            </tr>
            <tr>
                <th width="10">S.No</th>
                <th>Trip Reference</th>
                <th>Trip date</th>
                <th>Trip Charge</th>
                <th>GST</th>
                <th>Amount with GST</th>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>
        <table class="bordered">
            <tr>
                <td rowspan="2" colspan="2" class="content-top"><b>Amount in words: </b></td>
                <td class="content-right"><b>Total Trip Charge(without GST)</b>
                </td>
                <td class="content-right">XXXXXXX.XX</td>
            </tr>
            <tr>
                <td class="content-right"><b>Discount</b>
                </td>
                <td class="content-right">XXXX.XX</td>
            </tr>
            <tr>
                <td colspan="2">Other notes in case of RCM</td>
                <td class="content-right"><b>Gross</b></td>
                <td class="content-right">XXXXXXX.XX</t=d>
            </tr>
            <tr>
                <td colspan="2">Bank details</b>
                </td>
                <td class="content-right"><b>IGST</b></td>
                <td class="content-right">XXXX.XX</td>
            </tr>
            <tr>
                <td>A/c name
                </td>
                <td>SRP RMC AND CONSTRUCTIONS
                </td>
                <td class="content-right"><b>CGST</b></td>
                <td class="content-right">XXXX.XX</td>
            </tr>
            <tr>
                <td>A/c number
                </td>
                <td>XXXXXXXXXXX</td>
                <td class="content-right"><b>SGST</b></td>
                <td class="content-right">XXXX.XX</td>
            </tr>
            <tr>
                <td>Bank
                </td>
                <td>Canara bank of India
                </td>
                <td class="content-right"><b>Net payable</b></td>
                <td class="content-right">XXXXXXX.XX</td>
            </tr>
            <tr>
                <td>IFSC Code</td>
                <td>XXXXXXXX</td>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="4"> <b>Note: </b>Trip particulars enclosed with this invoice, please check against the trip reference.</td>
            </tr>
        </table>
    </page>

    <page class="a4-l">
        <h2 style="margin: 0 auto 12px; width: fit-content;">Trip Particulars Reference</h3>
            <table class="bordered">
                <tr>
                    <th> Reference</th>
                    <th>Trip date</th>
                    <th>Item description</th>
                    <th>HSN SAC</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Distance</th>
                    <th>Rate</th>
                    <th>Tax %</th>
                    <th>Tax</th>
                    <th>Amount</th>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tfoot>
                    <tr>
                        <td colspan="8">&nbsp;</td>
                        <td colspan="2" class="content-right"><b>Net total</b></td>
                        <td class="content-right"><b>XXXXXXX.XX</b></td>
                    </tr>

                    <tr>
                        <td colspan="8">&nbsp;</td>
                        <td class="content-right" colspan="2">Including IGST</td>
                        <td class="content-right">XXXXX.XX</td>
                    </tr>
                    <tr>
                        <td colspan="8">&nbsp;</td>
                        <td class="content-right" colspan="2">Including CGST</td>
                        <td class="content-right">XXXXX.XX</td>
                    </tr>
                    <tr>
                        <td colspan="8">&nbsp;</td>
                        <td class="content-right" colspan="2">Including SGST</td>
                        <td class="content-right">XXXXX.XX</td>
                    </tr>
                </tfoot>
            </table>
    </page>

    <script src=" invoice.js" async defer></script>
</body>

</html>