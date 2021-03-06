<table width="700" align="center" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#666666; padding:5px 0 15px;">Book today to lock in your low-cost quotes &nbsp; &nbsp; | &nbsp; &nbsp; Email not displaying? <a href="<?php echo site_url("rate/get/" . $id) ?>" title="View in browser" style="color: #C2041B;"><span style="color:#ec5b26;">View online</span></a>.</td>
        </tr>
    </tbody>
</table> 
<table width="700" border="3" cellspacing="0" cellpadding="0" align="center" style="font-family:'Trebuchet MS';font-family: 'Trebuchet MS'; border-color: #ed1a3b;">
    <tr>
        <td style="padding: 10px"><img src="<?php echo base_url() ?>public/images/AdwordsCustomerQuoteHeader.png" width="700" height="60" alt="AdwordsQuote" />
            <h1 align="center" style="font-family:'Trebuchet MS';font-weight:bold; color:#ED1A3B">Quote # WQ<?php echo $wq_number ?></h1>
            <p style="font-family:'Trebuchet MS';">If you would like to book your shipment based on this quote, feel free to click in the <a href="<?php echo site_url('home/book_quote/'.$id) ?>">“Book Now”</a> button below and complete our <a href="#">pick up request</a>, or you can send the shipment instructions to <a href="mailto:freight@smith-cargo.com">freight@smith-cargo.com</a>.</p>
            <p style="font-family:'Trebuchet MS';">Do you have any questions? Feel free to contact our shipping specialist agents at <strong>1-844-683-7447</strong> and we will gladly assist you.</p>
            <p align="center" >&nbsp;</p>
            <h2 style="font-family:'Trebuchet MS';" align="center" >Freight Description</h2>
            <hr /> 

            <ul >
                <li><span style="font-family:'Trebuchet MS'; font-weight:bold;">Origin Zipcode: <?php echo $origin ?></span></li>
                <li><span style="font-family:'Trebuchet MS'; font-weight:bold;">Destination Zipcode:<?php echo $destination ?></span></li>
                <li><span style="font-family:'Trebuchet MS'; font-weight:bold;">Item(s):</span></li>
                <table id="items_list" align="center" style="font-family:'Trebuchet MS';border-collapse: collapse;border: 1px solid #ccc; margin-top: 15px;margin-bottom: 15px; width: 420px;">
                    <thead style="font-family:'Trebuchet MS';background-color: #C9C9CB;">
                        <tr>
                            <th style="font-family:'Trebuchet MS'; font-size:11px; color:#303030; font-weight:bold;">Pieces</th>
                            <th style="font-family:'Trebuchet MS'; font-size:11px; color:#303030; font-weight:bold;">Weight</th>
                            <th style="font-family:'Trebuchet MS'; font-size:11px; color:#303030; font-weight:bold;">Class</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $items ?>
                    </tbody>
                </table>
                <div style="font-family:'Trebuchet MS';font-weight:bold; color:#ED1A3B">TOTAL QTY: <?php echo $total_quantity ?></div>
                <div style="font-family:'Trebuchet MS';font-weight:bold; color:#ED1A3B">WEIGHT:<?php echo $total_weight ?></div>
            </ul>

            <h2 style="font-family:'Trebuchet MS';" align="center" >Customer rates</h2>
            <hr />
            <table width="440" align="center" border="0" align="center" cellpadding="0" cellspacing="0" style="font-family:'Trebuchet MS';border-collapse: collapse;border: 1px solid #ccc; width: 440px;">
                <thead style='background-color: #C9C9CB;'>
                    <tr>
                        <td width="10">&nbsp;</td>
                        <td style="font-family:'Trebuchet MS'; font-size:11px; color:#303030; font-weight:bold;">Quotes</td>
                        <td width="50" align="center" style="font-family:'Trebuchet MS'; font-size:11px; color:#303030; font-weight:bold;">Transit Time</td>
                        <td width="80" align="right" style="font-family:'Trebuchet MS'; font-size:11px; color:#303030; font-weight:bold;">Cost</td>
                        <td width="10">&nbsp;</td>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $rates ?>
                </tbody>
            </table>
            <p align="center" ><a href="<?php echo site_url('home/book_quote/'.$id)?>"><img src="<?php echo base_url() ?>public/images/BookNow.png" width="218" height="110" alt="Book Now!"/></a></p>
            <h3 align="center" style="font-family:'Trebuchet MS';color:#ED1A3B"><strong>Do not miss out on the savings! Lock in your discounted freight rate today.</strong></h3></td>
    </tr>
</table>
<table width="700" align="center" border="0" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td align="center" style="padding:18px 0; font-size:12px; font-family:'Trebuchet MS'; color:#666666; line-height:18px;">
                <br>                                
                Smith Transportation Services Inc.&nbsp;| &nbsp;1300 Sawgrass Corporate Parkway&nbsp;  |&nbsp;Sunrise, FL 33323</td>
        </tr>
    </tbody>
</table>