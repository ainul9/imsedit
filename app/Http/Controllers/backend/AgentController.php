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
    $user = User::where('id', $usersID)->where('name', $agentName)->first();
    $agents = Agent::all();
    
    return view('backend.agent.create_agent', compact('user','agents'));



    // $agent = Agent::all();

    // $list = DB::table('users')
    // ->join('agent', 'users.id', '=', 'agent.usersID')
    // ->where('role', '=', 3)
    // ->select('agent.usersID','users.id', 'users.name')
    // ->get();

    // return view('backend.agent.create_agent', compact('list', 'agent'));
// $all = DB::table('agent')->get();
// return view('backend.agent.create_agent',compact('all'));
}



public function AgentInsert(Request $request)
{
    $user = User::find(2);
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
        return redirect()->route('agent.index')->with('success', 'Agent created successfully!');
    } else {
        $notification = [
            'messege' => 'Error creating agent',
            'alert-type' => 'error'
        ];
        return redirect()->route('agent.index')->with($notification);
    }
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

      public function AgentEdit ($id)
    {
        $edit=DB::table('agent')
             ->where('id',$id)
             ->first();
        return view('backend.agent.edit_agent', compact('edit'));     
    }

        public function AgentUpdate(Request $request,$id)
    {
      
        DB::table('agent')->where('id', $id)->first();        
        $data = array();
        $data['agentName'] = $request->agentName;
        $data['usersID'] = $request->usersID;
        $data['agentCat'] = $request->agentCat;
        $data['registrationNum'] = $request->registrationNum;
        $data['contact'] = $request->contact;
        $data['address'] = $request->address;
        $data['city'] = $request->city;
        $data['postcode'] = $request->postcode;
        $data['state'] = $request->state;
        $data['country'] = $request->country;
        $data['remarks'] = $request->remarks;
        $update = DB::table('agent')->where('id', $id)->update($data);

        if ($update) 
    {
            
            return Redirect()->route('agent.index')->with('success','Agent Updated successfully!');                     
    }
        else
    {
        $notification=array
        (
        'messege'=>'error ',
        'alert-type'=>'error'
        );
        return Redirect()->route('agent.index')->with($notification);
    }
     
    }

public function AgentDelete ($id)
    {
    
        $delete = DB::table('agent')->where('id', $id)->delete();
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
