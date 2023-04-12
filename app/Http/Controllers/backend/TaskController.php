<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Agent;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
        	
    public function TaskList(Request $request)
    {
        $list = DB::table('createtask')->get();
        return view('backend.task.list_task',compact('list'));
    }


    public function TaskAdd($agentID)
    {
        $agent = Agent::find($agentID);
        return view('backend.task.create_task', compact('agent'));
    }


public function TaskInsert(Request $request)
{
    $agent = Agent::find($request->agentID); // Retrieve the Agent object
    $data = array();
    $data['agentID'] = $agent->id; // Use the id property of the Agent object
    $data['productID'] = $request->productID;
    $data['ProductName'] = $request->ProductName;  
    $data['quantity'] = $request->quantity;
    $data['pickupAdd'] = $request->pickupAdd; 
    $data['pickupDate'] = $request->pickupDate; 
    $data['deliveryAdd'] = $request->deliveryAdd;
    $data['deliveryDate'] = $request->deliveryDate; 
    $data['remarks'] = $request->remarks;  
    $data['status'] = $request->status;   
    $insert = DB::table('createtask')->insert($data);
       
    if ($insert) {
        return Redirect()->route('task.index')->with('success','Task list created successfully!');
    } else {
        $notification=array(
            'messege'=>'error ',
            'alert-type'=>'error'
        );
        return Redirect()->route('task.index')->with($notification);
    }
}


      public function TaskEdit ($id)
    {
        $edit=DB::table('createtask')
             ->where('id',$id)
             ->first();
        return view('backend.task.edit_task', compact('edit'));     
    }

        public function TaskUpdate(Request $request,$id)
    {
      
        DB::table('createtask')->where('id', $id)->first();        
        $data = array();
        $data['agentID'] = $request->agentID;
        $data['productID'] = $request->productID;
        $data['ProductName'] = $request->ProductName;
        $data['quantity'] = $request->quantity;
        $data['pickupAdd'] = $request->pickupAdd; 
        $data['pickupDate'] = $request->pickupDate; 
        $data['deliveryAdd'] = $request->deliveryAdd;
        $data['deliveryDate'] = $request->deliveryDate; 
        $data['remarks'] = $request->remarks;  
        $data['status'] = $request->status; 
        $update = DB::table('createtask')->where('id', $id)->update($data);

        if ($update) 
    {
            
            return Redirect()->route('task.index')->with('success','Task List Updated successfully!');                     
    }
        else
    {
        $notification=array
        (
        'messege'=>'error ',
        'alert-type'=>'error'
        );
        return Redirect()->route('task.index')->with($notification);
    }
     
    }

public function TaskDelete ($id)
    {
    
        $delete = DB::table('createtask')->where('id', $id)->delete();
        if ($delete)
                            {
                            $notification=array(
                            'messege'=>'Successfully Task List Deleted ',
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