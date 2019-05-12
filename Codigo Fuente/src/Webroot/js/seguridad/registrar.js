var inputFechaNacimiento = $("#inputFechaNacimiento");
var btnInputFechaNacimiento = $("#btnInputFechaNacimiento");

inicializarDatePicker();

btnInputFechaNacimiento.click(function () {
    inputFechaNacimiento.data("daterangepicker").toggle();
});

function showPassword(btn) {
    var pwd = $(btn).parent().siblings(".pwd");
    var eye = $(btn).children();

    if(pwd.attr("type") === "password") {
        pwd.attr("type", "text");
        eye.removeClass("fa-eye").addClass("fa-eye-slash");
    } else {
        pwd.attr("type", "password");
        eye.removeClass("fa-eye-slash").addClass("fa-eye");
    }
}

function inicializarDatePicker() {

    inputFechaNacimiento.daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        opens: "left",
        minYear: 1901,
        maxYear: parseInt(moment().format('YYYY'), 10),
        startDate: moment().format("DD/MM/YYYY"),
        locale: {
            format: "DD/MM/YYYY",
            daysOfWeek: nombresDias,
            monthNames: nombresMeses
        }
    });

    inputFechaNacimiento.mask("99/99/9999", {
        translation: {
            'r': {
                pattern: /[\/]/,
                fallback: '/'
            },
            placeholder: "__/__/____"
        },
        placeholder: "__/__/____",
        selectOnFocus: true
    });
}


//Oculta el spinner de los input number
$(document).ready(function ($) {

    // Disable scroll when focused on a number input.
    $('form').on('focus', 'input[type=number]', function (e) {
        $(this).on('wheel', function (e) {
            e.preventDefault();
        });
    });

    // Restore scroll on number inputs.
    $('form').on('blur', 'input[type=number]', function (e) {
        $(this).off('wheel');
    });

    // Disable up and down keys.
    $('form').on('keydown', 'input[type=number]', function (e) {
        if (e.which == 38 || e.which == 40)
            e.preventDefault();
    });

});