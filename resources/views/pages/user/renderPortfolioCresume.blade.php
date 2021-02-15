<div class="row">
    <div class="col-sm-3">
        {!! $portfolio->links('pagination::bootstrap-4') !!}
    </div>
</div>

@foreach ($portfolio as $row)  
<div class="col-md-4 col-ms-6 jm-item first filtr-item" data-category="1" style="transition: 0.5s ease-out 10ms;">
    <div class="jm-item-wrapper">
        <div class="jm-item-image" >
            <img src="{{ asset('storage/portfolio_images/'. $row->portfolio_image) }}" 
            style="
                object-fit: none;
                object-position: center; 
                height: 300px;
                width: 340px;
                "  
            alt="property" />
            <span class="jm-item-overlay"></span>
            <div class="jm-item-button"><a href="#"  data-toggle="modal" data-target="#myModal{{ $row->id }}">View Details</a></div>
        </div>	
    </div>
</div>
@endforeach
<div class="clearfix"></div>


   



