@extends("dashbord.masterpage")


@section("content")






<table style="width: 80%; margin: auto; border-collapse: collapse; text-align: left; font-family: Arial, sans-serif; border: 1px solid #ddd;">
    <thead style="background-color: black;">
        <tr>
            <th style="padding: 10px; border: 1px solid #ddd; color: #fff;">#</th>
            <th style="padding: 10px; border: 1px solid #ddd; color: #fff;">Name</th>
            <th style="padding: 10px; border: 1px solid #ddd; color: #fff;">Email</th>
            <th style="padding: 10px; border: 1px solid #ddd; color: #fff;">message</th>
            <th style="padding: 10px; border: 1px solid #ddd; color: #fff;">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($contacts as $contact)
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $contact->id }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $contact->name }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $contact->email }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $contact->message }}</td>

                <td style="padding: 10px; border: 1px solid #ddd;">
                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-weight: bold; transition: background-color 0.3s ease;"
                            onmouseover="this.style.backgroundColor='#c82333';"
                            onmouseout="this.style.backgroundColor='#dc3545';">
                            Delete
                        </button>
                    </form>
                                    </td>
            </tr>
        @endforeach
    </tbody>
</table>


</body>
</html>


@endsection
