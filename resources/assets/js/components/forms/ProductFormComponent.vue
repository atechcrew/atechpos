<template>
    <div class="col-md-12">
        <form action="" method="post" id="main-form"  enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div v-if="message" class="alert alert-success mb-2" role="alert">
                    <strong>{{message.title}}</strong> {{message.message}}
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                    <fieldset class="form-group">
                        <label>Name</label>
                        <input v-model="product.name" name="name" type="text" class="form-control">
                        <small class="text-danger error" v-text="getError('name')"></small>
                    </fieldset>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                    <fieldset class="form-group">
                        <label>Sale Price</label>
                        <input v-model="product.sale_price" name="sale_price" type="text" class="form-control">
                        <small class="text-danger error" v-text="getError('sale_price')"></small>
                    </fieldset>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                    <fieldset class="form-group">
                        <label>Purchase Price</label>
                        <input v-model="product.purchase_price" name="purchase_price" type="text" class="form-control">
                        <small class="text-danger error" v-text="getError('purchase_price')"></small>
                    </fieldset>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                    <fieldset class="form-group">
                        <label>Current Stock</label>
                        <input v-model="product.current_stock" name="current_stock" type="text" class="form-control">
                        <small class="text-danger error" v-text="getError('current_stock')"></small>
                    </fieldset>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 mb-12">
                    <fieldset class="form-group">
                        <label>Description</label>
                        <textarea v-model="product.description" name="description" class="form-control"></textarea>
                        <small class="text-danger error" v-text="getError('description')"></small>
                    </fieldset>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 mb-6">
                    <fieldset class="form-group">
                        <img :src="product.image" width="200px" />
                        <input type="file" v-on:change="newAvatar" name="image" class="form-control">
                        <small class="text-danger error" v-text="getError('image')"></small>
                    </fieldset>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 mb-6">
                </div>
                <div class="form-actions text-right col-md-12">
                    <button @click.prevent="save()" v-show="savebutton && !updatemode" class="btn btn-success">Save</button>
                    <button @click.prevent="save()" v-show="updatemode && updatebutton" class="btn btn-primary">Update</button>
                    <button @click="clear()" type="button" class="btn btn-info">Clear</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>

export default {
    props: ['updatebutton', 'savebutton', 'modal'],
    data() {
        return {
            product: {},
            errors: {},
            message: "",
            updatemode: false
        }
    },
    methods: {
        save(){
            var url = 'api/product/store'
            if(this.updatemode == true){
                url = 'api/product/update/' + this.product.id 
            }
            var form = $('#main-form')[0];
            var data = new FormData(form);
            axios.post(url, data)
            .then((res) => {
                this.message = res.data
                this.clear()
            })
            .catch((err) => {
                this.errors = err.response.data
            })
        },
        getError(field){
            return this.errors.hasOwnProperty(field) ? this.errors[field][0] : ""
        },
        handleFileChange(e) {
            this.product.image =  e.target.files[0]
        },
        clear(){
            this.product = {}
            this.updatemode = false
            $(this.modal).modal('toggle');
        },
        newAvatar(event) {
            let files = event.target.files;
            if (files.length) this.company_logo = files[0];
        },
        getproduct(id) {
            axios.get('api/product/find/' + id)
            .then((res) => {
                this.product = res.data
            })
            .catch((err) => {
                this.errors = err.response.data
            })
        }
    },
    created: function(){
        Event.listen('getproduct', (id) => {
            this.getproduct(id)
            this.updatemode = true
        })
    }
}
</script>