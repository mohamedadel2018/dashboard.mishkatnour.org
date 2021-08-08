<template>
    <div class="container">

     <div class="d-flex justify-content-between mb-4">
         <p  style="font-size:15px;"> Edit all Enquiries </p>
     </div>

        <div class="card-header border-0">

             <el-select @change="searchstatusEnquiry()" v-model="changestatus" size="mini"  placeholder="search">
                <el-option
                    v-for="status in status_option"
                    :key="status.value"
                    :label="status.label"
                    :value="status.value">
                    </el-option>
                </el-select>

        </div>
            <el-table
                ref="multipleTable"
                :data="allenquirys.data.filter(data => !search || data.title.toLowerCase().includes(search.toLowerCase()))"
                style="width: 100%"
                height="450"
                border
                size="mini">
                <el-table-column
                label="Date" width="170px" >
                <template  slot-scope="scope"> {{scope.row.created_at | timeFormat}} </template>
                </el-table-column>
                <el-table-column
                label="Title"
                prop="title">
                </el-table-column>
                 <el-table-column
                label="enquiry Dec"
                prop="body" width="190">
            <template  slot-scope="scope"> <div style="direction:rtl;">  {{scope.row.body}} </div></template>
                </el-table-column>
                <el-table-column
                label="photo"
                prop="photo">
                 <template slot-scope="scope">
                  
                     <div v-if="scope.row.photo != null">
                          <img width="70%" :src="'/images/enquiry/' +scope.row.photo"/>
                    </div>
                    <div v-else>
                           no photo
                    </div>
                </template>
                </el-table-column>

                 <el-table-column
                label="Status" width="80">
                 <template  slot-scope="scope">
                
                 <p style="font-size:10px;"> {{scope.row.status}}</p>
                

                </template>
                </el-table-column>

                <el-table-column
                label="From">
                 <template  slot-scope="scope">
                 <p style="font-size:10px;"> {{scope.row.user.name }}</p>
                </template>
                </el-table-column>

                 <el-table-column
                label="To">
                 <template  slot-scope="scope">
                    <p style="font-size:10px;"> {{editfor(scope.row.for, scope.row.for_id )}}</p>
                </template>
                </el-table-column>
              
                <el-table-column
                align="right" 
                width="130px"
                >
                <template slot="header" slot-scope="scope">
                    <el-input
                    v-model="search"
                    placeholder="Type to search"/>
                 {{scope.row}}
                </template>

                <!-- startedit -->
               <template slot-scope="scope">

                         <el-button    @click.prevent="editEnquiry(scope.row)"  icon="el-icon-edit" circle></el-button>
                            <el-dialog
                                    title="Edit Enquiry"
                                    :visible.sync="editEnquiryVisible"
                                    width="50%"
                                    center>
                                    <span>
                     <el-form label-width="20%" @submit.prevent="addNewEnquiry">
                       <el-form-item label="Enquiry title*" center>
                        <el-input placeholder="Add Your title" v-model="form.title"></el-input>
                            <span class="text-danger" v-if="errors['title']">
                                {{errors['title'][0]}}
                            </span>
                        </el-form-item>
                    <el-form-item label="Enquiry Body*" center>
                        <el-input type="textarea" placeholder="Add Your Description" v-model="form.body"></el-input>
                            <span class="text-danger" v-if="errors['body']">
                                {{errors['body'][0]}}
                            </span>
                    </el-form-item>
                   <el-form-item label="photo">
                            <input type="file" @change="processFile($event)" multiple>
                            <span class="text-danger" v-if="errors['photo']">
                                {{errors['photo'][0]}}
                            </span>
                    </el-form-item>
                      <el-form-item label="For (option)">
                           <el-select v-model="form.for" placeholder="Select" multiple>
                                    <el-option
                                    v-for="user in users.data"
                                    :key="user.id"
                                    :label="user.name"
                                    :value="user.id">
                                     <span class="text-danger" v-if="errors['for']">
                                      {{errors['for'][0]}}
                            </span>
                                    </el-option>
                                </el-select>
                                   <h6 style="color:red;"> if you not selected One you will send enquiry for (all Users) </h6>
                    </el-form-item>

                    <el-form-item label="status">
                        <el-select  v-model="form.status"  placeholder="search">
                            <el-option
                                v-for="status in status_option"
                                :key="status.value"
                                :label="status.label"
                                :value="status.value">
                            </el-option>
                            </el-select>
                    </el-form-item>

                    </el-form>
                                    </span>
                                    <span slot="footer" class="dialog-footer">
                                        <el-button @click="editEnquiryVisible = false">Cancel</el-button>
                                        <el-button type="primary"  @click.prevent="updateEnquiry(form.id)">Save</el-button>
                                    </span>
                                    </el-dialog>
                    <el-button
                    type="danger"
                    
                    @click="deleteEnquiry(scope.row)" icon="el-icon-delete" circle></el-button>

                     <el-dialog
                            title="Delete Enquiry"
                            :visible.sync="deleteEnquiryVisible"
                            width="40%" center>
                            <span>
                                <h4 class="text-center"> Are you Sure You Wand Delete this Enquiry</h4>
                            </span>
                                <span slot="footer" class="dialog-footer">
                                <el-button @click="clearData()">Cancel</el-button>
                                <el-button type="danger"  @click.prevent="deleteEnquiry(scope.row)">Delete</el-button>
                          
                            </span>
                     </el-dialog>
                </template>
                </el-table-column>
        </el-table>
                <ul class="mb-4 mt-4">
                    <pagination :data="allenquirys" @pagination-change-page="getResults"  :limit="1" :show-disabled='true'>
                        <span slot="prev-nav">&lt; Previous</span>
                        <span slot="next-nav">Next &gt;</span>
                    </pagination>
                </ul>
    </div>

