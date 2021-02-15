<!--
	Author: W3layouts
	Author URL: http://w3layouts.com
	License: Creative Commons Attribution 3.0 Unported
	License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<head>
<title>Business Card</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta name="keywords" content="C-Resume a Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<!-- css -->
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{ asset('cresume/css/font-awesome.min.css')}}" />
<!-- //font-awesome icons -->
<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Yanone+Kaffeesatz:200,300,400,700" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('cresume/css/style.css') }}" type="text/css" media="all" />
<link rel="stylesheet" href="{{ asset('cresume/css/bootstrap.min.css') }}" type="text/css" media="all" />
<link rel="stylesheet" href="{{ asset('slider/slider.css') }}">
<style>

</style>
<!-- Default-JavaScript-File -->
	<script type="text/javascript" src="{{ asset('cresume/js/jquery-2.1.4.min.js') }}"></script>
	
	<script type="text/javascript" src="{{ asset('cresume/js/bootstrap.min.js') }}"></script>
<!-- //Default-JavaScript-File -->
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css')}}">
<style>
  body #toast-container > div {
	opacity: 1;
  }
</style>    
</head>
<body>
	 <!-- session flash messages -->
	 @include('layouts.inc.messagesContact')
	 <!-- ./messages end -->
<!-- banner -->
	<div class="w3-banner-top">
	<div class="agileinfo-dot">
			<div class="w3layouts_menu">
				<nav class="cd-stretchy-nav edit-content">
					<a class="cd-nav-trigger" href="#0"> Menu <span aria-hidden="true"></span> </a>
					<ul>
						<li><a href="#home" class="scroll"><span>Home</span></a></li>
						<li><a href="#about" class="scroll"><span>About</span></a></li>
						<li><a href="#experiences" class="scroll"><span>Experiences</span></a></li>
						<li><a href="#skills" class="scroll"><span>Skills</span></a></li> 
						<li><a href="#projects" class="scroll"><span>Projects</span></a></li>
						<li><a href="#contact" class="scroll"><span>Contact</span></a></li>
					</ul> 
					<span aria-hidden="true" class="stretchy-nav-bg"></span>
				</nav> 
			</div>

		<div class="w3-banner-grids">
			<div class="col-md-6 w3-banner-grid-left">
				<div class="w3-banner-img">
					<img src="{{ asset('storage/profile_images/'.$data->profile_image)}}" alt="profile_image">
					<h3 class="test">{{ $data->name }}</h3>
					<p class="test-p" >
						@if($skill_info->count() != 0)
							@for($i = 0; $i<count($skill_info); $i++)
							@if ($i==3)
								@php
									break;
								@endphp
							@endif
							@php
								if($i == count($skill_info)-1 || $i == 2){
								echo $skill_info[$i]->skill;
								}
								else{
								echo $skill_info[$i]->skill . ", ";
								}
							@endphp  
							@endfor
						@endif
					</p>
					<div class="text-center">
						@if (isset(Auth::user()->role) )
						@if (Auth::user()->role == "user")
						<a class="btn btn-danger mr-2 my-4" href="/userDashboard" >Dashboard</a>
						@endif
					@endif  
					</div>
				</div>
			</div>

			<div class="col-md-6 w3-banner-grid-right">
			<div class="w3-banner-text">
				@if($addInfo->career_goal != null)
				<h3>Career Goal</h3>
				<p>{{ $addInfo->career_goal }}</p>
				@endif
			</div>
				<div class=" w3-right-addres-1">
				<ul class="address">
								<li>
									<ul class="agileits-address-text ">
										<li class="agile-it-adress-left"><b>D.O.B</b></li>
										<li><span>:</span>{{ $data->dob }}</li>
									</ul>
								</li>
								<li>
									<ul class="agileits-address-text">
										<li class="agile-it-adress-left"><b>PHONE</b></li>
										<li><span>:</span>{{ $data->phone_number }}</li>
									</ul>
								</li>
								<li>
									<ul class="agileits-address-text">
										<li class="agile-it-adress-left"><b>ADDRESS</b></li>
										<li><span>:</span>{{ $data->address }}</li>
									</ul>
								</li>
								<li>
									<ul class="agileits-address-text">
										<li class="agile-it-adress-left"><b>E-MAIL</b></li>
										<li><span>:</span>{{ $data->email }}</li>
									</ul>
								</li>
								<li>
									<ul class="agileits-address-text">
										@if (isset($addInfo->languages))
										<li class="agile-it-adress-left"><b>Language</b></li>
										<li><span>:</span><a href="#">{{ $addInfo->languages }}</a></li>
										@endif
									</ul>
								</li>
							</ul> 

				</div>
				<div class="float-left">
					<div class="button-container">
					  @isset($addInfo->facebook_link)
					  <a class="btn btn-md" style="color:white;background: #3B5998;border-radius: 0px;" href="{{ $addInfo->facebook_link }}" title="Follow me on Facebook"><i class="fa fa-facebook"></i></a>         
					  @endisset
					  @isset($addInfo->twitter_link)
					  <a class="btn btn-md" style="color:white;background: #55ACEE;border-radius: 0px;" href="{{ $addInfo->twitter_link }}" title="Follow me on Twitter"><i class="fa fa-twitter"></i></a>
					  @endisset
					  @isset($addInfo->google_plus_link)
					  <a class="btn btn-md" style="color:white;background: #cb2027;border-radius: 0px;" href="{{ $addInfo->google_plus_link }}" title="Follow me on Google+"><i class="fa fa-google-plus"></i></a>
					  @endisset
					  @isset($addInfo->instagram_link)
					  <a class="btn btn-md" style="color:white;background: #C13584;border-radius: 0px;" href="{{ $addInfo->instagram_link }}" title="Follow me on Instagram"><i class="fa fa-instagram"></i></a>
					  @endisset
					</div>
				</div>
				
			</div>
			<div class="clearfix"></div>
		</div>
		</div>
		<div class="thim-click-to-bottom">
			<a href="#about" class="scroll">
				<i class="fa fa-chevron-down"></i>
			</a>
		</div>
	</div>
