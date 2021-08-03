@extends('Dashboard.structure')

{{-- @section('dashboard_CSS')
<link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
@endsection --}}

@section('dashboard_heading')
  <p> Enquiries </p>
@endsection
@section('structure_content') 
	<div id="app-tasks">
		<div class="row">
			<div class="col-md-12">
				<enquiry-component></enquiry-component>
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



{{-- @section('dashboard_scripts')
<script src="https://unpkg.com/vue/dist/vue.js"></script>
<!-- import JavaScript -->
<script src="https://unpkg.com/element-ui/lib/index.js"></script>
@endsection --}}