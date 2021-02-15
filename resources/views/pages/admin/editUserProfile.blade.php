@extends('layouts.userEdit')

@section('content')
    <div class="container">
        <h3 class="text-center py-2">Start Editing {{ $user_data->name }}'s Profile !</h3>
        <hr>
        <!-- Small boxes (Stat box) -->
    <div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              @if($skill->count() != 0)
              @php
              $count = 0;
                 foreach ($skill as $row) {
                    ++$count;
                 } 
              @endphp
              <h3>{{ $count }}</h3>
              @else
              <h3>0</h3>
              @endif
              
              <p>Skills Count</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/addSkills" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              @if($images->count() != 0)
                @php
                     $count_images = 0;
                    foreach ($images as $item) {
                        ++$count_images;
                    } 
                @endphp
                <h3>{{ $count_images }}</h3>
                @else
                <h3>0</h3>
              @endif
  
              <p>Total Portfolio Images</p>
            </div>
            <div class="icon">
              <i class="fas fa-images"></i>
            </div>
            <a href="/portfolio" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>  
    </div>
@endsection