@extends('layouts.dashboard')

@section('dashboard_content')
<?php
use App\branch;
?>
<div class="container">
    @foreach($projects as $project)
  <div class="row ">
    <div class="col-md-4 offset-md-4 mt-4">
      <div class="card" style="width: 18rem;">
        <ul class="list-group list-group-flush text-center">
          <li class="list-group-item"> <p> <b> <i>project Name :  </i> </b>{{$project->name}}</p> </li>
                    <?php
                    $branch = branch::find($project->branch) ;
                      ?>

          <li class="list-group-item"> <p> <b>   <i> Branch :  </i> </b> {{$branch->name}}</p> </li>
          <li class="list-group-item"><p> <b> <i> Location : </i> </b> {{$project->location}}</p></li>
          <li class="list-group-item"><p> <b> <i> Description : </i> </b> {{$project->description}}</p></li>
          <li class="list-group-item"><p> <b> <i> Objective : </i> </b> {{$project->objective->description}}</p></li>
          <li class="list-group-item"><p> <b> <i> Control : </i> </b> 
            <button type="button" class="btn btn-primary showTitle" data-toggle="modal" data-target="#AddModal{{$project->id}}"  title="Add Task">
              <i class="fa fa-plus"></i>
            </button>
            <!-- end add -->

                <!-- edit button -->
            <button class="btn btn-success showTitle" data-toggle="modal" data-target="#editModal{{$project->id}}" title="Edit">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>

            </button>
            <!-- delete button -->
            <button class="btn btn-danger showTitle" data-toggle="modal" data-target="#deleteModal{{$project->id}}" title="Delete">
                  <i class="fa fa-trash" aria-hidden="true"></i>
            </button> 
          </p></li>
        </ul>
      </div>

    </div>

  </div>
	<div class="row">
	  <div class="col-md-10 offset-md-1 mt-4">
		<table class="table">
  			<thead class="thead-dark">
  			  <tr>
  			    <th scope="col">task ID</th>
            <th scope="col">task description</th>
            <th scope="col">Urgency</th>
            <th scope="col">task status</th>
            <th scope="col">task responsibility</th>

           <th scope="col">

              <a href="/dashboard/addProject"><button type="button" class="btn btn-outline-primary"  title="Add New Project">
                <i class="fa fa-plus"></i>
          </button></a>

            </th>
  			  </tr>
  			</thead>
  			<tbody>
  			    
  			    
  			      <!-- Add Modal -->
  <div class="modal fade" id="AddModal{{$project->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="AddModal{{$project->id}}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="AddModal">{{$project->name}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- branch -->
        <form method="post" action="/dashboard/addTask/{{$project->id}}">
          @csrf
          <input type="hidden" value="{{$project->id}}" name="project">
            <!-- Task -->
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="taskInput">Task</label>
                <input type="text" class="form-control" id="taskInput"   name="taskInput">
              </div>
            </div>
            <!-- end task -->
             <!-- Task -->
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="taskInput">Quantity</label>
                <input type="number" class="form-control" id="quantity"   name="quantity">
              </div>
            </div>
            <!-- end task -->

            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="inputEmail4">Responsibilty</label>
                <select id="disabledSelect" class="form-control" name="ResponsibiltyInput">
                      @foreach($users as $user)
                        <option value="{{$user->id}}"> {{$user->name}} - {{$user->email}}</option>
                      @endforeach
                </select>
              </div>
            </div>

            <!-- urgency -->
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="inputEmail4">Urgency</label>
                <select id="disabledSelect" class="form-control" name="urgency">
                     <option style="color: red" value="2">Important</option>
                     <option style="color: orange" value="1">less Important</option>
                     <option style="color: green" value="0">Normal</option>
                </select>
              </div>
            </div>
            <!-- end urgency -->

            <!-- due time date -->
            <div class="form-row">
              <div class="form-group col-md-12">
                <input type="datetime-local" class="form-control" id="date" name="dueDate">
                {!! $errors->first('date', '<small style="color:red;">:message</small>')      !!}

              </div>

            </div>

     <!-- end due time date -->

            <button type="submit" class="btn btn-primary float-right">Add</button>
        </form>

      <!-- end of branch -->

          </div>
        </div>
      </div>
    </div>
  <!-- End of add modal -->
   <!-- Edit Modal -->
   <div class="modal fade" id="editModal{{$project->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="AddModal{{$project->id}}" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="AddModal">{{$project->name}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- branch -->
          <form method="post" action="{{route('editProject')}}">
            @csrf
            <input type="hidden" value="{{$project->id}}" name="project">
            <!-- name -->
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="taskInput">Name</label>
                  <input type="text" class="form-control" id="name"   name="name">
                </div>
              </div>
              <!-- end name -->
              <!-- description -->
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="taskInput">Description</label>
                  <input type="text" class="form-control" id="description"   name="description">
                </div>
              </div>
              <!-- end description -->
              <!-- location -->
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="taskInput">Location</label>
                  <input type="text" class="form-control" id="location"   name="location">
                </div>
              </div>
              <!-- end location -->
              <div class="form-row">
              <div class="form-group col-md-12">
                <label for="objDescription">change Objective</label>
                <select id="Project" class="form-control" name="objectiveSelect">
                    <option value="null">No changes</option>
                  @foreach ($objectives as $objective)
              
                   <option value="{{$objective->id}}">{{$objective->description}}</option>
                   @endforeach
                </select>               
                 {!! $errors->first('Project', '<small style="color:red;">:message</small>') !!}
              </div>
              </div>
              </div>
              <button type="submit" class="btn btn-primary float-right">Update</button>
          </form>
        <!-- end of branch -->

            </div>
          </div>
        </div>
      </div>
    <!-- End of Edit modal -->
      <!-- delete modal -->
       <div class="modal fade" id="deleteModal{{$project->id}}" tabindex="-1" role="dialog"aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$project->name}} </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="color: red">
                If you delete objective all data in relation with will be deleted .
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form method="post" action="{{ route ('deleteProject') }}">
                  @csrf
                  <input type="hidden" value="{{$project->id}}" name="id">
                  <input type="submit" class="btn btn-danger" value="Delete">
                </form>
              </div>
            </div>
          </div>
       </div>
        <!-- end delete modal -->
          @foreach($project->tasks as $task)
  			  <tr>

  			    <th scope="row">{{$task->id}}</th>
  			    <td>{{$task->description}}</td>
            <!-- urgency -->
            <td>
              @if($task->urgency == 0)
                 <span style="color:green ; background-color: green">U</span></td>

              @elseif($task->urgency == 1)
                  <span style="color:orange ; background-color: orange">U</span></td>

              @else
                 <span style="color:red ; background-color: red">U</span></td>
              @endif
            </td>
            <!-- end urgency -->
  			    <td>{{$task->status}}</td>
            <td>
              <?php
                $reps  = $task->tasks()->get();
               ?>

              <!-- RESPONSIBILTY DRO DOWN MENUE  -->



                    @foreach($reps as $res)
                        <a class="dropdown-item" href="/dashboard/profile/ {{$res->user()->first()->id}}"> {{$res->user()->first()->name}}
                        </a>

                    @endforeach

               <!-- END RESPONSIBILTY  -->

            </td>

  			  </tr>

           @endforeach

  			</tbody>
        </table>
     </div>

	</div>
    <hr>
    @endforeach
</div>








@endsection
