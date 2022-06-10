const REGEX = /^\w+([\.\+\-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/,
    RFC_PATTERN_PM = "^(([A-ZÑ&]{3})([0-9]{2})([0][13578]|[1][02])(([0][1-9]|[12][\\d])|[3][01])([A-Z0-9]{3}))|" +
        "(([A-ZÑ&]{3})([0-9]{2})([0][13456789]|[1][012])(([0][1-9]|[12][\\d])|[3][0])([A-Z0-9]{3}))|" +
        "(([A-ZÑ&]{3})([02468][048]|[13579][26])[0][2]([0][1-9]|[12][\\d])([A-Z0-9]{3}))|" +
        "(([A-ZÑ&]{3})([0-9]{2})[0][2]([0][1-9]|[1][0-9]|[2][0-8])([A-Z0-9]{3}))$",

    RFC_PATTERN_PF = "^(([A-ZÑ&]{4})([0-9]{2})([0][13578]|[1][02])(([0][1-9]|[12][\\d])|[3][01])([A-Z0-9]{3}))|" +
        "(([A-ZÑ&]{4})([0-9]{2})([0][13456789]|[1][012])(([0][1-9]|[12][\\d])|[3][0])([A-Z0-9]{3}))|" +
        "(([A-ZÑ&]{4})([02468][048]|[13579][26])[0][2]([0][1-9]|[12][\\d])([A-Z0-9]{3}))|" +
        "(([A-ZÑ&]{4})([0-9]{2})[0][2]([0][1-9]|[1][0-9]|[2][0-8])([A-Z0-9]{3}))$";


(function () {
    'use strict'

    var forms = document.querySelectorAll('#form-register'),
        login = document.querySelectorAll('#form-login');

    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', validForm);
        }, false);

    Array.prototype.slice.call(login)
        .forEach(function (form) {
            form.addEventListener('submit', validLogin);
        }, false);

    empty();
})()

function validForm (event) {

    event.preventDefault()
    event.stopPropagation()

    let form = document.querySelectorAll('.form-control');

    form.forEach((key, index) => {

        if(key.value.length == 0) {
            key.classList.add('is-invalid');
        } else {
            key.classList.remove('is-invalid');
        }

        if(key.id == 'rfc') {
            if (!validRFC(key.value)) {
                key.classList.add('is-invalid');
            } else {
                key.classList.remove('is-invalid');
            }
        }

        if (key.id == 'password-confirm') {
            var password = document.getElementById('password');
            if (key.value != password.value) {
                key.classList.add('is-invalid');
            } else {
                key.classList.remove('is-invalid');
            }
        }

        // Condicion para formulario de edición
        if (document.getElementById('id')) {
            if (key.id == 'password') {
                key.classList.remove('is-invalid');
            }

            if (key.id == 'password-confirm') {
                var password = document.getElementById('password');
                if (password.value != "") {
                    document.querySelector('#content-pass-confirm').classList.remove('d-none');
                    if (key.value != password.value) {
                        key.classList.add('is-invalid');
                    } else {
                        key.classList.remove('is-invalid');
                    }
                } else {
                    document.querySelector('#content-pass-confirm').classList.add('d-none');
                    key.classList.remove('is-invalid');
                }
            }
        }
    });

    let invalid = document.querySelectorAll('#form-register')[0].getElementsByClassName('is-invalid');
    if (!invalid.length) {
        let url = document.querySelector('#id') ? `/update/${document.querySelector('#id').value}` : '/store';
        send(url);
    }
}

function validLogin (event) {

    event.preventDefault()
    event.stopPropagation()

    let form = document.querySelectorAll('.form-control');

    form.forEach((key, index) => {
        if(key.value.length == 0) {
            key.classList.add('is-invalid');
        } else {
            key.classList.remove('is-invalid');
        }

        if(key.id == 'email') {
            if (!validEmail(key.value)) {
                key.classList.add('is-invalid');
                document.getElementById('error-email').innerHTML = 'Ingresa un correo valido';
                document.getElementById('error-serve').innerHTML = '';
            } else {
                key.classList.remove('is-invalid');
            }
        }
    });

    let invalid = document.querySelectorAll('.is-invalid');
    if (!invalid.length) {
        this.submit();
    }
}

function clearForm (value, element) {

    let input =  document.getElementById(element);

    if (value.length > 0) {
        input.classList.remove('is-invalid')
    } else {
        input.classList.add('is-invalid')
    }

    if (element == 'rfc') {
        if (!validRFC(value)) {
            input.classList.add('is-invalid');
        } else {
            input.classList.remove('is-invalid');
        }
    }

    if (element == 'password-confirm') {
        if (value != document.getElementById('password').value) {
            input.classList.add('is-invalid');
        } else {
            input.classList.remove('is-invalid');
        }
    }

    if (element == 'email') {
        if (!validEmail(value)) {
            input.classList.add('is-invalid');
        } else {
            input.classList.remove('is-invalid');
        }
    }

    let id = document.getElementById('id');
    if (id) {

        if (element == 'password') {
            input.classList.remove('is-invalid');
            document.querySelector('#content-pass-confirm').classList.remove('d-none');

            if (value == "") {
                document.querySelector('#content-pass-confirm').classList.add('d-none');
                document.getElementById('password-confirm').classList.remove('is-invalid');
            }
        }

        if (element == 'password-confirm') {
            var password = document.getElementById('password');
            if (password.value != "") {
                if (value != password.value) {
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }
            }
        }
    }
}

function empty () {
    var forms = document.querySelectorAll('.form-control')
    forms.forEach((key, index) => {
        document.getElementById(key.id).value = "";
    });
}

function validRFC (rfc) {
    rfc = rfc.toUpperCase();
    if (rfc.match(RFC_PATTERN_PM) || rfc.match(RFC_PATTERN_PF)){
        return true;
    }else {
        return false;
    }
}

function validEmail (email) {
    return REGEX.test(email);
}

function send(route) {

    let form = document.querySelectorAll('.form-control'),
        formData = new FormData();

    form.forEach((key, index) => {
        formData.append(key.name, key.value);
    });

    loading(true);

    fetch(route, {
        headers:{
            // 'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        method:'POST',
        body: formData
    })
        .then(response => response.json())
        .then(function(result){

            loading(false);

            if (result.status == 'success') {
                empty();
                if (result.reload) {
                    setTimeout(function () {
                        window.location.reload();
                    }, 3500)
                }
            }

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: result.status,
                title: result.msg
            });

        })
        .catch(function (error) {
            loading(false);
            console.log(error);
        });
}

function show (data) {
    document.querySelector('#id').value = data.id;
    document.querySelector('#name').value = data.name;
    document.querySelector('#phone').value = data.phone;
    document.querySelector('#rfc').value = data.rfc;
}

function loading(flag) {
    if (flag) {
        document.querySelector('#buttons').classList.add('d-none');
        document.querySelector('#loading').classList.remove('d-none');
    } else {
        document.querySelector('#buttons').classList.remove('d-none');
        document.querySelector('#loading').classList.add('d-none');
    }
}
