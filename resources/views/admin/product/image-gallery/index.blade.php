@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product Image Gallery</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Product: {{ $product->name }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.product-image-gallery.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
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

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>List of Product Image Galleries</h4>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table(['style' => 'width: 100%']) }}
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
