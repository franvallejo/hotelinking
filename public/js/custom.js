function checkUser(type) {
    switch (type) {
        case 'login':
            var name = $('#loginFormName').val();
            var pass = $('#loginFormPass').val();
            break;
        case 'registro':
            var name = $('#registroFormName').val();
            var pass = $('#registroFormPass').val();
            break;
    }

    $.ajax({
        type: "POST",
        url: '/hotelinking/source/ajax/check-user.php',
        dataType: 'json',
        data: {
            "userName": name,
            "password": pass,
            "type": type
        },
    }).done(function (data, textStatus, jqXHR) {
        if (data) {
            if (type == 'registro') {
                if (data == 'newUser') {
                    $('#ModalRegistro').modal('hide');
                    $('#success').text('Usuario registrado con éxito');
                    $('#info').text('Inicia Sesión');
                    $('#infoBox').fadeIn();
                    $('#succesBox').fadeIn();
                    $('#succesBox').fadeOut(5000);
                    $('#infoBox').fadeOut(5700);
                } else if (data == 'member') {
                    $('#ModalRegistro').modal('hide');
                    $('#warning').text('Este usuario ya posee una cuenta');
                    setTimeout($('#warningBox').fadeIn(), 6000);
                    $('#warningBox').fadeOut(3500);
                }

                //console.log(data + ' ----- ha ido bien');
            }
            if (type == 'login') {
                if (data == 'newUser') {
                    $('#ModalLogin').modal('hide');
                    $('#codeGeneratorBox').fadeOut();
                    $('#warning').text('Usuario no registrado');
                    setTimeout($('#warningBox').fadeIn(), 6000);
                    $('#warningBox').fadeOut(3500);
                } else if (data == 'member') {
                    $('#login').css('display', 'none');
                    $('#registro').css('display', 'none');
                    $('#logout').css('display', 'block');
                    $('#reset').css('display', 'block');
                    $('#ModalLogin').modal('hide');
                    $('#success').text('Bienvenido ' + name);
                    setTimeout($('#succesBox').fadeIn(), 5000);
                    $('#succesBox').fadeOut(4000);
                    $('#codeGeneratorBox').fadeIn(5500);
                }
            }
        } else {
            //console.log(data + ' ----- ha ido mal');
            //console.log(textStatus);
            //console.log(jqXHR);
        }
    }).fail(function (xhr, textStatus, errorThrown) {
        console.log(xhr.responseText);
        //console.log(xhr);
        //console.log(textStatus);
        //console.log(errorThrown);
    });
}

function checkPromo(type) {
    var checkBox = '';
    switch (type) {
        case 'registro':
            var checked = false;
            var promo = Math.floor((Math.random() * 100000) + 1);
            $('#success').text('Código Promocional: ' + promo);
            $('#succesBox').fadeIn(500);
            $('#succesBox').fadeOut(2000);
            break;
        case 'listado':
            var checked = '';
            var promo = '';
            break;
        case 'canjear':
            var checked = false;
            var allPromos = [];
            $('.check-boxes').each(function () {
                var currentPromo = $(this).attr("data-atribute");
                var tag = $(this).prop("tagName").toLowerCase();
                if ($(tag + '[data-atribute=' + currentPromo + ']:checked').length > 0) {
                    allPromos.push(currentPromo);
                    checked = 1;
                }
            });
            var promo = allPromos;
            if (promo.length < 1) {
                $('#ModalPromosList').modal('hide');
                $('#warning').text('Seleccione alguna Promoción');
                setTimeout($('#warningBox').fadeIn(), 6000);
                $('#warningBox').fadeOut(3500);
                return;
            }
            break;
    }

    $.ajax({
        type: "POST",
        url: '/hotelinking/source/ajax/check-promo.php',
        dataType: 'json',
        data: {
            "promo": promo,
            "checked": checked,
            "type": type
        },
    }).done(function (data, textStatus, jqXHR) {
        if (data != false) {
            if (type == 'listado') {
                $.each(data, function (key, value) {
                    if (value.checked == false) {
                        var estado = 'No Canjeado';
                        var disabled = '';
                        var style = '';
                    } else if (value.checked == true) {
                        var estado = 'Canjeado';
                        var disabled = 'disabled';
                        var style = 'opacity';
                    }
                    checkBox +=
                        '<tr><td id="">' + value.promo + '</td><td class="' + style + '">' + estado + '</td>' +
                        '<td><label class="custom-control custom-checkbox">' +
                        '<input type="checkbox" class="check-boxes" data-atribute="' + value.promo + '" ' + disabled + '>' +
                        '<span class="custom-control-indicator"></span>' +
                        '<span class="custom-control-description"></span>' +
                        '</label></td></tr>';
                });
                $('#modal-body-promo-list').html('');
                $('#modal-body-promo-list').append(checkBox);
            }
            if (type == 'canjear') {
                $('#ModalPromosList').modal('hide');
                $('#success').text('Código Promocional Canjeado');
                setTimeout($('#succesBox').fadeIn(), 6000);
                $('#succesBox').fadeOut(3500);
            }

            //console.log(data + ' ----- ha ido bien');

        } else {
            //console.log(data + '----- ha ido mal');
            //console.log(textStatus);
            //console.log(jqXHR);

            if (!$.trim(data) && textStatus == 'success') {
                $('#ModalPromosList').modal('hide');
                $('#warning').text('No tiene códigos promocionales');
                setTimeout($('#warningBox').fadeIn(), 6000);
                $('#warningBox').fadeOut(3000);
            }
        }
    }).fail(function (xhr, textStatus, errorThrown) {
        console.log(xhr.responseText);
        //console.log(xhr);
        //console.log(textStatus);
        //console.log(errorThrown);
    });
}