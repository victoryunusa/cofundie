(function ($) {
    "use strict";

    $.fn.initValidate = function () {
        $(this).validate({
            errorClass: 'is-invalid text-danger',
            validClass: ''
        });
    };

    $('[name="accept_installments"]').change(function() {
        if ($(this).is(':checked')) {
            $('.accept_installments').removeClass('d-none')
        } else {
            $('.accept_installments').addClass('d-none')
        }
    });

    $(".checkAll").on('click', function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    $('#is_period').on('change', function() {
        var val = $(this).val();
        if (val == 1) {
            $(".period_duration").removeClass('d-none');
        } else {
            $(".period_duration").addClass('d-none');
        }
    })

    $('#installment_amount').on('change', function() {
        const min_invest = parseFloat($('#min_invest').val());
        const max_invest = parseFloat($('#max_invest').val());
        const installment_amount = parseFloat($('#installment_amount').val());
        const percent = ((min_invest + max_invest) / 2) / installment_amount;
        $('#total_installments').val(Math.round(percent))
    })

    $('.anna-dismiss').on('click', function() {
        $('.top-header-area').fadeOut();
    })

    $('.invest-amount').on('keyup', function() {
        var val = $(this).val();
        var max = $(this).data('max');
        var min = $(this).data('min');

        if (min > val) {
            Notify('error', null, "Minimum investment is " + min)
            return false;
        } else if (max < val) {
            Notify('error', null, "Maximum investment is " + max)
            return false;
        }

        $('.amount').text(val)
        let min_profit = (val / 100) * 5
        let min_loss = (val / 100) * 5
        let max_profit = (val / 100) * 30
        let max_loss = (val / 100) * 20
        $('.min-profit').text(min_profit)
        $('.min-loss').text(min_loss)
        $('.max-profit').text(max_profit)
        $('.max-loss').text(max_loss)
        $('.total').text(val)
    })

    $('.invest-using').on('click', function() {
        $('#invest-modal').modal('show')
        $('.from-wallet').addClass('d-none');
        $('.installment-amount').attr('readonly', false);
        let action = $(this).data('action');
        if (action) {
            $('.payment-form').attr('action', action);
        }
        $('#project_id').val($(this).data('id'))
    })

    $('.installment-payment').on('click', function() {
        let action = $(this).data('action');
        let id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: action+'?id='+id,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.is_late) {
                    $('.installment-field').removeClass('d-none');
                    $('.including-fees').text(parseFloat(res.amount) + parseFloat(res.late_fees));
                    $('.late-fees').val(res.late_fees);
                    $('.late-fees').attr('readonly', true);
                } else {
                    $('.installment-field').addClass('d-none');
                }

                $('.from-wallet').removeClass('d-none');
                $('.installment-amount').attr('readonly', true);
                $('.installment-amount').val(res.amount);
                $('.installment-amount').attr('readonly', true);
                $('#invest-modal').modal('show')
                if (action) {
                    $('.payment-form').attr('action', action);
                }
                $('#project_id').val(id)
            },
        });
    })

    $.fn.initFormValidation = function () {
        var validator = $(this).validate({
            errorClass: 'is-invalid',
            highlight: function (element, errorClass) {
                var elem = $(element);
                if (elem.hasClass("select2-hidden-accessible")) {
                    $("#select2-" + elem.attr("id") + "-container").parent().addClass(errorClass);
                } else if (elem.hasClass('input-group')) {
                    $('#' + elem.add("id")).parents('.input-group').append(errorClass);
                } else if (elem.parents().hasClass('image-checkbox')){
                    Notify('error', null, elem.parent().data('required'))
                }else {
                    elem.addClass(errorClass);
                }
            },
            unhighlight: function (element, errorClass) {
                var elem = $(element);
                if (elem.hasClass("select2-hidden-accessible")) {
                    $("#select2-" + elem.attr("id") + "-container").parent().removeClass(errorClass);
                } else {
                    elem.removeClass(errorClass);
                }
            },
            errorPlacement: function (error, element) {
                var elem = $(element);
                if (elem.hasClass("select2-hidden-accessible")) {
                    element = $("#select2-" + elem.attr("id") + "-container").parent();
                    error.insertAfter(element);
                } else if (elem.parents().hasClass('image-checkbox')){

                } else if (elem.parent().hasClass('form-floating')) {
                    error.insertAfter(element.parent().css('color', 'text-danger'));
                } else if (elem.parent().hasClass('input-group')) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });

        $(this).on('select2:select', function () {
            if (!$.isEmptyObject(validator.submitted)) {
                validator.form();
            }
        });
    };


    // Select2 Initialization
    var select2FocusFixInitialized = false;
    var initSelect2 = function () {
        // Check if jQuery included
        if (typeof jQuery == 'undefined') {
            return;
        }

        // Check if select2 included
        if (typeof $.fn.select2 === 'undefined') {
            return;
        }

        var elements = [].slice.call(document.querySelectorAll('[data-control="select2"]'));

        elements.map(function (element) {
            var options = {
                dir: document.body.getAttribute('direction')
            };

            if (element.getAttribute('data-hide-search') == 'true') {
                options.minimumResultsForSearch = Infinity;
            }

            if (element.hasAttribute('data-placeholder')) {
                options.placeholder = element.getAttribute('data-placeholder');
            }

            $(document).ready(function (){
                $(element).select2(options);
            });
        });

        /*
        * Hacky fix for a bug in select2 with jQuery 3.6.0's new nested-focus "protection"
        * see: https://github.com/select2/select2/issues/5993
        * see: https://github.com/jquery/jquery/issues/4382
        *
        * TODO: Recheck with the select2 GH issue and remove once this is fixed on their side
        */

        if (select2FocusFixInitialized === false) {
            select2FocusFixInitialized = true;

            $(document).on('select2:open', function(e) {
                var elements = document.querySelectorAll('.select2-container--open .select2-search__field');
                if (elements.length > 0) {
                    elements[elements.length - 1].focus();
                }
            });
        }
    }

    initSelect2();
})(jQuery);

function showInputErrors(errors) {
    if (typeof errors['errors'] !== "undefined"){

        $.each(errors['errors'], function (index, value) {
            $('#' + index + '-error').remove();
            let $errorLable = '<label id="' + index + '-error" class="is-invalid" for="' + index + '">' + value + '</label>';
            if ($("#" +index).parents().hasClass('form-check')){
                $("#" +index).parents()
                    .find('.form-check')
                    .append($errorLable)
            }else {
                $('#' + index).addClass('is-invalid')
                    .after($errorLable)
            }
        });
    }
}

$(document).ready(function () {
    if (window.sessionStorage.hasPreviousMessage === "true"){
        Notify('success', null, window.sessionStorage.previousMessage, window.sessionStorage.redirect);
        window.sessionStorage.hasPreviousMessage = false;
    }
});

if ($('#selectAll').length > 0) {
    // Select All checkbox click
    const selectAll = document.querySelector('#selectAll'),
        checkboxList = document.querySelectorAll('[type="checkbox"]');
    selectAll.addEventListener('change', t => {
        checkboxList.forEach(e => {
            e.checked = t.target.checked;
        });
    });
}
