jQuery(document).ready(function($) {
    const ajaxUrl = data.ajax_url
    $('#form-edit-account-form').on('submit', function (event) {
        event.preventDefault()
        var form = $(this);
        var action = 'zen_update_account_info_general';
        var formData = form.serialize() + `&action=${action}`;
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: formData,
            beforeSend: function( xhr ) {
                form.find('button').addClass('disabled')
                form.find('input').removeClass('error')
            },
            success: function( data ) {
                if(data.success === true) {
                    setSuccessMessage(data.message)
                    emptyPasswordsFields()
                } else {
                    setErrorMessage(data.message)
                }
            },
            error(response) {
                var data = response.responseJSON.data
                var fields = data.fields
                var message = data.message
                setErrorMessage(message)
                setErrorsFields(fields,form)
            },
            complete: function () {
                form.find('button').removeClass('disabled')
            }
        });
    })
    $('#form-edit-billing').on('submit', function (event) {
        event.preventDefault()
        var form = $(this);
        var action = 'zen_update_user_billing_info';
        var formData = form.serialize() + `&action=${action}`;
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: formData,
            beforeSend: function( xhr ) {

                // form.find('button').addClass('disabled')
            },
            success: function( data ) {
                if(data.success === true) {
                    setSuccessMessage(data.message)
                } else {
                    setErrorMessage(data.message)
                }
            },
            error(response) {
                var data = response.responseJSON.data
                var message = data.message
                setErrorMessage(message)
            },
            complete: function () {
                form.find('button').removeClass('disabled')
            }
        });
    })
    $('#countries-select').on('change',function (event) {
        var stateSelect = $('#states-select')
        var countryCode = event.target.value;
        var data = {
            country : countryCode,
            action  : 'zen_get_current_states'
        }
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: data,
            beforeSend: function( xhr ) {
                stateSelect.addClass('disabled')
                stateSelect.find('option:not(:first)').remove();
            },
            success: function( response ) {
                var states = response.data
                if(states) {
                    Object.entries(states).forEach(function([code, name]) {
                        stateSelect.append('<option value="' + code + '">' + name + '</option>');
                    });
                }
            },
            error(response) {
                stateSelect.removeClass('disabled')
            },
            complete: function () {
                stateSelect.removeClass('disabled')
            }
        });
    })

    function setErrorMessage(text) {
        const errorModal = document.querySelector('#error-modal'),
            textWrapper = errorModal.querySelector('.message-container')
        textWrapper.innerHTML = text
        errorModal.classList.remove('hidden')
    }
    function setSuccessMessage(text)
    {
        const successModal = document.querySelector('#success-modal'),
            textWrapper = successModal.querySelector('.message-container')
        textWrapper.innerHTML = text
        successModal.classList.remove('hidden')
        window.setTimeout(function () {
            successModal.classList.add('hidden')
        },3000)
    }
    function setErrorsFields(fields,isGeneral = true)
    {
        if(fields.length === 0) {
            return
        }
        const form = isGeneral ? document.querySelector('#form-edit-account-form') : document.querySelector('#form-edit-billing')
        fields.forEach(field => {
            form.querySelector(`input[name=${field}]`).classList.add('error')
        })
    }
    function emptyPasswordsFields()
    {
        const form =document.querySelector('#form-edit-account-form'),
            fields = ['password_current','password_new','password_repeat']
        fields.forEach(field => {
            form.querySelector(`input[name=${field}]`).value = ''
        })
    }

});

