@extends('layouts.dashboard')
@section('dashboard_heading')
  <p> SOCIAL STATISTICS </p>
@endsection
@section('dashboard_content')
 <div class="container-fluid">
   <div id="app-tasks">
      <stable-component > </stable-component>
   </div>
    
</div>
 <!-- End of user section -->
@endsection
<!-- add scripts  -->
@section('dashboard_scripts') 
 <script src="{{ asset('js/app.js') }}"></script>
@endsection
