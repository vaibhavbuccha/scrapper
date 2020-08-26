<template>
    <div class="">
        <div v-if="loader == '1'" class="busy"></div>
        <div class="jumbotron " >
            <div class="col-sm-6 offset-3 d-flex">
                <input type="text" v-model="country" class="form-control col-sm-10" placeholder="Enter country name" >
                <button class="btn btn-primary" @click="searchData(country)" >Search</button>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="">
                <v-client-table :data="tableData" :columns="columns" :options="options"/>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                country:'',
                loader: '0',
                columns: ['name', 'state-province', 'country' , 'web_pages'],
                tableData: [],
                options: {
                    headings: {
                        name: 'University Name',
                        'state-province': 'State',
                        web_pages: 'Website'
                    },
                editableColumns:['name'],
                sortable: ['name', 'state-province','country'],
                filterable: ['name', 'state-province','country'],
                theme : 'bootstrap3'
                }
            }
        },
        created() {
            // this.getLocalData()
        },
        methods:{
            searchData: function(country){
                if(country != ''){
                    this.loader = '1';
                    axios.get(`/api/search?countryname=${country}`)
                    .then((res) => {
                        this.loader = '0';
                        this.tableData = res.data;
                        // console.log(res.data);
                    })
                    .catch((err) => {
                        this.loader = '0';
                        console.log('error',err);
                    });
                }
            },
            getLocalData: function(){
                axios.get('/country')
                .then((res) => {
                    this.tableData = res.data;
                    this.loader = '0';
                })
                .catch((err) => {
                    console.log('error',err);
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
