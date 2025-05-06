@extends("dashboard.masterpage")

@section('content')
<div class="container">
    <div class="shadow-sm card">
        <div class="text-white card-header bg-primary">
            <h3 class="mb-0 card-title">إضافة خدمة جديدة</h3>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">اسم الخدمة:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                            <div class="form-text">أدخل اسماً واضحاً ومميزاً للخدمة</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="price" class="form-label fw-bold">السعر:</label>
                            <div class="input-group">
                                <input type="number" name="price" id="price" class="form-control" step="0.01" min="0" value="{{ old('price') }}" required>
                                <span class="input-group-text">ريال</span>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="duration" class="form-label fw-bold">المدة (بالدقائق):</label>
                            <input type="number" name="duration" id="duration" class="form-control" min="1" value="{{ old('duration') }}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">وصف الخدمة:</label>
                            <textarea name="description" id="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                            <div class="form-text">أضف وصفاً تفصيلياً للخدمة</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="image" class="form-label fw-bold">صورة الخدمة:</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            <div class="form-text">الصيغ المدعومة: JPG, PNG, GIF (الحد الأقصى: 2MB)</div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">حالة الخدمة:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status_active" value="active" {{ old('status', 'active') == 'active' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_active">
                                    متاحة
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status_inactive" value="inactive" {{ old('status') == 'inactive' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_inactive">
                                    غير متاحة
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('services.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> العودة إلى قائمة الخدمات
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus-circle me-1"></i> إضافة الخدمة
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // يمكنك إضافة سكريبت للتحقق من الصورة قبل الرفع
    document.getElementById('image').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const fileSize = file.size / 1024 / 1024; // تحويل إلى ميجابايت
            if (fileSize > 2) {
                alert('حجم الصورة يتجاوز الحد المسموح به (2MB)');
                this.value = '';
            }
        }
    });
</script>
@endpush
@endsection