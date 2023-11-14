@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Seller Product</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>List of Seller Products</h4>
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
            //change status
            $('body').on('click', '.change-status', function() {
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('admin.product.change-status') }}",
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

            //approve product
            $('body').on('change', '.is_approve', function() {
                let value = $(this).val();
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('admin.seller-pending-product.approve') }}",
                    method: 'PUT',
                    data: {
                        value: value,
                        id: id,
                    },
                    success: function(data) {
                        toastr.success(data.message);
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    },
                })
            })
        })
    </script>
@endpush
