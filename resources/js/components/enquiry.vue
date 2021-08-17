<template>
    <div class="container">
        <!-- comments Form -->
          <div class="d-flex justify-content-between mb-4">
                 <el-button type="primary" round @click.prevent="dialogAddenquiryVisible = true" ><i class="fa fa-plus" aria-hidden="true"></i> Add Enquiry  </el-button>
             </div>

             <el-dialog
                title="New Enquiry"
                :visible.sync="dialogAddenquiryVisible"
                width="60%"
                center
                >
                <span>
                    <el-form   label-width="20%" v-loading="loading">
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
             
                    </el-form>
                </span>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="dialogAddenquiryVisible = false">Cancel</el-button>
                    <el-button type="primary"   @click.prevent="addNewenquiry()">Confirm</el-button>
                </span>
                </el-dialog>

<template>

  <el-tabs v-model="activeName" stretch v-loading="loading_page">
    <el-tab-pane name="first" >

        <span slot="label"> For all Users 
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                        <span class="visually-hidden" style="color:#fff"> {{enquirys.data.length}}</span>
                    </span>
            </span>
          
             <!-- start tabe for get enquery for one user -->
  <div v-if ="enquirys.data.length > 0" >
   
        <div class="card my-4" v-for="enquiry in enquirys.data" :key="enquiry.id">
         

               <h5 class="card-header" style="font-size:14px !important; direction:rtl;" >
                    
                <span style="font-size:12px; display: flex;">  <span class="badge badge-secondary">{{enquiry.created_at | timeFormat}}</span> 
             
                 <span class="badge badge-warning mr-4 " style="font-size:12px;" >{{enquiry.status}} </span>
                  
                <div v-if="enquiry.user_id  == user.auth_Id" style="width:15%;height:15px;margin-right:4px;">
                       <el-select @change="changestatusEnquiry(enquiry.id)" v-model="changestatus" size="mini"  placeholder="status">
                            <el-option
                            v-for="status in status_option"
                            :key="status.value"
                            :label="status.label"
                            :value="status.value">
                            </el-option>
                        </el-select>
                </div>
                  </span>
                             
                   <div  class="mb-2 mt-4" v-if="enquiry.user.photo == null">
                    <span> {{enquiry.user.name}}</span>       <img class="image-show "  width="4%" :src="'/images/users/blank-profile.png'">
                   </div>
                    <div class="mb-2" v-else>
                      <span> {{enquiry.user.name}}</span>    <img class="image-show "  width="4%" :src="'/images/users/'+ enquiry.user.photo">
                   </div>
                   <p style="font-size:15px;   background-color: #e2e2e2; padding:10px; border-radius: 10px 0px;"  >  {{enquiry.title}}</p>
                </h5>
      

             <div class="card-body">
                  <h5  style="margin-left:1%;font-size:14px !important;direction:rtl;" > {{enquiry.body}} </h5>
                  
               <img v-if="enquiry.photo" width="50%"  :src="'/images/enquiry/'+ enquiry.photo"  :alt="enquiry.title">
             </div>


            <div class="card-body">
                <el-form ref="form"  :key="enquiry.id"> 
                    <div  v-if="enquiry.status == 'open'">
                            <el-input  type="textarea" size="small" placeholder="Add Your Comment" v-model="enquiry.newcomment" ></el-input>
                                    <span class="text-danger" v-if="errors['newcomment']">
                                                {{errors['newcomment'][0]}}
                                    </span>
                            <el-button class="mt-2" type="primary" size="small" @click.prevent="addNewComment(enquiry.id,enquiry.newcomment)">Comment</el-button>
                    </div>
                    <div v-else>
                             <el-input  type="textarea" size="small" placeholder="Add Your Comment" v-model="enquiry.newcomment" disabled></el-input>
                                    <span class="text-danger" v-if="errors['newcomment']">
                                                {{errors['newcomment'][0]}}
                                    </span>
                            <el-button class="mt-2" type="primary" size="small" @click.prevent="addNewComment(enquiry.id,enquiry.newcomment)" disabled>Comment</el-button>
                    </div>
                
                </el-form>
                <hr/>
             

              <div v-if="enquiry.comment.length > 0">
               <div class="card-header mt-4 comment" v-for="comment in enquiry.comment" :key="comment.id">
                   <div v-if="comment.photo == null">
                        <img class="image-show "  width="4%" :src="'/images/users/blank-profile.png'">  <span> {{comment.name}}</span>
                   </div>
                    <div v-else>
                        <img class="image-show "  width="4%" :src="'/images/users/'+ comment.photo"> <span> {{comment.name}}</span>
                   </div>
                   <p class="comment" style="direction:rtl;" > {{comment.body}} <br>
                      <span style="font-size:12px;margin-left:80%;"> <span class="badge badge-secondary">{{comment.created_at | timeFormat}}</span></span>
                   </p>
                  
                </div>
                </div>
               
            </div>
        </div>
                    <pagination :data="enquirys" @pagination-change-page="getResults"  :limit="1" :show-disabled='true'>
                        <span slot="prev-nav">&lt; Previous</span>
                        <span slot="next-nav">Next &gt;</span>
                    </pagination>
          </div>
        <div v-else>
            <div class="mt-4 text-center  bg-secondary">
            <span style="font-size:20px"> Don't found any Enquiries</span>
            </div>
        </div>
    </el-tab-pane>
    <el-tab-pane  name="second">
      
           <span slot="label"> For you  
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                        <span class="visually-hidden" style="color:#fff"> {{getenquiryforonedata.data.length}}</span>
                    </span>
            </span>
             <!-- start tabe for get enquery for one user -->

  <div v-if ="getenquiryforonedata.data.length > 0" >
        <div class="card my-4" v-for="enquiry in getenquiryforonedata.data" :key="enquiry.id">
             
               <h5 class="card-header" style="font-size:14px !important; direction:rtl;" >

               <span style="font-size:12px; display: flex;">  <span class="badge badge-secondary">{{enquiry.created_at | timeFormat}}</span> 
             
                 <span class="badge badge-warning mr-4 " style="font-size:12px;" >{{enquiry.status}} </span>
                  
                <div v-if="enquiry.user_id  == user.auth_Id" style="width:15%;height:15px;margin-right:4px;">
                       <el-select @change="changestatusEnquiry(enquiry.id)" v-model="changestatus" size="mini"  placeholder="status">
                            <el-option
                            v-for="status in status_option"
                            :key="status.value"
                            :label="status.label"
                            :value="status.value">
                            </el-option>
                        </el-select>
                </div>
                  </span>             
                   <div  class="mb-2 mt-4" v-if="enquiry.user.photo == null">
                    <span> {{enquiry.user.name}}</span>   <img class="image-show "  width="4%" :src="'/images/users/blank-profile.png'">
                   </div>
                    <div class="mb-2" v-else>
                      <span> {{enquiry.user.name}}</span>    <img class="image-show "  width="4%" :src="'/images/users/'+ enquiry.user.photo">
                   </div>
                   <p style="font-size:15px;   background-color: #e2e2e2; padding:10px; border-radius: 10px 0px;"  >  {{enquiry.title}}</p>
                </h5>
             <div class="card-body">
                  <h5  style="font-size:14px !important;direction:rtl;" > {{enquiry.body}} </h5>
                  
               <img v-if="enquiry.photo"  width="50%"  :src="'/images/enquiry/'+ enquiry.photo"  :alt="enquiry.title">
             </div>


            <div class="card-body">
                 <div  v-if="enquiry.status == 'open'">
                            <el-input  type="textarea" size="small" placeholder="Add Your Comment" v-model="enquiry.newcomment" ></el-input>
                                    <span class="text-danger" v-if="errors['newcomment']">
                                                {{errors['newcomment'][0]}}
                                    </span>
                            <el-button class="mt-2" type="primary" size="small" @click.prevent="addNewComment(enquiry.id,enquiry.newcomment)">Comment</el-button>
                    </div>
                    <div v-else>
                             <el-input  type="textarea" size="small" placeholder="Add Your Comment" v-model="enquiry.newcomment" disabled></el-input>
                                    <span class="text-danger" v-if="errors['newcomment']">
                                                {{errors['newcomment'][0]}}
                                    </span>
                            <el-button class="mt-2" type="primary" size="small" @click.prevent="addNewComment(enquiry.id,enquiry.newcomment)" disabled>Comment</el-button>
                    </div>
                <hr/>
             

              <div v-if="enquiry.comment.length > 0">
               <div class="card-header mt-4 comment" v-for="comment in enquiry.comment" :key="comment.id">
                   <div v-if="comment.photo == null">
                        <img class="image-show"  width="4%" :src="'/images/users/blank-profile.png'">  <span> {{comment.name}}</span>
                   </div>
                    <div v-else>
                        <img class="image-show"  width="4%" :src="'/images/users/'+ comment.photo"> <span> {{comment.name}}</span>
                   </div>
                  <p class="comment" style="direction:rtl;" > {{comment.body}}<br>
                      <span style="font-size:12px;margin-left:80%;"> <span class="badge badge-secondary">{{comment.created_at | timeFormat}}</span></span>
                      </p>
                </div>
                </div>
               
            </div>
        </div>
                    <pagination :data="getenquiryforonedata" @pagination-change-page="getResults2"  :limit="1" :show-disabled='true'>
                        <span slot="prev-nav">&lt; Previous</span>
                        <span slot="next-nav">Next &gt;</span>
                    </pagination>
  </div>
  <div v-else>
      <div class="mt-4 text-center  bg-secondary">
       <span style="font-size:20px">  you Don't have any Enquiries</span>
       </div>
  </div>
  
    </el-tab-pane>
    <el-tab-pane  name="third">
             <span slot="label"> sent  
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                        <span class="visually-hidden" style="color:#fff"> {{getenquirySentdata.data.length}}</span>
                    </span>
            </span>

       <!-- start tabe for get enquery for Sent -->
  <div v-if ="getenquirySentdata.data.length > 0">
        <div class="card my-4" v-for="enquiry in getenquirySentdata.data" :key="enquiry.id">
              
               <h5 class="card-header" style="font-size:14px !important; direction:rtl;" >

              <span style="font-size:12px; display: flex;">  <span class="badge badge-secondary">{{enquiry.created_at | timeFormat}}</span> 
             
                 <span class="badge badge-warning mr-4 " style="font-size:12px;" >{{enquiry.status}} </span>
                  
                <div v-if="enquiry.user_id  == user.auth_Id" style="width:15%;height:15px;margin-right:4px;">
                       <el-select @change="changestatusEnquiry(enquiry.id)" v-model="changestatus" size="mini"  placeholder="status">
                            <el-option
                            v-for="status in status_option"
                            :key="status.value"
                            :label="status.label"
                            :value="status.value">
                            </el-option>
                        </el-select>
                </div>
                  </span>            
                   <div  class="mb-2 mt-4" v-if="enquiry.user.photo == null">
                    <span> {{enquiry.user.name}}</span>       <img class="image-show "  width="4%" :src="'/images/users/blank-profile.png'">
                   </div>
                    <div class="mb-2" v-else>
                      <span> {{enquiry.user.name}}</span>    <img class="image-show "  width="4%" :src="'/images/users/'+ enquiry.user.photo">
                   </div>
                   <p style="font-size:15px;   background-color: #e2e2e2; padding:10px; border-radius: 10px 0px;"  >  {{enquiry.title}}</p>
                </h5>
             <div class="card-body">
                  <h5  style="font-size:14px !important;direction:rtl;" > {{enquiry.body}} </h5>
                  
               <img v-if="enquiry.photo"  width="50%"  :src="'/images/enquiry/'+ enquiry.photo"  :alt="enquiry.title">
             </div>


            <div class="card-body">
                <el-form ref="form"  :key="enquiry.id"> 
                  <div  v-if="enquiry.status == 'open'">
                            <el-input  type="textarea" size="small" placeholder="Add Your Comment" v-model="enquiry.newcomment" ></el-input>
                                    <span class="text-danger" v-if="errors['newcomment']">
                                                {{errors['newcomment'][0]}}
                                    </span>
                            <el-button class="mt-2" type="primary" size="small" @click.prevent="addNewComment(enquiry.id,enquiry.newcomment)">Comment</el-button>
                    </div>
                    <div v-else>
                             <el-input  type="textarea" size="small" placeholder="Add Your Comment" v-model="enquiry.newcomment" disabled></el-input>
                                    <span class="text-danger" v-if="errors['newcomment']">
                                                {{errors['newcomment'][0]}}
                                    </span>
                            <el-button class="mt-2" type="primary" size="small" @click.prevent="addNewComment(enquiry.id,enquiry.newcomment)" disabled>Comment</el-button>
                    </div>
                </el-form>
                <hr/>
             

              <div v-if="enquiry.comment.length > 0">
               <div class="card-header mt-4 comment" v-for="comment in enquiry.comment" :key="comment.id">
                   <div v-if="comment.photo == null">
                        <img class="image-show"  width="4%" :src="'/images/users/blank-profile.png'">  <span> {{comment.name}}</span>
                   </div>
                    <div v-else>
                        <img class="image-show"  width="4%" :src="'/images/users/'+ comment.photo"> <span> {{comment.name}}</span>
                   </div>
                  <p class="comment" style="direction:rtl;"> {{comment.body}}<br>
                      <span style="font-size:12px;margin-left:80%;"> <span class="badge badge-secondary">{{comment.created_at | timeFormat}}</span></span>
                      </p>
                </div>
                </div>
               
            </div>
        </div>
                    <pagination :data="getenquirySentdata" @pagination-change-page="getResults3"  :limit="1" :show-disabled='true'>
                        <span slot="prev-nav">&lt; Previous</span>
                        <span slot="next-nav">Next &gt;</span>
                    </pagination>
  </div>
  <div v-else>
      <div class="mt-4 text-center  bg-secondary">
       <span style="font-size:20px"> you Don't Send any Enquiries</span>
       </div>
  </div>
    </el-tab-pane>
  </el-tabs>
