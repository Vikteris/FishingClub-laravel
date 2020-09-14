@extends('layouts.app')
@section('content')
<div class="card-body">
    @if($errors->any())
        <h4 style="color: green">{{$errors->first()}}</h4>
    @endif
    {{-- NOTIFICATIONS po CRUDO veiksmų --}}
    @if (session('status_success'))
        <p style="color: green"><b>{{ session('status_success') }}</b></p>
    @else
        <p style="color: red"><b>{{ session('status_error') }}</b></p>
    @endif
    <table class="table">
        <tr>
            <th>Pavadinimas</th>
            <th>Plotas, kv. m.</th>
            <th>Aprašas</th>
            <th>Žvėjys</th> 
            <th>Veiksmai</th>
        </tr>
        @foreach ($reservoirs as $reservoir)
        <tr>
            <td>{{ $reservoir->title }}</td>
            <td>{{ $reservoir->area }}</td>
            <td>{!! $reservoir->about !!}</td>
            <td>@for ($i = 0; $i < count($reservoir->member); $i++)
                @if ($i < count($reservoir->member)-1)
                  {{$reservoir->member[$i]->name.','}}
                @else
                  {{ $reservoir->member[$i]->name }}
                @endif
              @endfor
            </td>
            <td>
                <form action={{ route('reservoirs.destroy', $reservoir->id) }} method="POST">
                    <a class="btn btn-success" href={{ route('reservoirs.edit', $reservoir->id) }}>Redaguoti</a>
                    @csrf @method('delete')
                    <input type="submit" class="btn btn-danger" value="Trinti"/>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div>
        <a href="{{ route('reservoirs.create') }}" class="btn btn-success">Pridėti</a>
    </div>
</div>
@endsection