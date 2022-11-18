"use strict";

//Variables & Standalone functions

function printable(id) {
    var e = $("body").html(), a = $("#" + id).clone();
    $("body").empty().html(a), window.print(), $("body").html(e)
}

function slugify(str) {
    return str.toLowerCase()
        .trim()
        .replace(/[^\w\s-]/g, '')
        .replace(/[\s_-]+/g, '-')
        .replace(/^-+|-+$/g, '');
}

function success(response) {
    if (response.redirect){
        if (response.message){
            Notify.success(response)
        }

        window.setTimeout(function () {
            window.location.href = response.redirect
        }, 1000);
    }else if(response.message){
        Notify.success(response)
    }else{
        Notify.success(null, response)
    }
}

function error_response(xhr) {
    Notify.error(xhr)
}

let $csrf_token = $('meta[name="csrf-token"]').attr('content');
let $spinner = '<div class="spinner-border spinner-border-sm" role="status">\n' +
    '  <span class="sr-only">Loading...</span>\n' +
    '</div>';

const Notify = {
    success: function (res, msg) {
        let message = null;
        if(msg){
            message = msg;
        } else if(res.message){
            message = res.message ?? res
        }else{
            message = 'Operation Successfully Completed';
        }

        Toastify({
            text: message,
            duration: 3000,
            destination: "https://github.com/apvarun/toastify-js",
            close: true,
            gravity: "bottom", // `top` or `bottom`
            position: "center", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            },
            onClick: function(){} // Callback after click
        }).showToast();
    },
    error: function (xhr, msg) {
        let message = null;
        if(msg){
            message = msg;
        } else if(xhr.responseJSON.message){
            message = xhr.responseJSON.message
        }else if(xhr.responseText){
            message = xhr.responseText
        }else{
            message = 'Oops! Something went wrong.';
        }

        Toastify({
            text: message,
            duration: 3000,
            destination: "https://github.com/apvarun/toastify-js",
            close: true,
            gravity: "bottom", // `top` or `bottom`
            position: "center", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: 'linear-gradient(to right, #FF4B2B, #FF416C)'
            },
            onClick: function(){} // Callback after click
        }).showToast();
    }
}

function showInputErrors(xhr) {
    if (xhr.responseJSON?.errors) {
        $.each(xhr.responseJSON.errors, function (index, value) {
            $('#' + index + '-error').remove();
            let $errorLabel = '<label id="' + index + '-error" class="is-invalid text-danger" for="' + index + '">' + value + '</label>';

            if ($("#" +index).parents().hasClass('form-check')) {
                $('#' + index).addClass('is-invalid text-danger');
                $("#" +index).parents()
                    .find('.form-check')
                    .append($errorLabel);
            } else {
                $('#' + index).addClass('is-invalid text-danger')
                    .after($errorLabel)
            }
        });
    }
}

if ($('.clipboard-button').lenght > 0){
    var clipboard = new ClipboardJS('.clipboard-button');
    clipboard.on('success', function(e) {
        let $message = $(e.trigger).data('message') ?? 'Copied to clipboard'
        Notify.success(null, $message)
        e.clearSelection();
    });
}

let drawDataTable = function () {
    $('.dataTable').DataTable().draw(false);
}


if (localStorage.getItem('hasMessage') == "true"){
    Notify.success(null, localStorage.getItem('message'))
    localStorage.removeItem('hasMessage');
    localStorage.removeItem('message');
}

var liContents = [];
$('.sidebar-menu li').each(function() {
    liContents.push($(this).data('order'));
});
liContents.sort(numOrdDesc);
$('.sidebar-menu li').each(function() {
    $(this).html(liContents.pop());
});


function numOrdDesc(a, b) {
    return (parseInt(b) - parseInt(a));
}

