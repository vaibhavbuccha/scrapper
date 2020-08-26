<template>
    <div class="">
        <div class="jumbotron " >
            <div class="col-sm-6 offset-3 d-flex">
                <input type="text" v-model="country" class="form-control col-sm-10" placeholder="Enter country name" >
                <button class="btn btn-primary" @click="searchData(country)" >Search</button>
            </div>
        </div>
        <div class="col-sm-12">
            <table class="table" >
                <thead>
                    <th>Name</th>
                    <th>state</th>
                    <th>country</th>
                    <th>domain</th>
                </thead>
                <tbody v-for="u of universities"  :key="u.name" >
                    <tr>
                        <td>{{u.name}}</td>
                        <td>{{u.name}}</td>
                        <td>{{u.country}}</td>
                        <td>{{u.web_pages[0]}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                country:'india',
                universities: []
            }
        },
        created() {
            // axios.get('http://universities.hipolabs.com/search?country=japan')
            // .then((res) => {
            //     this.universities = res.data;
            // })
            // .catch((err) => {
            //     console.log('error',err);
            // })
        },
        methods:{
            searchData: function(country){
                // var self = this;
                axios.get(`http://universities.hipolabs.com/search?country=${country}`)
                .then((res) => {
                    this.universities = res.data;
                    alert('working');
                })
                .catch((err) => {
                    console.log('error',err);
                });
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
