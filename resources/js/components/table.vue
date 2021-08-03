<template>
   <div class="table">
    <!-- main row -->
       <div class="row">
            <div class="col-md-12">
                <div style="overflow-x:auto; overflow-y: auto;
                  height:700px;">
                   <button class="btn btn-primary " @click="showadd()" > add</button>
      
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
                                 <th scope="col">MORE INTRST. </th>
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

                                <tr v-for="row in rows" :key="row['id']" @dblclick="whichFunction(row)">
                                    <!-- main -->
                                    <td> {{row['date']}} </td>
                                    
                                    <!-- type -->
                                    <td>{{row['type']}} </td>
                                    <!-- program type -->
                                    <td>
                                      <p> {{row['progType']}}  </p>
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
                                        <small v-if="row['intrst'] !== ' '">
                                         <p style="word-wrap:break-word;" >  {{row['intrstContent']}} </p>
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

          <!-- edit modaaal -->
          <!-- Modal -->
               <!-- Modal -->
                  <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="editModal">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">

                                <!-- flow row -->
                              <div style="overflow-x:auto; overflow-y: auto;">
                                 <table class="table table-bordered table-fixed">
                            <thead >
                                <tr class="text-center">
                                    <th colspan="9" style="background-color: grey"></th>
                                    <th colspan="6" style="background-color: yellow">YOUTUBE</th>
                                    <th colspan="7" style="background-color: #8bc34acc">FACEBOOK</th>
                                    <th colspan="7" style="background-color: #debce4">INSTGRAM</th>
                                    <th colspan="7" style="background-color: #7d7db5">TWITTER</th>
                                    
                                 </tr>
                               <tr>
                                 <th scope="col">TYPE</th>
                                 <th scope="col">PROGRAME TYPE</th>              
                                 <th scope="col">CONTENT</th>
                                 <th scope="col">PHOTO/VIDEO</th>
                                 <th scope="col">ORGANIC OR SPONSERED</th>
                                 <th scope="col">SEGMENTATION</th>
                                 <th scope="col">MORE INTRST.</th>
                                 <th scope="col">INSTRST CONTENT</th>
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
                                <tr>
                                              <!-- date -->
                                                    <!-- <td> 
                                                  <select v-model = "row['date']">
                                                      <option  v-for="row in rows" :key="row['id']" @dblclick="whichFunction(row)" value="date">{{row['date']}} </option>
                                                     
                                                   </select> 
                                              </td> -->
                                              <!-- type -->
                                              <td> 
                                                  <select v-model = "row['type']">
                                                      <option value="post">post</option>
                                                      <option value="video">video</option>
                                                   </select> 
                                              </td>
                                              <!-- program type -->
                                              <td> 
                                                <select v-model="row['progType']">
                                                  <option>shtara course</option>
                                                  <option>shtara store</option>
                                                  <option>shtara event</option>
                                                  <option>kids station</option>
                                                  <option>Beot mastora-emar</option>
                                                  <option>Beot mastora - mnora</option>
                                                  <option>Beot mastora - sokia</option>
                                                  <option>Beot mastora - etam</option>
                                                  <option>bosla</option>
                                                  <option>3ndi suaal</option>
                                                  <option>Community police</option>
                                                  <option>qloab mastora</option>
                                                </select>
                                                <input type="text" v-model="row['progType']" placeholder="OTHER">
                                               </td>
                                              <!-- content -->
                                              <td> <textarea type="" v-model = "row['content']"> </textarea> </td>
                                              <!-- photo/video -->
                                              <td> 
                                                  <select v-model="row['PorV']">
                                                      <option > photo</option>
                                                      <option > video</option>
                                                  </select> 

                                                  <input type="text" v-model="row['path']">
                                              </td>
                                              <!-- organic / sponseres -->
                                              <td> 
                                                  <select v-model="row['OorS']">
                                                      <option> ORGANIC </option>
                                                      <option> SPONSOR </option>
                                                   </select> 
                                               </td>
                                               <!-- segmentation -->
                                              <td> 
                                                Age : 
                                                <input type="number" v-model="row['age']">
                                                location
                                                <input type="text" v-model="row['location']">
                                                gender
                                                  <select v-model="row['gender']">
                                                      <option> male </option>
                                                      <option> female </option>
                                                      <option> all </option>
                                                   </select>
                                              </td>
                                              <td > 
                                                  <select v-model="row['intrst']">
                                                    <option>shtara course</option>
                                                    <option>shtara event</option>
                                                    <option>shtara store</option>
                                                    <option>Donation</option>
                                                
                                                </select>
                                                
                                                     <input type="text" v-model="row['intrst']" placeholder="OTHER">
                                               
                                              </td>
                                              <td>
                                                
                                                 <textarea type="" v-model="row['intrstContent']"> </textarea>
                                               
                                              </td>
                                              <td> 
                                                  <select v-model="row['objective']">
                                                      <option>Brand awareness</option>
                                                      <option>local awareness</option>
                                                      <option>reach</option>
                                                      <option>traffic</option>
                                                      <option>engagement</option>
                                                      <option>app installs</option>
                                                      <option>video views</option>
                                                      <option>lead generation</option>
                                                       <option>conversations</option>
                                                      <option>product catalog sales</option>
                                                      <option>store visits</option>
                                                      
                                                  </select>
                                              </td>
                                              <td> <input type="" v-model = "row['duration']"> </td>
                                              <!-- end main -->
                                                  <!-- youtuve -->
                                              <td style="background-color: yellow">
                                                <input type="checkbox" v-model = "row['yCheck']">
                                              </td>
                                              <td> <input type="" v-model = "row['yPaid']"> </td>
                                              <td> <input type="" v-model = "row['yReach']"> </td>
                                              <td> <input type="" v-model = "row['yViews']"> </td>
                                              <td> <input type="" v-model = "row['ySubs']"> </td>
                                              <td> <input type="" v-model = "row['yLikes']"> </td>
                                              <!-- end youtube -->          

                                              <!-- facebook -->
                                              <td style="background-color: #8bc34acc">
                                                <input type="checkbox" v-model = "row['fCheck']">
                                              </td>
                                              <td> <input type="" v-model = "row['fPaid']"> </td>
                                              <td> <input type="" v-model = "row['fReach']"> </td>
                                              <td> <input type="" v-model = "row['fEngagement']"> </td>
                                              <td> <input type="" v-model = "row['fComment']"> </td>
                                              <td> <input type="" v-model = "row['fLikes']"> </td>
                                              <td> <input type="" v-model = "row['fShare']"> </td>
                                              <!-- end facebook -->          

                                              <!-- instgram -->
                                              <td style="background-color: #debce4 ">
                                                <input type="checkbox" v-model = "row['iCheck']">
                                               </td>
                                             <td> <input type="" v-model = "row['iPaid']"> </td>
                                              <td> <input type="" v-model = "row['iReach']"> </td>
                                              <td> <input type="" v-model = "row['iEngagement']"> </td>
                                              <td> <input type="" v-model = "row['iLikes']"> </td>
                                              <td> <input type="" v-model = "row['iComment']"> </td>
                                              <td> <input type="" v-model = "row['iShare']"> </td>
                                              <!-- end instgram -->
                                                   <!-- twitter -->
                                              <td style="background-color: #7d7db5">
                                                <input type="checkbox" v-model = "row['tCheck']">
                                               </td>
                                              <td> <input type="" v-model = "row['tPaid']"> </td>
                                              <td> <input type="" v-model = "row['tReach']"> </td>
                                              <td> <input type="" v-model = "row['tEngagement']"> </td>
                                              <td> <input type="" v-model = "row['tComment']"> </td>
                                              <td> <input type="" v-model = "row['tLikes']"> </td>
                                              <td> <input type="" v-model = "row['tRetweet']"> </td>
                                              <!-- end twitter -->          
          
                                    </tr>
                                </tbody>
                              </table>
                            </div>
                            <!-- end flow row -->
                            <button class="btn btn-primary" @click="updateRow(row)"> Update</button>
                             <button class="btn btn-danger mt-3" @click="deleteRow(row.id)"> Delete</button>

                        </div>
                        
                      </div>
                    </div>
                 
          <!-- end edit modal -->
          <!-- start add modal -->
              <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="addModal">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">

                                <!-- flow row -->
                              <div style="overflow-x:auto; overflow-y: auto;">
                                 <table class="table table-bordered table-fixed">
                            <thead >
                                <tr class="text-center">
                                    <th colspan="9" style="background-color: grey"></th>
                                    <th colspan="6" style="background-color: yellow">YOUTUBE</th>
                                    <th colspan="7" style="background-color: #8bc34acc">FACEBOOK</th>
                                    <th colspan="7" style="background-color: #debce4">INSTGRAM</th>
                                    <th colspan="7" style="background-color: #7d7db5">TWITTER</th>
                                    
                                 </tr>
                               <tr>
                                <th scope="col">table ID</th>
                                <th scope="col">date</th>
                                 <th scope="col">TYPE</th>
                                 <th scope="col">PROGRAME TYPE</th>              
                                 <th scope="col">CONTENT</th>
                                 <th scope="col">PHOTO/VIDEO</th>
                                 <th scope="col">ORGANIC OR SPONSERED</th>
                                 <th scope="col">SEGMENTATION</th>
                                 <th scope="col">MORE INTRST.</th>
                                 <th scope="col">INSTRST CONTENT</th>
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
                                <tr>
                                    <td>
                                          {{table_id}}
                                    </td>
                                              <!-- date -->
                                                 <td> 
                                                 <select v-model ="addrow['date']">
                                                 <option  v-for="row in rows" :key="row['id']" >{{row['date']}} </option>
                                                   </select> 
                                              </td>
                                              <!-- type -->
                                              <td> 
                                                  <select v-model ="addrow['type']">
                                                      <option value="post">post</option>
                                                      <option value="video">video</option>
                                                   </select> 
                                              </td>
                                              <!-- program type -->
                                              <td> 
                                                <select v-model="addrow['progType']">
                                                  <option>shtara course</option>
                                                  <option>shtara store</option>
                                                  <option>shtara event</option>
                                                  <option>kids station</option>
                                                  <option>Beot mastora-emar</option>
                                                  <option>Beot mastora - mnora</option>
                                                  <option>Beot mastora - sokia</option>
                                                  <option>Beot mastora - etam</option>
                                                  <option>bosla</option>
                                                  <option>3ndi suaal</option>
                                                  <option>Community police</option>
                                                  <option>qloab mastora</option>
                                                </select>
                                                <input type="text" v-model="addrow['progType']" placeholder="OTHER">
                                               </td>
                                              <!-- content -->
                                              <td> <textarea type="" v-model = "addrow['content']"> </textarea> </td>
                                              <!-- photo/video -->
                                              <td> 
                                                  <select v-model="addrow['PorV']">
                                                      <option > photo</option>
                                                      <option > video</option>
                                                  </select> 

                                                  <input type="text" v-model="addrow['path']">
                                              </td>
                                              <!-- organic / sponseres -->
                                              <td> 
                                                  <select v-model="addrow['OorS']">
                                                      <option> ORGANIC </option>
                                                      <option> SPONSOR </option>
                                                   </select> 
                                               </td>
                                               <!-- segmentation -->
                                              <td> 
                                                Age : 
                                                <input type="number" v-model="addrow['age']">
                                                location
                                                <input type="text" v-model="addrow['location']">
                                                gender
                                                  <select v-model="addrow['gender']">
                                                      <option> male </option>
                                                      <option> female </option>
                                                      <option> all </option>
                                                   </select>
                                              </td>
                                              <td > 
                                                  <select v-model="addrow['intrst']">
                                                    <option>shtara course</option>
                                                    <option>shtara event</option>
                                                    <option>shtara store</option>
                                                    <option>Donation</option>
                                                
                                                </select>
                                                
                                                     <input type="text" v-model="addrow['intrst']" placeholder="OTHER">
                                               
                                              </td>
                                              <td>
                                                
                                                 <textarea type="" v-model="addrow['intrstContent']"> </textarea>
                                               
                                              </td>
                                              <td> 
                                                  <select v-model="addrow['objective']">
                                                      <option>Brand awareness</option>
                                                      <option>local awareness</option>
                                                      <option>reach</option>
                                                      <option>traffic</option>
                                                      <option>engagement</option>
                                                      <option>app installs</option>
                                                      <option>video views</option>
                                                      <option>lead generation</option>
                                                       <option>conversations</option>
                                                      <option>product catalog sales</option>
                                                      <option>store visits</option>
                                                      
                                                  </select>
                                              </td>
                                              <td> <input type="" v-model = "addrow['duration']"> </td>
                                              <!-- end main -->
                                                  <!-- youtuve -->
                                              <td style="background-color: yellow">
                                                <input type="checkbox" v-model = "addrow['yCheck']">
                                              </td>
                                              <td> <input type="" v-model = "addrow['yPaid']"> </td>
                                              <td> <input type="" v-model = "addrow['yReach']"> </td>
                                              <td> <input type="" v-model = "addrow['yViews']"> </td>
                                              <td> <input type="" v-model = "addrow['ySubs']"> </td>
                                              <td> <input type="" v-model = "addrow['yLikes']"> </td>
                                              <!-- end youtube -->          

                                              <!-- facebook -->
                                              <td style="background-color: #8bc34acc">
                                                <input type="checkbox" v-model = "addrow['fCheck']">
                                              </td>
                                              <td> <input type="" v-model = "addrow['fPaid']"> </td>
                                              <td> <input type="" v-model = "addrow['fReach']"> </td>
                                              <td> <input type="" v-model = "addrow['fEngagement']"> </td>
                                              <td> <input type="" v-model = "addrow['fComment']"> </td>
                                              <td> <input type="" v-model = "addrow['fLikes']"> </td>
                                              <td> <input type="" v-model = "addrow['fShare']"> </td>
                                              <!-- end facebook -->          

                                              <!-- instgram -->
                                              <td style="background-color: #debce4 ">
                                                <input type="checkbox" v-model = "addrow['iCheck']">
                                               </td>
                                             <td> <input type="" v-model = "addrow['iPaid']"> </td>
                                              <td> <input type="" v-model = "addrow['iReach']"> </td>
                                              <td> <input type="" v-model = "addrow['iEngagement']"> </td>
                                              <td> <input type="" v-model = "addrow['iLikes']"> </td>
                                              <td> <input type="" v-model = "addrow['iComment']"> </td>
                                              <td> <input type="" v-model = "addrow['iShare']"> </td>
                                              <!-- end instgram -->
                                                   <!-- twitter -->
                                              <td style="background-color: #7d7db5">
                                                <input type="checkbox" v-model = "addrow['tCheck']">
                                               </td>
                                              <td> <input type="" v-model = "addrow['tPaid']"> </td>
                                              <td> <input type="" v-model = "addrow['tReach']"> </td>
                                              <td> <input type="" v-model = "addrow['tEngagement']"> </td>
                                              <td> <input type="" v-model = "addrow['tComment']"> </td>
                                              <td> <input type="" v-model = "addrow['tLikes']"> </td>
                                              <td> <input type="" v-model = "addrow['tRetweet']"> </td>
                                              <!-- end twitter -->          
          
                                    </tr>
                                </tbody>
                              </table>
                            </div>
                            <!-- end flow row -->
                            <button class="btn btn-primary" @click="addnew(table_id,addrow)"> add</button>
                        </div>
                        
                      </div>
                    </div>
          <!-- end add modal -->
          <!-- show text modal  -->
          <!-- Modal -->
              <div class="modal fade" id="textModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-body">
                     <p style="word-wrap:break-word;">{{text}}</p>
                    </div>
                   
                  </div>
                </div>
              </div>
          <!-- end show text modal  -->
            
   </div>
