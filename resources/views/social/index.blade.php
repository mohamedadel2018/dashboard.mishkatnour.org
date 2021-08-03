@extends('Dashboard.structure')
@section('dashboard_heading')
  <p> SOCIAL </p>
@endsection
@section('dashboard_content')
   <div class="container ">
   		<div class="row">
   			<div class="col-md-4 offset-md-4">
   				 <input id="myInput" class="form-control"type="text" placeholder="Search..">
   			</div>
   		</div>
     	<div class="row ">
   		   <div class="col-md-8 offset-md-2 mt-4">
   			  <div style="overflow-x:auto; overflow-y: auto;
                  height:700px;">
                      <table class="table table-bordered table-fixed text-center">
                      	<thead>
                      		<th> ID</th>
                      		<th> Date</th>
                      		<th> Created At</th>
                      		<th><button class="btn btn-primary" data-toggle="modal" data-target="#createTableModal">Create New </button></th>
                      	</thead>
                      	<tbody id="myTable" >
                      		@foreach($tables as $table)
                      		   <tr>
                         			<td> {{ $table->id}}</td>
                         			<td> {{ date("M , Y", strtotime($table->date)) }}</td>
                         			<td><small>{{$table->created_at}}</small></td>
                         			<td> 
                         				<form method="post" action="{{ route('showSocialTable' ,  [$table->id])}}">
                         					@csrf
                         						<input type="submit" class="btn btn-primary" value="show">
                         				</form>
                         			</td>
                         		</tr>

                      		@endforeach
                      	</tbody>
                      </table>
                </div>
            </div>
   		</div>
   		
   	</div>

   	<!-- modals -->
   		<!-- createTableModal -->
   			<div class="modal fade" id="createTableModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
             <div class="modal-dialog">
               <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="staticBackdropLabel">Create New Table</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                 </div>
                 <div class="modal-body">
                   <form method="post" action="{{ route('createSocialTable')}}">
                   	@csrf
                     <div class="form-row">
                     	<!-- Date -->
                       <div class="col">
                       	<label>Select Year and month </label>
                         <input type="month" class="form-control" name="date" required>
                       </div>
                       <!-- end Date -->
                     </div>
                     <div class="form-row mt-4">
                     <input type="submit" class="btn btn-primary float-right">
                  	 </div>
                   </form>
                 </div>
               </div>
             </div>
           </div>

   		<!-- end createTableModal -->

   	<!-- end modals -->
    

 <!-- End of user section -->
@endsection
<!-- add scripts  -->
@section('dashboard_scripts') 
 <script src="{{ asset('js/app.js') }}"></script>
@endsection
