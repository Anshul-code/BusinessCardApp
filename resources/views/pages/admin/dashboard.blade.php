@extends('layouts.admin')

@section('content')
<div class="content-header">
  <h1 class="col-sm-6 ml-2">Dashboard</h1>
</div><!-- /.col -->
  <div class="container">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            @if($user->count() != 0)
            @php
            $count = 0;
               foreach ($user as $row) {
                  ++$count;
               } 
            @endphp
            <h3>{{ $count }}</h3>
            @else
            <h3>0</h3>
            @endif
            
            <p>Users Count</p>
          </div>
          <div class="icon">
            <i class="fas fa-user"></i>
          </div>
          <a href="/showUsers" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
     
    </div>      
  </div>
@endsection