</template>

<script>
   
    export default {

        props: ['table_id'] ,

        data() {
            
            return {
                rows: [],
                addrow:{
                    id: '',
                    date :'' ,
                    type : '' ,
                    progType : '' ,
                    content : '' , 
                    PorV : '' ,
                    path : '' ,
                    OorS : '' , 
                   age:'' ,
                   location:'' , 
                   gender:'',
                    intrst:'' , 
                    intrstContent:'',
                    objective:'' , 
                    duration:'' , 
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
                row: {
                    id: '',
                    date :'' ,
                    type : '' ,
                    progType : '' ,
                    content : '' , 
                    PorV : '' ,
                    path : '' ,
                    OorS : '' , 
                   age:'' ,
                   location:'' , 
                   gender:'',
                    intrst:'' , 
                    intrstContent:'',
                    objective:'' , 
                    duration:'' , 
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
                text : '' ,

            
            };
        },
        computed: {

           
            

        },

        methods: {

            open1() {
       
      },
            // on double click to edit row
            whichFunction(row) {
                this.row = row;
                $("#editModal").modal();
            },

            // fetch all rows
           loadRows(){
                 axios.post(`/dashboard/api/rows/${this.table_id}`).then(res => {
                    if (res.status == 200) {
                        this.rows = res.data;
                        console.log( this.rows);
                    }
                }).catch(err => {
                    console.log(err)
                });
            },
            updateRow(){
                  // Update
                //   console.log(this.row);
                   axios.post(`/dashboard/api/rows`, this.row )
                         .then(res => {
                             $('#editModal').modal('hide');
                             this.loadRows();
                         }).catch(err => {
                         console.log(err)
                     })
            }, 
            deleteRow(id){
                     this.$confirm('This will permanently delete the row. Continue?', 'Warning', {
                        confirmButtonText: 'OK',
                        cancelButtonText: 'Cancel',
                        type: 'warning'
                        }).then(() => {
                                // console.log(id);
                            axios.post(`/dashboard/api/deleterow/${id}`)
                         .then(res => {
                             $('#editModal').modal('hide');
                             this.loadRows();
                            
                         }).catch(err => {
                         console.log(err)  
                           this.$notify.error({
                                    title: 'Error',
                                    message: err,
                                    type: 'Error'
                                });
                     })
                        this.$message({
                        type: 'success',
                        message: 'Delete completed'
                        });
                    }).catch(() => {
                        this.$message({
                        type: 'info',
                        message: 'Delete canceled'
                        });          
                    });
      
                // console.log(id);
                // axios.post(`/dashboard/api/deleterow/${id}`)
                //          .then(res => {
                //              $('#editModal').modal('hide');
                //              this.loadRows();
                            
                //          }).catch(err => {
                //          console.log(err)  
                //            this.$notify.error({
                //                     title: 'Error',
                //                     message: err,
                //                     type: 'Error'
                //                 });
                //      })
            },
            chnageStyle(){
              this.color = (this.color == 'red') ? 'black' : 'red' ; 
              this.overflow = (this.color == 'hidden') ? 'visible' : 'hidden' ; 
            },
            showText(text) {
              this.text = text ; 
              $('#textModal').modal();
            },
           
            showadd(){
              
                 $("#addModal").modal();
            },

            addnew(table_id,addrow){

                this.addrow = addrow;
                // console.log( table_id);
                axios.post(`/dashboard/api/addrows/${table_id}`, this.addrow )
                         .then(res => {
                             $('#addModal').modal('hide');
                             this.loadRows();
                             this.addrow = {};
                              this.$notify({
                                    title: 'Success',
                                    message: 'added successfully',
                                    type: 'success'
                                });
                         }).catch(err => {
                         console.log(err)
                            this.$notify.error({
                                    title: 'Error',
                                    message: 'please,complete your Data',
                                    type: 'Error'
                                });
                     })
            }

            //////
        },
         created() {
          
            this.loadRows();
        },
    };
     
</script>

