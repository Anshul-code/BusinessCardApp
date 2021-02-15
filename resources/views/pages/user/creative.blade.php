<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Business Card</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200'" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('creative/css/aos.css?ver=1.1.0') }}" rel="stylesheet">
    <link href="{{ asset('creative/css/bootstrap.min.css?ver=1.1.0') }}" rel="stylesheet">
    <link href="{{ asset('creative/css/main.css?ver=1.1.0') }}" rel="stylesheet">
    <noscript>
      <style type="text/css">
        [data-aos] {
            opacity: 1 !important;
            transform: translate(0) scale(1) !important;
        }

      </style>
    </noscript>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css')}}">
    <style>
      body #toast-container > div {
        opacity: 1;
      }
    </style>
  </head>
  <body id="top">
    <!-- session flash messages -->
      @include('layouts.inc.messagesContact')
    <!-- ./messages end -->
    <header>
      <div class="profile-page sidebar-collapse">
        <nav class="navbar navbar-expand-lg fixed-top navbar-transparent bg-primary" color-on-scroll="400">
          <div class="container">
            <div class="navbar-translate"><a class="navbar-brand" href="#" rel="tooltip">Business Card</a>
              <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-bar bar1"></span><span class="navbar-toggler-bar bar2"></span><span class="navbar-toggler-bar bar3"></span></button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">
              <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link smooth-scroll" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link smooth-scroll" href="#skill">Skills</a></li>
                <li class="nav-item"><a class="nav-link smooth-scroll" href="#portfolio">Portfolio</a></li>
                <li class="nav-item"><a class="nav-link smooth-scroll" href="#experience">Experience</a></li>
                <li class="nav-item"><a class="nav-link smooth-scroll" href="#contact">Contact</a></li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <div class="page-content">
    <div>
<div class="profile-page">
  <div class="wrapper">
    <div class="page-header page-header-small" filter-color="green">
      <div class="page-header-image" data-parallax="true" style="background-image: url('{{ asset('creative/images/cc-bg-1.jpg') }}')"></div>
      <div class="container">
        <div class="content-center">
          <div class="cc-profile-image"><a href="#contact" class="smooth-scroll"><img src="{{ asset('/storage/profile_images/'.$data->profile_image) }}" alt="Profile-Image"/></a></div>
        <div class="h2 title">{{ $data->name }}</div>
          <p class="category text-white">
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
          <a class="btn btn-primary smooth-scroll mr-2" href="#contact" data-aos="zoom-in" data-aos-anchor="data-aos-anchor">Hire Me</a>
          @if (isset(Auth::user()->role) )
            @if (Auth::user()->role == "user")
            <a class="btn btn-danger smooth-scroll mr-2" href="/userDashboard" data-aos="zoom-in" data-aos-anchor="data-aos-anchor">Dashboard</a>
            @endif
          @endif  
        </div>
      </div>
      <div class="section">
        <div class="container">
          <div class="button-container">
            @isset($addInfo->facebook_link)
            <a class="btn btn-default btn-round btn-lg btn-icon" href="{{ $addInfo->facebook_link }}" rel="tooltip" title="Follow me on Facebook"><i class="fa fa-facebook"></i></a>         
            @endisset
            @isset($addInfo->twitter_link)
            <a class="btn btn-default btn-round btn-lg btn-icon" href="{{ $addInfo->twitter_link }}" rel="tooltip" title="Follow me on Twitter"><i class="fa fa-twitter"></i></a>
            @endisset
            @isset($addInfo->google_plus_link)
            <a class="btn btn-default btn-round btn-lg btn-icon" href="{{ $addInfo->google_plus_link }}" rel="tooltip" title="Follow me on Google+"><i class="fa fa-google-plus"></i></a>
            @endisset
            @isset($addInfo->instagram_link)
            <a class="btn btn-default btn-round btn-lg btn-icon" href="{{ $addInfo->instagram_link }}" rel="tooltip" title="Follow me on Instagram"><i class="fa fa-instagram"></i></a>
            @endisset
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="section" id="about">
  <div class="container">
    <div class="card" data-aos="fade-up" data-aos-offset="10">
      <div class="row">
        <div class="col-lg-6 col-md-12">
          <div class="card-body">
            <div class="h4 mt-0 title">About</div>
            @if(isset($addInfo->about))
            {{ $addInfo->about }}
            @endif
          </div>
        </div>
        <div class="col-lg-6 col-md-12">
          <div class="card-body">
            <div class="h4 mt-0 title">Basic Information</div>
            <div class="row">
              <div class="col-sm-4"><strong class="text-uppercase">DOB:</strong></div>
            <div class="col-sm-8">{{ $data->dob }}</div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-4"><strong class="text-uppercase">Email:</strong></div>
            <div class="col-sm-8">{{ $data->email }}</div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-4"><strong class="text-uppercase">Phone:</strong></div>
            <div class="col-sm-8">{{ $data->phone_number }}</div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-4"><strong class="text-uppercase">Address:</strong></div>
            <div class="col-sm-8">{{ $data->address }}</div>
            </div>
            @isset($addInfo->languages)
            <div class="row mt-3">
              <div class="col-sm-4"><strong class="text-uppercase">Language:</strong></div>
            <div class="col-sm-8">{{ $addInfo->languages }}</div>
            </div>
            @endisset
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@if($skill_info->count() != 0)
<div class="section" id="skill">
  <div class="container">
    <div class="h4 text-center mb-4 title">Professional Skills</div>
    <div class="card" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
      <div class="card-body">
        <div class="row">
          @foreach ($skill_info as $row)
          <div class="col-md-6">
            <div class="progress-container progress-primary"><span class="progress-badge">{{ $row->skill }}</span>
              <div class="progress">
                <div class="progress-bar progress-bar-primary" data-aos="progress-full" data-aos-offset="10" data-aos-duration="2000" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $row->score }}%;"></div><span class="progress-value">@php if($row->score == 0){ echo ''; }else{ echo $row->score."%"; } @endphp</span>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endif
