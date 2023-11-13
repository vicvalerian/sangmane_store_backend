@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product Variant</h1>
        </div>
        <div class="mb-4">
            <a href="{{ route('admin.product.index') }}" class="btn btn-primary">Back</a>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Product: {{ $product->name }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.product-variant.create', ['product' => $product->id]) }}"
                                    class="btn btn-primary"><i class="fas fa-plus"></i> Add Product Variant</a>
                            </div>
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

    <script>
        $(document).ready(function() {
            $('body').on('click', '.change-status', function() {
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('admin.product-variant.change-status') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id,
                    },
                    success: function(data) {
                        toastr.success(data.message);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    },
                })
            })
        })
    </script>
@endpush
