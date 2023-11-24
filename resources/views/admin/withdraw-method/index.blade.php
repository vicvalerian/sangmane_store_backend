@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Withdraw Method</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>List of Withdraw Methods</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.withdraw-method.create') }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i> Add Withdraw Method</a>
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
@endpush
