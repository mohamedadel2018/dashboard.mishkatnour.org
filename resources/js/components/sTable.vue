<template>
    <div>
        <!-- status approval filter  -->
        <div class="row">
            <div class="col-md-11 ml-1">
                <div class="row">
                    <div class="col-md-3 mt-4 ">
                        <label>TYPE : </label>
                        <div class="btn-group" data-toggle="buttons">
                            <select class="form-control" v-model="typeFilter">
                                <option >All</option>
                                <option >POST</option>
                                <option >VIDEO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 mt-4 ">
                        <label>PROGRAM TYPE: </label>
                        <div class="btn-group" data-toggle="buttons">
                            <select class="form-control" v-model="progTypeFilter">
                                <option >All</option>
                                <option>shtara</option>
                                <option>Beot mastora</option>
                                <option>bosla</option>
                                <option>3ndi suaal</option>
                                <option>Community police</option>
                                <option>qloab mastora</option>
                                
                            </select>
                           
                        </div>
                    </div>
                    <div class="col-md-3 mt-4 ">
                        <label>INTSRT: </label>
                        <div class="btn-group" data-toggle="buttons">
                            <select class="form-control" v-model="intrstFilter">
                                <option>All</option>
                                <option>shtara course</option>
                                <option>shtara event</option>
                                <option>shtara store</option>
                                <option>Donation</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 mt-4 ">
                        <label>ORGANIC OR SPONSOR: </label>
                        <div class="btn-group" data-toggle="buttons">
                            <select class="form-control" v-model="SoOFilter">
                                <option>All</option>
                                <option>ORGANIC</option>
                                <option>SPONSOR</option>
                            </select>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
        <!-- end status approval filter -->

  

        <!-- status approval filter  -->
        <div class="row">
            <div class="col-md-11 ml-1">
                <div class="row">
                    <div class="col-md-4 mt-4 ">
                        <label>Above Age : </label>
                        <div class="btn-group" data-toggle="buttons">
                            <input class="form-control" type="number" v-model="ageFilter">
                        </div>
                    </div>
                    <div class="col-md-4 mt-4 ">
                        <label>Gender: </label>
                        <div class="btn-group" data-toggle="buttons">
                            <select class="form-control" v-model="genderFilter">
                                <option>None</option>
                                <option>all</option>
                                <option>male</option>
                                <option>female</option>
                               
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 mt-4 ">
                        <label>Location : </label>
                        <div class="btn-group" data-toggle="buttons">
                            <input class="form-control" type="text" v-model="locationFilter">
                        </div>
                    </div>
                   
                    
                </div>
            </div>
        </div>
        <!-- end status approval filter -->
        <div class="row mt-4">
            <div class="col-md-8 offset-md-2">
                <div class="row">
                    <div class="col-md-4">
                        <label>From: </label>
                        <div class="btn-group" data-toggle="buttons">
                             <input type="number" class="form-control" v-model="fMonthFilter" placeholder="Month" >
                             <input type="number" class="form-control" v-model="fYearFilter"  placeholder="Year">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>To: </label>
                         <div class="btn-group" data-toggle="buttons">
                             <input type="number" class="form-control" v-model="tMonthFilter"placeholder="Month" >
                             <input type="number" class="form-control" v-model="tYearFilter"  placeholder="Year" >
                        </div>
                    </div>
                </div>
                    
            </div>
            
        </div>

        <!-- social card -->
        <div class="row mt-4">
            <!-- youtube -->
            <div class="col-md-6 mt-4" >
                <div class="card" style="background-color: yellow" scope="col">
                  <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                             <i class="fa fa-youtube fa-3x" aria-hidden="true"></i> {{stat['yCheck']}}
                        </div>
                        <div class="col-md-10">
                            <div class="row">

                                <div class="col-md-4"> <b>AMOUNT PAID : {{stat['yPaid']}} </b></div>
                                <div class="col-md-4"><b> REACH : {{stat['yReach']}}</b> </div>
                                <div class="col-md-4"><b>VIEWS : {{stat['yViews']}} </b></div>
                                <div class="col-md-4"><b>Subscriptions: {{stat['ySubs']}} </b></div>
                                <div class="col-md-4"><b>LIKES : {{stat['yLikes']}}</b></div>
                            </div>
                             
                        </div>
                        
                    </div>
                  </div>
              </div>
            </div>
            <!-- FACEBOOK -->
             <div class="col-md-6 mt-4">
                <div class="card"  style="background-color: #8bc34acc">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-2">
                             <i class="fa fa-facebook fa-3x" aria-hidden="true"></i> {{stat['fCheck']}}
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-4">
                                    <b>AMOUNT PAID : {{stat['fPaid']}} </b>
                                 </div>
                                <div class="col-md-4">
                                    <b> REACH :{{stat['fReach']}} </b> 
                                </div>
                                <div class="col-md-4">
                                    <b>ENGAGEMENT : {{stat['fEngagement']}} </b>
                                </div>
                                <div class="col-md-4">
                                    <b>comments: {{stat['fComment']}}</b >
                                </div>
                                <div class="col-md-4">
                                    <b>LIKES : {{stat['fLikes']}}</b>
                                </div>
                                <div class="col-md-4">
                                    <b>SHARE : {{stat['fShare']}}</b>
                                </div>
                            </div>
                             
                        </div>
                        
                    </div>
                  </div>
              </div>
            </div>
            <!-- INSTGRAM -->
             <div class="col-md-6 mt-4">
                <div class="card" style="background-color: #debce4">
                  <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                             <i class="fa fa-instagram fa-3x" aria-hidden="true"></i> {{stat['iCheck']}}
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                               <div class="col-md-4">
                                    <b>AMOUNT PAID : {{stat['iPaid']}} </b>
                                 </div>
                                <div class="col-md-4">
                                    <b> REACH :{{stat['iReach']}} </b> 
                                </div>
                                <div class="col-md-4">
                                    <b>ENGAGEMENT : {{stat['iEngagement']}} </b>
                                </div>
                                <div class="col-md-4">
                                    <b>comments: {{stat['iComment']}}</b >
                                </div>
                                <div class="col-md-4">
                                    <b>LIKES : {{stat['iLikes']}}</b>
                                </div>
                                <div class="col-md-4">
                                    <b>SHARE : {{stat['iShare']}}</b>
                                </div>
                                
                            </div>
                             
                        </div>
                    </div>
                  </div>
              </div>
            </div>
            <!-- TWITTER -->
             <div class="col-md-6 mt-4">
                <div class="card" style="background-color: #7d7db5">
                  <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                             <i class="fa fa-twitter fa-3x" aria-hidden="true"></i>{{stat['tCheck']}}
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                               <div class="col-md-4">
                                    <b>AMOUNT PAID : {{stat['tPaid']}} </b>
                                 </div>
                                <div class="col-md-4">
                                    <b> REACH :{{stat['tReach']}} </b> 
                                </div>
                                <div class="col-md-4">
                                    <b>ENGAGEMENT : {{stat['tEngagement']}} </b>
                                </div>
                                <div class="col-md-4">
                                    <b>comments: {{stat['tComment']}}</b >
                                </div>
                                <div class="col-md-4">
                                    <b>LIKES : {{stat['tLikes']}}</b>
                                </div>
                               
                                <div class="col-md-4">
                                    <b>retweet :{{stat['tRetweet']}} </b>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
              </div>
            </div>
            
        </div>
        <!-- end social card -->
  


        <!-- main table -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div style="overflow-x:auto; overflow-y: auto;
                  height:700px;">
                      <table class="table table-bordered table-fixed">
                            <thead >
                                <tr class="text-center">
                                    <th colspan="10" style="background-color: grey"></th>
                                    <th colspan="6" style="background-color: yellow">YOUTUBE</th>
                                    <th colspan="7" style="background-color: #8bc34acc">FACEBOOK</th>
                                    <th colspan="7" style="background-color: #debce4">INSTGRAM</th>
                                    <th colspan="7" style="background-color: #7d7db5">TWITTER</th>
                                    
                                 </tr>
                               <tr>
                                 <th scope="col">DATE</th>
                                 <th scope="col">TYPE</th>
                                 <th scope="col">PROGRAME TYPE</th>              
                                 <th scope="col">CONTENT</th>
                                 <th scope="col">PHOTO/VIDEO</th>
                                 <th scope="col">ORGANIC OR SPONSERED</th>
                                 <th scope="col">SEGMENTATION</th>
                                 <th scope="col">MORE INTRST.</th>
                                 <th scope="col">campaign objective</th>
                                 <th scope="col">Duration</th>
                                 <!-- YOUTUBE -->
                                 <th style="background-color: yellow" scope="col">YOUTUBE</th>
                                 <th scope="col">AMOUNT PAID </th>
                                 <th scope="col">REACH</th>
                                 <th scope="col">VIEWS</th>
                                 <th scope="col">Subscriptions</th>
                                 <th scope="col">LIKES</th>
                                 <!-- FACEBOOK -->
                                 <th style="background-color: #8bc34acc" scope="col">FACEBOOK</th>
                                 <th scope="col">AMOUNT PAID</th>
                                 <th scope="col">REACH</th>
                                 <th scope="col">ENGAGEMENT</th>
                                 <th scope="col">comments</th>
                                 <th scope="col">LIKES</th>
                                 <th scope="col">SHARE</th>
                                 <!-- INSTGRAM -->
                                 <th style="background-color: #debce4" scope="col">INSTGRAM</th>
                                 <th scope="col">AMOUNT PAID</th>
                                 <th scope="col">REACH</th>
                                 <th scope="col">ENGAGEMENT</th>
                                 <th scope="col">LIKES</th>
                                 <th scope="col">comments</th>
                                 <th scope="col">SHARE</th>
                                <!-- TWITTER -->
                                 <th style="background-color: #7d7db5" scope="col">TWITTER</th>
                                 <th scope="col">AMOUNT PAID</th>
                                 <th scope="col">REACH</th>
                                 <th scope="col">ENGAGEMENT</th>
                                 <th scope="col">comments</th>
                                 <th scope="col">LIKES</th>
                                 <th scope="col">retweet</th>

                                
                               </tr>
                            </thead>
                            <tbody>

                                <tr v-for="row in filter" :key="row['id']" >
                                
                                   
                                    <!-- main -->
                                    <td> {{row['date']}}-{{row['year']}} </td>
                                    <!-- type -->
                                    <td>{{row['type']}} </td>
                                    <!-- program type -->
                                    <td>
                                      <p> {{row['progType']}}  </p>
                                      <small v-if="row['progType']== 'shtara'">course-store-event-kids station</small>
                                    </td>
                                    <!-- content -->
                                    <td style="max-width: 300px ; overflow: hidden" @click="showText(row['content'])"> 
                                      {{row['content']}}
                                    </td>
                                    <!-- photo/video -->
                                    <td>{{row['PorV']}}<small v-if="row['path']">-</small>{{row['path']}} </td>
                                    <!-- organic / sponseres -->
                                   <td>{{row['OorS']}} </td>
                                     <!-- segmentation -->
                                    <td>
                                      <p v-if="row['age']">Age : {{row['age']}}</p>
                                      <p v-if="row['gender']">Gender : {{row['gender']}}</p>
                                      <p v-if="row['location']">Location : {{row['location']}}</p>
                                     
                                     </td>
                                    <td>
                                        <p> <b> {{row['intrst']}}  </b></p>
                                        <small style="word-wrap:break-word;" v-if="row['intrst'] == 'shtara course'">

                                          Designer clothing , Drawing , Acoustic guitar , <br>
                                           Creativity , Guitar Center , Oil painting , Watercolor painting , <br>
                                            Musical theatre , Drawing , Guitar , Painting , Fine art , <br>
                                            Fashion design, Handmade, Sewing,Pattern (sewing), Handicraft, Art jewelry , Handmade jewelry 
                                        </small>
                                        <small v-if="row['intrst'] == 'shtara store'">
                                          Handicraft , Art jewelry, Handmade , Handmade jewelry , Do it yourself (DIY)  <br>
                                          Designer clothing,Fashion design,Drawing ,Painting , Sewing,Pattern (sewing), 
                                        </small>
                                        <small v-if="row['intrst'] == 'shtara event'">
                                          Designer clothing , Drawing , Acoustic guitar , Creativity ,<br>
                                           Guitar Center , Oil painting , Watercolor painting , Musical theatre ,<br>
                                            Drawing , Guitar , Painting , Fine art , Fashion design, Handmade, Sewing, <br>
                                            Pattern (sewing), Handicraft, Art jewelry , Handmade jewelry
                                        </small>
                                        <small v-if="row['intrst'] == 'Donation'">
                                          Misr El Kheir Foundation - مؤسسة مصر الخير‎, Non-profit organisation‎, <br>
                                           Feed the Children, Charitable organisation, Children in Need, Save the Children, <br>
                                            UNICEF, Charity,  Donation, ‎ Save the Children International, ‎Mountain View,<br> 
                                             ‎‎Resala Charity Organization - جمعية رسالة للاعمال الخيرية‎, ‎مؤسسة مستشفى سرطان الاطفال 57357‎‎‎‎‎‎‎ , <br>Humanitarianism , Community issues , Fundraising , Foundation (non-profit) , UNICEF, Social change or Charity
                                        </small>
                                    </td>
                                    <td>{{row['objective']}} </td>
                                    <td>{{row['duration']}} </td>
                                    <!-- end main -->
                                        <!-- youtuve -->
                                    <td style="background-color: yellow" class="text-center">
                                        <i class="fa fa-check" v-if="row['yCheck']"></i>
                                    </td>
                                    <td>{{row['yPaid']}} </td>
                                    <td>{{row['yReach']}} </td>
                                    <td>{{row['yViews']}} </td>
                                    <td>{{row['ySubs']}} </td>
                                    <td>{{row['yLikes']}} </td>
                                    <!-- end youtube -->

                                    <!-- facebook -->
                                    <td style="background-color: #8bc34acc" class="text-center">
                                     <i class="fa fa-check" v-if="row['fCheck']"></i>
                                    </td>
                                    <td>{{row['fPaid']}} </td>
                                    <td>{{row['fReach']}} </td>
                                    <td>{{row['fEngagement']}} </td>
                                    <td>{{row['fComment']}} </td>
                                    <td>{{row['fLikes']}} </td>
                                    <td>{{row['fShare']}} </td>
                                    <!-- end facebook -->

                                    <!-- instgram -->
                                    <td style="background-color: #debce4 " class="text-center">
                                       <i class="fa fa-check" v-if="row['iCheck']"></i>
                                    </td>
                                    <td>{{row['iPaid']}} </td>
                                    <td>{{row['iReach']}} </td>
                                    <td>{{row['iEngagement']}} </td>
                                    <td>{{row['iLikes']}} </td>
                                    <td>{{row['iComment']}} </td>
                                    <td>{{row['iShare']}} </td>
                                    <!-- end instgram -->
                                         <!-- twitter -->
                                    <td style="background-color: #7d7db5" class="text-center">
                                       <i class="fa fa-check" v-if="row['tCheck']"></i>
                                    </td>
                                    <td>{{row['tPaid']}} </td>
                                    <td>{{row['tReach']}} </td>
                                    <td>{{row['tEngagement']}} </td>
                                    <td>{{row['tComment']}} </td>
                                    <td>{{row['tLikes']}} </td>
                                    <td>{{row['tRetweet']}} </td>
                                    <!-- end twitter -->

                                  
                                </tr>
                            </tbody>
                      </table>
                  </div>
              </div>
          </div>



        <!-- end main tabe -->
       
      
      
       
    </div> 
