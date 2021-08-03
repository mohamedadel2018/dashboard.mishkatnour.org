<?php
use App\user;
use App\task_paper;
?>
@extends('Dashboard.structure')
@section('dashboard_heading')
  <p> PENDING TASKS</p>
@endsection
@section('structure_content')
<div class="">
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
  <!-- search -->
  <div class="row">
    <div class="col-md-11 ml-1">
        <div class="row">
             <div class="col-md-2 mt-4">
                    <select class="form-control" id="statusFilterSelect">
                      <option value="">All</option>
                      <option value="done">Done</option>
                      <option value="late">Late</option>
                      <option value="Delayed" >Delayed</option>
                      <option value="Transfer">Transfer</option>
                    </select>
             </div>
             <div class="col-md-4 mt-4 offset-md-2 float-right">
               <input class="form-control" id="myInput" type="text" placeholder="Search..">
             </div>

       </div>
    </div>
  </div>
  <!-- end search -->

  <div class="row">
    <div class="col-md-10 mt-4">
    <div  style="overflow-x:auto; overflow-y:auto;
    height:500px;">
    <table class="table table-bordered table-fixed"
            style="width:1500px";
            padding:2px;
            >
         <thead class="thead-dark">
                      <tr>
                        <th scope="col">Actions</th>
                        <th scope="col">Project</th>
                        <th scope="col"> Task ID </th>
                        <th scope="col"style="width:50%">Task</th>
                         <th scope="col" >Quantity</th>
                          <th scope="col" >Done Quantity</th>
                        <th scope="col" >Responsibility</th>
                        <th scope="col" >Created at</th>
                        <th scope="col" >Due date</th>
                        <th scope="col" >Files</th>
                        <th scope="col" >Status</th>
                        <th scope="col" >Status Date</th>
                        <th scope="col"   >Confirmation</th>
                        <th scope="col" >Notes</th>

                      </tr>
                    </thead>
                    <tbody id="myTable">
                      @foreach($tasks as $task)

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

                  <button class="btn btn-info" data-toggle="modal" data-target="#editModal{{$task->id}}">
                       <i class="fa fa-edit" aria-hidden="true"></i>
                  </button>



                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$task->id}}">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>




                         <!-- delete modal -->
                      <div class="modal fade" id="deleteModal{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{$task->description}} </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body" style="color: red">
                                If you delete task all data in relation with will be deleted .
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <form method="post" action="{{ route ('deleteTask') }}">
                                  @csrf
                                 <input type="hidden" value="{{$task->id}}" name="id">
                                  <input type="submit" class="btn btn-danger" value="Delete">
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                       <!-- end delete modal -->

                          <!-- edit modal -->
                  <div class="modal fade" id="editModal{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{$task->description}} </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body" >

                          <form method="post" action="{{ route ('editTask')}}">
                            @csrf
                              <!-- Task -->
                              <input type="hidden" name="id" value="{{$task->id}}">

                                  <!-- project Name -->
                                      <div class="form-row">
                                      <div class="form-group col-md-12">
                                          <label for="description">Description</label>
                                          <input type="text" value="{{$task->description}}" class="form-control" id="description" name="description">
                                          {!! $errors->first('description', '<small style="color:red;">:message</small>') !!}
                                      </div>
                                      </div>
                                      <!-- end Task Name -->
                                      <!-- task description -->
                                      <div class="form-row">
                                        <div class="form-group col-md-12">
                                          <label for="objDescription">Responsibilty</label>
                                          <select id="user"  class="form-control" name="user">
                                            @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->id}} - {{$user->name}}</option>
                                            @endforeach
                                          </select>
                                          {!! $errors->first('objective', '<small style="color:red;">:message</small>') !!}

                                        </div>
                                      </div>

                                      <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="quantity">Quantity</label>
                                            <input type="text" value="{{$task->quantity}}" class="form-control" id="quantity" name="quantity">
                                            {!! $errors->first('Quantity', '<small style="color:red;">:message</small>') !!}
                                        </div>
                                        </div>
                                      <!-- end task description -->
                                      <!-- due time date -->
                                      <div class="form-row">
                                        <div class="form-group col-md-12">
                                          <label>Due Date</label>
                                        <input type="date" class="form-control" value="{{$task->dueDate}}" id="date" name="date">
                                          {!! $errors->first('date', '<small style="color:red;">:message</small>') !!}

                                        </div>

                                      </div>

                                      <!-- end due time date -->
                              <!-- end of project -->

                              <br>
                              <button type="submit" class="btn btn-primary">Add</button>
                          </form>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                          </div>
                        </div>
                      </div>
                    </div>
                  <!-- end edit modal -->

                      </td>

                          <td  >{{$task->project()->first()->name}}</td>
                          <td  > {{$task->id}}</td>
                          <td style="direction:rtl;">
                               {{$task->description}}
                          </td>
                          <td > {{$task->quantity}}</td>
                          <?php
                          $task_papers = task_paper::where('task_id',$task->id)->get();

                        ?>
                       <td>

                        {{$task->doneQuantity}}
                        @if($task->doneQuantity  >   $task->quantity  )
                        <i style="color:green;padding-left:40px;" class="fa fa-arrow-up" ></i>
                        @endif

                        @if($task->doneQuantity  <   $task->quantity && $task->doneQuantity != null )
                            <i style="color:red;padding-left:40px;" class="fa fa-arrow-down" ></i>
                        @endif

                        @if($task->doneQuantity  ==   $task->quantity && $task->doneQuantity != null )
                             <i style="color:blue;padding-left:40px;" class="fa fa-check" aria-hidden="true"></i>
                        @endif

                        @if($task->doneQuantity  == null)
                            <i class="fa fa-window-minimize" aria-hidden="true"></i>
                         @endif




                    </td>

                          </td>
                           <td>
                            <?php
                              $reps  = $task->tasks()->get();
                             ?>


                        <!-- RESPONSIBILTY DRO DOWN MENUE  -->
                            @foreach($reps as $res)
                                <a style="color: blue" class="dropdown-item" href="/dashboard/profile/ {{$res->user()->first()->id}}"> {{$res->user()->first()->name}}

                                </a>
                              <?php $responsibility =$res->user_id;  ?>
                            @endforeach
                        <!-- END RESPONSIBILTY  -->



                        </td>
                        <td  >
                           @if($task->isApproved == 0)
                                {{$task->created_at}} by user
                            @elseif ($task->isApproved)
                              @if(is_null($task->approveTaskDate))
                                  {{$task->created_at}} by admin
                              @else
                                <p> {{$task->created_at}}</p>
                                <p> approved at </p>
                                <p> {{$task->approveTaskDate}}</p>

                              @endif
                            @endif
                        </td>
                        <td  >{{$task->dueDate}}</td>


                        <td>
                            <?php
                            $paper = $task->task_papers()->get();
                             ?>
                          @foreach($paper as $papers)
                          <a href="/dashboard/task/downloadPaper/{{$papers->destination}}">
                            <b> <i>{{$papers->destination}}</i> </b> <br>
                          </a>
                          @endforeach


                        </td>


                          <td>

                                  <b> <i>{{$task->status}}</i> </b>

                            @if($task->status == 'transfer')

                               <span style="color: red"> to </span>
                               <?php
                                  $user = user::find($task->alternative);
                               ?>
                                {{$user->email}}

                            @elseif($task->status == 'late')

                             {{$task->lateDate}}

                            @endif
                          </td>

                          <td>
                            {{$task->statusDate}}
                          </td>
                          <td>
                            <div class="row">
                              <!-- notApproved -->

                              @if($task->isApproved == 0)
                                <div class="col-md-6">

                                    <form action = "{{ route ('taskConfirmation')}}" method="post">
                                      @csrf
                                      <input type="hidden" name="id" value="{{$task->id}}">
                                      <button type="submit" class="btn btn-success showTitle" title="approve task">

                                        <i class="fa fa-check" aria-hidden="true"></i>

                                      </button>
                                    </form>
                                  </div>
                                  <div class="col-md-6">

                                     <form action = "{{ route ('taskDenay')}}" method="post">
                                      @csrf
                                      <input type="hidden" name="id" value="{{$task->id}}">
                                      <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash" aria-hidden="true"></i>

                                      </button>
                                    </form>
                                 </div>

                              @elseif(is_null($task->status))
                              <div class="col-md-12">
                                <p> not updated yet </p>
                                </div>
                              @elseif(!is_null($task->status))
                                <!-- check if approved transfered -->
                                 @if($task->alternative != $responsibility )
                                   <div class="col-md-6">
                                        <form action = "{{route('statusConfirmation')}}" method="post">
                                          @csrf
                                          <input type="hidden" name="id" value="{{$task->id}}">
                                          <button type="submit" class="btn btn-success showTitle" title="approve Status" >

                                           <i class="fa fa-check" aria-hidden="true"></i>

                                          </button>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        <form action = "{{route('taskNotConfirmation')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$task->id}}">
                                            <button type="submit" class="btn btn-info showTitle" title="not approved Status" >
                                                <i class="fa fa-hand-paper-o" aria-hidden="true"></i>
                                              </button>
                                          </form>
                                    </div>
                                @else
                                <div class="col-md-12">
                                    <p> not updated yet </p>
                                </div>


                              @endif



                              @endif
                            </div>

                          </td>
                          <td  >
                           <?php $notes = $task->notes()->get() ?>
								@foreach($notes as $note)
								  <p style="background-color : #b3d7ff"> <b> {{$note->note}} <b> <p>

								@endforeach
                          </td>
                        </tr>
                      @endforeach


                    </tbody>
        </table>
        </div>
     </div>

  </div>




</div>
@endsection
