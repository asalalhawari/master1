@extends("dashboard.masterpage")

@section("content")
<div class="container">
    <h1 class="text-center">إدارة الخدمات</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    <div class="mb-3 d-flex justify-content-between">
        <a href="{{ route('services.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle"></i> إضافة خدمة جديدة
        </a>
        
        <div class="form-group">
            <input type="text" id="searchInput" class="form-control" placeholder="بحث...">
        </div>
    </div>
    
    @if($services->count() > 0)
        <div class="table-responsive">
            <table class="table text-center table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>الوصف</th>
                        <th>السعر</th>
                        <th>المدة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $index => $service)
                        <tr>
                            <td>{{ $index + 1 + ($services->currentPage() - 1) * $services->perPage() }}</td>
                            <td>{{ $service->name }}</td>
                            <td>{{ Str::limit($service->description, 50) }}</td>
                            <td>{{ number_format($service->price, 2) }} ريال</td>
                            <td>{{ $service->duration }} دقيقة</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('services.show', $service->id) }}" class="btn btn-primary btn-sm" title="عرض">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning btn-sm" title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="حذف" 
                                                onclick="return confirm('هل أنت متأكد من حذف خدمة {{ $service->name }}؟')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4 d-flex justify-content-center">
            {{ $services->links() }}
        </div>
    @else
        <div class="text-center alert alert-info">
            <i class="mb-3 fas fa-info-circle fa-2x"></i>
            <p>لا توجد خدمات متاحة حالياً.</p>
            <a href="{{ route('services.create') }}" class="mt-2 btn btn-primary">إضافة خدمة جديدة</a>
        </div>
    @endif
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // بحث مباشر في الجدول
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
@endpush
@endsection