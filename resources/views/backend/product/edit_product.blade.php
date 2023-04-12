@extends('backend.layouts.app')
@section('content')

<div class="card-body">
    <div class="row">

      <div class="col-md-2">

      </div>
                     <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{URL::to('/update_product/'.$edit->id)}}" method="post" enctype="multipart/form-data">
              	@csrf
                <div class="card-body">


<div class="form-group">
<label for="exampleInputEmail1">Product Name</label>
<input type="text" name="product_name" value="{{$edit->product_name}}"  class="form-control @error('title') is-invalid @enderror"
 id="exampleInputEmail1" placeholder="Enter Product Name">

@error('title')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>

<div class="form-group">
  <label for="exampleInputEmail1">Product Description</label>
  <input type="text" name="product_desc" value="{{$edit->product_desc}}"  class="form-control @error('title') is-invalid @enderror"
   id="exampleInputEmail1" placeholder="Enter Product Description">
  
  @error('title')
  <span class="invalid-feedback" role="alert">
  <strong>{{ $message }}</strong>
  </span>
  @enderror
  </div>

<div class="form-group">
    <label for="exampleInputEmail1">Rack Location</label>
    <input type="text" name="rack_location" value="{{$edit->rack_location}}"  class="form-control @error('title') is-invalid @enderror"
     id="exampleInputEmail1" placeholder="Enter Rack Location">
    
    @error('title')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>

<div class="form-group">
<label for="exampleInputEmail1">Quantity</label>
<input type="text" name="quantity" value="{{$edit->quantity}}"  class="form-control @error('title') is-invalid @enderror"
 id="exampleInputEmail1" placeholder="Enter Quantity">

@error('slug')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>


                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
        </div>


 <div class="col-md-2">

      </div>


            </div>
            <!-- /.row -->
        </div>

                        <script type="text/javascript">
    function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#image')
                  .attr('src', e.target.result)
                  .width(80)
                  .height(80);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>

@endsection