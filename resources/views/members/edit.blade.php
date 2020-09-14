@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pakeiskite nario informacija:</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('members.update', $member->id) }}">
                        @csrf @method("PUT")
                        <div class="form-group">
                            <label for="">Vardas</label>
                            <input type="text" name="name" class="form-control" value="{{ $member->name }}">
                        </div>

                        <div class="form-group">
                            <label for="">Pavardė</label>
                            <input type="text" name="surname" class="form-control" value="{{ $member->surname }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="">Gyvenamoji vieta</label>
                            <input type="text" name="live" class="form-control" value="{{ $member->live }}">
                        </div>

                            @if($errors->any())
                                <h4 style="color: green">{{$errors->first()}}</h4>
                            @endif
                        <div class="form-group">
                            <label for="">Patirtis</label>
                            <input type="number" name="experience" class="form-control" value="{{ $member->experience }}">
                        </div>
                        <div class="form-group">
                            <label for="">Registruotas</label>
                            <input type="number" name="registered" class="form-control" value="{{ $member->registered }}">
                        </div>
                        <div class="form-group">
                            <label>Pakeisti vandens teliknį: </label>
                            <select name="reservoir_id" id="" class="form-control">
                                 <option value="" selected disabled>Pasirinkite tvenkinį</option>
                                 @foreach ($reservoirs as $reservoir)
                                <option value="{{ $reservoir->id }}" 
                                    @if($reservoir->id == $member->reservoir_id) selected="selected" @endif
                                    >{{ $reservoir->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Išsaugoti</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
