<div id="container">
    <div id="header"><img src="<?php echo base_url() ?>/public/images/header.png" width="1000" height="100" alt="GET A FREE FREIGHT QUOTE!" /></div>
    <div id="introtext">
        <p>Our Less Than Truckload (LTL) Freight Shipping Services can’t be compared. We provide the most comprehensive transportation solutions to clients and consumers nationwide, including customized consolidation, distribution, logistics and warehousing services. </p>
        <p>Our 24/7 online freight rate and instant quote system ensures you receive Top Cost effective handling of your freight. Start shipping with Smith-Cargo and receive the best services and prices within the logistics transportation market.</p>
    </div>
    <div id="banner">
        <div class="low-price">
            <img style="width:70px; height:70px" src="<?php echo base_url() ?>/public/images/guarantee.png" />
        </div>	
        <div id="quoteform"><!--      <div id="class"></div>-->
            <div id="pt-main" class="pt-perspective">

                <div id="page1" class="pt-page pt-page-1 pt-page-current">

                    <div id="all-divs"> <!-- all divs container -->

                        <div id="invisible-div-1"> <!--Start of invisible-div-1 -->

                            <table>
                                <tr><div style="padding-top:30px" align="left" class="subt">LTL FREIGHT QUOTE CALCULATOR</div><div style="float:left" id="sys_message"></div><div style="float:left; width:300px">&nbsp;</div></tr>
                                <!-- <div class="bloque_form"> -->
                                <tr>
                                    <td><div class="label_form">Origin Zipcode</div></td>
                                    <td align="left"><div align="left"><input name="orig_zip" id="ltl_origin" data-or="77071"  class="txt_mid" type="text" size="25" placeholder="Origin" onkeypress="return isNumberKey(event)"><div id="suggesstion-box-origin"></div><input type="hidden" id="ltl_origin_format"/></div></td>
                                    <td><div class="label_form">Destination Zipcode</div></td><td><input name="dest_zip" id="ltl_destination" class="txt_mid" data-dt="33133" type="text" size="25" placeholder="Destination" onkeypress="return isNumberKey(event)"><div id="suggesstion-box-destination"></div></td>
                                </tr></table>                                    
                            <table width="500px">
                                <tr>
                                    <td width="250px"><div align="left" class="subt">Do you know the freight Class?</div></td><td width="250px"><div align="left">
                                            <input type="radio" id="ck_class" name="FreightClass" onclick="enableClass()" value="yes">Yes&nbsp;<input type="radio" id="ck_class" name="FreightClass" onclick="disableClass()" value="no">No
                                        </div></td>
                                </tr></table>
                            <div style="background-color:#9797a6;width:500px">
                                <table width="500px">
                                    <tr class="specs">
                                        <td >Qty</td>
                                        <td>Weight</td>
                                        <td>Class</td>
                                        <td>Lenght</td>
                                        <td>Width</td>
                                        <td>Height</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr class="fields">
                                        <td ><input id="ltl_quantity" style="width:20px" type="text" />
                                            <select id="quantity_unit" name="quantity_unit">
                                                <option value="plt">Plt</option>
                                                <option value="skd">Skid</option>
                                                <option value="ctn">carton</option>
                                                <option value="ctn">Drum</option>
                                            </select>
                                        </td>
                                        <td><input id="ltl_weight" style="width:60px" type="text"/>
                                            <select id="weight_unit" name="weight_unit">
                                                <option value="lb">lbs</option>
                                                <option value="kg">kgs</option>
                                            </select></td>
                                        <td><select id="ltl_class" name="classValue">
                                                <option value="">Select one</option>
                                                <option value="50">50</option>
                                                <option value="55">55</option>
                                                <option value="60">60</option>
                                                <option value="65">65</option>
                                                <option value="70">70</option>
                                                <option value="77.5">77.5</option>
                                                <option value="85">85</option>
                                                <option value="92.5">92.5</option>
                                                <option value="100">100</option>
                                                <option value="110">110</option>
                                                <option value="125">125</option>
                                                <option value="150">150</option>
                                                <option value="200">200</option>
                                                <option value="300">300</option>
                                                <option value="400">400</option>
                                                <option value="500">500</option>
                                            </select> </td>
                                        <td ><input id="ltl_length" name="item-lenght" value="48" style="width:30px" type="text" /></td>
                                        <td ><input id="ltl_width" name="item-width" value="48" style="width:30px" type="text" /></td>
                                        <td ><input id="ltl_height" name="item-height" value="90" style="width:30px" type="text" /></td>
                                        <td>
                                            <select id="ltl_unit_dimension" name="ltl_unit_dimension">
                                                <option value="in">in</option>
                                                <option value="ft">ft</option>
                                                <option value="cm">cm</option>
                                                <option value="mt">mt</option>
                                            </select>                                                                             
                                        </td>
                                        <td ><a id="add-item" type="button" style="cursor: pointer;color:rgba(255,255,255,1);text-decoration: none;" ><img id="redAdd" src="<?php echo base_url() ?>/public/images/red-dot.png"  />Add to Quote</a>

                                    </tr>
                                </table>
                            </div> <!-- Div tabla de datos -->
                            <div id="results-table">
                                <div>
                                    <table id="items_list" style="width: 100%;"></table>
                                    <div id="sys_message"></div>
                                </div><br> 
                            </div>

                            <div align="right" style="padding-right: 0px; padding-top: 5px;"><button style="width:120px;" id="get-quote" class="pt-touch-button send" onclick="">GET YOUR QUOTE!</button></div>

                        </div> <!--End of invisible-div-1 -->



                        <div id="invisible-div-2">  <!--Start of invisible-div-2 -->
                            <div >
                                <table>
                                    <tr><div style="padding-top:15px" align="left" class="subt">LTL FREIGHT QUOTE CALCULATOR</div></tr>
                                    <!-- <div class="bloque_form"> -->
                                </table>
                                <div style="float:left; width: 200px;">
                                    <table style="width: 200px;">
                                        <tr><td class="subt2">Quote #</td><td>&nbsp;</td></tr>
                                        <tr><td>-Origin Zipcode:</td><td><div id="rst_org_zipcode"></div></td></tr>
                                        <tr><td>-Destination Zipcode:</td><td><div id="rst_dest_zipcode"></div></td></tr>
                                    </table>
                                    <div style="overflow-y: auto; height: 70px">
                                        <table></table>
                                    </div>

                                    <table>
                                        <tr><td class="subt2">Total Qty:</td><td>&nbsp;</td></tr>
                                        <tr><td class="subt2">Total Weight:</td><td>&nbsp;</td></tr>
                                    </table>
                                </div>
                                <div style="float:left;" id="carriers">


                                    <div align="right" style="padding-right:50px">
                                        <div style="background-color:#9797a6;width:280px">
                                            <table width="280px">
                                                <tr align="center" class="specs">
                                                    <td >Carrier</td>
                                                    <td>Transit Days</td>
                                                    <td>Rate</td>
                                                </tr>

                                            </table>
                                        </div> <!-- Div tabla de datos -->
                                        <div style="background-color:rgba(238,238,238,1); border: 0.5px solid rgba(153,153,153,1); width:280px; height:190px">
                                            <table id="carrier-rates" width="280px">
                                                <tr style="height:50px" align="center">
                                                    <td><div id="carrier-item">Logo&nbsp;</div></td>
                                                    <td><div id="transit-Days">Days&nbsp;</div></td>
                                                    <td><div id="rate-item"><img src="<?php echo base_url() ?>/public/images/loading.gif" style="width:15px; height:15px" />&nbsp;</div></td></tr>
                                                <tr align="center">
                                                    <td><div id="carrier-item">Logo&nbsp;</div></td>
                                                    <td><div id="transit-Days">Days&nbsp;</div></td>
                                                    <td><div id="rate-item"><img src="<?php echo base_url() ?>/public/images/loading.gif" style="width:15px; height:15px" />&nbsp;</div></td></tr>
                                            </table>
                                        </div> <!-- end carriers -->
                                    </div>
                                </div>
                            </div>



                            <div id="front-layer"> <!-- start front-layer --> <!-- Contact Form -->


                                <!-- <form id="contact-data"> -->

                                <div id="contact-box" style="height: 300px">
                                    <table id="contact-table">
                                        <input type="hidden" id="id_contact" name="id_contact-name" />
                                        <tr><td class="subt2">CONTACT INFORMATION</td></tr>
                                        <tr><td><div style="float:left; background-color: #FFA1A1;" id="contact_msg"></div><div style="float:left; width:20px">&nbsp;</div><td></tr>
                                        <tr>
                                            <td>Contact Name</td>
                                            <td>Contact Phone</td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" id="ltl_name" name="client-name" /></td>
                                            <td><input type="text" id="ltl_phone" name="client-phone" /></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>Company</td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" id="ltl_email" name="client-email"/></td>
                                            <td><input type="text" id="ltl_company" name="client-company"/></td>
                                        </tr>

                                    </table>
                                    <table>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>** You will receive a copy in your email too.</td>
                                        </tr>
                                    </table>

                                    <table width="280px" id="contact-table2">
                                        <tr>
                                            <td align="center"><button style="width:200px;" id="contact_submit" class="pt-touch-button send" onclick="">OK - LET ME SEE THE RATES</button></td>
                                        </tr>
                                    </table>
                                </div>

                            </div> <!-- End for contact Form -->


                        </div> <!-- End div for invisible-div-2-->                                                                   

                        <div id="invisible-div-3"> <!-- Start Invisible Div 3 -->
                            <div>
                                <table>
                                    <tr><div style="padding-top:15px" align="left" class="subt">LTL FREIGHT QUOTE CALCULATOR</div></tr>
                                    <!-- <div class="bloque_form"> -->
                                </table>
                                <div style="float:left; width: 200px;">
                                    <table style="width: 200px;">
                                        <tr><td id="quote_number" class="subt2" style="font-weight: 600">Quote #</td><td>&nbsp;</td></tr>
                                        <tr><td>-Origin Zipcode:</td><td><div id="rst3_org_zipcode"></div></td></tr>
                                        <tr><td>-Destination Zipcode:</td><td><div id="rst3_dest_zipcode"></div></td></tr>
                                    </table>
                                    <div style="overflow-y: auto; height: 70px">
                                        <table id="tbl_result_items"></table>
                                    </div>

                                    <table>
                                        <tr><td class="subt2">Total Qty:</td><td id="total_quantity">Test</td></tr>
                                        <tr><td class="subt2">Total Weight:</td><td id="total_weight">&nbsp;</td></tr>
                                    </table>
                                </div>
                                <div style="float:left;" id="carriers">


                                    <div align="right" style="padding-right:50px">
                                        <div style="background-color:#9797a6;width:280px">
                                            <table width="280px">
                                                <tr align="center" class="specs">
                                                    <td >Carrier</td>
                                                    <td>Transit Days</td>
                                                    <td>Rate</td>
                                                </tr>

                                            </table>
                                        </div> <!-- Div tabla de datos -->
                                        <div style="background-color:rgba(238,238,238,1); border: 0.5px solid rgba(153,153,153,1); width:280px; height:190px">
                                            <div id="img_loading" style="text-align: center;"><img src="<?php echo base_url() ?>/public/images/loading.gif" style="width: 100px; height: 100px;top: 40px;position: relative;" /></div>
                                            <table id="listado_precios" width="250px" style="border-collapse: collapse; float: left; margin-left: 5%;" class="scroll"></table>
                                        </div> <!-- end carriers -->
                                    </div>
                                </div>
                                <table style="padding-left:30px" id="buttons">
                                    <tr><td>&nbsp;</td></tr>
                                    <tr><td><div align="right" style="padding-right:50px"><button style="width:120px;" id="rate_another" class="pt-touch-button send" onclick="location.reload();">RATE ANOTHER</button></div></td>
                                        <td><div align="right" style="padding-right:50px"><button style="width:120px;" id="send_email" class="pt-touch-button send">SEND BY EMAIL</button></div></td>                                    
                                        <td><div align="right" style="padding-right:50px"><button style="width:120px;" id="rate_another" class="pt-touch-button send" onclick="book_now()">BOOK NOW!</button></div></td>
                                    </tr>
                                </table>
                            </div>

                        </div><!--End of invisible-div-3 -->                               

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="chatbar">
        <div id="chattext">
            <h1>Save valuable time with Smith, Shipping LTL cargo fast and easy!</h1>
        </div>
        <div id="chatbutton">
            <!-- LiveZilla Chat Button Link Code (ALWAYS PLACE IN BODY ELEMENT) --><!-- LiveZilla Tracking Code (ALWAYS PLACE IN BODY ELEMENT) --><div id="livezilla_tracking" style="display:none"></div><script type="text/javascript">
                var script = document.createElement("script");
                script.async = true;
                script.type = "text/javascript";
                var src = "http://www.leanstaffing.com/livechat/server.php?a=86ca7&rqst=track&output=jcrpt&intgroup=U21pdGhDYXJnbyAtIEN1c3RvbWVyIFNlcnZpY2U_&hg=P1NtaXRoQ2FyZ28gLSBDdXN0b21lciBTZXJ2aWNl&eh=aHR0cDovL3d3dy5sZWFuc3RhZmZpbmcuY29tL2xpdmVjaGF0L2ltYWdlcy9sb2dvcy9zbWl0aC5naWY_&dl=MQ__&nse=" + Math.random();
                setTimeout("script.src=src;document.getElementById('livezilla_tracking').appendChild(script)", 1);</script><noscript><img src="http://www.leanstaffing.com/livechat/server.php?a=86ca7&amp;rqst=track&amp;output=nojcrpt" width="0" height="0" style="visibility:hidden;" alt=""></noscript><!-- http://www.LiveZilla.net Tracking Code --><a href="javascript:void(window.open('http://www.leanstaffing.com/livechat/chat.php?a=ae679&amp;intgroup=U21pdGhDYXJnbyAtIEN1c3RvbWVyIFNlcnZpY2U_&amp;hg=P1NtaXRoQ2FyZ28gLSBDdXN0b21lciBTZXJ2aWNl&amp;eh=aHR0cDovL3d3dy5sZWFuc3RhZmZpbmcuY29tL2xpdmVjaGF0L2ltYWdlcy9sb2dvcy9zbWl0aC5naWY_&amp;dl=MQ__&amp;epc=I2ZmMDAwMA__&amp;etc=I2NhMDAwMA__','','width=590,height=760,left=0,top=0,resizable=yes,menubar=no,location=no,status=yes,scrollbars=yes'))" class="lz_cbl"><img src="http://www.leanstaffing.com/livechat/image.php?a=2b751&amp;id=3&amp;type=inlay&amp;hg=P1NtaXRoQ2FyZ28gLSBDdXN0b21lciBTZXJ2aWNl" width="220" height="75" style="border:0px;" alt="LiveZilla Live Chat Software"></a><!-- http://www.LiveZilla.net Chat Button Link Code -->

        </div> 
    </div>
    <div id="titleone">
        <h2>Smith Cargo is leader in:</h2>
    </div>
    <div id="contenttext">
        <div id="listone">
            <ul>
                <li>
                    <h4>Inbound and outbound Freight Routing</h4>
                </li>
                <li>
                    <h4> Specialized LTL Volume Quote</h4>
                </li>
                <li>
                    <h4> Freight Shipments Tracking</h4>
                </li>
                <li>
                    <h4> Cost Savings</h4>
                </li>
            </ul>
        </div>
        <div id="listtwo">
            <ul>
                <li>
                    <h4>Volume LTL</h4>
                </li>
                <li>
                    <h4> Guaranteed Delivery and Expedited LTL</h4>
                </li>
                <li>
                    <h4> Refrigerated LTL</h4>
                </li>
                <li>
                    <h4> Real-time Load Tracking and Metrics</h4>
                </li>
            </ul>
        </div>
    </div>
    <div id="titletwo">
        <h3>Trust your shipment to us! Always relying on our loyal carriers:</h3>
    </div>
    <div id="footer"></div>
