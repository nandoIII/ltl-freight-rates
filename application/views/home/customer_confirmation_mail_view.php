<table width="700" border="3" cellspacing="0" cellpadding="0" align="center" style="font-family: 'Trebuchet MS';border-color: #ed1a3b;">
    <tbody>
        <tr>
            <td><img src="<?php echo base_url() ?>public/images/AdwordsBookingHeader.png" width="700" height="60" alt="AdwordsQuote">
                <h2 align="center" style="font-family:'Trebuchet MS';font-weight:bold;color:#ed1a3b">Quote # WQ<?php echo $contact['idcontact'] + 31320 ?></h2><br>

                <p style="margin: 0px 25px;text-align: justify;">Thank you for booking your shipment with Smith Transportation, shortly, one of our agents will be contacting you to provide the respective Bill of Lading and, if necessary, rectify any pertinent information. Do you have any questions? Feel free to contact our shipping specialist agents at 1-844-683-7447 or send an email to freight@smith-cargo.com and we will gladly assist you. </p>

                <h2 align="center" style="font-family:'Trebuchet MS';">Customer Information</h2>
                <hr>

                <ul style="font-family:'Trebuchet MS';">

                    <li><span style="font-family:'Trebuchet MS';font-weight:bold">Name: <?php echo $contact['name'] ?></span></li>
                    <li><span style="font-family:'Trebuchet MS';font-weight:bold">Company: <?php echo $contact['company'] ?></span></li>
                    <li><span style="font-family:'Trebuchet MS';font-weight:bold">Phone: <?php echo $contact['phone'] ?></span></li>
                    <li><span style="font-family:'Trebuchet MS';font-weight:bold">E-mail: <?php echo $contact['email'] ?></span></li>
                </ul>

                <h2 align="center" style="font-family:'Trebuchet MS';">Freight Description</h2>
                <hr> 

                <ul style="font-family:'Trebuchet MS';">
                    <li><span style="font-family:'Trebuchet MS';font-weight:bold">Origin Zipcode: <?php echo $contact['origin'] ?></span></li>
                    <li><span style="font-family:'Trebuchet MS';font-weight:bold">Destination Zipcode: <?php echo $contact['destination'] ?></span></li>
                    <li><span style="font-family:'Trebuchet MS';font-weight:bold">Item(s):</span></li>
                    <table id="items_list" align="center" style="font-family:'Trebuchet MS';border-collapse: collapse;border: 1px solid #ccc; margin-top: 15px; margin-bottom: 15px; width: 420px;">
                        <thead style="font-family:'Trebuchet MS';background-color: #C9C9CB;">
                            <tr>
                                <th style="font-family:'Trebuchet MS';font-size:11px; color:#303030; font-weight:bold;">Pieces</th>
                                <th style="font-family:'Trebuchet MS';font-size:11px; color:#303030; font-weight:bold;">Weight</th>
                                <th style="font-family:'Trebuchet MS';font-size:11px; color:#303030; font-weight:bold;">Class</th>
                                <th style="font-family:'Trebuchet MS';font-size:11px; color:#303030; font-weight:bold;">NMFC</th>
                                <th style="font-family:'Trebuchet MS';font-size:11px; color:#303030; font-weight:bold;">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($items as $item => $row) {
                                echo'<tr class="item" data-id="' . $row['iditem'] . '">'
                                . '<td style="text-align: center; width:90px">' . $row['quantity'] . ' ' . $row['quantity_unit'] . '</td>'
                                . '<td style="text-align: center; width:90px">' . $row['weight'] . ' ' . $row['weight_unit'] . '</td>'
                                . '<td style="text-align: center; width:90px">' . $row['class'] . '</td>'
                                . '<td style="text-align:center;width:90px">' . $row['nmfc'] . '</td>'
                                . '<td style="text-align:center;">' . $row['description'] . '</td>'
                                . '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>                    
                    <div style="font-family:'Trebuchet MS';font-weight:bold;color:#ed1a3b">TOTAL QTY: <?php echo $contact['total_quantity'] ?></div>
                    <div style="font-family:'Trebuchet MS';font-weight:bold;color:#ed1a3b">WEIGHT: <?php echo $contact['total_weight'] ?>lbs</div>
                </ul>

                <h2 align="center" style="font-family:'Trebuchet MS';">Your Selected Rate</h2>
                <hr>
                <table width="440" align="center" border="0" align="center" cellpadding="0" cellspacing="0" style="font-family:'Trebuchet MS';border-collapse: collapse;border: 1px solid #ccc; width: 440px;">
                    <thead style='background-color: #C9C9CB;'>
                        <tr>
                            <td style="font-family:'Trebuchet MS';font-size:11px; color:#303030; font-weight:bold;">Quotes</td>
                            <td width="50" align="center" style="font-family:'Trebuchet MS';font-size:11px; color:#303030; font-weight:bold;">Transit Time</td>
                            <td width="80" align="right" style="font-family:'Trebuchet MS';font-size:11px; color:#303030; font-weight:bold;">Cost</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($rates as $rate => $row) {
                            $style = '';
                            if ($row['sw'] == 1) {
                                $style = "style='background-color: gold;'";
                            }

                            echo'<tr ' . $style . '>'
                            . '<td style="text-align: center; width:90px">' . $row['carrier'] . '</td>'
                            . '<td style="text-align: center; width:90px">' . $row['days'] . '</td>'
                            . '<td style="text-align: center;">' . $row['total'] . '</td>'
                            . '</tr>';
                        }
                        ?>
                    </tbody>
                </table>                
                <p>&nbsp;</p>
                <p>&nbsp;</p>

                <h2 align="center" style="font-family:'Trebuchet MS';">Shipping instructions</h2>
                <hr>                                
                <table width="650" border="0" cellspacing="0" cellpadding="0" align="center" bordercolor="#ED1A3B">
                    <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-weight:bold; background-color:#999">
                        <td colspan="2" align="center">Shipper (From)</td>
                        <td colspan="2" align="center">Consignee (To)</td>
                    </tr>
                    <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                        <td><strong>Name</strong></td>
                        <td><label for="textfield"></label>
                            <?php echo $param['sh_name'] ?></td>
                        <td><strong>Name</strong></td>
                        <td> <?php echo $param['cs_name'] ?></td>
                    </tr>
                    <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                        <td><strong>Address 1</strong></td>
                        <td><?php echo $param['sh_address'] ?></td>
                        <td><strong>Address 1</strong></td>
                        <td><?php echo $param['cs_address'] ?></td>
                    </tr>
                    <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                        <td><strong>Address 2</strong></td>
                        <td><?php echo $param['sh_address2'] ?></td>
                        <td><strong>Address 2</strong></td>
                        <td><?php echo $param['cs_address'] ?></td>
                    </tr>
                    <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                        <td><strong>City</strong></td>
                        <td><?php echo $param['sh_city'] ?></td>
                        <td><strong>City</strong></td>
                        <td><?php echo $param['cs_city'] ?></td>
                    </tr>
                    <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                        <td><strong>State</strong></td>
                        <td><?php echo $param['sh_state'] ?></td>
                        <td><strong>State</strong></td>
                        <td><?php echo $param['cs_state'] ?></td>
                    </tr>
                    <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                        <td><strong>Zipcode</strong></td>
                        <td><?php echo $param['sh_zipcode'] ?></td>
                        <td><strong>Zipcode</strong></td>
                        <td><?php echo $param['cs_zipcode'] ?></td>
                    </tr>
                    <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                        <td><strong>Country</strong></td>
                        <td><?php echo $param['sh_country'] ?></td>
                        <td><strong>Country</strong></td>
                        <td><?php echo $param['cs_country'] ?></td>
                    </tr>
                    <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                        <td><strong>Contact</strong></td>
                        <td><?php echo $param['sh_contact'] ?></td>
                        <td><strong>Contact</strong></td>
                        <td><?php echo $param['cs_contact'] ?></td>
                    </tr>
                    <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                        <td><strong>Phone</strong></td>
                        <td><?php echo $param['sh_phone'] ?></td>
                        <td><strong>Phone</strong></td>
                        <td><?php echo $param['cs_phone'] ?></td>
                    </tr>
                    <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                        <td><strong>Email</strong></td>
                        <td><?php echo $param['sh_email'] ?></td>
                        <td><strong>Email</strong></td>
                        <td><?php echo $param['cs_email'] ?></td>
                    </tr>
                    <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr align="center" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-weight:bold; background-color:#999">
                        <td colspan="4">Special Instructions</td>
                    </tr>
                    <tr>
                        <td colspan="4"><label for="textfield22"></label>
                            <label for="textarea"></label>
                            <?php echo $param['esp_inst'] ?></td>
                    </tr>
                    <tr align="center" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-weight:bold; background-color:#999">
                        <td colspan="4">References</td>
                    </tr>
                    <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                        <td><strong>Purchase Order</strong></td>
                        <td><?php echo $param['pr_order'] ?></td>
                        <td><strong>Reference # 1:</strong></td>
                        <td><?php echo $param['ref_1'] ?></td>
                    </tr>
                    <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                        <td><strong>Sales Order </strong></td>
                        <td><?php echo $param['sales_order'] ?></td>
                        <td><strong>Reference # 2:</strong></td>
                        <td><?php echo $param['ref_2'] ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>