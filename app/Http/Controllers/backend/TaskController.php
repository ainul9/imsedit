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
  
        	
    public function TaskList(Request $request, $agentID)
    {
        $list = DB::table('createtask')->where('agentID', $agentID)->get();
        $agent = Agent::where('id', $agentID)->first();
        return view('backend.task.list_task',compact('list', 'agent'));
    }


    public function TaskAdd($agentID)
    {

        $list = DB::table('createtask')->where('agentID', $agentID)->get();
        $agent = Agent::where('id', $agentID)->first();
        // $agent = DB::table('agent')->where('id', $agentID)->get();
        // $agent = Agent::find($agentID);
        // return view('backend.task.create_task', compact('agent','list'));
            return view('backend.task.create_task', compact('agent','list'));
    }


public function TaskInsert(Request $request, $agentID)
{
    $agent = Agent::find($agentID); // Retrieve the Agent object
    $data = [
        'agentID' => $agent->id,
        'agentName' => $agent->agentName, // Use the id property of the Agent object
        'productID' => $request->productID,
        'ProductName' => $request->ProductName, 
        'quantity' => $request->quantity,
        'pickupAdd' => $request->pickupAdd, 
        'pickupDate' => $request->pickupDate, 
        'deliveryAdd' => $request->deliveryAdd,
        'deliveryDate' => $request->deliveryDate, 
        'remarks' => $request->remarks,  
        'status' => $request->status,  
    ];
        $insert = DB::table('createtask')->insert($data);
       
    if ($insert) {
        return redirect()->route('backend.task.list_task', ['agentID' => $agentID])->with('success','Task list created successfully!');
    } else {
        $notification=array(
            'messege'=>'error ',
            'alert-type'=>'error'
        );
        return redirect()->route('backend.task.list_task')->with($notification);
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
        $data['agentName'] = $request->agentName;
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
        $list = Agent::where('id', $id)->get(); 
        $notification = [
            'messege' => 'Task List updated successfully!',
            'alert-type' => 'success'
        ];
        return view('backend.task.list_task', compact('list'))->with($notification);
            // return Redirect()->route('backend.task.list_task')->with('success','Task List Updated successfully!');                     
    }
        else
    {
        $notification=array
        (
        'messege'=>'error ',
        'alert-type'=>'error'
        );
        return redirect()->route('backend.task.list_task', [ $id => 'id'])->with($notification);
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