<!-- banner -->
<!-- /about -->

<div class="w3-about" id="about">
	<div class="container">
		<div class="w3-about-head">
			<h3>About me</h3>
		</div>
		<div class="w3-about-grids">
		<div class=" w3-about-grids1">
				<div class="col-md-6 w3-about-grid-left1">
					<img src="{{ asset('cresume/images/ab5.jpg')}}" alt="img1">
		
				</div>
				<div class="col-md-6 w3-about-grid-right1">
					<h3>Information</h3>
					<p>{{ $addInfo->about }}</p>
					<h5>Specialization in :</h5>
					<div class= "w3-about-grid-small-border">
						@if($skill_info->count() != 0)
							@for($i = 0; $i<count($skill_info); $i++)
							@if ($i==3)
								@php
									break;
								@endphp
							@endif
							<div class="col-md-4 w3-about-grid-small">
								<h3 class="w3-head-project">{{ $skill_info[$i]->score }}<span style="font-size: 20px;">%</span></h3>
								<h5>{{ $skill_info[$i]->skill  }}</h5>
							</div>		
							@endfor
						@endif
					
					
				<div class="clearfix"></div>
				</div>
				</div>
				<div class="clearfix"></div>
		</div>
	</div>
</div>
</div>
<!-- //about  -->
<!--/ experience -->
@if($exp_data->count() != 0 || $edu_data->count() != 0)
	<div class="w3-edu-top" id="experiences">
	<div class="container">
		<div class="w3-edu-grids">
			@if($exp_data->count() != 0)
			<div class="col-md-6 w3-edu-grid-left">
				<div class="w3-edu-grid-header">
				<h3>Experiences</h3>
				</div>
			@foreach ($exp_data as $row)
			<div class="col-md-4 w3-edu-info1">
				<p style="color: white;font-size:12px;margin-top:30px;">({{ date('F j,Y',strtotime($row->start_date)) }} to {{ date('F j,Y',strtotime($row->end_date)) }})</p>
				<h4>{{ $row->title }}</h4>
			</div>
			<div class="col-md-6 w3-edu-info2">
				<h3>{{ $row->company }}</h3>
					<p>{{ $row->about_exp }}</p>
			</div>
			<div class="clearfix"></div>
			@endforeach
			@endif		
			</div>
			<div class="col-md-6 w3-edu-grid-right">
			@if($edu_data->count() != 0)
				<div class="w3-edu-grid-header">
				<h3>Education</h3>
				</div>
				@foreach ($edu_data as $row)
				<div class="col-md-4">
					<p style="color: white;font-size:12px;margin-top:45px;">({{ date('F j, Y',strtotime($row->start_date)) }} to {{ date('F j, Y',strtotime($row->end_date)) }})</p>
				</div>
				<div class="col-md-8 w3-edu-info-right2">
					<h3>{{ $row->institute }}</h3>
						<h4>{{ $row->course }}</h4>
						<p>{{ $row->about_course }}</p>
				</div>
				<div class="clearfix"></div>
				@endforeach
			@endif	
			</div>
		<div class="clearfix"></div>	
	</div>
	</div>
	</div>
