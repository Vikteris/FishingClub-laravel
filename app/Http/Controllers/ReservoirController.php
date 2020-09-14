<?php

namespace App\Http\Controllers;

use App\Reservoir;
use Illuminate\Http\Request;

class ReservoirController extends Controller
{
    public function index()
    {
        return view('reservoirs.index', ['reservoirs' => Reservoir::orderBy('area', 'desc')->get()]);
    }
    public function create()
    {
        return view('reservoirs.create');
    }
    public function store(Request $request)
    {
        $reservoir = new Reservoir();
        // can be used for seeing the insides of the incoming request
        //  var_dump($request->all()); die();

        //ERROR VALIDACIJA
        $this->validate($request, [
            // [Dėmesio] validacijoje unique turi būti nurodytas teisingas lentelės pavadinimas!
            // galime pažiūrėti, kas bus jei bus neteisingas

            'title' => 'required|unique:reservoirs,title',
            'area' => 'required',
            'about' => 'required',
        ]);

        $reservoir->fill($request->all());

        return ($reservoir->save() !==1 ) ? 
            redirect()->route('reservoirs.index')->with('status_success', 'Sėkmingai sukurta!') :
            redirect()->route('reservoirs.index')->with('status_error', 'Nesukurta!'); //<- NOTIFICATION LOGIKA su printu i puslapy
        }
        
    public function edit(Reservoir $reservoir)
    {
        return view('reservoirs.edit', ['reservoir' => $reservoir]);
    }

    public function update(Request $request, Reservoir $reservoir)
    {
        $reservoir->fill($request->all());

        return ($reservoir->save() !==1 ) ? 
            redirect()->route('reservoirs.index')->with('status_success', 'Atnaujinta!') :
            redirect()->route('reservoirs.index')->with('status_error', 'Neatnaujinta!');///<- NOTIFICATION LOGIKA su printu i puslapy
    }

    public function destroy(Reservoir $reservoir)
    {

        if (count($reservoir->member)) {
            return back()->withErrors(['error' => ['Negalima ištrinti vandens telkinio, jeigu yra jam priskirtas žvejys!']]);
        }
        return ($reservoir->delete() ) ? 
            redirect()->route('reservoirs.index')->with('status_success', 'Ištrinta!'):
            redirect()->route('reservoirs.index')->with('status_error', 'Nesukurta!');//<- NOTIFICATION LOGIKA su printu i puslapy
        
    }
}
