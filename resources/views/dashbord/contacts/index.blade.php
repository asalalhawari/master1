@extends('dashboard.masterpage')

@section('content')
<div class="container mt-4">
    <h1>Contact Us Messages</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>
                    <h5>Message:</h5>
                    <p>{{ $contact->message }}</p>
                    
                    @if($contact->reply)
                    <h5>Reply:</h5>
                    <p>{{ $contact->reply }}</p>
                    @endif
                </td>
                <td>
                    <div class="gap-2 d-flex justify-content-start">
                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#replyModal{{ $contact->id }}">
                            Reply
                        </button>
                    </div>
                    
                    <!-- Reply Modal -->
                    <div class="modal fade" id="replyModal{{ $contact->id }}" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="replyModalLabel">Reply to {{ $contact->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('contacts.reply', $contact->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="reply" class="form-label">Your Reply</label>
                                            <textarea class="form-control" id="reply" name="reply" rows="5" required>{{ $contact->reply }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Send Reply</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection