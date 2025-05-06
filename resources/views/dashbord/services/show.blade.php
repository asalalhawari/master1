@extends("dashboard.masterpage")

@section('content')
<div class="container py-4">
    <div class="shadow-sm card">
        <div class="text-white card-header bg-primary d-flex justify-content-between align-items-center">
            <h3 class="mb-0 card-title">تفاصيل الخدمة البيطرية</h3>
            <div>
                <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> تعديل
                </a>
                <a href="{{ route('services.index') }}" class="btn btn-light btn-sm ms-2">
                    <i class="fas fa-list"></i> قائمة الخدمات
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="mb-4 col-md-4 mb-md-0">
                    @if(isset($service->image))
                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="rounded img-fluid">
                    @else
                        <div class="rounded bg-light d-flex justify-content-center align-items-center" style="height: 200px;">
                            <i class="fas fa-paw fa-4x text-muted"></i>
                        </div>
                    @endif
                    
                    <div class="mt-3 text-center">
                        <span class="badge bg-{{ $service->status == 'active' ? 'success' : 'danger' }} p-2">
                            {{ $service->status == 'active' ? 'متاحة' : 'غير متاحة' }}
                        </span>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <h2 class="mb-3">{{ $service->name }}</h2>
                    
                    <div class="mb-4">
                        <h5 class="text-muted">وصف الخدمة</h5>
                        <p>{{ $service->description ?: 'لا يوجد وصف متاح.' }}</p>
                    </div>
                    
                    <div class="mb-4 row">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="text-center card-body">
                                    <h5 class="card-title">السعر</h5>
                                    <p class="card-text fs-4 fw-bold text-primary">{{ number_format($service->price, 2) }} ريال</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="text-center card-body">
                                    <h5 class="card-title">المدة</h5>
                                    <p class="card-text fs-4 fw-bold text-primary">{{ $service->duration }} دقيقة</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h5 class="text-muted">معلومات إضافية</h5>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                نوع الحيوانات
                                <span>{{ $service->animal_type ?? 'جميع الحيوانات الأليفة' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                الطبيب المسؤول
                                <span>{{ $service->doctor ?? 'جميع الأطباء' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                تاريخ الإضافة
                                <span>{{ $service->created_at->format('Y-m-d') }}</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="gap-2 d-grid">
                        <a href="{{ route('bookings.create', ['service_id' => $service->id]) }}" class="btn btn-success">
                            <i class="fas fa-calendar-plus me-1"></i> حجز موعد لهذه الخدمة
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-between">
                <div>
                    <small class="text-muted">تم التحديث: {{ $service->updated_at->diffForHumans() }}</small>
                </div>
                <div>
                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذه الخدمة؟');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash me-1"></i> حذف الخدمة
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection