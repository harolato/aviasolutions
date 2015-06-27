// Laukiam kol puslapis pakankamai užkrautas
$(document).ready(function(){
    /*
        Ši funkcija vykdoma atidarius Modal langelį.
        Parametrai gaunami iš mygtuko atributo.
        Galimi parametrai:
            data-type (confirm, form)
            data-message (Žinutė, kuri parodoma prie ištrinant ką nors)
            data-title (Antraštė langeliui)
            data-ajaxurl (adresas, kurį reikia užkrauni ajax metodu)
            data-noajax (true, false) kintamasis reikalingas confirm langelio tipui
        Yra dvi skirtigos langelio paskirtys: užkrauti forma ajax metodu arba parodyti patvirtinimo žinute prieš
         pašalinant įrašą.
        Pašalinti įrašą galima AJAX ir GET metodais.
     */
    $('#ajaxModal').on('show.bs.modal',function(e){
        // Užkraunam mygtuką, kuris atidarė Modal langą. Ir, beje, kuris turi data- parametrus
        var btn = $(e.relatedTarget);
        // Užkraunam patį Modal langą
        var modal = $(this);
        // Tikrinam kokio tipo langas
        if ( btn.data('type') == 'confirm' ) {
            // Jeigu confirm, pakeičiam title ir žinutę atitinkamai.
            modal.find('.modal-header .modal-title').html(btn.data('title'));
            modal.find('.modal-body').html(btn.data('message'));
            // Tikrinam GET ar POST metodu nori ištrinti įrašą
            if ( btn.data('noajax') ) {
                modal.find('.modal-footer .submit').html('<a href="' + btn.data('ajaxurl') + '">Yes</a>');
            } else {
                modal.find('.modal-footer .submit').html('Yes');
            }
        } else if ( btn.data('type') == 'form' ) {
            // Jeigu form, pakeičiam submit mygtuko užrašą
            modal.find('.modal-footer .submit').show();
            modal.find('.modal-footer .submit').html('Submit');
            // Užkraunam formą
            $.ajax(btn.data('ajaxurl'),{
                success : function(r){
                    modal.find('.modal-header .modal-title').html(btn.data('title'));
                    modal.find('.modal-body').html(r);
                }
            });
        }
        // Laukam Submit arba Yes mygtuko paspaudimo
        $('button.submit').click(function(){
            // Patikriname kuris mygtukas buvo paspaustas
            if ( btn.data('type') == 'confirm' && !btn.data('noajax') ) {
                // Siunčiame AJAX užklausa įrašo ištrinimui
                $.ajax(btn.data('ajaxurl'),{
                    type : 'POST',
                    dataType : 'JSON',
                    success : function(r){
                        // Uždarome Modal langą
                        modal.modal('hide');
                        // patikriname kokį atsakymą gavome
                        if ( r[0] ) {
                            // Įrašas ištrintas sėkmingai
                            // Atvaizduojam atitinkama pranešimą
                            $('.flash-row').html('').append('<div class="message success">' + r[1] + '</div>');
                            // Patikriname kokio tipo įrašas buvo ištrintas
                            if ( btn.parent().is("div") ) {
                                // Jeigu ištrinta kompanija, tai paslepiame kompanijos mygtuką iš pagrindinio puslpaio
                                btn.parent().fadeOut(1000);
                            } else {
                                // Jeigu tai darbuotojas, tai paslepiame lentelės eilutę
                                btn.parent().parent().fadeOut(1000);
                                // Ir sumažiname darbuotojų skaičiu per vienetą
                                var employee_heading = $('h2.employees');
                                var employee_count = parseInt(employee_heading.html().split('(')[1].split(')'));
                                employee_count--;
                                employee_heading.html('Employees(' + employee_count + ')');
                            }
                        } else {
                            // Jeigu įrašo nepavyko ištrinti, parodo atitinkamą žinutę
                            $('.flash-row').html('').append('<div class="message error">' + r[1] + '</div>');
                        }
                    }
                });
            } else if ( btn.data('type') == 'form' ) {
                // Jeigu tai formo tipo langas, tikriname ar įvesti duomenys į laukelius yra teisingi
                if ( validateForm(modal.find('form .form-control')) ) {
                    // Jeigu klaidų nerasta, siunčiame duomenis Controlleriui
                    modal.find('form').submit();
                }
            }
        });
    }).on('hidden.bs.modal', function(e){
        // Išvalome Modal langą
        $(this).find('.modal-body').html('<div class="spinner text-center"><span class="glyphicon glyphicon-fullscreen"></span></div>');
        $(this).find('.modal-header .modal-title').html('Loading...');
        $(this).find('.modal-footer .submit').hide();
        $('.popover').popover('destroy');
    });
});
/*
    Įvesties laukelių tikrinimas
    parametrai: formos laukelių masyvas
 */
var validateForm = function(fields){
    // panaikinime prieš tai atidarytą popover debesėlį.
    $('.popover').popover('destroy');
    // kintamasis formos tikrinimui
    var valid = true;
    // Iteruojame per masyvą
    fields.each(function(i,e){
        // Sukuriame kintamajį klaidos pranešimui
        var error = "";
        // Pašaliname prieš tai sukurtus klaidos pranešimo popover atributus
        $(e).removeAttr('data-container').removeAttr('data-placement').removeAttr('data-content').removeAttr('data-popover');
        // Tikriname ar nėra paliktų tuščių laukelių
        if ($(e).val().length < 1 ) {
            error = "Please fill this field";
        }
        // Tikriname ar el pašto adresas įvestas teisingai
        if ($(e).attr('type') == "email" ) {
            if ( !validateEmail($(e).val()) ) {
                error = "Invalid email address";
            }
        }
        // Tikriname ar data pasirinkta
        if ( $(e).hasClass('day') && $(e).val().length < 1) {
            error = "Select day";
        }
        if ( $(e).hasClass('month') && $(e).val().length < 1) {
            error = "Select month";
        }
        if ( $(e).hasClass('year') && $(e).val().length < 1) {
            error = "Select year";
        }
        // Tikriname ar šiame įvesties laukelyje buvo rasta klaidų
        if ( error.length > 0 ) {
            // Jeigu rasta, tai pakeičiam valid flag'ą į false
            // Ir pridedame atributus reikalingus popover debesėliams
            valid = false;
            $(e).attr({
                'data-popover'      : 'popover',
                'data-container'    : 'body',
                'data-placement'    : ((e.type == "select-one")?'top':'right'),
                'data-content'      : error
            });
        }
    });
    // Jeigu buvo rasta klaidų, atvaizduojame popover debesėlius
    if ( !valid ) {
        $('[data-popover="popover"]').popover('show');
    }
    // Išvedame boolean tipo rezultatą
    return valid;
}

/*
Funkcija el pašto adreso tikrinui.
Paimta iš interneto.
 */
function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}
/*====*/