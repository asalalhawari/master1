@extends('dashbord.masterpage')

@section('content')
<div class="container-fluid py-4">
    <h1 class="text-center mb-5">Client Messages</h1>

    <div class="row">
        @foreach($contacts as $contact)
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $contact->name }}</h5>
                    <small>{{ $contact->email }}</small>
                </div>
                <div class="card-body">
                    <p>{{ $contact->message }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
