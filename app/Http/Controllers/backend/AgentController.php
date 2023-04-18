<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Agent;
use App\Models\User;

class AgentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
        	
    public function AgentList(Request $request)
    {
        $list = DB::table('users')
            ->where('role', '=', 3)
            ->get();

        return view('backend.agent.list_agent', compact('list'));
        // $list = DB::table('agent')->get();
        // return view('backend.agent.list_agent',compact('list'));
    }


public function AgentAdd($usersID, $agentName)
{
    // $user = User::where('id', $usersID)->where('name', $agentName)->first();
    // $agents = Agent::all();
    
    // return view('backend.agent.create_agent', compact('user','agents'));
    $list = DB::table('agent')->where('usersID', $usersID)->get();
    $user = User::where('id', $usersID)->where('name', $agentName)->first();
    // $agents = Agent::where('usersID', $usersID)->get();
    
    if($list->isEmpty()){
        return view('backend.agent.create_agent', compact('user','list'));
    }else{
        $notification = session('success'); // Get the success message, if any
        return view('backend.agent.show_details', compact('user', 'list'))->with('success', 'Details for this agent have been added successfully');

    }
}



public function AgentInsert(Request $request, $usersID)
{
    $user = User::find($usersID);
    $data = [
        'usersID' => $user->id,
        'agentName' => $user->name,
        'agentCat' => $request->agentCat,
        'registrationNum' => $request->registrationNum,
        'contact' => $request->contact,
        'address' => $request->address,
        'city' => $request->city,
        'postcode' => $request->postcode,
        'state' => $request->state,
        'country' => $request->country,
        'remarks' => $request->remarks,
    ];
    $insert = DB::table('agent')->insert($data);
    
    if ($insert) {
        return redirect()->route('backend.agent.show_details', ['usersID' => $usersID])->with('success', 'Agent details added successfully!');
        // return redirect()->route('backend.agent.show_details')->with('success', 'Agent details added successfully!');
    } else {
        $notification = [
            'messege' => 'Error creating agent',
            'alert-type' => 'error'
        ];
        return redirect()->route('backend.agent.show_details')->with($notification);
    }
}


public function AgentShow(Request $request, $usersID)
    {
        
        // $list = DB::table('agent')->get();
        $list = Agent::where('usersID', $usersID)->get();
        $user = User::where('id', $usersID)->first();

        return view('backend.agent.show_details', compact('list', 'user'));
       
    }
     

//     public function AgentInsert(Request $request)
//     {


// $user = User::find($request->id);
// $data = [];
// $data['agentCat'] = $request->agentCat;
// $data['registrationNum'] = $request->registrationNum;
// $data['contact'] = $request->contact;
// $data['address'] = $request->address;
// $data['city'] = $request->city;
// $data['postcode'] = $request->postcode;
// $data['state'] = $request->state;
// $data['country'] = $request->country;
// $data['remarks'] = $request->remarks;
// $insert = DB::table('agent')->insert($data);
       
// if ($usersID) 
// {
   
//                 return Redirect()->route('agent.index')->with('success','Agent created successfully!');
                 
//         }
// else
//         {
//         $notification=array
//         (
//         'messege'=>'error ',
//         'alert-type'=>'error'
//         );
//         return Redirect()->route('agent.index')->with($notification);
//         }
           
// }

    public function AgentEdit ($usersID)
    {
        $edit=DB::table('agent')
            ->where('usersID',$usersID)
            ->first();
        return view('backend.agent.edit_agent', compact('edit'));     
    }

        public function AgentUpdate(Request $request,$usersID)
    {
        $list = Agent::where('usersID', $usersID)->get();
        DB::table('agent')->where('usersID', $usersID)->first();        
        $data = array();
        $data['usersID'] = $request->usersID;
        $data['agentName'] = $request->agentName;
        $data['agentCat'] = $request->agentCat;
        $data['registrationNum'] = $request->registrationNum;
        $data['contact'] = $request->contact;
        $data['address'] = $request->address;
        $data['city'] = $request->city;
        $data['postcode'] = $request->postcode;
        $data['state'] = $request->state;
        $data['country'] = $request->country;
        $data['remarks'] = $request->remarks;
        $update = DB::table('agent')->where('usersID', $usersID)->update($data);

        if ($update) 
    {
        
            $list = Agent::where('usersID', $usersID)->get(); 
            $notification = [
                'messege' => 'Agent updated successfully!',
                'alert-type' => 'success'
            ];
            return view('backend.agent.show_details', compact('list'))->with($notification);
            // return redirect()->route('backend.agent.show_details',[$usersID => 'usersID'])->with('success','Agent Updated successfully!');
            // return view('backend.agent.show_details', compact('list'));                     
       
        }   
        else
    {
        $notification=array
        (
        'messege'=>'error ',
        'alert-type'=>'error'
        );
        return redirect()->route('backend.agent.show_details', [$usersID => 'usersID'])->with($notification);
    }
     
    }

public function AgentDelete ($usersID)
    {
    
        $delete = DB::table('agent')->where('usersID', $usersID)->delete();
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

//       public function AgentAddTask()
// {
// $all = DB::table('createtask')->get();
// $edit=DB::table('createtask')
//              ->where('agentID',$agentID)
//              ->first();
//         return view('backend.task.create_task', compact('edit')); 
// }
    
}
