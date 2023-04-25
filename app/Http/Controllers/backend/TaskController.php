<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Agent;
use App\Models\Task;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
        	
    public function TaskList(Request $request, $usersID)
    {
        // $user = auth()->user();
        
        // $list = DB::table('createtask')->where('usersID', $usersID)->get();
        // $agent = Agent::where('usersID', $usersID)->first();
        // $usersID = $agent->usersID;
        // // $list = Task::where('usersID', $usersID)->get();
        // $user = User::where('id', $usersID)->first();
        // return view('backend.task.list_task', compact('list', 'user', 'agent'));
        $list = []; 
        $user = auth()->user();
        if ($user->role == 3){
            $list = DB::table('createtask')->where('usersID', $usersID)->get();
            return view('backend.task.list_task', compact('list'));
        }
        else{
            $list = DB::table('createtask')->where('usersID', $usersID)->get();
            $agent = Agent::where('usersID', $usersID)->first();
            $usersID = $agent->usersID;
            $user = User::where('id', $usersID)->first();
            return view('backend.task.list_task', compact('list', 'user', 'agent'));
        }

    }

    public function TaskAdd($usersID)
    {

        $list = DB::table('createtask')->where('usersID', $usersID)->get();
        $user = User::where('id', $usersID)->first();
        // $agent = DB::table('agent')->where('id', $usersID)->get();
        // $agent = Agent::find($usersID);
        // return view('backend.task.create_task', compact('agent','list'));
            return view('backend.task.create_task', compact('user','list'));
    }


public function TaskInsert(Request $request, $usersID)
{
    $user = User::find($usersID); // Retrieve the Agent object
    $data = [
        'usersID' => $user->id,
        'agentName' => $user->name, // Use the id property of the Agent object
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
        return redirect()->route('backend.task.list_task', ['usersID' => $usersID])->with('success','Task list created successfully!');
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

    public function TaskUpdate(Request $request, $id)
{
    $task = DB::table('createtask')->where('id', $id)->first();
    $usersID = $task->usersID;
    $data = array(
        'agentName' => $request->agentName,
        'productID' => $request->productID,
        'ProductName' => $request->ProductName,
        'quantity' => $request->quantity,
        'pickupAdd' => $request->pickupAdd, 
        'pickupDate' => $request->pickupDate, 
        'deliveryAdd' => $request->deliveryAdd,
        'deliveryDate' => $request->deliveryDate, 
        'remarks' => $request->remarks,  
        'status' => $request->status
    ); 
    
    $update = DB::table('createtask')->where('id', $id)->update($data);
    
    if ($update) {
        return redirect()->route('backend.task.list_task', ['usersID' => $usersID])->with('success', 'Task updated successfully!');
    } else {
        $notification = array(
            'messege' => 'error ',
            'alert-type' => 'error'
        );
        return redirect()->route('backend.task.list_task', ['usersID' => $usersID])->with($notification);
    }
}

    



    public function UpdatedTask(Request $request,$id)
    {
        $list = DB::table('createtask')->where('id', $id)->get();
        return view('backend.task.updated_task', compact('list'));
        
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



    //   public function AgentViewTask(Request $request, $usersID)
    //   {
    //       $userView = auth()->user();
    //       $listView = DB::table('createtask')->where('usersID', $usersID)->get();
    //     //   $agent = Agent::where('usersID', $usersID)->first();
    //     //   $usersID = $agent->usersID;
    //       // $list = Task::where('usersID', $usersID)->get();
    //       $userView = User::where('id', $usersID)->first();
    //       return view('backend.task.list_task', compact('listView', 'userView'));
    //   }

// public function Back()
// {
//     return redirect()->route('backend.task.list_task');
// }

}