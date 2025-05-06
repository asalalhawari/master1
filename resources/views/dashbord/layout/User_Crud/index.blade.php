@extends("dashbord.masterpage")


@section("content")



<div style="display: flex; justify-content: space-between; align-items: center; margin: 20px auto; width: 80%;">
    <button style="padding: 10px 20px; font-size: 14px; color: #fff; background-color: #28a745; border: none; border-radius: 5px; cursor: pointer; text-transform: uppercase; transition: background-color 0.3s;">
        <a href="{{ route('customer.create') }}" style="text-decoration: none; color: #fff;">Add New</a>
    </button>
</div>

<table style="width: 80%; margin: auto; border-collapse: collapse; text-align: left; font-family: Arial, sans-serif; border: 1px solid #ddd;">
    <thead style="background-color: black;">
        <tr>
            <th style="padding: 10px; border: 1px solid #ddd; color: #fff;">#</th>
            <th style="padding: 10px; border: 1px solid #ddd; color: #fff;">Name</th>
            <th style="padding: 10px; border: 1px solid #ddd; color: #fff;">Email</th>
            <th style="padding: 10px; border: 1px solid #ddd; color: #fff;">phone</th>
            <th style="padding: 10px; border: 1px solid #ddd; color: #fff;">Update</th>
            <th style="padding: 10px; border: 1px solid #ddd; color: #fff;">Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $customer->id }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $customer->name }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $customer->email }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $customer->phone }}</td>
                <td style="padding: 10px; border: 1px solid #ddd;"><h4>
    <a href="{{route('customer.edit',$customer->id)}}" style="color: #007bff; text-decoration: none; font-weight: bold; transition: color 0.3s ease;"
       onmouseover="this.style.color='#0056b3'; this.style.textDecoration='underline';"
       onmouseout="this.style.color='#007bff'; this.style.textDecoration='none';">
       Edit
    </a>
</h4>
</td>
                <td style="padding: 10px; border: 1px solid #ddd;">
                    <form action="{{ route('customer.destroy',$customer->id) }}" method="POST">
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


