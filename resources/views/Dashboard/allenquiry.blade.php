@extends('Dashboard.structure')

{{-- @section('dashboard_CSS')
<link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
@endsection --}}

@section('dashboard_heading')
  <p> all Enquiries </p>
@endsection
@section('structure_content') 
	<div id="app-tasks">
		<div class="row">
			<div class="col-md-12">
				<allenquiry-component></allenquiry-component>
			</div>
			
		</div>
		
	</div>
 @endsection
 @section('dashboard_scripts') 
 <script src="{{ asset('js/app.js') }}"></script>
 <script>
    new Vue({
      el: '#app-tasks',
      data: function() {
        return { visible: false }
      }
    })
  </script>
@endsection