<!-- //education -->
@endif
@if($skill_info->count() != 0)
<!-- skills -->
<div class="skills" id="skills">
	<div class="container">
	<div class="title-w3ls">
		<h4>My Skills</h4>
		</div>
		<div class="skills-bar">
		<div class="w3-agile-skills-grid">
			<section class='bar'>
				<section class='wrap'>
					<div class='wrap_right'>
					  <div class='bar_group' max="100">
						@foreach ($skill_info as $row)
						<div class='bar_group__bar thin' label='{{ $row->skill }}' show_values='true' tooltip='true' value='{{ $row->score }}' ></div>
						@endforeach
					  </div>
					</div>
					<div class="clearfix"></div>
				</section>
			</section>
		</div>
		<div class="clearfix"></div>
		</div>
	</div>
</div>
<!-- //skills -->
@endif

@if($portfolio->count() != 0)
<!-- main-content -->
<div class="main-content">
	<!-- gallery -->
<div class="gallery" id="projects">
	<div class="w3-gallery-head" style="margin-bottom: 0px;">
		<h3>Portfolio</h3>
	</div>
<div class="container">
	<div class="gallery_gds">
		<div class="filtr-container" id="result_ajax" style="padding: 0px; position: relative; height: 400px;">
			@include('pages.user.renderPortfolioCresume')
		</div>
	</div>
</div>	
</div>
<!--//gallery-->
</div>
@endif
@if($portfolio_modal->count() != 0)
@foreach ($portfolio_modal as $item)
<!-- //modal-content -->				 
<div class="modal fade" id="myModal{{ $item->id }}" tabindex="-1" role="dialog" >
<div class="modal-dialog">
			<!-- Modal content-->
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="w3ls-property-images">
				<img src="{{ asset('storage/portfolio_images/'. $item->portfolio_image) }}" alt="image">
			</div>
		<div class="ins-details">
			<div class="ins-name">
				<h3>{{ $item->image_title }}</h3>
				<p>{{ $item->about_image }}</p>
			</div>
		</div>		
	</div>
</div>
<!-- modal end -->
@endforeach	
@endif 	

