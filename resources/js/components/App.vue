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
                loader: '1',
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
            this.getLocalData()
        },
        methods:{
            searchData: function(country){
                this.loader = '1';
                if(country != ''){
                    axios.get(`http://universities.hipolabs.com/search?country=${country}`)
                    .then((res) => {
                        this.loader = '0';
                        this.tableData = res.data;
                        axios.post('/country', res.data)
                        .then((res)=>{
                            setTimeout(()=>{
                                this.getLocalData();
                            }, 100000);
                            console.log(res.data)
                        })
                        .catch((err) => {
                            console.log(err)
                        })
                    })
                    .catch((err) => {
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
