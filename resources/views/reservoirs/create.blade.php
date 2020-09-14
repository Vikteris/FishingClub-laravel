@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Naujas telkinys:</div>
               <div class="card-body">
                   <form action="{{ route('reservoirs.store') }}" method="POST">
                       @csrf
                       {{-- Alert msg. galima det ir kaip atskiram inputui kad išmesti errorui jei inputas neužpildytas --}}
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        {{-- ----------- --}}
                       <div class="form-group">
                           <label>Pavadinimas: </label>
                           <input type="text" name="title" class="form-control">
                       </div>
                       @error('area')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                       <div class="form-group">
                           <label>Plotas kv. m.: </label>
                           <input type="decimal" name="area" class="form-control"> 
                       </div>
                       @error('about')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                       <div class="form-group">
                           <label>Aprašas: </label>
                           <textarea id="mce" name="about" rows=10 cols=100 class="form-control"></textarea>
                       </div>
                       <button type="submit" class="btn btn-primary">Submit</button>
                   </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection