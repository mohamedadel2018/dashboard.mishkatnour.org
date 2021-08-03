@extends('layouts.dashboard')

@section('dashboard_content')
 <div class="container-fluid">
   <div id="app-tasks">
      <table-component table_id ="{{$id}}" > </table-component>
   </div>
    
</div>
 <!-- End of user section -->
@endsection
<!-- add scripts  -->
@section('dashboard_scripts') 
 <script src="{{ asset('js/app.js') }}"></script>
@endsection
