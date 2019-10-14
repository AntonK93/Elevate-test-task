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
        <form @submit.prevent="createRoom()">
        <router-link to="/" class="btn btn-default">Back</router-link>

            <div class="panel panel-default">
            <div class="form-group">
                <button class="btn btn-success">Create</button>
            </div>
                <div class="panel-heading">rooms</div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Temperature</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input type="text" v-model="room.Name" class="form-control"></td>
                        <td><input type="text" v-model="room.Temperature" class="form-control"></td>
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
                room: {
                    WarehouseId: '',
                    Name: '',
                    Temperature: '',
                }
            }
        },
        methods: {
            createRoom() {
                var app = this;
                app.room.WarehouseId = app.$route.params.id;
                var newRoom = app.room;
                axios.post('api/rooms', newRoom)
                    .then(function (resp) {
                        app.$router.push({path: '/'});
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your room");
                    });
            }
        }
    }
</script>