<!doctype html>
<html>
    <head>

        <title>LTL Freight rates - Smith Cargo Transportation Services</title>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

        <!--<link href="<?php echo base_url() ?>public/css/layout.css" rel="stylesheet" type="text/css" />-->

        <!-- HEADER STYLE -->
    </head>
    <body>        
        <form id="frm_book" action="<?php echo site_url('home/update_book') ?>">
            <input type="hidden" name="id" value="<?php echo $contact['idcontact'] ?>"/>
            <input type="hidden" name="items_new" id="item_new" value=""/>
            <div id="register_form_error" class="alert alert-error"> Dynamic </div>
            <table width="700" border="3" cellspacing="0" cellpadding="0" align="center" bordercolor="#ED1A3B" bgcolor="#FFFFFF">
                <tr>
                    <td style="padding: 10px"><img src="<?php echo base_url() ?>public/images/AdwordsCustomerBookingHeader.png" width="700" height="60" alt="AdwordsQuote" />
                        <h1 align="center" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-weight:bold; color:#ED1A3B">Booking Quote # WQ<?php echo $contact['idcontact'] + 31320 ?></h1>
                        <p style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">Once you send this form you will receive an email from one of our freight especialist containing our BOL with a pickup number, if we have any inquiry about this quote, we will contact:</p>
                        <h2 align="center" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">Contact Information</h2>
                        <hr />

                        <ul style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">

                            <li><span style=" font-weight:bold;">Name:<?php echo $contact['name'] ?></span></li>
                            <li><span style=" font-weight:bold;">Company:<?php echo $contact['company'] ?></span></li>
                            <li><span style=" font-weight:bold;">Phone:<?php echo $contact['phone'] ?></span></li>
                            <li><span style=" font-weight:bold;">E-mail:<?php echo $contact['email'] ?></span></li>
                        </ul>
                        <h2 align="center" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">Rate and Carrier Selection</h2>
                        <hr /> 

                        <p style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">Please select the carrier of your preference</p>
                        <div id="msg_rate" style="background-color: #FBADAD; width: 200px; margin: 10px 25px;font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif;;"></div>
                        <p style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                        <table width="440" align="center" border="0" align="center" cellpadding="0" cellspacing="0" style="font-family:'Trebuchet MS';border-collapse: collapse;border: 1px solid #ccc; width: 440px;">
                            <thead style='background-color: #C9C9CB;'>
                                <tr>
                                    <td style="font-family:'Trebuchet MS'; font-size:11px; color:#303030; font-weight:bold;width: 20px;"></td>
                                    <td style="font-family:'Trebuchet MS'; font-size:11px; color:#303030; font-weight:bold;">Carrier</td>
                                    <td width="50" align="center" style="font-family:'Trebuchet MS'; font-size:11px; color:#303030; font-weight:bold;">Transit Time</td>
                                    <td width="80" align="center" style="font-family:'Trebuchet MS'; font-size:11px; color:#303030; font-weight:bold;">Cost</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($rates as $rate => $row) {
                                    echo'<tr>'
                                    . '<td><input type="radio" name="rate" value="' . $row['idrate'] . '"></td>'
                                    . '<td style="text-align: center; width:90px">' . $row['carrier'] . '</td>'
                                    . '<td style="text-align: center; width:90px">' . $row['days'] . '</td>'
                                    . '<td style="text-align: center;">$' . $row['total'] . '</td>'
                                    . '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>                          
                        </p>
                        <h2 align="center" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">Item Description</h2>
                        <hr />
                        <div id="msg_item" style="background-color: #FBADAD; width: 200px; margin: 10px 25px;font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif;;"></div>
                        <p align="center" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">If your freight description has change please requote using our <a href="<?php echo site_url() ?>">online rate calculator</a>.</p>
                        <table id="tbl_items" width="650" border="0" cellspacing="0" cellpadding="0" align="center" bordercolor="#ED1A3B">
                            <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-weight:bold; background-color:#999;" >
                                <td>Quantity</td>
                                <td>Weight</td>
                                <td>Class</td>
                                <td>NMFC</td>
                                <td>Description</td>
                            </tr>
                            <?php
                            foreach ($items as $item => $row) {
                                echo'<tr class="item" data-id="' . $row['iditem'] . '">'
                                . '<td style="text-align: center; width:90px">' . $row['quantity'] . ' ' . $row['quantity_unit'] . '</td>'
                                . '<td style="text-align: center; width:90px">' . $row['weight'] . ' ' . $row['weight_unit'] . '</td>'
                                . '<td style="text-align: center; width:90px">' . $row['class'] . '</td>'
                                . '<td><input type="text" class="nmfc" /></td>'
                                . '<td><input type="text" class="desc" /></td>'
                                . '</tr>';
                            }
                            ?>
                        </table>
                        <h2 align="center" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">Shipping instructions</h2>
                        <hr /> 

                        <p align="center" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">Please fill up the form with all pertinent information</p>
                        <div id="contact_msg" style="background-color: #FBADAD; width: 200px; margin: 10px 25px;font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif;;"></div>
                        <table width="650" border="0" cellspacing="0" cellpadding="0" align="center" bordercolor="#ED1A3B">
                            <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-weight:bold; background-color:#999">
                                <td colspan="2" align="center">Shipper (From)</td>
                                <td colspan="2" align="center">Consignee (To)</td>
                            </tr>
                            <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                                <td><strong>Name</strong></td>
                                <td><label for="textfield"></label>
                                    <input type="text" name="sh_name" id="sh_name" /></td>
                                <td><strong>Name</strong></td>
                                <td><input type="text" name="cs_name" id="cs_name"/></td>
                            </tr>
                            <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                                <td><strong>Address 1</strong></td>
                                <td><input type="text" name="sh_address" id="sh_address"/></td>
                                <td><strong>Address 1</strong></td>
                                <td><input type="text" name="cs_address" id="cs_address"/></td>
                            </tr>
                            <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                                <td><strong>Address 2</strong></td>
                                <td><input type="text" name="sh_address2" id="sh_address2"/></td>
                                <td><strong>Address 2</strong></td>
                                <td><input type="text" name="cs_address2" id="cs_address2"/></td>
                            </tr>
                            <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                                <td><strong>City</strong></td>
                                <td><input type="text" name="sh_city" id="sh_city" readonly="readonly" value="<?php echo str_replace(",", "", $or_city) ?>" /></td>
                                <td><strong>City</strong></td>
                                <td><input type="text" name="cs_city" id="cs_city" readonly="readonly" value="<?php echo str_replace(",", "", $dt_city) ?>"/></td>
                            </tr>
                            <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                                <td><strong>State</strong></td>
                                <td><input type="text" name="sh_state" id="sh_state" readonly="readonly" value="<?php echo $or_state ?>"/></td>
                                <td><strong>State</strong></td>
                                <td><input type="text" name="cs_state" id="cs_state" readonly="readonly" value="<?php echo $dt_state ?>"/></td>
                            </tr>
                            <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                                <td><strong>Zipcode</strong></td>
                                <td><input type="text" name="sh_zipcode" id="sh_zipcode" readonly="readonly" value="<?php echo $or_zipcode ?>"/></td>
                                <td><strong>Zipcode</strong></td>
                                <td><input type="text" name="cs_zipcode" id="cs_zipcode" readonly="readonly" value="<?php echo $dt_zipcode ?>"/></td>
                            </tr>
                            <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                                <td><strong>Country</strong></td>
                                <td><input type="text" name="sh_country" id="sh_country" readonly="readonly" value="<?php echo $or_country ?>"/></td>
                                <td><strong>Country</strong></td>
                                <td><input type="text" name="cs_country" id="cs_country" readonly="readonly" value="<?php echo $dt_country ?>"/></td>
                            </tr>
                            <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                                <td><strong>Contact</strong></td>
                                <td><input type="text" name="sh_contact" id="sh_contact"/></td>
                                <td><strong>Contact</strong></td>
                                <td><input type="text" name="cs_contact" id="cs_contact"/></td>
                            </tr>
                            <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                                <td><strong>Phone</strong></td>
                                <td><input type="text" name="sh_phone" id="sh_phone"/></td>
                                <td><strong>Phone</strong></td>
                                <td><input type="text" name="cs_phone" id="cs_phone"/></td>
                            </tr>
                            <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                                <td><strong>Email</strong></td>
                                <td><input type="text" name="sh_email" id="sh_email"/></td>
                                <td><strong>Email</strong></td>
                                <td><input type="text" name="cs_email" id="cs_email"/></td>
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
                                    <textarea name="esp_inst" id="textarea" cols="45" rows="5" style="margin-left: 0px; margin-right: 0px; width: 618px;"></textarea></td>
                            </tr>
                            <tr align="center" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-weight:bold; background-color:#999">
                                <td colspan="4">References</td>
                            </tr>
                            <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                                <td><strong>Purchase Order</strong></td>
                                <td><input type="text" name="pr_order" id="pr_order"/></td>
                                <td><strong>Reference # 1:</strong></td>
                                <td><input type="text" name="ref_1" id="ref_1"/></td>
                            </tr>
                            <tr style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                                <td><strong>Sales Order </strong></td>
                                <td><input type="text" name="sales_order" id="sales_order"/></td>
                                <td><strong>Reference # 2:</strong></td>
                                <td><input type="text" name="ref_2" id="textfield26"/></td>
                            </tr>
                        </table>

                        <p align="center" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
                            <input type="image" src="<?php echo base_url() ?>public/images/SendPickup.png" width="218" height="110" alt="Send Pickup">
                            <br />
                        </p>
                        <h3 align="center" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; color:#ED1A3B"><strong>Do you have any questions? Feel free to contact our shipping specialist agents <br />
                                at 1-844-683-7447</strong></h3></td>
                </tr>
            </table>
        </form>
        <script>
            $(function () {
                $('#contact_msg').hide();
                $("#msg_item").hide();
                var items = [];
                $("#register_form_error").hide();

                $('#frm_book').submit(function (evt) {
                    evt.preventDefault();

                    $('#contact_msg').hide();
                    $("tr.item").each(function () {
                        var item_id = $(this).data("id");
                        var item_nmfc = $(this).find("input.nmfc").val();
                        var item_desc = $(this).find("input.desc").val();

                        items.push({id: item_id,
                            nmfc: item_nmfc,
                            desc: item_desc
                        });
                    });

                    var json = JSON.stringify(items);

                    $('#item_new').val(json);


                    var url = $(this).attr('action');
                    var postData = $(this).serialize();

                    if (valContactForm()) {
                        $.post(url, postData, function (o) {
                            if (o.result == 1) {
                                alert('We received your book. A confirmation email has been sent to you.');
                                window.location.href = '<?php echo site_url('home') ?>';
                            } else {
                                $("#register_form_error").show();
                                var output = '<ul>';
                                for (var key in o.error) {
                                    var value = o.error[key];
                                    output += '<li>' + value + '</li>';
                                }
                                output += '</ul>';
                                $("#register_form_error").html(output);
                            }
                        }, 'json');
                    } else {
                        show_missed(missed);
                    }

                });

            });
            var missed;

            function valContactForm() {

                $('#contact_msg').hide();
                $("#msg_item").hide();
                $('#msg_rate').hide();

                if ($('input[name="rate"]:checked').length == 0) {
                    $("#msg_rate").text('Carrier selection missing');
                    missed = $("#msg_rate");
                    console.log('carrier');
                    return false;
                }

                if ($(".desc").val() == '') {
                    $("#msg_item").text('Item description is required');
                    missed = $("#msg_item");
                    console.log('desc mi');
                    return false;
                }

                //Shipper

                if ($("#sh_name").val() == '') {
                    $("#contact_msg").text('Shipper name is required');
                    missed = $("#contact_msg");
                    return false;
                }
                if ($("#sh_address").val() == '') {
                    $("#contact_msg").text('Shipper address 1 is required');
                    missed = $("#contact_msg");
                    return false;
                }
                if ($("#sh_country").val() == '') {
                    $("#contact_msg").text('Shipper country is required');
                    missed = $("#contact_msg");
                    return false;
                }
                if ($("#sh_contact").val() == '') {
                    $("#contact_msg").text('Shipper contact is required');
                    missed = $("#contact_msg");
                    return false;
                }
                if ($("#sh_contact").val() == '') {
                    $("#contact_msg").text('Shipper contact is required');
                    missed = $("#contact_msg");
                    return false;
                }
                if ($("#sh_phone").val() == '') {
                    $("#contact_msg").text('Shipper phone is required');
                    missed = $("#contact_msg");
                    return false;
                }

                //consignee

                if ($("#cs_name").val() == '') {
                    $("#contact_msg").text('Consignee name is required');
                    missed = $("#contact_msg");
                    return false;
                }
                if ($("#cs_address").val() == '') {
                    $("#contact_msg").text('Consignee address 1 is required');
                    missed = $("#contact_msg");
                    return false;
                }
                if ($("#cs_country").val() == '') {
                    $("#contact_msg").text('Consignee country is required');
                    missed = $("#contact_msg");
                    return false;
                }
                if ($("#cs_contact").val() == '') {
                    $("#contact_msg").text('Consignee contact is required');
                    missed = $("#contact_msg");
                    return false;
                }
                if ($("#cs_contact").val() == '') {
                    $("#contact_msg").text('Consignee contact is required');
                    missed = $("#contact_msg");
                    return false;
                }
                if ($("#cs_phone").val() == '') {
                    $("#contact_msg").text('Consignee phone is required');
                    missed = $("#contact_msg");
                    return false;
                }

                return true;
            }

            function show_missed(missed) {
                missed.show();
                $('html,body').animate({
                    scrollTop: missed.offset().top
                }, 1000);
            }
        </script>