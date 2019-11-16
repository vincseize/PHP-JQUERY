<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD -> PHP| MySQL | Vue.js | Axios</title>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css">
</head>
<body>

<h1>Administration Contacts</h1>
<hr>
<div id='vueapp' style="padding:5px;">

  <div id='form' style="padding:5px;display:none;">
      <form>
        <label>Name</label>
        <input type="text" name="name" v-model="name">
        </br>
        <label>Email</label>
        <input type="email" name="email" v-model="email">
        </br>
        <label>Country</label>
        <input type="text" name="country" v-model="country">
        </br>
        <label>City</label>
        <input type="text" name="city" v-model="city">
        </br>
        <label>Job</label>
        <input type="text" name="job" v-model="job">
        </br>
        <label>Id</label>
        <input type="text" name="id" v-model="id">
      </form>
      </br>
    </div>
      <!-- <input type="button" @click="createContact()" value="Add Input"> -->
      <!-- <button id="btAdd" type="button" class="btn btn-primary">Add</button> -->
      <button id='btAdd' type="button" @click="toggleForm()" class="btn btn-primary">Add</button>
      <button id='btCancel' type="button" @click="toggleForm()" class="btn btn-default" style="display:none;">Cancel</button>
      <button id='btConfirm' type="button" @click="createContact()" class="btn btn-primary" style="display:none;">Confirm</button>
    <hr>
  <table border='1' width='100%' style='border-collapse: collapse;'>
    <tr style="background-color:gray;">
      <th>Name</th>
      <th>Email</th>
      <th>Country</th>
      <th>City</th>
      <th>Job</th>
      <th width="1%"></th>
      <th width="1%"></th>
    </tr>
    <tr v-for='contact in contacts'>
      <td>{{ contact.name }}</td>
      <td>{{ contact.email }}</td>
      <td>{{ contact.country }}</td>
      <td>{{ contact.city }}</td>
      <td>{{ contact.job }}</td>
      <td><button type="submit" @click="updateContact(contact.id,contact.name)" class="btn btn-primary">Update</button></td>
      <td><button type="submit" @click="deleteContact(contact.id)" class="btn btn-danger">Delete</button></td>
      <!-- <td><button type="submit" @click="deleteContact(contact.id)" class="btn btn-danger btn-xs">Delete</button></td> -->
    </tr>
  </table>

  </br>

</div>

<script>
var app = new Vue({
  el: '#vueapp',
  data: {
      name: '',
      email: '',
      country: '',
      city: '',
      job: '',
      id: '',
      contacts: []
  },
  mounted: function () {
    // console.log('Hello from Vue!')
    this.getContacts()
  },
  methods: {
    getContacts: function(){
        axios.get('api/contacts.php')
        .then(function (response) {
            console.log(response.data);
            app.contacts = response.data;
        })
        .catch(function (error) {
            console.log(error);
        });
    },
    updateContact: function(id,name_update){
        console.log("Update");
        console.log(id+name_update);
        axios.post('api/contacts.php', {
          data : {
            update: id,
            name: name_update
            },
          }) .then(function (response) {
            //handle success

              //  refresh Contacts to do better
              axios.get('api/contacts.php')
              .then(function (response) {
                  console.log(response.data);
                  app.contacts = response.data;
              })
              .catch(function (error) {
                  console.log(error);
              });
            
          }) .catch(function (error) {
              //handle error
              console.log(error)
          });
    },
    deleteContact: function(id){
        console.log("Delete");
        axios.post('api/contacts.php', {
          data : {delete: id},
          }) .then(function (response) {
            //handle success

              //  refresh Contacts to do better
              axios.get('api/contacts.php')
              .then(function (response) {
                  console.log(response.data);
                  app.contacts = response.data;
              })
              .catch(function (error) {
                  console.log(error);
              });
            
          }) .catch(function (error) {
              //handle error
              console.log(error)
          });
    },
    createContact: function(){
        console.log("Create");
        if(this.name===null || this.name=== ''){alert('Empty Name')}
        else{
            let formData = new FormData();
            formData.append('name', this.name=this.sanitize(this.name))
            formData.append('email', this.email=this.sanitize(this.email))
            formData.append('city', this.city=this.sanitize(this.city))
            formData.append('country', this.country=this.sanitize(this.country))
            formData.append('job', this.job=this.sanitize(this.job))

            var contact = {};
            formData.forEach(function(value, key){
                contact[key] = value;
            });
            axios.defaults.trailingSlash = true;
            axios.interceptors.request.use((config) => {
              if (config.addTrailingSlash && config.url[config.url.length-1] !== '/') {
                config.url += '/';
              }
              return config;
            });
            axios({
                method: 'post',
                url: 'api/contacts.php',
                data: formData,
                config: { headers: {'Content-Type': 'multipart/form-data'}}
            })
            .then(function (response) {
                //handle success
                contact['id'] = response['data']['id'];
                app.contacts.push(contact)
                app.resetForm();
            })
            .catch(function (response) {
                //handle error
                console.log(response)
            });
        }
    },
    sanitize: function(value){
      value = value.replace(/\\/g,'/');
      console.log(value);
      return value;
      // value = value.replace(/\t/g,'\\t');
      // value = value.replace(/^\\/, '\\\\');
      // if(value.length === 1){
      //   console.log(value);
      // }
      // if(value.length > 0){
        // console.log('--sanitize');
        // console.log(value);
        // return value ? value.replace(/\\/g,'\\\\').replace(/\n/g,'\\n').replace(/\t/g,'\\t').replace(/\v/g,'\\v').replace(/'/g,"\\'").replace(/"/g,'\\"').replace(/[\x00-\x1F\x80-\x9F]/g,hex) : s;
        // function hex(c) { var v = '0'+c.charCodeAt(0).toString(16); return '\\x'+v.substr(v.length-2); }
      // }
      // else{
      //   return value;
      // }
    },
    toggleForm: function(){
      $("#form").toggle();
      $("#btAdd").toggle();
      $("#btCancel").toggle();
      $("#btConfirm").toggle();
    },
    resetForm: function(){
        this.name = '';
        this.email = '';
        this.country = '';
        this.city = '';
        this.job = '';
    }
  }
})    
</script>
<script>
//   $(document).ready(function() {
//   $('#btAdd').click(function() {
//     console.log('toggleFormReady');
//     $("#form").toggle();
//   });
// });
</script>

<style>
.logo {
  width: 50px;
  float: left;
  margin-right: 15px;
}

.form-group {
  max-width: 500px;
}

.actions {
  padding: 10px 0;
}

.glyphicon-euro {
  font-size: 12px;
}

</style>

</div>


</body>
</html>
