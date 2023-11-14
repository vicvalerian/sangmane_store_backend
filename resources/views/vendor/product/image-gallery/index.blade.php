@extends('vendor.layouts.master')

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <a href="{{route('vendor.product.index')}}" class="btn btn-warning mb-4"><i class="fas fa-chevron-left"></i> Back</a>
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="fas fa-images"></i> product: {{ $product->name }}</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form action="{{ route('vendor.product-image-gallery.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group wsus__input">
                                        <label for="">Image <code>(Multiple Image Supported)</code></label>
                                        <input type="file" name="image[]" class="form-control" multiple>
                                        <input type="hidden" value="{{ $product->id }}" name="product">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="fas fa-images"></i> list of product image galleries</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                {{ $dataTable->table(['style' => 'width: 100%']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
