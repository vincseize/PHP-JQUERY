<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP| MySQL | Vue.js | Axios Example</title>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>

<h1>Administration Contacts</h1>
<div id='vueapp'>

  <table border='1' width='100%' style='border-collapse: collapse;'>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Country</th>
      <th>City</th>
      <th>Job</th>
      <th>Update</th>
      <th>Delete</th>
    </tr>
    <tr v-for='contact in contacts'>
      <td>{{ contact.name }}</td>
      <td>{{ contact.email }}</td>
      <td>{{ contact.country }}</td>
      <td>{{ contact.city }}</td>
      <td>{{ contact.job }}</td>
      <td><input type="button" @click="updateContact(contact.id)" value="update"></td>
      <td><input type="button" @click="deleteContact(contact.id)" value="x"></td>
    </tr>
  </table>

  </br>

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
    </br>
    <input type="button" @click="createContact()" value="Add">
  </form>

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
    deleteContact: function(id){
        console.log("Delete");
        axios.post('api/contacts.php', {
          data : {delete: id},
          }) .then(function (response) {
            //handle success

            // app.resetForm();

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

</div>


</body>
</html>
