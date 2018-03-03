
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

$(document).on("click", ".open-edit-contact", function () {
    let contact_id = $(this).data('id');
    let contact_name = $(this).data('name');
    let contact_surname = $(this).data('surname');
    let contact_email = $(this).data('email');
    let phone_number = $(this).data('phone_number');
    let contact_address = $(this).data('address');
    let dob = $(this).data('dob');
    $(".modal-body #contact_id").val( contact_id );
    $(".modal-body #contact_name").val( contact_name );
    $(".modal-body #contact_surname").val( contact_surname );
    $(".modal-body #contact_email").val( contact_email );
    $(".modal-body #phone_number").val( phone_number );
    $(".modal-body #contact_address").val( contact_address );
    $(".modal-body #dob").val( dob );
});
$(document).on("click", ".edit-profile-button", function () {
    let form = $('#form-edit-contact').serializeArray();
    axios.post('http://netpc.test/contacts/update/'+form[0].value, {
        name:        form[1].value,
        surname:     form[2].value,
        email:       form[3].value,
        phone_number:form[4].value,
        address:     form[5].value,
        dob:         form[6].value
    }).then(function (res) {
        if(res.data.status !== 200)
        {
            $(".label-error" ).html('');
            let keyNames = Object.keys(res.data.errors);
            $(keyNames).each(function (key, item) {
                $("span[data-label='contact_"+item+"']" ).html(res.data.errors[item]);
            });
            return;
        }
        window.location.reload();
    })
});
$(document).on("click", ".create-profile-button", function () {
    let form = $('#form-create-contact').serializeArray();
    axios.post('http://netpc.test/contacts/store', {
        name:        form[1].value,
        surname:     form[2].value,
        email:       form[3].value,
        phone_number:form[4].value,
        address:     form[5].value,
        dob:         form[6].value
    }).then(function (res) {
        if(res.data.status !== 200)
        {
            $(".label-error" ).html('');
            let keyNames = Object.keys(res.data.errors);
            $(keyNames).each(function (key, item) {
                $("span[data-label='contact_"+item+"']" ).html(res.data.errors[item]);
            });
            return;
        }
        window.location.reload();
    })
});


