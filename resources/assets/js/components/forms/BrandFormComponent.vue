<template>
    <div class="col-md-12">
        <form action="" method="post" :id="formid"  enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div v-if="message != null" class="alert alert-success mb-2" role="alert">
                    <strong>{{message.title}}</strong> {{message.message}}
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 mb-12">
                    <fieldset class="form-group">
                        <label>Name</label>
                        <input v-model="brand.name" name="name" type="text" class="form-control">
                        <small class="text-danger error" v-text="getError('name')"></small>
                    </fieldset>
                    <fieldset class="form-group">
                        <label>Description</label>
                        <textarea v-model="brand.description" name="description" type="text" class="form-control"></textarea>
                        <small class="text-danger error" v-text="getError('description')"></small>
                    </fieldset>
                    <fieldset class="form-group">
                        <label>Active</label>
                        <input type="hidden" name="active" value="0">
                        <input type="checkbox" true-value="1" false-value="0" :checked="brand.active" value="1" name="active" v-model="brand.active"  />
                    </fieldset>
                </div>
                <div class="form-actions text-right col-md-12">
                    <button @click.prevent="save()" v-show="savebutton && !updatemode" class="btn btn-success">Save</button>
                    <button @click.prevent="update()" v-show="updatemode && updatebutton" class="btn btn-primary">Update</button>
                    <button @click="clear()" type="button" class="btn btn-info">Cancel</button>
                    <button @click="closeModal()" v-show="closebutton" type="button" class="btn btn-default">Close</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['savebutton', 'updatebutton', 'closebutton', 'modal', 'formid'],
        data() {
            return {
                brand: {active: 1},
                errors: {},
                message: null,
                updatemode: false
            }
        },
        methods: {
            save(){
                var form = $('#' + this.formid)[0];
                var data = new FormData(form);
                axios.post('api/brand/store', data)
                .then((res) => {
                    this.message = res.data
                    this.updatemode = false
                    this.brand = {}
                    Event.fire('brandadded')
                })
                .catch((err) => {
                    this.errors = err.response.data
                })
            },
            update(){
                var form = $('#' + this.formid)[0];
                var data = new FormData(form);
                axios.post('api/brand/update/' + this.brand.id, data)
                .then((res) => {
                    this.message = res.data
                    this.updatemode = false
                    this.brand = {active: 1}
                    Event.fire('brandadded')
                })
                .catch((err) => {
                    this.errors = err.response.data
                })
            },
            clear() {
                this.brand = {active: 1}
                this.updatemode = false
                this.message = null
            },
            getError(field){
                return this.errors.hasOwnProperty(field) ? this.errors[field][0] : ""
            },
            closeModal(){
                this.clear()
                Event.fire('closemodal', this.modal)
            }
        },
        created() {
            Event.listen('editbrand', (data) => {
                this.brand = data
                this.updatemode = true
            })
        }
    }
</script>