</template>



<script>
  export default {
    data() {
      return {
        OrdersData: [],
        search: '',
        dialogVisible: false,
        deleteEnquiryVisible: false,
        editEnquiryVisible: false,
        errors:{},
        allenquirys:[],
         form:{},
         users:{},
        status_option: [ 
            {
            value: 'all',
            label: 'all'
            },{
            value: 'open',
            label: 'Open'
            },{
            value: 'satisfied',
            label: 'Satisfied'
            }, {
            value: 'not satisfied',
            label: 'Not Satisfied'
            }, ],
      }
    },
    methods: {

         getenquiry(){
              axios.get('/getallenquiry').then(res =>  { 
           
                this.allenquirys = res.data;     console.log(res.data.data);
               
              })
             .catch(err => { console.log(err)});
        },

     processFile(event) {
        let file = event.target.files[0]
        let reader = new FileReader();
            if(file['size'] < 3111775)
            {
                reader.onloadend = (file) => {
                // console.log('RESULT', reader.result)
                    this.form.photo = reader.result;
                }
                    reader.readAsDataURL(file);
            }else{
                alert('File size can not be bigger than 3 MB')
            }
        },
        editfor(namefor,forid){
            if(forid == null){
                return 'All Users'
            }else{
                return namefor.name;
            }
        },
        deleteEnquiry(row){

             this.$confirm('Are you Sure You Wand Delete this Enquiry', 'Warning', {
          confirmButtonText: 'OK',
          cancelButtonText: 'Cancel',
          type: 'warning'
        }).then(() => {
         
            axios.delete(`allenquiry/${row.id}`).then(res => {
                  
                         this.$notify({
                            title: 'Success',
                            message: 'Enquiry Deleted Successfully',
                            type: 'success'
                            });
                    this.getenquiry();
                    this.clearData();
                    }).catch(err => console.log(err));
          
        }).catch(() => {
          this.$message({
            type: 'info',
            message: 'Delete canceled'
          });          
        });
             
         },
        clearData(){
            this.errors = {}
             this.form = {}
             this.deleteEnquiryVisible = false
            this.editEnquiryVisible = false
         
        },
      
       editEnquiry(row) {
          this.editEnquiryVisible = true
          this.form = row;

        },
         updateEnquiry(row){
             axios.put(`allenquiry/${row}`, this.form ).then(res => {
               this.$notify({
                            title: 'Success',
                            message: 'Enquiry updated Successfully',
                            type: 'success'
                            });
                            this.clearData();
                            this.getenquiry();
                    }
                ).catch(err => this.errors = err.response.data.errors);
        },
       getResults(page = 1) {
			axios.get('getallenquiry?page=' + page)
				.then(response => {
					this.allenquirys  = response.data;
				});
        },
         loadUsers(){
                 axios.get('/api/users').then(res => {
                    
                        this.users = res.data;
                  
                }).catch(err => {
                    console.log(err);
                });
            },
        searchstatusEnquiry(){
             let {changestatus} = this;
                axios.post(`/searchstatus`, {changestatus}).then(res => {
                            
                    this.allenquirys = res.data; 
                    }).catch(err => this.errors = err.response.data.errors);
            },
    },
    created(){
      this.getenquiry();
      this.loadUsers();
    }
  }
</script>