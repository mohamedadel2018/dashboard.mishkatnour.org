@extends('layouts.dashboard')
@section('dashboard_content')
<div class="container">
<br> <br>
<div id="user" class="mt-4">
  <div class="row">
    <div class="col-md-4 offset-md-4">
      <h3 style="color: grey">Add Project</h3>
    </div>
    <div class="col-md-8 offset-md-2">

      <form method="post" action="{{ route ('addProject')}}"  autoComplete="off">
        @csrf
          
        <!-- Objective description -->
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="objDescription">Objective</label>
              <select id="objective" class="form-control" name="id">
                @foreach ($objectives as $objective)
                 <option value="{{$objective->id}}">{{$objective->id}} - {{$objective->description}}</option>
                 @endforeach
              </select>               
               {!! $errors->first('objective', '<small style="color:red;">:message</small>') !!}

            </div>
          </div>
          <!-- end of ojective Description -->
          <!-- project -->
          <fieldset class="border p-2">

              <legend style="color: grey">Projects:</legend>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="objDescription">Select Project</label>
                  <select id="Project" class="form-control" name="projectSelect">
                      <option value="{{null}}">No One</option>
                    @foreach ($projects as $project)
                     <option value="{{$project->id}}">{{$project->name}} - {{str_limit($project->location)}}</option>
                     @endforeach
                  </select>               
                   {!! $errors->first('Project', '<small style="color:red;">:message</small>') !!}
    
                </div>
              </div>
              <!-- project Name -->
               	 <div class="form-row">
               	 	<div class="form-group col-md-12">
               	 	    <label for="projectName">Add a new Project Name</label>
               	 	    <input type="text" class="form-control" id="projectName" name="projectName">
                      {!! $errors->first('projectName', '<small style="color:red;">:message</small>') !!}

               	 	</div>
               	 </div>
                 <!-- end project Name -->
                 <!-- project description -->
               	 <div class="form-row">
               	 	<div class="form-group col-md-12">
               	 	    <label for="proDescription">Project Description <h6> (Only for new Project name)</h6></label>
               	 	    <input type="text" class="form-control" id="proDescription" name="proDescription">
                      {!! $errors->first('proDescription', '<small style="color:red;">:message</small>') !!}

               	 	</div>
               	 </div>
                 <!-- end project description -->

                 <!-- project Location -->
 			           <div class="form-row">
               	  	<div class="form-group col-md-12">
               	 	    <label for="projectLocation" >Project Location</label>
               	 	    <input type="text" class="form-control" id="projectLocation" name="projectLocation">
                      {!! $errors->first('projectLocation', '<small style="color:red;">:message</small>') !!}

               	  	</div>
               	  </div>
                  <!-- end project Location -->

                        <!-- project Branch -->
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <label for="projectLocation" >Project Branch</label>
                      <select name="branch[]" style="height:80px !important;" class="form-control" multiple>
                        @foreach ($Branches as $branch)
                          <option value="{{$branch->id}}">{{$branch->id}} - {{$branch->name}} </option>
                          @endforeach
                        </select>               
                        {!! $errors->first('branch', '<small style="color:red;">:message</small>') !!}
                    </div>
                  </div>
            
                   
                  <!-- end brNCH -->
      
            </fieldset>
          <!-- end of project -->
          
           
          <br>
          <button type="submit" class="btn btn-primary">Add</button>
      </form>
    </div>
  </div>
</div>
@endsection