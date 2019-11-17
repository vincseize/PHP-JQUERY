<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD -> PHP| MySQL | Vue.js | Axios</title>

    <!-- <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css"> -->
    
    <script src="js/vue/2.6.10/vue.js"></script>
    <script src="js/axios.min.js"></script>
    <script src="js/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap/3.3.7/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap/3.3.7/bootstrap-theme.min.css">

  </head>
<body>

<h1>CONTACTS Administration</h1>
<hr>
<div id='vueapp' style="padding:5px;">

  <div id='form' style="padding:5px;display:none;">
      <form>
        <label>Name</label>
        <input type="text" id="form_name" name="name" v-model="name">
        </br>
        <label>Email</label>
        <input type="email" id="form_email" name="email" v-model="email">
        </br>
        <label>Country</label>
        <input type="text" id="form_country" name="country" v-model="country">
        </br>
        <label>City</label>
        <input type="text" id="form_city" name="city" v-model="city">
        </br>
        <label>Job</label>
        <input type="text" id="form_job" name="job" v-model="job">
        </br>
        <input type="text" id="form_id" name="id" v-model="id" style="display:none;">
      </form>
      </br>
    </div>
      <!-- <input type="button" @click="createContact()" value="Add Input"> -->
      <!-- <button id="btAdd" type="button" class="btn btn-primary">Add</button> -->
      <button id='btAdd' type="button" @click="addToggleForm()" class="btn btn-primary" style="display:block;">Add</button>
      <button id='btCancel' type="button" @click="cancelForm()" class="btn btn-default" style="display:none;">Cancel</button>
      <button id='btConfirm' type="button" @click="createContact()" class="btn btn-primary" style="display:none;">Confirm</button>
      <button id='btUpdate' type="button" @click="updateContact()" class="btn btn-primary" style="display:none;">Update</button>
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
      <td><button type="submit" @click="updateTogleForm(contact.id,contact.name,contact.email,contact.country,contact.city,contact.job)" class="btn btn-primary">Update</button></td>
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
      url_api: 'api/contacts.php',
      contacts: []
  },
  mounted: function () {
    // console.log('Hello from Vue!')
    this.getContacts()
  },
  methods: {
    getContacts: function(){
        axios.get(this.url_api)
        .then(function (response) {
            console.log(response.data);
            app.contacts = response.data;
        })
        .catch(function (error) {
            console.log(error);
        });
    },
    updateContact: function(){
        console.log("updateContact");
        id = $("#form_id").val();
        name_update= $("#form_name").val();
        email_update= $("#form_email").val();
        city_update= $("#form_city").val();
        country_update= $("#form_country").val();
        job_update= $("#form_job").val();

        // console.log(id+name_update+email_update+city_update+country_update+job_update);
        axios.post(app.url_api, {
          data : {
            update: id,
            name: name_update,
            email: email_update,
            city: city_update,
            country: country_update,
            job: job_update
            },
          }) .then(function (response) {
            //handle success
            // to do better

              // this.cancelForm;
              $("#form").hide();
              $("#btAdd").show();
              $("#btCancel").hide();
              $("#btUpdate").hide();
              $("#btConfirm").hide();

              //  refresh Contacts to do better
              axios.get(app.url_api)
              .then(function (response) {
                  console.log(response.data);
                  app.contacts = response.data;
              })
              .catch(function (error) {
                  console.log(error);
              });
            
          }) .catch(function (error) {
              console.log(error)
          });
    },

// deleteContact: (id) => {

  // console.log("Delete");
  //       axios.post('api/contacts.php', {
  //         data : {delete: id},
  //         }) .then(function (response) {
  //           //handle success


                // this.getContacts();

  //             //  refresh Contacts to do better
  //             axios.get('api/contacts.php')
  //             .then(function (response) {
  //                 console.log(response.data);
  //                 app.contacts = response.data;
  //             })
  //             .catch(function (error) {
  //                 console.log(error);
  //             });


            
  //         }) .catch(function (error) {
  //             //handle error
  //             console.log(error)
  //         });
  //   },

//}

    deleteContact: function(id){
        console.log("Delete"+id);
        axios.post(app.url_api, {
          data : {delete: id},
          }) .then(function (response) {
            //handle success

              //  refresh Contacts to do better
              axios.get(app.url_api)
              .then(function (response) {
                  console.log(response.data);
                  app.contacts = response.data;
              })
              .catch(function (error) {
                  console.log(error);
              });


            
          }) .catch(function (error) {
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
                url: app.url_api,
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
    addToggleForm: function(){
      $("#form").toggle();
      $("#btAdd").toggle();
      $("#btCancel").toggle();
      $("#btConfirm").toggle();
      // $("#form").trigger('reset');
      app.resetForm();
    },
    cancelForm: function(){
      $("#form").hide();
      $("#btAdd").show();
      $("#btCancel").hide();
      $("#btUpdate").hide();
      $("#btConfirm").hide();
    },
    updateTogleForm: function(id,name,email,country,city,job){
      console.log('updateTogleForm');
      console.log(id);
      console.log(name);
      $("#form").show();
      $("#btAdd").hide();
      $("#btCancel").show();
      $("#btUpdate").show();
      $("#btConfirm").hide();

      app.id = id;
      app.name = name;
      app.email = email;
      app.country = country;
      app.city = city;
      app.job = job;

      // $("#form_id").val(id);
      // $("#form_name").val(name);
      // $("#form_email").val(email);
      // $("#form_country").val(country);
      // $("#form_city").val(city);
      // $("#form_job").val(job);

    },
    resetForm: function(){
      console.log('resetForm');
        this.name = '';
        this.email = '';
        this.country = '';
        this.city = '';
        this.job = '';
        this.id = '';
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

// function updateTogleFormDES(id,name,email,country,city,job){
//       console.log('updateTogleForm new');
//       console.log(id);
//       console.log(name);
//       $("#form").show();
//       $("#btAdd").hide();
//       $("#btCancel").show();
//       $("#btUpdate").show();
//       $("#btConfirm").hide();

//       $("#form_id").val(id);
//       $("#form_name").val(name);
//       $("#form_email").val(email);
//       $("#form_country").val(country);
//       $("#form_city").val(city);
//       $("#form_job").val(job);

//     }

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
