<!DOCTYPE html>
<html>
    <head>
        <title>Vue.Js</title>
        <script src = "./js/vue.js"></script>
        <link rel="stylesheet" type = "text/css" href ="./css/bootstrap.min.css">
        <style type="text/css">
            #overlay{
                position : fixed;
                top : 0;
                bottom : 0;
                left : 0;
                right : 0;  
                background : rgba(0,0,0,0.6);
            }
        </style>
    </head>
    <body>
        <div id = "app">
            <div class = "container-fluid">
                <div class = "row bg-dark">
                    <div class = "col-lg-12">
                        <p class = "text-center text-light display-4 pt-2" style ="font-size:25px;"> Whatsup </p>
                    </div>
                </div>
            </div>
            <div class ="container">
                <div class = "row mt-3">
                    <div class = "col-lg-6">
                        <h3 class = "text-info" style ="font-size:20px;"> List of all Users </h3>
                    </div>
                    <div class = "col-lg-6">
                        <button class = "btn btn-info float-right" @click ="showAddModal = true"> Add New User</button>
                    </div>
                </div>
                <hr class = "bg-info">  
                <div class = "alert alert-danger" v-if ="errorMsg">{{ errorMsg }}</div>
                <div class = "alert alert-success" v-if ="successMsg">{{ successMsg }}</div>

                <div class ="row">
                    <div class = "col-lg-12"> 
                        <table class = "table table-bordered table-striped">
                            <thead>
                                <tr class = "text-center bg-info text-light">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Phone Number </th>
                                    <th>Edit</th>
                                    <th>Delete</th> 
                            </thead>
                            <tbody>
                                <tr class = "text-center" v-for ="user in users">
                                <td>{{user.id}}</td>
                                <td>{{user.name}}</td>
                                <td>{{user.email}}</td>
                                <td>{{user.address}}</td>
                                <td>{{user.phoneNum}}</td>
                                <td><button class = "btn btn-outline-primary btn-sm" @click = "showEditModal = true; selectUser(user);">Edit</td>
                                <td><button class = "btn btn-outline-danger btn-sm" @click = "showDeleteModal = true; selectUser(user);">Delete</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Tambah User Baru -->
            <div id = "overlay" v-if ="showAddModal">
                <div class = "modal-dialog">
                    <div class ="modal-content">
                        <div class = "modal-header">
                            <h5 class = "modal-title">Add New User</h5>
                            <button type ="button" class = "close" @click ="showAddModal = false">
                                <span aria-hidden ="true">&times;</span>
                            </button>
                        </div>
                        <div class = "modal-body p-4">
                             <form action="#" method ="post">
                                <div class = "form-group">
                                    <input type ="text" name="name" class ="form-control form-control-lg" placeholder ="Name" v-model ="newUser.name">
                                </div>
                                <div class = "form-group">
                                    <input type ="email" name="email" class ="form-control form-control-lg" placeholder ="Email" v-model ="newUser.email">
                                </div>
                                <div class = "form-group">
                                    <input type ="text" name="address" class ="form-control form-control-lg" placeholder ="Address"v-model ="newUser.address">
                                </div>
                                <div class = "form-group">
                                    <input type ="tel" name="phoneNum" class ="form-control form-control-lg" placeholder ="PhoneNum" v-model ="newUser.phoneNum">
                                </div>
                                <div class = "form-group">
                                    <button class = "btn btn-info btn-block btn-lg" @click ="showAddModal = false; addUser();">Add User</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id = "overlay" v-if ="showEditModal">
                <div class = "modal-dialog">
                    <div class ="modal-content">
                        <div class = "modal-header">
                            <h5 class = "modal-title">Edit User</h5>
                            <button type ="button" class = "close" @click ="showEditModal = false">
                                <span aria-hidden ="true">&times;</span>
                            </button>
                        </div>
                        <div class = "modal-body p-4">
                             <form action="#" method ="post">
                                <div class = "form-group">
                                    <input type ="text" name="name" class ="form-control form-control-lg" v-model = "currentUser.name" >
                                </div>
                                <div class = "form-group">
                                    <input type ="email" name="email" class ="form-control form-control-lg" v-model = "currentUser.email">
                                </div>
                                <div class = "form-group">
                                    <input type ="text" name="address" class ="form-control form-control-lg" v-model = "currentUser.address">
                                </div>
                                <div class = "form-group">
                                    <input type ="tel" name="phoneNum" class ="form-control form-control-lg" v-model = "currentUser.phoneNum">
                                </div>
                                <div class = "form-group">
                                    <button class = "btn btn-info btn-block btn-lg" @click ="showEditModal = false; editUser();">Edit User</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id = "overlay" v-if ="showDeleteModal">
                <div class = "modal-dialog">
                    <div class ="modal-content">
                        <div class = "modal-header">
                            <h5 class = "modal-title">Delete User</h5>
                            <button type ="button" class = "close" @click ="showDeleteModal = false">
                                <span aria-hidden ="true">&times;</span>
                            </button>
                        </div>
                        <div class = "modal-body p-4">
                                <h4>Are you sure you want to Delete the User?</h4>
                                <h5>You are deleteing {{ currentUser.name}} </h5>
                                <hr>
                                <button class = "btn btn-danger btn-lg" @click = "showDeleteModal = false; deleteUser();" >Yes </button>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <button class = "btn btn-success btn-lg"@click = "showDeleteModal = false" >No </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
    <script>

        var app = new Vue({
             el: '#app',
            data : {    
                errorMsg : "",
                successMsg : "",
                showAddModal : false,
                showEditModal : false,
                showDeleteModal : false,    
                users : [],
                newUser : {name : "",email : "",address : "",phoneNum : ""},
                currentUser : {}
            },
            mounted : function(){
                this.getAllUsers();
            },
            methods : {
                getAllUsers(){
                    axios.get("http://localhost/Vue/config.php?action=read").then(function(response){
                        if(response.data.error){
                            app.errorMsg = response.data.message;
                        }
                        else{
                            app.users = response.data.users;
                        }
                    });
                },
                addUser(){
                    var formData = app.toFormData(app.newUser);
                    axios.post("http://localhost/Vue/config.php?action=create",formData).then(function(response){
                        app.newUser = {name: "",email: "",address: "",phoneNum: ""};
                        if(response.data.error){
                            app.errorMsg = response.data.message;
                        }
                        else{
                            app.successMsg = response.data.message;
                            app.getAllUsers();
                        }
                    });
                },
                toFormData(obj){
                    var fd = new FormData();
                        for(var i in obj){
                            fd.append(i,obj[i]);
                        }
                    return fd; 
                },
                editUser(){
                    var formData = app.toFormData(app.currentUser);
                    axios.post("http://localhost/Vue/config.php?action=edit",formData).then(function(response){
                        app.currentUser = {};
                        if(response.data.error){
                            app.errorMsg = response.data.message;
                        }
                        else{
                            app.successMsg = response.data.message;
                            app.getAllUsers();
                        }
                    });
                },
                selectUser(user){
                    app.currentUser = user;
                },
                deleteUser(){
                    var formData = app.toFormData(app.currentUser);
                    axios.post("http://localhost/Vue/config.php?action=delete",formData).then(function(response){
                        app.currentUser = {};
                        if(response.data.error){
                            app.errorMsg = response.data.message;
                        }
                        else{
                            app.successMsg = response.data.message;
                            app.getAllUsers();
                        }
                    });
                },   
            }
        });
    </script>
</html>