@if($portfolio->count() != 0)
<!-- ./portfolio start -->
<div class="section" id="portfolio">
  <div class="container">
    <div class="row">
      <div class="col-md-6 ml-auto mr-auto">
        <div class="h4 text-center mb-4 title">Portfolio</div>
      </div>
    </div>
    
    <div class="tab-content gallery mt-5">
      <div class="tab-pane active">
        <div class="ml-auto mr-auto">
          <div id="result_ajax">
            @include('pages.user.renderPortfolio')
          </div>
        </div>
        
      </div>
    </div>
    
  </div>
</div>
@endif
<!-- ./portfolio end -->
@if($exp_data->count() != 0)
<!-- experience start -->
<div class="section" id="experience">
  <div class="container cc-experience">
    <div class="h4 text-center mb-4 title">Work Experience</div>
    @foreach ($exp_data as $row)
    <div class="card">
      <div class="row">
        <div class="col-md-3 bg-primary" data-aos="fade-right" data-aos-offset="50" data-aos-duration="500">
          <div class="card-body cc-experience-header">
            <p>{{ date('F j, Y',strtotime($row->start_date)) }} - {{ date('F j, Y',strtotime($row->end_date)) }}</p>
            <div class="h5">{{ $row->company }}</div>
          </div>
        </div>
        <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
          <div class="card-body">
            <div class="h5">{{ $row->title }}</div>
            <p>{{ $row->about_exp }}</p>
          </div>
        </div>
      </div>
    </div>  
    @endforeach
  </div>
</div>
@endif
<!-- education start -->
@if($edu_data->count() != 0)
<div class="section">
  <div class="container cc-education">
    <div class="h4 text-center mb-4 title">Education</div>
    @foreach ($edu_data as $row)
    <div class="card">
      <div class="row">
        <div class="col-md-3 bg-primary" data-aos="fade-right" data-aos-offset="50" data-aos-duration="500">
          <div class="card-body cc-education-header">
            <p>{{ date('F j, Y',strtotime($row->start_date)) }} - {{ date('F j, Y',strtotime($row->end_date)) }}</p>
            <div class="h5">{{ $row->institute }}</div>
          </div>
        </div>
        <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
          <div class="card-body">
            <div class="h5">{{ $row->course }}</div>
            <p class="category">{{ $row->institute }}</p>
            <p>{{ $row->about_course }}</p>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
