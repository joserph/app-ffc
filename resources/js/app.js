/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


//const { default: Axios } = require('axios');

/////require('./jquery'); 
//require('./bootstrap.js');


//window.Vue = require('vue');
//require('toastr');
//require('axios');


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#invoiceitem',
    created: function(){
               
        this.getInvoiceItems();
    },
    data: {
        invoiceitems: [],
        id_invoiceh: '', 
        id_client: '', 
        id_farm: '', 
        id_load: '', 
        variety_id: '', 
        hawb: '', 
        pieces: '',
        hb: '',
        qb: '',
        eb: '', 
        stems: '', 
        price: '',
        bunches: '', 
        fulls: '',    
        total: '',
        id_user: '',
        update_user: '',
        stems_p_bunches: ''
    },
    methods: {
        getInvoiceItems: function(){
            var id_load = $('#id_load').val();
            //alert(id_load);
            var urlInvoiceItems = 'invoicesitems/' + id_load;
            axios.get(urlInvoiceItems).then(response => {
                this.invoiceitems = response.data
            });
        },
        deleteInvoiveItem: function(item){
            var url = 'masterinvoicesitems/' + item.id;
            axios.delete(url).then(response => { // Eliminamos
                this.getInvoiceItems(); // Listamos
                toastr.success('Eliminado correctamente'); // Mensaje
            });
        },
        createInvoiceItem: function(){
            var url = 'masterinvoicesitems';
            
            // Calculo de los total de piezas.
            this.pieces = parseInt(this.hb) + parseInt(this.qb) + parseInt(this.eb);
            // Calculo de los fulls.
            this.fulls = parseFloat(this.hb * 0.50) + parseFloat(this.qb * 0.25) + parseFloat(this.eb * 0.125);

            console.log(this.fulls);
            
            axios.post(url, {
                id_invoiceh: $('#id_invoiceh').val(),
                id_client: this.id_client,
                id_farm: this.id_farm,
                id_load: $('#id_load').val(),
                variety_id: this.variety_id,
                hawb: this.hawb,
                pieces: this.pieces,
                hb: this.hb,
                qb: this.qb,
                eb: this.eb,
                stems: this.stems, 
                price: parseFloat(this.price),
                bunches: $('#bunches').val(), 
                fulls: parseFloat(this.fulls),  
                total: parseFloat($('#total').val()),
                id_user: $('#id_user').val(),
                update_user: $('#update_user').val(),
                stems_p_bunches: this.stems_p_bunches
            }).then(response => {
                this.getInvoiceItems();
                this.id_invoiceh = '';
                this.id_client = '';
                this.id_farm = '';
                this.id_load = '';
                this.variety_id = '';
                this.hawb = '';
                this.pieces = '';
                this.hb = '';
                this.qb = '';
                this.eb = '';
                this.stems = '';
                this.price = '';
                this.bunches = '';
                this.fulls = '';
                this.total = '';
                this.id_user = '';
                this.update_user = '';
                this.stems_p_bunches = '';
                $('#agregarItem').modal('hide');
                toastr.success('creado correctamente'); // Mensaje
            })
        }
    }
});