@if($ref_data->count() != 0)
<!-- slider  --> 
<div class="container">
	<div class="row">
	  <div class='col-md-offset-2 col-md-8 text-center'>
	  <h2>References</h2>
	  </div>
	</div>
	<div class='row'>
	  <div class='col-md-offset-2 col-md-8' style="margin-bottom: 100px;">
		<div class="carousel slide" data-ride="carousel" id="quote-carousel" style="position: relative;"> 
		  <!-- Bottom Carousel Indicators -->
		  <ol class="carousel-indicators">
			@php
			$count_ind = 0;
		  	@endphp
		  	@foreach ($ref_data as $row)
				<li data-target="#quote-carousel" data-slide-to="{{ $count_ind }}" class="@if($count_ind == 0) active @endif"></li>
			@php
			$count_ind++;
			@endphp
			@endforeach
		  </ol>
		  
		  <!-- Carousel Slides  -->
		  <div class="carousel-inner">
			@php
				$count = 0;
			@endphp
			@foreach ($ref_data as $row)
			<!-- slide -->
			<div class="item @if($count == 0) active @endif">
			  <blockquote>
				<div class="row">
				  <div class="col-sm-3 text-center">
					<img class="img-circle" src="{{ asset('storage/references_images/'.$row->ref_image) }}" style="width: 100px;height:100px;">
				  </div>
				  <div class="col-sm-9">
					<p>{{ $row->ref_about }}</p>
					<small>{{ $row->name }} ({{ $row->designation }} / {{ $row->company }})</small>
				  </div>
				</div>
			  </blockquote>
			</div>
			@php
				$count++;
			@endphp
			@endforeach
		  </div>
		  
		  <!-- Carousel Buttons Next/Prev -->
		  <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
		  <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
		</div>                          
	  </div>
	</div>
  </div>
<!-- ./slider end -->
@endif
 <script src="{{ asset('cresume/js/jquery.filterizr.js')}}"></script>
    
    <!-- Kick off Filterizr -->
    <script type="text/javascript">
       
    </script>

<!-- contact -->
	 <div class="contact" id="contact">
	<div class="container">
		<div class="w3ls-heading">
			<h3>Contact me</h3>
		</div>
			<div class="contact-w3ls">
				<form action="/contactUser/{{ $data->id }}" method="post">
					@csrf
					<div class="col-md-7 col-sm-7 contact-left agileits-w3layouts">
						<input type="text" name="name" placeholder="Name" minlength="2" maxlength="255" value="{{ old('name') }}" required>
						@error('name')
                              <small class="text-danger">
                                <strong>{{ $message }}</strong>
                              </small>
                          @enderror
						<input type="email"  class="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
						@error('email')
                              <small class="text-danger">
                                <strong>{{ $message }}</strong>
                              </small>
                        @enderror
						<input type="text" name="subject" placeholder="Subject" minlength="2" maxlength="255" value="{{ old('subject') }}" required>
						@error('subject')
                              <small class="text-danger">
                                <strong>{{ $message }}</strong>
                              </small>
                        @enderror
						<!-- <input type="text" class="email" name="Last Name" placeholder="Last Name" required=""> -->
					</div> 
					<div class="col-md-5 col-sm-5 contact-right agileits-w3layouts">
						<textarea name="message" placeholder="Message" required>{{ old('message') }}</textarea>
						@error('message')
                              <small class="text-danger">
                                <strong>{{ $message }}</strong>
                              </small>
                          @enderror
						<input type="submit" value="Submit">
					</div>
					<div class="clearfix"> </div> 
				</form>
			</div>  

	</div>
