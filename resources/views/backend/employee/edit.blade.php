@extends('layouts.backend.master')

@section('title')
    Edit Employee {{ $data->name }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4">
            <form class="card" action="{{ route('employee.update', $data->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf @method('PATCH')
                <div class="card-header">
                    <h3 class="card-title">Add Employee</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-label">Select Company</div>
                        <select class="form-select @error('company') is-invalid @enderror" name="company" id="company">
                        </select>
                        @error('company')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ $data->name }}" placeholder="E.G Hai Ojan">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email-Address</label>
                        <input class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ $data->email }}" placeholder="your-email@domain.com">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Balance</label>
                                <input type="number" class="form-control @error('balance') is-invalid @enderror"
                                    name="balance" value="{{ $data->balance }}" placeholder="E.G 50000">
                                @error('balance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary w-100">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $('#company').select2({
            theme: 'bootstrap-5',
            placeholder: 'Select Company',
            ajax: {
                url: '{{ route('employee.edit', $data->id) }}',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
            }
        });

        $('.deleteBtn').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
