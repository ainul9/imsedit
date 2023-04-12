@extends('backend.layouts.app')
@section('content')

       <div class="row">
<div class="col-md-12">
<div class="card card-primary">
<div class="card-header info">
<h3 class="card-title">Product List</h3>
</div>
            <!-- /.card-header -->
 <div class="card-body">
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
<th>ID</th>
<th>Product Name</th>    
<th>Product Description</th>             
<th>Rack Location</th>  
<th>Quantity</th>      
<th>Action</th>               
</tr>
</thead>
<tbody>
@foreach($list as $row)
<tr>
<td>{{ $row->id }}</td>
<td>{{ $row->product_name }}</td>
<td>{{ $row->product_desc }}</td>
<td>{{ $row->rack_location }}</td>
<td> {{ $row->quantity }} </td>

<td>
                 
<a href="{{ URL::to('/edit_product/'.$row->id) }}" class="btn btn-sm btn-info">Edit</a>
<a href="{{ URL::to('delete_product/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete" class="middle-align">Delete</a>

</td>
</tr>
@endforeach


        </table>
        </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        </div>

            @endsection

