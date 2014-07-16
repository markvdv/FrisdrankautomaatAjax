//jsonAJAX leverancier in servicelaag
//met jquery, javascript leverancier aanspreken
// en gegevens tonen

$(function() {//doc onload start
    $.getJSON("ajaxcontroller.php", null, function(result) {
//console.log(result);
        //opbouw weergave van munten
        for (var i in result['munten']) {
            var $a = $('<a>');//href want krijgt onclick eventhandler
            //toevoegen van link in geval dat javascript niet actief is
            $a.attr('href', "automaatcontroller.php?action=steekgeldin&id=" + result['munten'][i].id)
            var $div = $('<div>');
            $div.addClass("muntdiv");
            var $img = $('<img>');
            // $img.addClass("muntimg").draggable({containment: "body"}).attr('src', "img/" + result['munten'][i].waarde + ".png").attr('id', result['munten'][i].id);
            $img.addClass("muntimg").attr('src', "img/" + result['munten'][i].waarde + ".png").attr('id', result['munten'][i].id);
            $div.append($img);
            $a.append($div).insertBefore($('.muntenholder label'));
        }

        //opbouw voor dranken in drankautomaat
        var leegholderHTML = '';
        $.each(result['dranken'], function(key) {
            var $area = $('<area>')
            $area.attr('id', result['dranken'][key].id).attr('class', 'drankknop').attr('prijs', result['dranken'][key].prijs).attr('title', result['dranken'][key].type).attr('name', result['dranken'][key].type).attr('shape', "rect").attr('coords', result['dranken'][key].coords).attr('href', "automaatcontroller.php?action=kopen&id=" + result['dranken'][key].id + "&prijs=" + result['dranken'][key].prijs + "&type=" + result['dranken'][key].type).appendTo($('map'));
            if (result['dranken'][key].aantal === '0') {
                leegholderHTML += "<label class='leeg'>LEEG</label>"
            }
            else {
                leegholderHTML += "<label class='leeg'></label>"
            }
        })
        //leeglabels
        $('.leegholder').html(leegholderHTML);
        //saldolabel
        $('#saldo').html(parseFloat(result['totaalsaldo'] / 100).toFixed(2));
    });

});//einde onload


//geldteruggave zonder aankoops
$("#geldterug").click(function(e) {
    e.preventDefault();
    $.getJSON("ajaxcontroller.php", {action: "geldterug"}, function(result) {
        //saldo label updaten
        $('#saldo').html(parseFloat(result['totaalsaldo'] / 100).toFixed(2));

    })
    $('#saldo').html(parseFloat(result['totaalsaldo'] / 100).toFixed(2));
})


//functionaliteit voor toevoegen van munten aan saldo 
$('.muntenholder').on('click', 'a', function(e) {
    //verwijderen van mogelijk error messages
    $('#errorholder').html('');
    //verhinderen van navigatie op link    
    e.preventDefault();
    //naar AJAXcall voor saldo te veranderen
    $.getJSON("ajaxcontroller.php", {action: "steekgeldin", id: e.target.id}, function(result) {
        //saldo label updaten
        $('#saldo').html(parseFloat(result['totaalsaldo'] / 100).toFixed(2));

    })

});


//functionaliteit voor aankopen van drank
$('#automaat').on('click', '.drankknop', function(e) {
    e.preventDefault();
    // applicationdata.responseJSON.aankoopdrankid = e.target.id;
    //applicationdata.responseJSON.aankoopdrankprijs = e.target.getAttribute('prijs');
    $.getJSON("ajaxcontroller.php", {action: "aankoop", drankid: e.target.id}, function(data) {

        if (typeof data['error'] === "undefined") {
            $('#errorholder').html('');
            //serviocelaag heeft geen rrors opgeworpen dus kunnen e verder
            console.log(data)
            $('<table id="teruggave" class="teruggave">').appendTo('body');
            var teruggaveHTML = '';
            for (var i in data['teruggave']) {
                teruggaveHTML += "<tr><td>" + data['teruggave'][i] + "</td><td>X</td><td><div class= 'muntdiv' ><img  class='muntimg' src= 'img/" + i + ".png'></div></td></tr>";
            }
            $('#teruggave').html(teruggaveHTML);
            $('#saldo').html("0.00");

            $("#canimgholder").html('<img src="img/' + e.target.getAttribute('name') + '.png">');
        }

        else {
            //errorafhandeling
            switch (data['error'].code) {
                case 0:
                    var errorHTML = "<p class='error'>te weinig geld ingegeven</p>";
                    break;
                case 1:
                    var errorHTML = "<p class='error'>niet genoeg wisselgeld gepast betalen </p>";
                    break;
                case 2:
                    var errorHTML = "<p class='error'>ongeldige parameter</p>";
                    break;

                default://in het geval dat er geen code overeenkomt
                    var errorHTML = "<p class='error'>" + data['error'].message + "</p>";
                    break;

            }
            $('#errorholder').html(errorHTML)
        }
    })
});

$('#admintoegang').click(function() {
    self.location.href = "adminlogin.php"
});




