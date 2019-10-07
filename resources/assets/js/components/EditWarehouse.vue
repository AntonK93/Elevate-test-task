<style>
ul {
    list-style: none;
}
#rooms ul,#rooms li {
    display:inline-block;
}
#rooms ul {
    width:100%;
    border: 1px solid #ddd;
}
#rooms li {
    width:33%;
    padding: 10px;
}
.form-group {
    float: right;
    margin: 10px;
}
.panel-heading {
    height: 55px;
}
#alert {
    padding:15px;
    background-color:#ff000059;
    margin-bottom: 10px;
}
</style>
<template>
    <div>
        <div id="alert" v-show="warehouse.Status == 'high'" show>
            <ul>
                <li>Status: {{ warehouse.Status }}</li>
                <li>Warehouse is {{ warehouse.distance }} km away from your location</li>
            </ul>
        </div>

        <form v-on:submit="saveWarehouse()">
            <router-link to="/" class="btn btn-default">Back</router-link>
            <div class="panel panel-default" id="warehouse">
                <div class="form-group">
                        <button class="btn btn-success">Save</button>
                </div>
                <div class="panel-heading">
                    Warehouse {{ warehouse.Name }}
                </div>
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
 
        <div class="panel panel-default" id="rooms">
        <div class="form-group">
            <router-link :to="{name: 'AddRoom'}" class="btn btn-success">Add Room</router-link>
        </div>
            <div class="panel-body">
            <div class="panel-heading">Rooms</div>
            <div width="100%">
            <ul id="room-names">
                <li>Name</li>
                <li>Temperature</li>
                <li style="width:200px !important">&nbsp;</li>
            </ul>
            </div>
                <div v-for="room, index in rooms">
                <form v-on:submit="saveRoom(room)">
                    <ul>
                        <li><input type="text" v-model="room.Name" class="form-control"></li>
                        <li><input type="text" v-model="room.Temperature" class="form-control"></li>
                        <li style="width:50px !important; padding: 0px !important;"><span>&deg;C</span></li>
                        <li style="width:200px !important">  
                            <button class="btn btn-success">Save</button>
                            <a href="#" class="btn btn-danger" v-on:click="deleteRoom(room.id, index)">
                                Delete
                            </a>
                        </li>
                    </ul>     
                </form>      
                </div>

            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data: function () {
            return {
                warehouse: [],
                rooms: [],
            }
        },
        mounted() {
            var app = this;
            app.warehouseId = app.$route.params.id;
            axios.get('api/warehouses/'+ app.warehouseId)
                .then(function (resp) {
                    app.warehouse = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load warehouse");
                });
            axios.get('api/warehouses/getRooms/'+ app.warehouseId)
                .then(function (resp) {
                    app.rooms = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load rooms of warehouse");
                });
        },
        methods: {
            deleteRoom(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete('api/rooms/' + id)
                        .then(function (resp) {
                            app.rooms.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete room");
                        });
                }
            },
            saveWarehouse() {
                event.preventDefault();
                var app = this;
                var updatedWarehouse = app.warehouse;
                axios.put('api/warehouses/' + app.warehouseId, updatedWarehouse)
                    .then(function (resp) {
                        app.$router.replace('/');
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not update your warehouse");
                    });
            },
            saveRoom(room) {
                event.preventDefault();
                var app = this;
                var updatedRoom = room;
                console.log(room.Temperature);
                axios.put('api/rooms/' + updatedRoom.id, updatedRoom)
                    .then(function (resp) {
                        app.$router.go();
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not update your room");
                    });
            }
        }
    }
</script>
