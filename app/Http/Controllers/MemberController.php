<?php

namespace App\Http\Controllers;

use App\Reservoir;
use App\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request){
        // var_dump($request->all()); die();
        //also code for filtering
        if (isset($request->reservoir_id) && $request->reservoir_id !== 0){
            $members = Member::where('reservoir_id', $request->reservoir_id)->orderBy('name')->get(); 
        } else {
            $reservoirs = Reservoir::orderBy('title')->get();
            $members = Member::orderBy('surname')->get();
        }
        return view('members.index', ['members' => $members, 'reservoirs' => \App\Reservoir::orderBy('title')->get()]);
    }

    // ATTENTION :: we need reservoirs to be able to assign them
    public function create(){
        $reservoirs = \App\Reservoir::orderBy('title')->get();
        return view('members.create', ['reservoirs' => $reservoirs]);
    }
    public function store(Request $request){
        
        //ERROR VALIDACIJA
        $this->validate($request, [
            // [Dėmesio] validacijoje unique turi būti nurodytas teisingas lentelės pavadinimas!
            // galime pažiūrėti, kas bus jei bus neteisingas
            
            'name' => 'required|unique:members,name',
            'surname' => 'required',
            'live' => 'required',
            'experience' => 'required',
            'registered' => 'required',
            'reservoir_id' => 'required',
            ]);
            
            // can be used for seeing the insides of the incoming request
            // var_dump($request->all()); die();
        $member = new Member();
        $member->fill($request->all());
        if ($member->experience < $member->registered) {
            return back()->withErrors(['error' => ['Negalima kurti naujo nario, jei patirtis mažesnė nei registracijos laikas!']]);
        }
    
        return ($member->save() !== 1 ) ? 
            redirect()->route('members.index')->with('status_success', 'Sėkmingai sukurta!') :
            redirect()->route('members.index')->with('status_error', 'Ištrinta!'); //<- NOTIFICATION LOGIKA su printu i puslapy
        
    }
    public function show(Member $member){
        //
    }
    // ATTENTION :: we need reservoirs to be able to assign them
    public function edit(Member $member){
        $reservoirs = \App\Reservoir::orderBy('title')->get();
        return view('members.edit', ['member' => $member, 'reservoirs' => $reservoirs]);
    }
    public function update(Request $request, Member $member){
        $member->fill($request->all());

        if ($member->experience < $member->registered) {
            return back()->withErrors(['error' => ['Atnaujinti negalima, jei nario patirtis mažesnė nei registravimo laikas!']]);
        }
        
        return ($member->save() !==1 ) ? 
            redirect()->route('members.index')->with('status_success', 'Atnaujinta!') :
            redirect()->route('members.index')->with('status_error', 'Neatnaujinta!');//<- NOTIFICATION LOGIKA su printu i puslapy
    }
    public function destroy(Member $member){
        return ($member->delete() !==1 ) ? 
            redirect()->route('members.index')->with('status_success', 'Ištrinta!') :
            redirect()->route('members.index')->with('status_error', 'Neištrinta!');//<- NOTIFICATION LOGIKA su printu i puslapy
    }
    public function info($id){
        $member = Member::find($id);
        return view('members.info', ['member' => $member]);
    }
}
