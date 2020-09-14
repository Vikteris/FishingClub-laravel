@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Sukurkime klientą:</div>
               <div class="card-body">
                   <form action="{{ route('members.store') }}" method="POST">
                        @csrf
                        {{-- Alert msg. galima det ir kaip atskiram inputui kad išmesti errorui jei inputas neužpildytas --}}
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        {{-- ----------- --}}
                        <div class="form-group">
                            <label>Vardas: </label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        @error('surname')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Pavardė: </label>
                            <input type="text" name="surname" class="form-control"> 
                        </div>

                        @error('live')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Gyvenamoji vieta: </label>
                            <input type="text" name="live" class="form-control"> 
                        </div>

                        @error('experience')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label>Patirtis: </label>
                            <input type="number" name="experience" class="form-control"> 
                        </div>

                        @error('registered')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @if($errors->any())
                            <h4 style="color: green">{{$errors->first()}}</h4>
                        @endif
                        
                        <div class="form-group">
                            <label>Registruotas: </label>
                            <input type="number" name="registered" class="form-control"> 
                        </div>

                        <div class="form-group">
                            <label>Žvejoja: </label>
                            <select name="reservoir_id" id="" class="form-control">
                                 <option value="" selected disabled>Pasirinkite tvenkinį</option>
                                 @foreach ($reservoirs as $reservoir)
                                 <option value="{{ $reservoir->id }}">{{ $reservoir->title }}</option>
                                 @endforeach
                            </select>
                        </div>
                       <button type="submit" class="btn btn-primary">Sukurkite</button>
                   </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection