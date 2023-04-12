<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\backend\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function ProductList(Request $request)
    {
        $list = DB::table('products')->get();
        return view('backend.product.list_product',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function ProductAdd()
    {
        $all = DB::table('products')->get();
        return view('backend.product.create_product',compact('all'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function ProductInsert(Request $request)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['rack_location'] = $request->rack_location;    
        $data['quantity'] = $request->quantity; 
        $insert = DB::table('products')->insert($data);
       
        if ($insert) 
{
   
                return Redirect()->route('product.index')->with('success','Product added successfully');
                 
        }
else
        {
        $notification=array
        (
        'messege'=>'error ',
        'alert-type'=>'error'
        );
        return Redirect()->route('product.index')->with($notification);
        }
           
}
    

    public function ProductEdit ($id)
    {
        $edit=DB::table('products')
             ->where('id',$id)
             ->first();
        return view('backend.product.edit_product', compact('edit'));     
    }

        public function ProductUpdate(Request $request,$id)
    {
      
        DB::table('products')->where('id', $id)->first();        
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['rack_location'] = $request->rack_location;    
        $data['quantity'] = $request->quantity;   
        $update = DB::table('products')->where('id', $id)->update($data);

        if ($update) 
    {
            
            return Redirect()->route('product.index')->with('success','Product Updated Successfully!');                     
    }
        else
    {
        $notification=array
        (
        'messege'=>'error ',
        'alert-type'=>'error'
        );
        return Redirect()->route('product.index')->with($notification);
    }
     
    }

public function ProductDelete ($id)
    {
    
        $delete = DB::table('products')->where('id', $id)->delete();
        if ($delete)
                            {
                            $notification=array(
                            'messege'=>'Product Deleted Successfully',
                            'alert-type'=>'success'
                            );
                            return Redirect()->back()->with($notification);                      
                            }
             else
                  {
                  $notification=array(
                  'messege'=>'error ',
                  'alert-type'=>'error'
                  );
                  return Redirect()->back()->with($notification);

                  }

      }
}
