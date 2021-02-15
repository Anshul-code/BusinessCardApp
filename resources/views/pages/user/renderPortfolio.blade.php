<div class="row">
@foreach ($portfolio as $row)  
    <div class="col-sm-6">
        <div class="cc-porfolio-image img-raised" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
        <!-- Button trigger modal -->
        <a  data-toggle="modal" data-target="#model{{ $row->id }}">
            <figure class="cc-effect crop" style="height: 300px;overflow:hidden;"><img src="{{ asset('storage/portfolio_images/'. $row->portfolio_image) }}" 
                
                style="
                object-fit: none;
                object-position: center; 
                height: 300px;
                width: 550px;
                "  
                
                alt="Image"/>
                <figcaption>
                <div class="h4">{{ $row->image_title }}</div>
                <p>{{ $row->about_image }}</p>
                </figcaption>
            </figure>
        </a>
        </div> 
    </div>
@endforeach
@foreach ($portfolio as $row)
   <!-- Modal -->
<div class="modal fade" id="model{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">{{ $row->image_title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <img src="{{ asset('storage/portfolio_images/'. $row->portfolio_image) }}" alt="image{{ $row->portfolio_image }}" width="100%">
            <p>{{ $row->about_image }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    </div> 
@endforeach
</div>
<br>
<div class="row">
    <div class="col-sm-2 mx-auto">
        {!! $portfolio->links('pagination::bootstrap-4') !!}
    </div>
</div>