</template>

<script>
   
    export default {

        data() {

            return {
                rows: [],
                 stat: {
                    yCheck:'' ,
                    yPaid:'' , 
                    yReach:'' , 
                    yViews:'' , 
                    ySubs:'' , 
                    yLikes:'' , 
                    fCheck:'' ,
                    fPaid:'' , 
                    fReach:'' , 
                    fEngagement:'' , 
                    fComment:'' , 
                    fLikes:'' , 
                    fShare:'' ,
                    iCheck:'' , 
                    iPaid:'' , 
                    iReach:'' , 
                    iEngagement:'' , 
                    iComment:'' , 
                    iLikes:'' , 
                    iShare:'' ,
                    tCheck:'' , 
                    tPaid:'' , 
                    tReach:'' , 
                    tEngagement:'' , 
                    tComment:'' , 
                    tLikes:'' , 
                    tRetweet:'' , 
       
                },
                fMonthFilter:'1',
                fYearFilter:'2021',
                tMonthFilter:'12',
                tYearFilter:'2021',
                typeFilter :'All',
                progTypeFilter :'All',
                intrstFilter :'All',
                SoOFilter :'All',
                ageFilter :'',
                genderFilter :'None',
                locationFilter :'',


            };
        },
        computed: {

            filter() {
               
               var  $rows =  this.filterByType(
                        this.filterByProgType(
                            this.filterByIntsrt(
                                this.filterBySoOFilter(
                                    this.filterByAge(
                                        this.filterByGender(
                                            this.filterByLocation(
                                                this.filterByLocation(
                                                    this.filterByMonth(
                                                        this.filterByYear(
                                                            this.rows
                                            ))))))))));
                
              
               this.statistics($rows );
                return $rows;
            },

                              
           
                              
 
            
        },
        
        created() {
            this.loadRows();
        },
        mounted() {
            
        },
        methods: {
            test(){
                var sum = this.filter.reduce((acc, item) => acc + item.tLikes, 0);
                console.log(sum)
            },
           

            filterByType(rows) {
               
                if (this.typeFilter == "All") return rows
                return rows.filter(el => el.type == this.typeFilter)
            },
            filterByProgType(rows) {

                if (this.progTypeFilter == "All") return rows
                return rows.filter(el => el.progType == this.progTypeFilter)
            },
            filterByIntsrt(rows) {

                if (this.intrstFilter == "All") return rows
                return rows.filter(el => el.intrst == this.intrstFilter)
            },
            filterBySoOFilter(rows) {

                if (this.SoOFilter == "All") return rows
                return rows.filter(el => el.OorS == this.SoOFilter)
            },
            filterByAge(rows) {

                if (this.ageFilter == "") return rows
                return rows.filter(el => el.age >= this.ageFilter)
            },
            filterByGender(rows) {

                if (this.genderFilter == "None") return rows
                return rows.filter(el => el.gender == this.genderFilter)
            },
            filterByLocation(rows) {

                if (this.locationFilter == "") return rows
                return rows.filter(el => el.location == this.locationFilter)
            },
           
            filterByMonth(rows) {

                if (this.fMonthFilter == "" || this.tMonthFilter == "" ) return rows
                return rows.filter(el => parseInt(el.month) >= this.fMonthFilter && parseInt(el.month) <= this.tMonthFilter )
            },
            filterByYear(rows) {

                if (this.fYearFilter == "" || this.tYearFilter == ""  ) return rows
                return rows.filter(el => el.year >= this.fYearFilter && el.year <= this.tYearFilter )
            },
            
            loadRows(){
                 axios.get(`/dashboard/api/rows/all`).then(res => {
                    if (res.status == 200) {
                        this.rows = res.data;
                    }
                }).catch(err => {
                    console.log(err)
                });
            },
            statistics(rows)
            {
                    this.stat['yCheck'] =  rows.reduce((acc, item) => acc + item.yCheck, 0);
                    this.stat['yPaid'] =  rows.reduce((acc, item) => acc + item.yPaid, 0);
                    this.stat['yReach'] =  rows.reduce((acc, item) => acc + item.yReach, 0);
                    this.stat['yViews'] =  rows.reduce((acc, item) => acc + item.yViews, 0);
                    this.stat['ySubs'] =  rows.reduce((acc, item) => acc + item.ySubs, 0);
                    this.stat['yLikes'] =  rows.reduce((acc, item) => acc + item.yLikes, 0);
                    this.stat['fCheck'] =  rows.reduce((acc, item) => acc + item.fCheck, 0);
                    this.stat['fPaid'] =  rows.reduce((acc, item) => acc + item.fPaid, 0);
                    this.stat['fReach'] =  rows.reduce((acc, item) => acc + item.fReach, 0);
                    this.stat['fEngagement'] =  rows.reduce((acc, item) => acc + item.fEngagement, 0);
                    this.stat['fComment'] =  rows.reduce((acc, item) => acc + item.fComment, 0);
                    this.stat['fLikes'] =  rows.reduce((acc, item) => acc + item.fLikes, 0);
                    this.stat['fShare'] =  rows.reduce((acc, item) => acc + item.fShare, 0);
                    this.stat['iCheck'] =  rows.reduce((acc, item) => acc + item.iCheck, 0);
                    this.stat['iPaid'] =  rows.reduce((acc, item) => acc + item.iPaid, 0);
                    this.stat['iReach'] =  rows.reduce((acc, item) => acc + item.iReach, 0);
                    this.stat['iEngagement'] =  rows.reduce((acc, item) => acc + item.iEngagement, 0);
                    this.stat['iComment'] =  rows.reduce((acc, item) => acc + item.iComment, 0);
                    this.stat['iLikes'] =  rows.reduce((acc, item) => acc + item.iLikes, 0);
                    this.stat['iShare'] =  rows.reduce((acc, item) => acc + item.iShare, 0);
                    this.stat['tCheck'] =  rows.reduce((acc, item) => acc + item.tCheck, 0);
                    this.stat['tPaid'] =  rows.reduce((acc, item) => acc + item.tPaid, 0);
                    this.stat['tReach'] =  rows.reduce((acc, item) => acc + item.tReach, 0);
                    this.stat['tEngagement'] =  rows.reduce((acc, item) => acc + item.tEngagement, 0);
                    this.stat['tComment'] =  rows.reduce((acc, item) => acc + item.tComment, 0);
                    this.stat['tLikes'] =  rows.reduce((acc, item) => acc + item.tLikes, 0);
                    this.stat['tRetweet'] =  rows.reduce((acc, item) => acc + item.tRetweet, 0);
                
            }


            //////
        }
    };
     
</script>