</div>
<script>
    $("#contact_submit").click(function () {
        if (valContactForm()) {
            $("#invisible-div-3").show();
            $('#invisible-div-3').transition({top: "15px"});
            $("#invisible-div-2").hide();
            $("#invisible-div-1").hide();
            sendRatesSmith();
        }
    });
</script>
<div id="result"></div>


<!-- form itself -->

<form id="test-form" class="white-popup-block mfp-hide">
    <h1>Send to email</h1>
    <fieldset style="border:0;">

        <label for="email">Email</label>
        <input id="email" name="email" type="email" placeholder="example@domain.com" required="">

        <div align="right" style="padding-right: 0px; padding-top: 5px; text-align: center; margin-top: 15px;"><button style="width:120px;" id="send_mail" class="pt-touch-button send" onclick="">Send</button></div>
    </fieldset>
</form>
<div class="white-popup" style="display:none">
    <div id="">
        <table id="contact-table">
            <tr>
                <td class="subt2">Send Rate to emails</td>
            </tr>            
            <tr>
                <td class="subt2"><input type="text" id="emails" style="width:190px"></td>
            </tr>
        </table>
        <table width="200px" id="contact-table2">
            <tr>
                <td align="center"><button style="width:80px;" id="ok_send_button" class="pt-touch-button send" onclick="closePopup()" >OK</button></td>
            </tr>
        </table>
    </div>
