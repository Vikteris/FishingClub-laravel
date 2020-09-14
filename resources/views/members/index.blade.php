@extends('layouts.app')
@section('content')
{{-- FILTRAVIMAS --}}
<label>Filtravimas:</label>
<form class="form-inline" action="{{ route('members.index') }}" method="GET">
    <select name="reservoir_id" id="" class="form-control">
        <option value="" selected>Visi</option>
        @foreach ($reservoirs as $reservoir)
        <option value="{{ $reservoir->id }}" 
            @if($reservoir->id == app('request')->input('reservoir_id')) 
                {{-- selected="selected" reiškia kad altiksu filtravimą, ta pasirnkite inpute palieka rodoma --}}
            selected="selected"  
            @endif>{{ $reservoir->title }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary">Filtruoti</button>
</form>

{{-- Message sukurimas kai yra kažkas sukuriama ar ištrinama, ar updeitinama. LOgika controlleri --}}
<div class="card-body">
    @if (session('status_success'))
        <p style="color: green"><b>{{ session('status_success') }}</b></p>
        @else
        <p style="color: red"><b>{{ session('status_error') }}</b></p>
    @endif

    <table class="table">
        <tr>
            <th>Vardas</th>
            <th>Pavardė</th>
            <th>Gyvenamoji vieta</th>
            <th>Žvejo patirtis metais</th>
            <th>Klube registruotas metais</th>
            <th>Vandens telkinys</th>
            <th>Veiksmai</th>
        </tr>
        @foreach ($members as $member)
        <tr>
            <td>{{ $member->name }}</td>
            <td>{{ $member->surname }}</td>
            <td>{{ $member->live }}</td>
            <td>{{ $member->experience }}</td>
            <td>{{ $member->registered }}</td>
            <td>{{ $member->reservoir->title }}</td>
            <td>
                <form action={{ 
                    route('members.destroy', $member->id) . 
                    ( app('request')->input('reservoir_id') !== '' 
                        ? '?reservoir_id=' . app('request')->input('reservoir_id') 
                        : '' )
                }} method="POST">
                <a class="btn btn-success" href={{ route('members.edit', $member->id) }}>Redaguoti</a>
                @csrf @method('delete')
                <input type="submit" class="btn btn-danger" value="Trinti"/>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div>
        <a href="{{ route('members.create') }}" class="btn btn-success">Pridėti</a>
    </div>
    
</div>
@endsection