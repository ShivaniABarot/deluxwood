<?php

namespace App\Http\Controllers\backend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\AgentForm;
use App\Models\Agent;
use App\Models\User;
use App\Models\Customer;
use Hash;
use Session;
class AgentController extends BaseController {
   
    public function index() {
        $pagename = "Agent Index";
        
        $agents = Agent::select('agent.*','users.name','users.email')->leftjoin('users', 'users.id', 'agent.user_id')->latest()->get();
        // dd($agent);
		return view('backend.agent.index',compact('pagename','agents'));
	}
    public function agent_assign_index(){
        $pagename = "Agent Assign";
        //$customers = Customer::select('customer.*','users.name','users.email')->leftjoin('users', 'users.id', 'customer.user_id')->latest()->get();
        $customers = Customer::select('customer.*','users.name','users.email','users.removed')->leftjoin('users', 'users.id', 'customer.user_id')->where('reg_status', 'Approved')->where('removed', 'NO')->latest()->get();
      
		return view('backend.agent.agent_assign_index',compact('pagename','customers'));
    }
    public function agent_assign_form($id){
        $pagename = "Agent Assign";
        $customer = Customer::select('customer.*','users.name','users.email')->leftjoin('users', 'users.id', 'customer.user_id')->where('customer_id',$id)->first();
        $agents = Agent::select('agent.*','users.id','users.name','users.email')->leftjoin('users', 'users.id', 'agent.user_id')->get();
        return view('backend.agent.agent_assign',compact('pagename','customer','agents','id'));
    } 
    public function agent_assign_update(Request $request,$id){
        $customer = Customer::find($id);
        if($request->agent_id != "")
        {
            $customer->agent_id = $request->agent_id;
        }else{
            $customer->agent_id = Null;
        }
        if($customer->save()){
            return redirect('/admin/agent-assign-index')->with('success','Account Manager  Updated  Successfully');
           }else{
            return redirect('/admin/agent-assign-index')->with('error', 'Error: Something went wrong. Please try again.');
           }

    }

    public function create()
    {
        $pagename = 'Create Agent';
        return view('backend.agent.create',compact('pagename'));
    }

    public function store(AgentForm  $request){
        if($request->ajax()){
            return true;
        }
        $user = new User();  

        $user->name = $request->name;
        $user->role_id = 3;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); 
        $user->save();
        
        $agent = new Agent();  
        $agent->user_id =  $user->id;
        $agent->user_name = $request->username;
      
      if($agent->save()){
        return redirect('/admin/agent-list')->with('success','Account Manager  Added Successfully');
       }else{
        return redirect('/admin/agent-list')->with('error', 'Error: Something went wrong. Please try again.');
       }
           
        }
      
    public function destroy($id)
     {
    
       $agent = Agent::find($id); 
        if($agent->delete()){
            Session::flash('success', 'Agent deleted successfully'); 
            return response()->json(['message' => 'Account Manager  deleted successfully']);
        }
        else
        {
            Session::flash('fail', 'Something went wrong. Please try again.'); 
            return response()->json(['message' => ' Something went wrong. Please try again.']); 
        }
         echo json_encode($json);
       
    }
    public function view($id) {
        $pagename = "Agent View";
        $agent = Agent::select('agent.*','users.name','users.email')->leftjoin('users', 'users.id', 'agent.user_id')->find($id);
        // $agent = Agent::find($id);
    //   /  dd($agent);
       
		return view('backend.agent.view',compact('pagename','agent'));
	}
    public function edit($id) {
        $pagename = "Agent Edit";
        $agent = Agent::select('agent.*','users.name','users.email')->leftjoin('users', 'users.id', 'agent.user_id')->find($id);
        // $agent = Agent::find($id);
        //dd($agent);
       
		return view('backend.agent.edit',compact('pagename','agent'));
	}
 
	
    public function update(AgentForm  $request,$id){
        if($request->ajax()){
            return true;
        }
        $agent = Agent::find($id); 
        $user =User::find($agent->user_id);  

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        } 
        $user->save();
       
      
        $agent->user_name = $request->username;
       
       if($agent->save()){
        return redirect('/admin/agent-list')->with('success','Account Manager  Updated  Successfully');
       }else{
        return redirect('/admin/agent-list')->with('error', 'Error: Something went wrong. Please try again.');
       }
           
        }
      
}