<!-- ./education close -->
@endif
@if($ref_data->count() != 0)
<!-- reference start -->
<div class="section" id="reference">
  <div class="container cc-reference">
    <div class="h4 mb-4 text-center title">References</div>
    <div class="card" data-aos="zoom-in">
      <div class="carousel slide" id="cc-Indicators" data-ride="carousel">
        <ol class="carousel-indicators">
          @php
            $count_ind = 0;
          @endphp
          @foreach ($ref_data as $row)
            <li class="@if($count_ind == 0) active @endif" data-target="#cc-Indicators" data-slide-to="{{ $count_ind }}"></li>
            @php
                $count_ind++;
            @endphp
          @endforeach
        </ol>
        <div class="carousel-inner">
          @php
              $count = 0;
          @endphp
          @foreach ($ref_data as $row)
          @php
              ++$count;
          @endphp
          <div class="carousel-item @if($count == 1) active @endif">
            <div class="row">
              <div class="col-lg-3 col-md-3 cc-reference-header"><img src="{{ asset('storage/references_images/'.$row->ref_image)}}" alt="Image"/>
                <div class="h5 pt-2">{{$row->name}}</div>
                <p class="category">{{ $row->designation }} / {{ $row->company }}</p>
              </div>
              <div class="col-lg-9 col-md-9">
                <p>{{ $row->ref_about }}</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endif