</template>

                
    </div>
</template>


<script>
export default {
  
    data(){
        return{
            form:{},
            errors:{},
            comment:{},
            enquirys:[],
            getenquiryforonedata:[],
            getenquirySentdata:[],
            allComments:[],
            dialogAddenquiryVisible: false,
             users:{},
             user:{},
             activeName: 'first',
            status_option: [{
                    value: 'satisfied',
                    label: 'Satisfied'
                    }, {
                    value: 'not satisfied',
                    label: 'Not Satisfied'
                    }, ],
            changestatus:'',
             loading: false,
             loading_page:true,
        }
    },
    methods:{
     
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
        addNewenquiry(){
             axios.post('/dashboard/enquiry', this.form).then(res => {
                  this.loading = true;
                  this.clearData();
              this.$notify({
                    title: 'Success',
                    message: 'Your Enquiry Send',
                    type: 'success'
                    });
                 this.getenquiry();
                this.getenquiryforone();
                this.getenquirySent();
                    }
                ).catch(err => this.errors = err.response.data.errors);
        },
      
        getenquiry(){
              axios.get('/getenquiry').then(res =>  { 
                    this.loading_page = false;
                // console.log(res.data.data);
                this.enquirys = res.data;
               
              })
             .catch(err => { console.log(err)});
        },
        getenquiryforone(){
            axios.get('/getenquiryforone').then(res =>  { 
              
            this.getenquiryforonedata = res.data;
            
            })
            .catch(err => { console.log(err)});
        },
        getenquirySent(){
            axios.get('/getenquirySent').then(res =>  { 
              
            this.getenquirySentdata = res.data;
            })
            .catch(err => { console.log(err)});
        },

        getResults(page = 1) {
        axios.get('/getenquiry?page=' + page)
            .then(response => {
                this.enquirys = response.data;
            });
        },
          getResults2(page = 1) {
        axios.get('/getenquiryforonedata?page=' + page)
            .then(response => {
                this.getenquiryforonedata = response.data;
            });
        },

     getResults3(page = 1) {
        axios.get('/getenquirySent?page=' + page)
            .then(response => {
                this.getenquirySentdata = response.data;
            });
        },

    addNewComment(enquiryid,comment){
          axios.post('/comment', {comment,enquiryid}).then(res => {
                       this.$notify({
                            title: 'Success',
                            message: 'Your Comment Send',
                            type: 'success'
                            });
                        this.comment = {}
                        this.getenquiry();
                        this.getenquiryforone();
                        this.getenquirySent();
                    }).catch(err => this.errors = err.response.data.errors);
        }, 
        checkUser(){
            axios.get('user').then(res => {
                        this.user = res.data;    console.log( this.user.auth_Id );
                }).catch(err => {
                    console.log(err);
                });
        },
        showComments(enquiryid){
          axios.post('/showComment', {enquiryid}).then(res => {
                    this.allCommentsenquiryid = res.data; 
                    }).catch(err => this.errors = err.response.data.errors);
        },

     
            loadUsers(){
                 axios.get('/api/users').then(res => {
                    
                        this.users = res.data;
                  
                }).catch(err => {
                    console.log(err);
                });
            },

        changestatusEnquiry(enquiryid){
             let {changestatus} = this;
                axios.post(`/changestatus/${enquiryid}`, {changestatus}).then(res => {
                      this.$notify({
                            title: 'Success',
                            message: 'updated Successfully',
                            type: 'success'
                            });
                             this.getenquiry();
                            this.getenquiryforone();
                            this.getenquirySent();
                    this.status = res.data; 
                    }).catch(err => this.errors = err.response.data.errors);
            },

        clearData(){
          this.dialogAddenquiryVisible = false
          this.form = {}
        }
    },
    created(){
         this.getenquiry();
         this.loadUsers();
         this.getenquiryforone();
         this.getenquirySent();
         this.checkUser();
    }
}
</script>