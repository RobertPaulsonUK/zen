jQuery(document).ready(function($) {
    const ajaxUrl = data.ajax_url
    $('#login-form, #register-form').on('submit', function (event) {
        event.preventDefault()
        var form = $(this);
        var action = $(this).is('#login-form') ? 'zen_login_user' : 'zen_register_user'
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
                    window.setTimeout(function () {
                        window.location.href = data.redirect
                    },3000)
                } else {
                    setErrorMessage(data.message)
                }
            },
            error(response) {
                var data = response.responseJSON.data
                var fields = data.fields
                var message = data.message
                setErrorMessage(message)
                setErrorsFields(fields,$(this).is('#login-form'))
            },
            complete: function () {
                form.find('button').removeClass('disabled')
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
    }
    function setErrorsFields(fields,isLogin = true)
    {
        if(fields.length === 0) {
            return
        }
        console.log(1)
        const form = isLogin ? document.querySelector('#login-form') : document.querySelector('#register-form')
        fields.forEach(field => {
            form.querySelector(`input[name=${field}]`).classList.add('error')
        })
    }

});

