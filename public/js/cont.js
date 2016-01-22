$(function () {

    $('.popup-with-form').magnificPopup({
        type: 'inline',
        preloader: false,
        focus: '#name',
        // When elemened is focused, some mobile browsers in some cases zoom in
        // It looks not nice, so we disable it:
        callbacks: {
            beforeOpen: function () {
                if ($(window).width() < 700) {
                    this.st.focus = false;
                } else {
                    this.st.focus = '#name';
                }
            }
        }
    });


    $("#ltl_origin").keyup(function () {
        var str = $(this).val();
        var n = str.length;


        if (n > 2) {
            $.ajax({
                type: "POST",
                url: "home/get_zipcode/" + str + "/1",
                data: {
                    zip: str
                },
                dataType: "json",
                beforeSend: function () {
                    $("#ltl_origin").css("background", "#FFF url(public/images/LoaderIcon.gif) no-repeat 115px");
                },
                success: function (o) {

                    var output = '<ul id="country-list">';
                    for (var i = 0; i < o.length; i++) {
                        var zip = "'" + o[i].zip + ' - ' + o[i].primary_city + ', ' + o[i].state + "'";
                        output += '<li onclick="selectZipcodeOrigin(' + zip + ')">' + o[i].primary_city + ', ' + o[i].state + ' ' + o[i].zip + '</li>';
                    }
                    output += '</ul>';

                    $("#suggesstion-box-origin").show();
                    $("#suggesstion-box-origin").html(output);
                    $("#ltl_origin").css("background", "#FFF");

                }
            });
        }
    });

    $("#ltl_destination").keyup(function () {
        var str = $(this).val();
        var n = str.length;


        if (n > 2) {
            $.ajax({
                type: "POST",
                url: "home/get_zipcode/" + str + "/1",
                dataType: "json",
                beforeSend: function () {
                    $("#ltl_destination").css("background", "#FFF url(public/images/LoaderIcon.gif) no-repeat 115px");
                },
                success: function (o) {

                    var output = '<ul id="country-list">';
                    for (var i = 0; i < o.length; i++) {
                        var zip = "'" + o[i].zip + ' - ' + o[i].primary_city + ', ' + o[i].state + "'";
                        output += '<li onclick="selectZipcodeDestination(' + zip + ')">' + o[i].primary_city + ', ' + o[i].state + ' ' + o[i].zip + '</li>';
                    }
                    output += '</ul>';

                    $("#suggesstion-box-destination").show();
                    $("#suggesstion-box-destination").html(output);
                    $("#ltl_destination").css("background", "#FFF");

                }
            });
        }
    });



    getQuoteNumber();
    $("#load").hide();
    $("#users-contain").hide();

    $("#invisible-div-2").hide();
    $("#invisible-div-3").hide();
    $("#invisible-div-4").hide();

    var dialog, form,
            // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
            emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
            name = $("#name"),
            phone = $("#phone"),
            company = $("#company"),
            email = $("#email"),
            password = $("#password"),
            allFields = $([]).add(name).add(phone).add(company).add(email),
            tips = $(".validateTips");

    function updateTips(t) {
        tips
                .text(t)
                .addClass("ui-state-highlight");
        setTimeout(function () {
            tips.removeClass("ui-state-highlight", 1500);
        }, 500);
    }

    function checkLength(o, n, min, max) {
        if (o.val().length > max || o.val().length < min) {
            o.addClass("ui-state-error");
            updateTips("Length of " + n + " must be between " +
                    min + " and " + max + ".");
            return false;
        } else {
            return true;
        }
    }

    function checkRegexp(o, regexp, n) {
        if (!(regexp.test(o.val()))) {
            o.addClass("ui-state-error");
            updateTips(n);
            return false;
        } else {
            return true;
        }
    }

    function addUser() {
        var valid = true;
        allFields.removeClass("ui-state-error");

        valid = valid && checkLength(name, "username", 3, 16);
        valid = valid && checkLength(email, "email", 6, 80);
        valid = valid && checkLength(password, "password", 5, 16);

        valid = valid && checkRegexp(name, /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter.");
        valid = valid && checkRegexp(email, emailRegex, "eg. ui@jquery.com");
//        valid = valid && checkRegexp(password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9");

        if (valid) {
            $("#users tbody").append("<tr>" +
                    "<td>" + name.val() + "</td>" +
                    "<td>" + email.val() + "</td>" +
                    "<td>" + password.val() + "</td>" +
                    "</tr>");
            dialog.dialog("close");
        }
        return valid;
    }

    function sendContactForm() {

        var valid = true;
        allFields.removeClass("ui-state-error");

        valid = valid && checkLength(name, "name", 3, 16);
        valid = valid && checkLength(phone, "phone", 3, 16);
        valid = valid && checkLength(company, "company", 3, 16);
        valid = valid && checkLength(email, "email", 6, 80);
//    valid = valid && checkLength(password, "password", 5, 16);

        valid = valid && checkRegexp(email, emailRegex, "Enter a valid email, eg. jsmith@lss.com");
//    valid = valid && checkRegexp(password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9");
    }

    $("#mail_other").button().on("click", function () {

        $("#invisible-div-4").show();
        $('#invisible-div-4').transition({top: "15px"});
        $("#invisible-div-1").hide();
        $("#invisible-div-2").hide();
        $("#invisible-div-3").hide();

    });

    $("#get-quote").button().on("click", function () {

        if (valRateForm()) {
            get_rate();
            set_rate_info();

            $("#invisible-div-2").show();
            $('#invisible-div-2').transition({top: "15px"});
            $("#invisible-div-1").hide();
            $("#invisible-div-3").hide();

        }
    });


    $("#add-item").button().on("click", function () {
        if (valItem()) {
            addItems();
        }
    });


// Rate another

    $("rate_another").button().on("click", function () {

        location.reload();
    });


// Transition layers 
//
//    $("#get-quote").click(function () {
//        $("#invisible-div-2").show();
//        $('#invisible-div-2').transition({top: "15px"});
//        $("#invisible-div-1").hide();
//        $("#invisible-div-3").hide();
//    });

// Send quote to email


    $("#send_email").button().on("click", function () {
//        $("#invisible-div-4").show();
//        $('#invisible-div-4').transition({top: "15px"});
//        $("#invisible-div-1").hide();
//        $("#invisible-div-2").hide();
//        $("#invisible-div-3").hide();


        $(".white-popup").show();

//        getSelectedRates();
//    $("#invisible-div-2").show();
    });

    $("#ok_send_button").button().on("click", function () {

        getSelectedRates();

    });



    // begin with item's field disabled


    //Disable Lenght Width Height

    document.getElementById('ltl_quantity').disabled = true;
    document.getElementById('ltl_weight').disabled = true;
    document.getElementById('ltl_class').disabled = true;

    document.getElementById('ltl_length').disabled = true;
    document.getElementById('ltl_width').disabled = true;
    document.getElementById('ltl_height').disabled = true;

});
var sw = 0;
var sw_item = 0;
var items = [];
var total_amount = 0;
var total_weight = 0;
var total_quantity = 0;
var rates = [];

var class_item = 0;


function selectZipcodeOrigin(zip) {
    $('#ltl_origin').val(zip);
    $('#suggesstion-box-origin').hide();
}

function selectZipcodeDestination(zip) {
    $('#ltl_destination').val(zip);
    $('#suggesstion-box-destination').hide();
}

function get_rate() {

    $("#invisible-div-2").show();
    $('#invisible-div-2').transition({top: "15px"});
    $("#invisible-div-1").hide();
    $("#invisible-div-3").hide();

    var json = JSON.stringify(items);
    $.ajax({
        type: "POST",
        url: 'home/get_rate',
        beforeSend: function () {
            $("#completo").html('cargando').fadeOut();
            $("#cargando").fadeIn();
        },
        data: {
            origin: $("#ltl_origin").val(),
            destination: $("#ltl_destination").val(),
            items: json
        },
        dataType: "xml",
        success: function (xml) {
//            $('#result').html(xml);
            get_price_sheets(xml);
        },
        error: function () {
            alert('Ocurrio un problema con el procesamiento del XML');
        },
        complete: function () {
            $("#cargando").hide();
            $("#completo").fadeIn();
        }
    });
}

function set_rate_info() {

    var total_w = 0;
    var total_w = 0;

    tHead = $('<thead>');
    tRow = $('<tr>');
    tEtqItem = $('<td class="subt2">').html("Item");

    tRow.append(tEtqItem);
    tHead.append(tRow);

    $('#tbl_result_items').append(tHead);
    for (var key in items) {
        var obj = items[key];

        tRow = $('<tr>');
        tEtqItem = $('<td>').html('- ' + obj.quantity + '@' + obj.length + 'x' + obj.width + 'x' + obj.height + ' ' + 'Cl' + obj.class + ' ' + obj.weight + obj.weight_unit);
        tRow.append(tEtqItem);
        $('#tbl_result_items').append(tRow);
    }

    //div 2
    $("#rst_org_zipcode").html($("#ltl_origin").val());
    $("#rst_dest_zipcode").html($("#ltl_weight").val());

    //div 3
    $("#rst3_org_zipcode").html($("#ltl_origin").val());
    $("#rst3_dest_zipcode").html($("#ltl_destination").val());
}

function addItems() {
    if ($('#ltl_class').val() == '') {
        getClassByDimensions();
    }

    // Create and add table headers
    if (sw_item == 0) {
        tHead = $('<thead>');
        tRow = $('<tr>');
        tEtqPieces = $('<th>').html("Pieces");
        tEtqWeight = $('<th>').html("Weight");
        tEtqClass = $('<th>').html("Class");

        tRow.append(tEtqPieces);
        tRow.append(tEtqWeight);
        tRow.append(tEtqClass);

        tHead.append(tRow);

        $('#items_list').append(tHead);

    }

    // header end

    //create and add table content
    sw_item++;
    tRow = $('<tr>');

    tEtqPieces = $('<td width=80 align= center>').html($('#ltl_quantity').val());
    tEtqWeight = $('<td width=80 align= center>').html($('#ltl_weight').val() + ' ' + $('#weight_unit').val());
    tEtqClass = $('<td width=80 align= center>').html(class_item);

    tRow.append(tEtqPieces);
    tRow.append(tEtqWeight);
    tRow.append(tEtqClass);
    $('#items_list').append(tRow);
    $('#result2').text(class_item);

    var qty = parseInt($('#ltl_quantity').val());
    var wgt = parseInt($('#ltl_weight').val());
    var wgt_unit = $('#weight_unit');

    if (wgt_unit.val() == 'kg') {
        wgt = wgt * 2.20462;
    }

    total_quantity = total_quantity + qty;
    total_weight = total_weight + wgt;

    $('#total_quantity').html(total_quantity);
    $('#total_weight').html(total_weight + 'lb');

    items.push({quantity: $('#ltl_quantity').val(),
        quantity_unit: $('#quantity_unit').val(),
        weight: $('#ltl_weight').val(),
        weight_unit: $('#weight_unit').val(),
        class: class_item,
        length: $('#ltl_length').val(),
        width: $('#ltl_width').val(),
        height: $('#ltl_height').val()});
    clearItem();
}

function get_price_sheets(xml) {

    var numCols = 1;
    var total_amount = 0;
    var total_weight = 0;
    $(xml).find('PriceSheet').each(function (i) {
        //valores 
        var ContractName = $(this).find("CarrierName").text();
        var service = $(this).find("Service").text();
        var serviceDays = parseFloat($(this).find("ServiceDays").text());
        var distance = parseFloat($(this).find("Distance").text());
        var total = $(this).find("Total").text();
        var id = $(this).find("Id").text();

        var type = $(this).attr('type');

        console.log('type: ' + $(this).attr('type'));
        //recorrido de valores
        if (!(i % numCols))
            tRow = $('<tr>');

        tContractName = $('<td id="compnay" style="border-bottom: 2px solid #fff;" width="120px" align= left>').html(ContractName);
        tServiceDays = $('<td align= center style="border-bottom: 2px solid #fff;">').html(serviceDays);
        tTotal = $('<td align= right style="border-bottom: 2px solid #fff;">').html('$' + total);

        tRow.append(tContractName);
        tRow.append(tServiceDays);
        tRow.append(tTotal);

        if (type == 'Cost') {
            if (ContractName == 'ESTES EXPRESS SUNRISE') {
                if (total_quantity < 4) {
                    rates.push({contract_name: ContractName,
                        service_days: serviceDays,
                        total: total
                    });
                    total_amount += total;
                }
            } else {
                rates.push({contract_name: ContractName,
                    service_days: serviceDays,
                    total: total
                });
                total_amount += total;
            }
        }
    });
    sortPriceSheet(rates);
    $('#listado_precios').show();
    $("#img_loading").hide();
//    resizeTable();
}

function sortPriceSheet(rates) {
    var sort_rates = rates.sort(function (a, b) {
        return a.total - b.total;
    });

    for (var i = 0; i < sort_rates.length; i++) {
        var bold = 'inherit';
        tRow = $('<tr>');
        if (i == 0)
            bold = '600';
        tContractName = $('<td id="compnay" style="border-bottom: 2px solid #fff; font-weight: ' + bold + '" width="120px" align= left>').html(sort_rates[i].contract_name);
        tServiceDays = $('<td align= center style="border-bottom: 2 px solid #fff; font-weight: ' + bold + '">').html(sort_rates[i].service_days);
        tTotal = $('<td align= right style="border-bottom: 2px solid #fff; font-weight: ' + bold + '">').html('$' + sort_rates[i].total);

        tRow.append(tContractName);
        tRow.append(tServiceDays);
        tRow.append(tTotal);

        $('#listado_precios').append(tRow);
    }

}

function resizeTable() {
// Change the selector if needed
    var $table = $('#listado_precios'),
            $bodyCells = $table.find('tbody tr:first').children(),
            colWidth;

// Adjust the width of thead cells when window resizes
    $(window).resize(function () {
        // Get the tbody columns width array
        colWidth = $bodyCells.map(function () {
            return $(this).width();
        }).get();

        // Set the width of thead columns
        $table.find('thead tr').children().each(function (i, v) {
            $(v).width(colWidth[i]);
        });
    }).resize(); // Trigger resize handler

}

function getSelectedRates() {
    var rates = [];
    var sw = 0;

    $('#listado_precios tr').each(function () {

        $tr = $(this);
        var rate_array = [];
        var i = 0;
        $('td', $tr).each(function () {
            // If you need to iterate the TD's
            $td = $(this);
            rate_array[i] = $td.text();
//            alert(rate_array[i]);
            i++;
            $('#out').append($td.attr('id'));
        });
        rates.push(rate(rate_array));
        //get row values
        // $('#out').append(this.id);

        sw++;
    });

//    sendContactForm();

    sendRates(rates);
}

function rate(rate_array) {
//    alert("desde funcion "+rate_array[1]);
    var total_char = rate_array[2].replace("$", "");
//    var total = 
    return {
        carrier: rate_array[0],
        service_days: rate_array[1],
        total: total_char
    }

}

function showContactForm() {
    $('#contact_form').show();
}

function getQuoteNumber() {
    $.ajax({
        type: "POST",
        url: 'home/get/1/null/date/desc/1/1',
        beforeSend: function () {
            $("#completo").fadeOut();
            $("#cargando").fadeIn();
        },
        data: {
            name: $('#ltl_name').val(),
            email: $('#ltl_email').val(),
            action: 'select'
        },
        dataType: "json",
        success: function (data) {
            var index = 0;
            if (data[0].idcontact != null) {
                index = parseInt(data[0].idcontact)
            }
            var ft = index + 31320;
            $('#id_contact').val(data[0].idcontact);
            $("#quote_number").html('Quote# WQ' + ft);
        },
        error: function () {
            alert('Ocurrio un problema');
        },
        complete: function () {
            $("#cargando").hide();
            $("#completo").fadeIn();
        }
    });
}

function book_now() {
    var id = parseInt($('#id_contact').val());
    id += 1;
    window.location.href = 'home/book_quote/' + id;
}

function saveContactx() {
    $.ajax({
        type: "POST",
        url: 'home/insert',
        beforeSend: function () {
            $("#completo").fadeOut();
            $("#cargando").fadeIn();
        },
        data: {
            name: $('#ltl_name').val(),
            phone: $('#ltl_phone').val(),
            company: $('#ltl_company').val(),
            email: $('#ltl_email').val(),
            origin: $('#ltl_origin').val(),
            destination: $('#ltl_destination').val(),
            total_quantity: $('#total_quantity').html(),
            total_weight: $('#total_weight').html()
        },
        dataType: "json",
        success: function (data) {
//            $("#result").html(data);
        },
        error: function () {
            alert('Ocurrio un problema');
        },
        complete: function () {
            $("#cargando").hide();
            $("#completo").fadeIn();
        }
    });
}

function sendRates(rates) {
//    var jsonRates = $.parseJSON(rates);
    var items_json = JSON.stringify(items);
    var json = JSON.stringify(rates);

    $.ajax({
        type: "POST",
        url: 'home/send_contact_mail',
        beforeSend: function () {
            $("#completo").fadeOut();
            $("#cargando").fadeIn();
        },
        data: {
            rates: json,
            items: items_json,
            origin: $("#ltl_origin").val(),
            destination: $('#ltl_destination').val(),
            total_quantity: $('#total_quantity').html(),
            total_weight: $('#total_weight').html(),
            id: $('#id_contact').val(),
            email: $('#emails').val()
        },
        dataType: "json",
        success: function (data) {
            $("#result").html(data.result);
        },
        error: function () {
            alert('Ocurrio un problema');
        },
        complete: function () {
            $("#cargando").hide();
            $("#completo").fadeIn();
        }
    });
}

// Sends rate to Smith Transportation

function sendRatesSmith() {

    var rates = [];
    var sw = 0;

    $('#listado_precios tr').each(function () {

        $tr = $(this);
        var rate_array = [];
        var i = 0;
        $('td', $tr).each(function () {
            // If you need to iterate the TD's
            $td = $(this);
            rate_array[i] = $td.text();
//            alert(rate_array[i]);
            i++;
            $('#out').append($td.attr('id'));
        });
        rates.push(rate(rate_array));
        //get row values
        // $('#out').append(this.id);

        sw++;
    });


    var items_json = JSON.stringify(items);
    var json = JSON.stringify(rates);

//    alert(items_json);

    $.ajax({
        type: "POST",
        url: 'home/insert',
        beforeSend: function () {
            $("#completo").fadeOut();
            $("#cargando").fadeIn();
        },
        data: {
            rates: json,
            items: items_json,
            name: $('#ltl_name').val(),
            phone: $('#ltl_phone').val(),
            company: $('#ltl_company').val(),
            email: $('#ltl_email').val(),
            origin: $("#ltl_origin").val(),
            destination: $('#ltl_destination').val(),
            total_quantity: $('#total_quantity').html(),
            total_weight: $('#total_weight').html(),
        },
        dataType: "json",
        success: function (data) {
            console.log(data.result);
//            $("#result").html(data.result);
        },
        error: function () {
            alert('Ocurrio un problema');
        },
        complete: function () {
            $("#cargando").hide();
            $("#completo").fadeIn();
        }
    });
}

function enableClassx() {
    $("#class_lbl").show();
    $("#dimensions_lbl").hide();
}

function enableDimensions() {
    $("#dimensions_lbl").show();
    $("#class_lbl").hide();
}

function getClassByDimensions() {

    // convert weight
    var weight = $('#ltl_weight').val();
    if ($('#weight-unit').val() == 'kgs') {
        weight = weight * 2.20462;
    }

    // convert dimension

    var length = $('#ltl_length').val();
    var width = $('#ltl_width').val();
    var height = $('#ltl_height').val();


    if ($('#ltl_unit_dimension').val() == 'ft') {
        length = length * 12;
        width = width * 12;
        height = height * 12;
    }

    if ($('#ltl_unit_dimension').val() == 'cm') {
        length = length * 0.393701;
        width = width * 0.393701;
        height = height * 0.393701;
    }

    if ($('#ltl_unit_dimension').val() == 'mt') {
        length = length * 39.3701;
        width = width * 39.3701;
        height = height * 39.3701;
    }



    var cl = 0;
    var density = 0;
    var cubic_feet = 0;
    var num = 0;

    num = length * width * height;
    cubic_feet = num / 1728;
    density = weight / cubic_feet;

//    alert('la densidad es: ' + density);

    switch (true) {
        case (density < 1):
            cl = 500;
            break;
        case (density >= 1 && density < 2):
            cl = 400;
            break;
        case (density >= 2 && density < 3):
            cl = 300;
            break;
        case (density >= 3 && density < 4):
            cl = 250;
            break;
        case (density >= 4 && density < 5):
            cl = 200;
            break;
        case (density >= 5 && density < 6):
            cl = 175;
            break;
        case (density >= 7 && density < 8):
            cl = 125;
            break;
        case (density >= 8 && density < 9):
            cl = 110;
            break;
        case (density >= 9 && density < 10.5):
            cl = 100;
            break;
        case (density >= 10.5 && density < 12):
            cl = 92.5;
            break;
        case (density >= 12 && density < 13.5):
            cl = 85;
            break;
        case (density >= 13.5 && density < 15):
            cl = 77.5;
            break;
        case (density >= 15 && density < 22.5):
            cl = 70;
            break;
        case (density >= 22.5 && density < 30):
            cl = 65;
            break;
        case (density >= 30 && density < 35):
            cl = 60;
            break;
        case (density >= 35 && density < 50):
            cl = 55;
            break;
        case (density >= 50):
            cl = 50;
            break;
        default:
            alert('unknown class');
    }

    $('#ltl_class').val(cl);
    class_item = cl;

}

/*************************************** Validations ******************************************/

function valRateForm() {

    if ($("#ltl_origin").val() == '') {
        validate2('Origin zipcode is required');
        $("#sys_message").text('Origin zipcode is required');
        return false;
    }
    if ($("#ltl_destination").val() == '') {
        validate2('Destination zipcode is required');
        $("#sys_message").text('Destination zipcode is required');
        return false;
    }
    if (items.length === 0) {
        validate2('You must add at least 1 item');
        $("#sys_message").text('You must add at least 1 item');
        return false;
    }

    return true;
}

function validate2(msn) {
    if (msn != '') {
        $.magnificPopup.open({
            items: {
                src: '<div class="white-popup">' + msn + '</div>'
            },
            type: 'inline'
        });
    }
}

function valContactForm() {

    if (!validateEmail($("#ltl_email").val())) { /* do stuff here */
        $("#contact_msg").text('Enter a valid email');
        return false;
    }

    if ($("#ltl_name").val() == '') {
        $("#contact_msg").text('Name is required');
        return false;
    }
    if ($("#ltl_phone").val() == '') {
        $("#contact_msg").text('Phone is required');
        return false;
    }
    if ($("#ltl_company").val() == '') {
        $("#contact_msg").text('Company is required');
        return false;
    }
    if ($("#ltl_email").val() == '') {
        $("#contact_msg").text('Email is required');
        return false;
    }

    return true;
}

function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test($email);
}

