<template>
    <div>
        <div class="col-md-12">
            <div v-if="message != null" class="alert alert-success mb-2" role="alert">
            <strong>{{message.title}}</strong> {{message.message}}
            </div>
        </div>
        <input type="text" v-model="searchPerm" class="form-control" placeholder="Search" @input="get()">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>
                        Name
                    </th>
                    <th>
                        Description
                    </th>
                    <th>
                        Active
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="brand in brands.data" :key="brand.id">
                    <td>{{brand.name}}</td>
                    <td>{{brand.description}}</td>
                    <td><i :class="getClass(brand.active)"></i></td>
                    <td>
                        <button class="btn btn-sm btn-primary" @click="editItem(brand.id)"><i class="ft-pen"></i> Edit</button>
                        <button class="btn btn-sm btn-danger" @click="deleteItem(brand.id)"><i class="ft-cross"></i> Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination :data="brands" v-on:pagination-change-page="get"></pagination>
        <div class="form-actions text-right col-md-12">
            <button @click="closeModal()" v-if="closebutton" type="button" class="btn btn-default">Close</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['modal', 'closebutton'],
        data() {
            return {
                brands: {},
                brand: {},
                message: null,
                searchPerm: ''
            }
        },
        methods: {
            get(page){
                if (typeof page === 'undefined') {
				    page = 1;
                }
                var perm = this.searchPerm
                if(this.searchPerm.trim() == ''){
                    perm = '---nothing---'
                }

                axios.get('api/brand/all/ ' + perm + '?page=' + page)
                .then((res) => {
                    this.brands = res.data  
                })
                .catch((err) => {

                })
            },
            deleteItem(id) {
                axios.get('api/brand/destroy/' + id)
                .then((res) => {
                    this.message = res.data
                    this.get()
                })
                .catch((err) => {

                })
            },
            editItem(id){
                Event.fire('openmodal', this.modal)
                axios.get('api/brand/find/' + id)
                .then((res) => {
                    Event.fire('editbrand', res.data)  
                    this.closeModal()
                })
                .catch((err) => {

                })
            },
            closeModal(){
                Event.fire('closemodal', this.modal)
            },
            getClass(active){
                if(active == 1){
                    return 'ft-check-circle'
                }
                else {
                    return 'ft-x-circle'
                }
            }
        },
        created() {
            this.get()
            Event.listen('brandadded', () => {
                this.get()
            })
        }
    }
</script>
