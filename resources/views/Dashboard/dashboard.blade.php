@extends('layouts.dashboard')

@section('dashboard_CSS')
{{-- animated --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  @endsection
@section('dashboard_content')
<div class="container">
	<div class="row" >
		<div class="col-md-9 offset-md-1 mt-4" >
			<div class="card text-center">
  				<div class="card-body"  >
					<h6 class="card-title" >Dashboard</h6>
					<h6 class="card-text" style="color:#6e2771;">Welcome , {{Auth::user()->name}}</h6>
				  </div>
				<h1 style="font-size:20px !important;color:#6e2771;" class="mt-4">About Mishkat nour  </h1>

				  <ul class="nav nav-tabs" id="myTab" role="tablist" >
						<li class="nav-item" role="presentation">
						  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" style="font-size:13px;" aria-selected="true">Vision</button>
						</li>
						<li class="nav-item" role="presentation">
						  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" style="font-size:13px;" aria-selected="false">photos</button>
						</li>
						
					  </ul>
					  <div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="home" role="tabpanel" style="background:linear-gradient(3deg, #505fc8, #f5f5f5);height:100%; " 	 aria-labelledby="home-tab">
								<div class="row " >
										{{-- <div  class="col-md-1"></div> --}}
										<div  class="col-md-11">
											<h1 class="dash_title" style="font-size:15px !important; margin-top:30px; width:100%; margin-left:5%; padding:5px; background-color: #ba8ecebd; border-radius: 80px 0px;"  >A video explaining the vision of <span style="color:#6e2771;"> Mishkat Nour </span>  and Ethics kiosk.</h1>
										</div>
									<div  class="col-md-1"></div>
								 <div  class="col-md-10">
										<video  style="margin-left:10%;margin-top:5%;" width="100%"  controls  poster="{{asset('images/video-img.png') }}">
												<source src="{{asset('videos/Final_koshk.mp4') }}" title="mishkat nour Vision" alt="mishkat nour Vision" type="video/mp4">
													Your browser does not support the video tag.
											</video>		
										</div>
										
										<div style="margin-left:8%;margin-top:5%;margin-bottom:4%;"  class=" col-md-10 talk animate__animated animate__fadeInUp ">
	
												إن التنمية المُسْتَدامَة لا تقوم إلا على عُنْصُر الإنسان، فإذا كان سلُوك الإنسان سَيِّئًا وتصرُّفاته تِجَاه المجتمع سَيِّئَةً، فإن مُعدَّلات التنمية المُسْتَدامَة ستكون مُنْخَفِضة .
													والعكس صحيح: ترتفع مُعدَّلات التنمية بالسُّلُوكِيَّات الإيجابية تِجَاه المجتمع.
													إذَنْ السلوك عامل رئيس في التنمية، ولكي نرتقي بالسلوك جاءت فكرة « كُشْك أخْلاق » الذي تقدمه مؤسسة « مِشْكَاة نُور» والذي يُعَدُّ التجربة الأولى في العالم للنُّهوض بالسلوكيات العامة التي تسببت في تَجْريف المجتمع لعُقُود طويلة.
													و التي تقوم على رسم خارطة طريق جديدة للمجتمع المدني؛ بأنه في خلال 40 عامًا سيتغير شكل المُساعدات الاجتماعية، بحيث لا تَنْحَصِر علَى كراتين ومساعدات وَقْتِيَّة، بل مساعدات أكثر نفعًا للإنسان، وسيتغير شكل المجتمع من الاستهلاك والاتِّكَالِيَّة والكَسَل إلى الإنتاج والنشاط والتقدم، مما سيرفع بكل تأكيد مُعَدلات التنمية المُسْتَدامَة التي كادت تُقَاتِل وحْدَها في ساحات النُّمُو السُّكاني المُدَمِّر بغير تَوْعِيَة أو ضَبْط .
																على المجتمع المدني أن يَعِي أن دوره المُسْتَقبلي يجب أن لا يُنْحَصِرعلى الإطعام وتقديم المال ودفع الديون إلَّا لحالات فَرْدِيَّة ليس لها عائل؛ ككبار السن والأرامِل وأصحاب الحالات من الأطفال المُشَرَّدِين والأيتام 
													
												</div>
							 </div>
							
							 
						</div>
						<div class="tab-pane fade" id="profile" role="tabpanel" style="background:linear-gradient(3deg, #505fc8, #f5f5f5);height:100%;" aria-labelledby="profile-tab">
								<div class="row " style="padding-top:50px;">
										
										<div class=" mt-4 col-md-6 animate__animated animate__fadeInLeft">
											<img width="100%" height="100%" src="{{asset('images/vision/s1.jpg')}}" title="mishkat Vision" alt="">
										</div>
										<div class=" mt-4 col-md-6 animate__animated animate__fadeInRight">
												<img width="100%"  height="100%" src="{{asset('images/vision/s2.jpg')}}" title="mishkat Vision" alt="">
											</div>
									<div style="margin-bottom:10%;" class="mt-4 col-md-12 animate__animated animate__fadeInBottomRight">
											<img width="100%" height="100%" src="{{asset('images/vision/s3.jpg')}}" title="mishkat Vision" alt="">
										</div>
								</div>
						</div>
						<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">.cc..</div>
					  </div>


		
			 </div>
		</div>
	</div>
</div>
@endsection

@section('dashboard_scripts')
 <!-- Option 1: Bootstrap Bundle with Popper -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endsection