function valItem() {
    if (!$('input[name=FreightClass]').is(':checked')) {
        validate2('Do you know the freight Class?');
        $("#sys_message").text('Do you know the freight Class?');
        return false;
    }


    if ($('#ltl_quantity').val() == '') {
        validate2('Quantity is required');
        $("#sys_message").text('Quantity is required');
        return false;
    }
    if ($('#ltl_weight').val() == '') {
        validate2('Weight is required');
        $("#sys_message").text('Weight is required');
        return false;
    }

    if ($('#ltl_class').val() == '' && $('input[name=FreightClass]:checked').val() == 'yes') {
        validate2('Choose the class');
        $("#sys_message").text('Choose the class');
        return false;
    }


    if ($('#ltl_class').val() == '') {
        if ($('#ltl_length').val() == '' || $('#ltl_width').val() == '' || $('#ltl_height').val() == '') {
            validate2('Choose a class or fill in the dimensions');
            $("#sys_message").text('Choose a class or fill in the dimensions');
            return false;
        } else {
            $("#sys_message").text('passed');
            getClassByDimensions();
            return true;
        }
    } else {
        class_item = $('#ltl_class').val();
    }
    return true;
}

function clearItem() {
    $('#ltl_quantity').val("");
    $('#ltl_weight').val("");
    $('#ltl_class').val("");
    $('#ltl_length').val("48");
    $('#ltl_width').val("48");
    $('#ltl_height').val("90");
    $('#sys_message').text("");
    class_item = 0;
}

function show(id) {
    $("#" + id).show();
}

function hide(id) {
    $("#" + id).hide();
}

//  ---- enable and disable item's fields

function enableClass() {
    document.getElementById('ltl_quantity').disabled = false;
    document.getElementById('ltl_weight').disabled = false;
    document.getElementById('ltl_class').disabled = false;

    document.getElementById('ltl_length').disabled = false;
    document.getElementById('ltl_width').disabled = false;
    document.getElementById('ltl_height').disabled = false;

}
function disableClass() {

    document.getElementById('ltl_quantity').disabled = false;
    document.getElementById('ltl_weight').disabled = false;
    document.getElementById('ltl_class').disabled = true;
    document.getElementById('ltl_class').value = '';

    document.getElementById('ltl_length').disabled = false;
    document.getElementById('ltl_width').disabled = false;
    document.getElementById('ltl_height').disabled = false;


}