// Dependent Functions
(function ($) {
    "use strict";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $csrf_token
        }
    });

    $.fn.initValidate = function () {
        $(this).validate({
            errorClass: 'is-invalid text-danger',
            validClass: ''
        });
    };

    $.fn.initFormValidation = function () {
        var validator = $(this).validate({
            errorClass: 'is-invalid text-danger',
            highlight: function (element, errorClass) {
                var elem = $(element);
                if (elem.hasClass("select2-hidden-accessible")) {
                    $("#select2-" + elem.attr("id") + "-container").parent().addClass(errorClass);
                } else if (elem.hasClass('input-group')) {
                    $('#' + elem.add("id")).parents('.input-group').append(errorClass);
                } else {
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

            $(document).on('ready',function (){
                $(element).select2(options);
            });
        });

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

    // Forms submission

    /*---Ajaxform Instant Form Reload Reload----*/
    let $instant_reload_form = $(document).find('.instant_reload_form');
    $instant_reload_form.initFormValidation();

    $(document).on('submit', '.instant_reload_form', function (e) {
        e.preventDefault();

        if ($instant_reload_form.valid()) {

            let $submitBtn = $instant_reload_form.find('.submit-button');
            let $submitBtnOriginal = $submitBtn.html();

            $.ajax({
                type: 'POST',
                url: this.action,
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $submitBtn.html($spinner).attr('disabled', true);
                },
                success: function (res) {
                    $submitBtn.html($submitBtnOriginal).attr('disabled', false);

                    if (res.message){
                        localStorage.setItem('message', res.message);
                        localStorage.setItem('hasMessage', true);
                    }

                    if (res.redirect){
                        location.href = res.redirect;
                    }else{
                        Notify.success(res)
                    }
                },
                error: function (xhr) {
                    $submitBtn.html($submitBtnOriginal).attr('disabled', false);
                    Notify.error(xhr);
                    showInputErrors(xhr);
                }
            });
        }
    });

    // Ajax form without validation
    $(document).on('submit', '.form_without_validate', function (e) {
        e.preventDefault();

        let $submitBtn = $(this).find('.submit-button');
        let $submitBtnOriginal = $submitBtn.html();

        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $submitBtn.html($spinner).attr('disabled', true);
            },
            success: function (res) {
                $submitBtn.html($submitBtnOriginal).attr('disabled', false);

                if (res.message){
                    localStorage.setItem('message', res.message);
                    localStorage.setItem('hasMessage', true);
                }

                if (res.redirect){
                    location.href = res.redirect;
                }else{
                    Notify.success(res)
                }
            },
            error: function (xhr) {
                $submitBtn.html($submitBtnOriginal).attr('disabled', false);
                Notify.error(xhr);
                showInputErrors(xhr);
            }
        });
    });

    // Ajax form without validation
    $(document).on('submit', '.datatable_modal_form', function (e) {
        e.preventDefault();

        let $submitBtn = $(this).find('.submit-button');
        let $submitBtnOriginal = $submitBtn.html();

        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $submitBtn.html($spinner).attr('disabled', true);
            },
            success: function (res) {
                $submitBtn.html($submitBtnOriginal).attr('disabled', false);

                if (res.message){
                    Notify.success(res)
                }
                $('.modal').modal('hide');
                drawDataTable()
            },
            error: function (xhr) {
                $submitBtn.html($submitBtnOriginal).attr('disabled', false);
                Notify.error(xhr);
                showInputErrors(xhr);
            }
        });
    });

    $(document).on('click', '.confirm-delete', function (e) {
        e.preventDefault();
        let $this = $(this);
        let $title = $this.data('title') ?? 'Heads Up!';
        let $message = $this.data('content') ?? 'Are you sure to delete?';
        let $url = $this.attr('href') ?? $this.attr('action') ?? $this.data('action');

        let $oldButtonText = $this.html();

        $.confirm({
            title: $title,
            content: $message,
            icon: 'fas fa-trash',
            theme: 'modern',
            closeIcon: true,
            animation: 'scale',
            type: 'red',
            scrollToPreviousElement: false,
            scrollToPreviousElementAnimate: false,
            buttons: {
                confirm: {
                    btnClass: 'btn-red',
                    action: function () {
                        $.ajax({
                            url: $url,
                            type: 'DELETE',
                            beforeSend: function () {
                                $this.html($spinner)
                                    .addClass('disabled')
                                    .attr('disabled', true);
                            },
                            success: function (res) {
                                Notify.success(res);
                                $this.html($oldButtonText)
                                    .removeClass('disabled')
                                    .attr('disabled', false);

                                if (res.redirect){
                                    location.href = res.redirect
                                }
                            },
                            error: function (xhr) {
                                $this.html($oldButtonText)
                                    .removeClass('disabled')
                                    .attr('disabled', false);
                                Notify.error(xhr);
                            }
                        })
                    }
                },
                close: {
                    action: function () {
                        this.buttons.close.hide()
                    }
                }
            }
        });
    });

    $(document).on('click', '.confirm-action', function (e) {
        e.preventDefault();
        let $this = $(this);
        let $title = $this.data('title') ?? 'Heads Up!';
        let $message = $this.data('content') ?? 'Are you sure to delete?';
        let $url = $this.attr('href') || $this.data('action');
        let $icon = $this.attr('icon') ?? 'fas fa-warning';
        let $type = $this.attr('method') ?? 'POST';
        let $btnClass = $this.attr('btnClass') ?? 'btn-red';

        let $oldButtonText = $this.html();

        $.confirm({
            title: $title,
            content: $message,
            icon: $icon,
            theme: 'modern',
            closeIcon: true,
            animation: 'scale',
            type: 'red',
            scrollToPreviousElement: false,
            scrollToPreviousElementAnimate: false,
            buttons: {
                confirm: {
                    btnClass: $btnClass,
                    action: function () {
                        $.ajax({
                            url: $url,
                            type: $type,
                            beforeSend: function () {
                                $this.html($spinner)
                                    .addClass('disabled')
                                    .attr('disabled', true);
                            },
                            success: function (res) {
                                $this.html($oldButtonText)
                                    .removeClass('disabled')
                                    .attr('disabled', false);

                                if (res.redirect){
                                    if (res.message){
                                        localStorage.setItem('message', res.message);
                                        localStorage.setItem('hasMessage', true);
                                    }

                                    location.href = res.redirect;
                                }else {
                                    Notify.success(res);

                                    if ($('.dataTable').length > 0){
                                        drawDataTable();
                                    }
                                }
                            },
                            error: function (xhr) {
                                $this.html($oldButtonText)
                                    .removeClass('disabled')
                                    .attr('disabled', false);
                                Notify.error(xhr);
                            }
                        })
                    }
                },
                close: {
                    action: function () {
                        this.buttons.close.hide()
                    }
                }
            }
        });
    });

    $(document).on('click', '.preview-modal', function(e){
        e.preventDefault();

        let $this = $(this);
        let $oldText = $this.html();
        let $url = $this.attr('href') ?? $this.data('action');
        let $size = $this.data('size');
        let $type = $this.data('method') ?? 'GET';
        let $title = $this.data('title');
        let $modal = $('#defaultModal');
        let $modalTitle = $('#defaultModal .modal-title').html($title);
        let $modalBody = $('#defaultModal .modal-body');
        let $modalDialog = $('#defaultModal .modal-dialog').addClass($size);

        $.ajax({
            type: $type,
            url: $url,
            accept: 'application/json',
            beforeSend: function () {
                $this.attr('disabled', true).addClass('disabled').html($spinner);
            },
            success: function(res){
                $modalBody.html(res);
                $modal.modal('show');

                $this.html($oldText)
                    .removeClass('disabled')
                    .attr('disabled', false);

            },
            error: function(xhr){
                Notify.error(xhr);
                $this.html($oldText)
                    .removeClass('disabled')
                    .attr('disabled', false);
            }
        })
    });

    // End Form Submission



    $('.collapse_btn').on('click', function() {
        $('.sidebar-header').toggleClass('d-none')
    });

    /*----------------------
        CheckAll Active
    --------------------------*/
    $(".checkAll").on('click', function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    $(document).on('click',function() {
        let charge_type = $('#charge_type').val()
        if (charge_type == 'fixed') {
            $('.transaction_fixed').addClass('d-block')
            $('.transaction_percentage').removeClass('d-block')
        }
        if (charge_type == 'percentage') {
            $('.transaction_fixed').removeClass('d-block')
            $('.transaction_percentage').addClass('d-block')
        }
    });

    /*-------------------------------
    Delete Confirmation Alert
    -----------------------------------*/
    $(".cancel").on('click',function(e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Do It!'
        }).then((result) => {
            if (result.value == true) {
                window.location.href = link;
            }
        })
    });
})(jQuery);
