<style>
.form-group {
    float: right;
    margin: 10px;
}
.panel-heading {
    height: 55px;
}
</style>
<template>
    <div>
        <form @submit.prevent="createForm()">
        <router-link to="/" class="btn btn-default">Back</router-link>
            <div class="panel panel-default">
            <div class="form-group">
                <button class="btn btn-success">Create</button>
            </div>
                <div class="panel-heading">Warehouses</div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Longtitude</th>
                        <th>Latitude</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input type="text" v-model="warehouse.Name" class="form-control"></td>
                        <td><input type="text" v-model="warehouse.Longtitude" class="form-control"></td>
                        <td><input type="text" v-model="warehouse.Latitude" class="form-control"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        </form>
    </div>
</template>
 
<script>
    export default {
        data: function () {
            return {
                warehouse: {
                    Names: '',
                    Longtitude: '',
                    Latitude: '',
                }
            }
        },
        methods: {
            createForm() {
                var app = this;
                var newWarehouse = app.warehouse;
                axios.post('api/warehouses', newWarehouse)
                    .then(function (resp) {
                        app.$router.push({path: '/'});
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your warehouse");
                    });
            }
        }
    }
</script>