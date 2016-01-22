<table width="700" border="3" cellspacing="0" cellpadding="0" align="center" style="font-family: 'Trebuchet MS';border-color: #ed1a3b;">
    <tbody><tr>
            <td><img src="<?php echo base_url() ?>public/images/AdwordsQuoteHeader.png" width="700" height="60" alt="AdwordsQuote">
                <h2 align="center" style="font-family:'Trebuchet MS';font-weight:bold;color:#ed1a3b">Quote # WQ<?php echo $wq_number ?></h2><br>

                <h2 align="center" style="font-family:'Trebuchet MS';">Customer Information</h2>
                <hr>

                <ul style="font-family:'Trebuchet MS';">

                    <li><span style="font-family:'Trebuchet MS';font-weight:bold">Name: <?php echo $name ?></span></li>
                    <li><span style="font-family:'Trebuchet MS';font-weight:bold">Company: <?php echo $company ?></span></li>
                    <li><span style="font-family:'Trebuchet MS';font-weight:bold">Phone: <?php echo $phone ?></span></li>
                    <li><span style="font-family:'Trebuchet MS';font-weight:bold">E-mail: <?php echo $email ?></span></li>
                </ul>

                <h2 align="center" style="font-family:'Trebuchet MS';">Freight Description</h2>
                <hr> 

                <ul style="font-family:'Trebuchet MS';">
                    <li><span style="font-family:'Trebuchet MS';font-weight:bold">Origin Zipcode: <?php echo $origin ?></span></li>
                    <li><span style="font-family:'Trebuchet MS';font-weight:bold">Destination Zipcode: <?php echo $destination ?></span></li>
                    <li><span style="font-family:'Trebuchet MS';font-weight:bold">Item(s):</span></li>
                    <table id="items_list" align="center" style="font-family:'Trebuchet MS';border-collapse: collapse;border: 1px solid #ccc; margin-top: 15px; margin-bottom: 15px; width: 420px;">
                        <thead style="font-family:'Trebuchet MS';background-color: #C9C9CB;">
                            <tr>
                                <th style="font-family:'Trebuchet MS';font-size:11px; color:#303030; font-weight:bold;">Pieces</th>
                                <th style="font-family:'Trebuchet MS';font-size:11px; color:#303030; font-weight:bold;">Weight</th>
                                <th style="font-family:'Trebuchet MS';font-size:11px; color:#303030; font-weight:bold;">Class</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $items ?>
                        </tbody>
                    </table>                    
                    <div style="font-family:'Trebuchet MS';font-weight:bold;color:#ed1a3b">TOTAL QTY: <?php echo $total_quantity ?></div>
                    <div style="font-family:'Trebuchet MS';font-weight:bold;color:#ed1a3b">WEIGHT: <?php echo $total_weight ?></div>
                </ul>

                <h2 align="center" style="font-family:'Trebuchet MS';">Customer rates</h2>
                <hr>
                <table width="440" align="center" border="0" align="center" cellpadding="0" cellspacing="0" style="font-family:'Trebuchet MS';border-collapse: collapse;border: 1px solid #ccc; width: 440px;">
                    <thead style='background-color: #C9C9CB;'>
                        <tr>
                            <td width="10">&nbsp;</td>
                            <td style="font-family:'Trebuchet MS';font-size:11px; color:#303030; font-weight:bold;">Quotes</td>
                            <td width="50" align="center" style="font-family:'Trebuchet MS';font-size:11px; color:#303030; font-weight:bold;">Transit Time</td>
                            <td width="80" align="right" style="font-family:'Trebuchet MS';font-size:11px; color:#303030; font-weight:bold;">Cost</td>
                            <td width="10">&nbsp;</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $rates ?>
                    </tbody>
                </table>                
                <p>&nbsp;</p>
                <p>&nbsp;</p>
            </td>
        </tr>
    </tbody>
</table>