<?php
 use App\task ;
 use App\branch ;
 use App\user ;
 use App\task_paper;
?>
@extends('layouts.dashboard')
@section('dashboard_content')
<div class="row">

    @php
        $user = user::find(Auth::user()->id);
    @endphp
@if($user->photo != null)


            <div class="form-group col-md-4" >
                <img class="image-show" style="margin-left:10%;" width="40%" src="{{asset('images/users/'.$user->photo)}}"  >
            </div>
            <div class="form-group col-md-5" ></div>
            <button  type="button" style="height:40px;" class="btn btn-primary mt-4" data-toggle="modal" data-target="#photo">
                change photo
             </button>
  @else
        <div class="form-group col-md-4" >
            <img class="image-show" style="margin-left:10%;" width="40%" src="{{asset('images/users/blank-profile.png')}}"  >
        </div>
        <div class="form-group col-md-5" ></div>
        {{-- user upload photo --}}
        <button  type="button" style="height:40px;" class="btn btn-primary mt-4" data-toggle="modal" data-target="#photo2">
            upload photo
         </button>
@endif

</div>
  {{-- end user photo --}}



         <!-- user photo modal -->
         <div class="modal fade" id="photo" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">profile picture </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-md-4" >
                        <img class="image-show" style="margin-left:10%;" width="40%" src="{{asset('images/users/'.$user->photo)}}"  >
                    </div>
                    <div class="form-group col-md-5" ></div>
                    <form method="post" action="{{ route('addUserphoto') }}"  enctype="multipart/form-data">
                        @csrf
                            <div class="form-row">
                                <div class="form-group col-md-10">
                                    <label>Select Your profile picture</label>
                                    <input class="form-control" type="file" name="photo" >
                                </div>
                                </div>

                                <input type="hidden" name='id' value="{{Auth::user()->id}}">
                                <button type="submit" class="btn btn-primary">upload</button>
                    </form>

              </div>
            </div>
          </div>
          </div>



            <!-- user photo2 modal -->
         <div class="modal fade" id="photo2" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">profile picture </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="form-group col-md-4" >
                      <img class="image-show"  width="40%" src="{{asset('images/users/blank-profile.png')}}"  >
                  </div>
                  <div class="form-group col-md-5" ></div>
                  <form method="post" action="{{ route('addUserphoto') }}"  enctype="multipart/form-data">
                      @csrf
                          <div class="form-row">
                              <div class="form-group col-md-10">
                                  <label>Select Your profile picture</label>
                                  <input class="form-control" type="file" name="photo" >
                              </div>
                              </div>

                              <input type="hidden" name='id' value="{{Auth::user()->id}}">
                              <button type="submit" class="btn btn-primary">upload</button>
                  </form>

            </div>
          </div>
        </div>
        </div>



    <!-- enduserphotomodal -->