</div>
<!-- //contact -->
<!-- footer -->
	<div class="w3l_footer">
		<div class="container">
			
			<div class="w3ls_footer_grids">
				
				<div class="w3ls_footer_grid">
					<div class="col-md-4 w3ls_footer_grid_left">
						<div class="w3ls_footer_grid_leftl">
							<i class="fa fa-map-marker" aria-hidden="true"></i>
						</div>
						<div class="w3ls_footer_grid_leftr">
							<h4>Location</h4>
							<p>{{ $data->address }}</p>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="col-md-4 w3ls_footer_grid_left">
						<div class="w3ls_footer_grid_leftl">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</div>
						<div class="w3ls_footer_grid_leftr">
							<h4>Email</h4>
							<p>{{ $data->email }}</p>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="col-md-4 w3ls_footer_grid_left">
						<div class="w3ls_footer_grid_leftl">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</div>
						<div class="w3ls_footer_grid_leftr">
							<h4>Call Me</h4>
							<p>{{ $data->phone_number }}</p>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>

		<div class="container text-center" >
			<h4 class="py-2" style="color: whitesmoke;">Share Business Card <span class="fa fas fa-share-alt"></span></h4>  
			<a class="btn" style="color:white;background: #3B5998;border-radius:0px;" href="{{ Share::page(URL::current(), 'Share on facebook')->facebook()->getRawLinks() }}"><i class="fa fa-facebook fa-2x " aria-hidden="true"></i></a>
			<a class="btn" style="color:white;background: #25D366;border-radius:0px;" href="{{ Share::page(URL::current(), 'Share on whatsapp')->whatsapp()->getRawLinks() }}"><i class="fa fa-whatsapp fa-2x " aria-hidden="true"></i></a>
			<a class="btn" style="color:white;background: #cb2027;border-radius:0px;" href="{{ Share::page(URL::current(), 'Share on pinterest')->pinterest()->getRawLinks() }}"><i class="fa fa-pinterest fa-2x" aria-hidden="true"></i></a>
			<a class="btn" style="color:white;background: #0088cc;border-radius:0px;" href="{{ Share::page(URL::current(), 'Share on telegram')->telegram()->getRawLinks() }}"><i class="fa fa-paper-plane fa-2x" aria-hidden="true"></i></a>
			<a class="btn" style="color:white;background: #55ACEE;border-radius:0px;" href="{{ Share::page(URL::current(), 'Share on twitter')->twitter()->getRawLinks() }}"><i class="fa fa-twitter fa-2x " aria-hidden="true"></i></a>
			<a class="btn" style="color:white;background: #ff5700;border-radius:0px;" href="{{ Share::page(URL::current(), 'Share on reddit')->reddit()->getRawLinks() }}"><i class="fa fa-reddit fa-2x" aria-hidden="true"></i></a>
			<a class="btn" style="color:white;background: #007bb5;border-radius:0px;" href="{{ Share::page(URL::current(), 'Share on linkedin')->linkedin()->getRawLinks() }}"><i class="fa fa-linkedin fa-2x" aria-hidden="true"></i></a>
			<a class="btn" style="color:white;background: #FFCC00;border-radius:0px;" href="sms:?&body={{ URL::current() }}"><i class="fa fa-envelope fa-2x" aria-hidden="true"></i></a>
		</div>

		<div class="w3l_footer_pos">
			<p>© 2017 C-Resume. All Rights Reserved | Design by <a href="https://w3layouts.com/">W3layouts</a></p>
		</div>
	</div>
<!-- //footer -->
<script src="{{ asset('cresume/js/bars.js') }}"></script>
<!-- start-smoth-scrolling -->
<script src="{{ asset('cresume/js/SmoothScroll.min.js') }}"></script>
<!-- text-effect -->
		<script type="text/javascript" src="{{ asset('cresume/js/jquery.transit.js') }}"></script> 
		<script type="text/javascript" src="{{ asset('cresume/js/jquery.textFx.js') }}"></script> 
		<script type="text/javascript">
			$(document).ready(function() {
					$('.test').textFx({
						type: 'fadeIn',
						iChar: 100,
						iAnim: 1000
					});
					$('.test-p').textFx({
						type: 'fadeIn',
						iChar: 30,
						iAnim: 100
					});
			});
		</script>
<!-- //text-effect -->
<!-- menu-js --> 	
	<script src="{{ asset('cresume/js/modernizr.js') }}"></script>	
	<script src="{{ asset('cresume/js/menu.js') }}"></script>
<!-- //menu-js --> 	


<script type="text/javascript" src="{{ asset('cresume/js/move-top.js') }}"></script>

<script type="text/javascript" src="{{ asset('cresume/js/easing.js') }}"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
 <script src="{{ asset('js/share.js') }}"></script>
 <script>
	$(document).ready(function(){

	 $(document).on('click', '.pagination a', function(event){
	 event.preventDefault(); 
	 var page = $(this).attr('href').split('page=')[1];
	 fetch_data(page);
	 });

   function fetch_data(page)
   {
	 $.ajax({
	   url:"/fetch_data_cresume/{{ $data->name_slug }}?page="+page,
	   success:function(data)
	   {
	   $('#result_ajax').html(data);
	   }
	 });
   }
   
   
   });
// slider
$(document).ready(function() {
  //Set the carousel options
  $('#quote-carousel').carousel({
    pause: true,
    interval: 4000,
  });
});
</script>
<!-- Toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
</body>
</html>