<!-- reference end -->
<div class="section" id="contact">
  <div class="cc-contact-information" style="background-image: url('{{ asset('creative/images/staticmap.png')}}')">
    <div class="container">
      <div class="cc-contact">
        <div class="row">
          <div class="col-md-9">
            <div class="card mb-0" data-aos="zoom-in">
              <div class="h4 text-center title">Contact Me</div>
              <div class="row">
                <div class="col-md-6">
                  <div class="card-body">
                    <!-- contact form -->
                    <form action="/contactUser/{{ $data->id }}" method="POST">
                      @csrf
                      <div class="p pb-3"><strong>Feel free to contact me </strong></div>
                      <div class="row mb-3">
                        <div class="col">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                            <input class="form-control" type="text" name="name" placeholder="Name" minlength="2" maxlength="255" value="{{ old('name') }}" required="required"/>
                          </div>
                          @error('name')
                              <small class="text-danger">
                                <strong>{{ $message }}</strong>
                              </small>
                          @enderror
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                            <input class="form-control" type="text" name="subject" minlength="2" maxlength="255" placeholder="Subject" value="{{ old('subject') }}" required="required"/>
                          </div>
                          @error('subject')
                              <small class="text-danger">
                                <strong>{{ $message }}</strong>
                              </small>
                          @enderror
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input class="form-control" type="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required="required"/>
                          </div>
                          @error('email')
                              <small class="text-danger">
                                <strong>{{ $message }}</strong>
                              </small>
                          @enderror
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col">
                          <div class="form-group">
                            <textarea class="form-control" name="message" minlength="2" maxlength="255" placeholder="Your Message" required="required">{{ old('message') }}</textarea>
                          </div>
                          @error('message')
                              <small class="text-danger">
                                <strong>{{ $message }}</strong>
                              </small>
                          @enderror
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <button class="btn btn-primary" type="submit">Send</button>
                        </div>
                      </div>
                    </form>
                    <!-- ./contact form end -->
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card-body">
                    <p class="mb-0"><strong>Address </strong></p>
                    <p class="pb-2">{{ $data->address }}</p>
                    <p class="mb-0"><strong>Phone</strong></p>
                    <p class="pb-2">{{ $data->phone_number }}</p>
                    <p class="mb-0"><strong>Email</strong></p>
                    <p>{{ $data->email }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div></div>
    </div>
    <footer class="footer">
      {{-- <div class="container text-center">
        @isset($addInfo->facebook_link)
        <a class="cc-facebook btn btn-link" href="{{ $addInfo->facebook_link }}"><i class="fa fa-facebook fa-2x " aria-hidden="true"></i></a>
        @endisset
        @isset($addInfo->twitter_link)
        <a class="cc-twitter btn btn-link " href="{{ $addInfo->twitter_link }}"><i class="fa fa-twitter fa-2x " aria-hidden="true"></i></a>
        @endisset
        @isset($addInfo->google_plus_link)
        <a class="cc-google-plus btn btn-link" href="{{ $addInfo->google_plus_link }}"><i class="fa fa-google-plus fa-2x" aria-hidden="true"></i></a>
        @endisset
        @isset($addInfo->instagram_link)
        <a class="cc-instagram btn btn-link" href="{{ $addInfo->instagram_link }}"><i class="fa fa-instagram fa-2x " aria-hidden="true"></i></a>
        @endisset
      </div> --}}

      <div class="container text-center" >
        <div class="row">
          <div class="col-md-3">
            <h4>Share Business Card <span class="fa fas fa-share-alt"></span></h4>  
          </div>
        </div>
        <a class="btn btn-round btn-lg btn-icon" style="background: #3B5998;" href="{{ Share::page(URL::current(), 'Share on facebook')->facebook()->getRawLinks() }}"><i class="fa fa-facebook fa-2x " aria-hidden="true"></i></a>
        <a class="btn btn-round btn-lg btn-icon" style="background: #25D366;" href="{{ Share::page(URL::current(), 'Share on whatsapp')->whatsapp()->getRawLinks() }}"><i class="fa fa-whatsapp fa-2x " aria-hidden="true"></i></a>
        <a class="btn btn-round btn-lg btn-icon" style="background: #cb2027;" href="{{ Share::page(URL::current(), 'Share on pinterest')->pinterest()->getRawLinks() }}"><i class="fa fa-pinterest fa-2x" aria-hidden="true"></i></a>
        <a class="btn btn-round btn-lg btn-icon" style="background: #0088cc;" href="{{ Share::page(URL::current(), 'Share on telegram')->telegram()->getRawLinks() }}"><i class="fa fa-telegram fa-2x" aria-hidden="true"></i></a>
        <a class="btn btn-round btn-lg btn-icon" style="background: #55ACEE;" href="{{ Share::page(URL::current(), 'Share on twitter')->twitter()->getRawLinks() }}"><i class="fa fa-twitter fa-2x " aria-hidden="true"></i></a>
        <a class="btn btn-round btn-lg btn-icon" style="background: #ff5700;" href="{{ Share::page(URL::current(), 'Share on reddit')->reddit()->getRawLinks() }}"><i class="fa fa-reddit fa-2x" aria-hidden="true"></i></a>
        <a class="btn btn-round btn-lg btn-icon" style="background: #007bb5;" href="{{ Share::page(URL::current(), 'Share on linkedin')->linkedin()->getRawLinks() }}"><i class="fa fa-linkedin fa-2x" aria-hidden="true"></i></a>
        <a class="btn btn-round btn-lg btn-icon" style="background: #FFCC00;" href="sms:?&body={{ URL::current() }}"><i class="fa fa-envelope fa-2x" aria-hidden="true"></i></a>
      </div>
      
      
      
      <div class="h4 title text-center">{{ $data->name }}</div>
      <div class="text-center text-muted">
        <p>&copy; Business Card App. All rights reserved.<br>Design - <a class="credit" href="https://templateflip.com" target="_blank">TemplateFlip</a></p>
      </div>
    </footer>
    <script src="{{ asset('creative/js/core/jquery.3.2.1.min.js?ver=1.1.0') }}"></script>
    <script src="{{ asset('creative/js/core/popper.min.js?ver=1.1.0') }}"></script>
    <script src="{{ asset('creative/js/core/bootstrap.min.js?ver=1.1.0') }}"></script>
    <script src="{{ asset('creative/js/now-ui-kit.js?ver=1.1.0') }}"></script>
    <script src="{{ asset('creative/js/aos.js?ver=1.1.0') }}"></script>
    <script src="{{ asset('creative/scripts/main.js?ver=1.1.0') }}"></script>
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
          url:"/fetch_data/{{ $data->name_slug }}?page="+page,
          success:function(data)
          {
          $('#result_ajax').html(data);
          }
        });
      }
      });
   </script>
   <!-- Toastr -->
  <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
  </body>
</html>