<hr>
<div class="container">

  <!-- hint for urgency  -->
  <div class="row">
    <div class="col-md-4">
      <div class="row">
        <div class="col-md-2">
            <div class="square" style="background-color:#f2dede;"></div>
        </div>
        <div class="col-md-2">
           IMPORTANT
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
             <div class="square" style="background-color:#fcf8e3;"></div>
        </div>
        LESS IMPORTANT

      </div>
       <div class="row">
        <div class="col-md-2">
            <div class="square" style="background-color: #dff0d8;"></div>
        </div>
        <div class="col-md-2">
            NORMAL
        </div>

      </div>

    </div>
    </div>


  <!-- end urgency -->
  <!-- search -->
  <div class="row">
    <div class="col-md-4 offset-md-4 mt-4">
      <input class="form-control" id="myInput" type="text" placeholder="Search..">
    </div>

  </div>
  <!-- end search -->
  <!-- my tasks -->
  <div class="row">
    <div class="col-md-12 mt-4">
        <div style="overflow-x:auto; overflow-y: auto;
    height:500px;">
    <table class="table table-bordered table-fixed"

            >
        <thead class="thead-dark">
          <tr>
            <th scope="col">Project Branch</th>
            <th scope="col">Project name</th>
            <th scope="col">task ID</th>

            <th scope="col">task description</th>
            <th>Quantity</th>
            <th>Done Quantity</th>


            <th scope="col">Status</th>
            <th scope="col">Due date</th>

          </tr>
        </thead>
        <tbody id="myTable">

          @foreach($rows as $row)
          <?php

            $task = task::find($row->task_id);
          ?>
          <!-- select approved tasks -->


          <tr style="background-color: <?php
                            if($task->urgency == 0 )
                                echo  "#dff0d8" ;
                            else if ($task->urgency == 1)
                                echo  "#fcf8e3" ;
                            else
                            echo  "#f2dede"

                            ?>

                        ">
              <td>
               <?php
                $branch_id = $task->project()->first()->branch;
                $branch = branch::find($branch_id);

              ?>
              {{ $branch->name}}</td>
              <td style="direction:rtl;">
                  <?php
                  $project = $task->project;
                $branch = branch::find($branch_id);
                ?>
                {{$project->name}} </td>
              <td> {{$task->id}} </td>
              <td style="font-size:15px;direction:rtl;">
                 {{$task->description}}
               </td>
               <td> {{$task->quantity}} </td>
               <td>
                 @if( is_null($task->status))
                    @if($task->quantity > 0)
                      <form method="post" action="{{ route('statusUpdate') }}"  enctype="multipart/form-data" >
                        @csrf
                        <input type="hidden" name="id" value="{{$task->id}}">
                        <div class="input-group mb-3">
                          <input style="min-width:20px;max-height:30px;"
                           class="form-control quantityInput input-sm" type="text" name="quantity"  value= "{{$task->doneQuantity}}">
                           
                          <div class="input-group-append ">
                           <input style="min-width:75px;max-height:30px;" class="btn btn-primary float-right input-sm" type="submit">
                          </div>
                        </div>
                      </form>
                     @endif
                  @else
                      <p>  {{$task->doneQuantity}}</p>
                        {{-- $task_papers = task_paper::where('task_id',$task->id)->get(); --}}
                    {{-- <p>  {{count( $task_papers)}} </p> --}}
                  @endif
                  {{-- @endforeach --}}
               </td>


              <!-- check approval-->

              @if(!$task->isApproved)
                <td> wait for approval </td>
                 <!-- if status added -->
              @elseif( !is_null($task->status))
              <!-- tranfered -->
                    @if($task->status == 'transfer')
                      <!-- if have repsonsibilty -->
                      @if($task->tasks()->first()->user_id == Auth::user()->id)
                          @if($task->from == Auth::user()->id)
                              <td>wait for transfer approval</td>
                          @else

                                <td>

                                  transfered from
                                   <?php
                                         $user = user::find($task->from)->first();
                                    ?>
                                     <small style="color: blue" >{{$user->name}} </small>
                                      @if($task->quantity > 0 && $task->doneQuantity )
                                       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#task{{$task->id}}">
                                          Status
                                       </button>
                                      @endif

                                        	<button class="btn btn-primary" data-toggle="modal" data-target="#note{{$task->id}}" > Send message </button>



                               </td>

                          @endif
                        @endif
                    @else
                      <td> {{$task->status}}
                      @if($task->statusApproved)
                            <small style="color: green">Approved</small>
                      @else
                            <small style="color: red">not Approved yet</small>
                      @endif
                      </td>
                    @endif

              @else

              <td>

                <p style="display: none;">new</p>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#task{{$task->id}}">
                          Status
                </button>

                 	<button class="btn btn-primary" data-toggle="modal" data-target="#note{{$task->id}}" > Send message </button>

              </td>

                @endif
                <!-- Modal -->
                <div class="modal fade" id="task{{$task->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">{{$task->description}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="post" action="{{ route ('statusUpdate') }}"  enctype="multipart/form-data" >
                              @csrf
                              <input type="hidden" name="id" value="{{$task->id}}">
                              <!-- status -->
                               <div class="form-row">
                                 <div class="form-group col-md-12">
                                    <label for="objDescription">Status</label>
                                    <select  id="objective" class="form-control" name="status">

                                        {{-- @if($task->quantity > 0 && $task->doneQuantity == $task->quantity ) --}}
                                              <option value="done">Done</option>
                                        {{-- @elseif($task->quantity == 0 )
                                            <option value="done">Done</option>
                                        @endif --}}
                                      <option value="canceled">canceled</option>
                                      <option value="late">Late</option>
                                      <option value="delayed">Delayed</option>
                                      <option value="transfer">transfer</option>
                                    </select>
                                     {!! $errors->first('status', '<small style="color:red;">:message</small>') !!}
                                  </div>
                                </div>
                                <!-- date -->
                                <div class="form-row">
                                 <div class="form-group col-md-12">
                                    <label>Late Date</label>
                                    <input class="form-control" type="date" name="lateDate">
                                    <small style="color: red">required in <b>late </b> status</small>
                                    {!! $errors->first('date', '<small style="color:red;">:message</small>') !!}
                                  </div>
                                </div>

                                <!-- users -->
                                <div class="form-row">
                                 <div class="form-group col-md-12">
                                    <label>User</label>
                                    <select class="form-control" name="alternative">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}} - {{$user->email}}</option>
                                        @endforeach
                                    </select>
                                     <small style="color: red">required in <b>transfer</b> status</small>
                                     {!! $errors->first('alternative', '<small style="color:red;">:message</small>') !!}
                                  </div>
                                </div>
                                 <input class="form-control" type="file" name="files[]"  multiple=" ">


                        </div>
                        <div class="modal-footer">
                          <a type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                          <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>



              <td> {{$task->dueDate}}  </td>

          </tr>
          <!-- modals -->
                      <!-- add note modal -->
			    <div class="modal fade" id="note{{$task->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">{{$task->description}} - Add Note</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="post" action="{{ route ('add_note') }}" >
                              @csrf
							  <input type="hidden" name="id" value="{{$task->id}}">
							  <div class="form-row">
                                 <div class="form-group col-md-12">
                                   <label for="note">Note</label>
                                   <p style="color:#846161;">( This message will be sent to the manager before you change your task status ) </p>
                                   <textarea  type="text" class="form-control" id="note"    name="note"></textarea >
                                 </div>
                               </div>
							  <button type="submit" class="btn btn-primary">Add</button>
						  </form>
                      </div>
                    </div>
                  </div>
				  </div>



			<!-- endnotemodal -->
        @endforeach
        </tbody>
        </table>
     </div>
   </div>
  </div>
  <div class="text-center" style="font-size:14px;">Projects in Branch</div>
	<div class="row">
      @foreach($projects as $project)
		<div class="col-md-4 mt-4">
			<div id="accordion">
        <!-- card -->
  				<div class="card" >
  				  <div class="card-header" id="heading{{$project->id}}">
  				    <h5 class="mb-0">
  				      <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$project->id}}" aria-expanded="false" aria-controls="collapseOne">
                        {{$project->name}} - ( {{$project->description}} )
                   <button type="button" class="btn btn-outline-primary float-right" data-toggle="modal" data-target="#AddModal{{$project->id}}">
                        <i class="fa fa-plus"></i>

  				          </button>
  				    </h5>
 				   </div>

    			   <div id="collapse{{$project->id}}" class="collapse show" aria-labelledby="heading{{$project->id}}" data-parent="#accordion">

    			   </div>
          </div>
      </div>
    </div>

          <!-- Modal to add task -->
           <!-- Add Modal -->
              <div class="modal fade" id="AddModal{{$project->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="AddModal" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-center" style="color: blue" id="AddModal">{{ucfirst($project->name)}}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <!-- branch -->
                    <form method="post" action="/dashboard/user/addTask/{{$project->id}}">
                      @csrf
                      <input type="hidden" value="{{$project->id}}" name="project" >
                       <input type="hidden" class="count" name="count" value="1">

                        <!-- quantity -->
                        <div class="form-row">
                          <div class="form-group col-md-12">
                            <label for="quantity">quantity</label>
                            <input type="number" class="form-control" id="quantity"   name="quantity">
                          </div>
                        </div>
                        <!-- end quantity -->


                      <!-- Task -->
                        <div class="form-row">
                          <div class="form-group col-md-12">
                            <label for="taskInput"><b>Task</b></label>
                            <input type="text" class="form-control" id="taskInput"   name="taskInput1" required>
                          </div>
                        </div>
                        <!-- end task -->




                         <!-- due time date -->
                        <div class="form-row">
                          <div class="form-group col-md-12">
                            <input type="date" class="form-control" value="" id="date" name="date">
                            {!! $errors->first('date', '<small style="color:red;">:message</small>') !!}
                            {{-- {!! $errors->first('date', '<small style="color:red;">:message</small>')      !!} --}}

                          </div>

                        </div>



                   <!-- urgency -->
                        <div class="form-row">
                          <div class="form-group col-md-12">
                            <label for="inputEmail4">Urgency</label>
                            <select id="disabledSelect" class="form-control" name="urgency1" required>
                                 <option style="color: red" value="2">Important</option>
                                 <option style="color: orange" value="1">less Important</option>
                                 <option style="color: green" value="0">Normal</option>
                            </select>
                          </div>
                        </div>
                        <!-- end urgency -->
                        <!-- new task by jquery -->
                        <div class="newTasksSection">


                        </div>
                        <!-- end new tasks -->
                           <button type="submit" class="btn btn-primary float-right showTitle" title="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    </form>
                    <div class="btn-group btn-group-toggle " data-toggle="buttons">
                       <button class="btn btn-success showTitle addNewTask" title="add task"><i class="fa fa-plus" aria-hidden="true"></i> </button>
                       <div class="deleteButtonSection">

                       </div>

                    </div>


                  <!-- end of branch -->

          <!-- end modal -->
          <!-- end of card -->


                   </div>
        </div>
	</div>
</div>



          @endforeach
</button>
@endsection
@section('dashboard_scripts')
<script src="http://code.jquery.com/jquery-latest.js"></script>

 <script>
    $(document).ready(function () {
    $('.form-control.quantityInput').click(function () {
         $(this).removeAttr('readonly');

    });
});

 </script>
@endsection

