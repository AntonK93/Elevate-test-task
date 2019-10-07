<style>
ul {
    list-style-type:none;
}
#location input {
    width:300px;
}
#location li {
    padding:6px;
}
</style>
<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'AddWarehouse'}" class="btn btn-success">Add Warehouse</router-link>
        </div>
 
        <div class="panel panel-default">
            <div class="panel-heading">Warehouses</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Names</th>
                        <th>Longtitude</th>
                        <th>Latitude</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="warehouse, index in warehouses">
                        <td><router-link :to="{name: 'EditWarehouse', params: {id: warehouse.id}}">{{ warehouse.Name }}</router-link></td>
                        <td>{{ warehouse.Longtitude }}</td>
                        <td>{{ warehouse.Latitude }}</td>
                        <td>{{ warehouse.Status.toUpperCase() }} ({{ warehouse.Temperature }} &deg;C)</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-default" id="location">
        <div class="panel-heading">My location</div>
        <div class="panel-body">
        <form v-on:submit="savePosition()">
            <ul>
                <li>Longtitude:</li>
                <li><input type="text" v-model="position.Longtitude" class="form-control"></li>
                <li>Latitude:</li>
                <li><input type="text" v-model="position.Latitude" class="form-control"></li>
                <li><button class="btn btn-success">Save</button></li>
            </ul>
        </form>
        </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data: function () {
            return {
                warehouses: [],
                position: []
            }
        },
        mounted() {
            var app = this;
            axios.get('api/warehouses')
                .then(function (resp) {
                    app.warehouses = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load warehouses");
                });
            axios.get('cookie/position/get')
                .then(function (resp) {
                    app.position = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load current position");
                });
        },
        methods: {
            savePosition() {
                event.preventDefault();
                var app = this;
                var newPosition = app.position;
                axios.post('cookie/position/set', {Longtitude: newPosition.Longtitude, Latitude: newPosition.Latitude})
                    .then(function (resp) {
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not save position");
                    });
            }
        }
    }
</script>