</div>
<style>
    #test-form{
        background-color: #fff;
        width: 500px;
        text-align: center;
        margin-left: 35%;        
    }
</style>
<script src='http://dimsemenov-static.s3.amazonaws.com/dist/jquery.magnific-popup.min.js'></script>       
<script>
                    $('#send_email').magnificPopup({
                        items: [
                            {
                                src: $('.white-popup'), // Dynamically created element
                                type: 'inline',
                            }
                        ]
                    });

                    $('#send_emailx').magnificPopup({
                        items: [
                            {
                                src: $('<div class="white-popup"><div id=""><table id="contact-table" style="margin-left: 25px;"><tr><td class="subt2">THE EMAIL HAS BEEN SENT</td></tr><tr><td class="subt2">PLEASE CHECK YOUR INBOX</td></tr></table><table style="width=200px" width="200px" id="contact-table2"><tr><td align="center"><button style="width:80px;" id="ok_button" class="pt-touch-button send" onclick="closePopup()" >OK</button></td></tr></table></div></div>'), // Dynamically created element
                                type: 'html',
                                modal: false,
                            }
                        ],
                        gallery: {
                            enabled: false
                        },
                        type: 'image' // this is a default type
                    });
                    // $('#ltl_mail2').html('hjgj');
                    // Close Magnific


                    function closePopup() {
                        $.magnificPopup.close();
                    }
</script>
