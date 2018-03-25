require('./bootstrap');

window.Vue = require('vue');

//Event dispatcher
window.Event = new class {
    constructor() {
        this.vue = new Vue()
    }
    fire(event, data = null) {
        this.vue.$emit(event, data)
    }
    listen(event, callback) {
        this.vue.$on(event, callback)
    }
}

Vue.component(
    'product-form-component',
    require('./components/forms/ProductFormComponent.vue')
);

Vue.component(
    'category-form-component',
    require('./components/forms/CategoryFormComponent.vue')
);

Vue.component(
    'category-grid-component',
    require('./components/grids/CategoryGridComponent.vue')
);

Vue.component('pagination', require('laravel-vue-pagination'));

const app = new Vue({
    el: '#app',
    methods: {
        openModal(modal) {
            $(modal).modal('show')
        },
        closeModal(modal) {
            $(modal).modal('show')
        }
    },
    created: function () {
        Event.listen('closemodal', (modal) => {
            $(modal).modal('hide')
        })

        Event.listen('openmodal', (modal) => {
            $(modal).modal('show')
        })
    }
});
