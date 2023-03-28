@extends('layouts.backend.master')

@section('title')
    List Employee
@endsection

@section('button-header')
    <div class="btn-list">
        <button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#modal-simple">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-spreadsheet" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                <path d="M8 11h8v7h-8z"></path>
                <path d="M8 15h8"></path>
                <path d="M11 11v7"></path>
            </svg>
            Import Excell
        </button>
    </div>
@endsection

@section('content')
    <div class="row row-cards">
        <div class="col-md-8">
            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                        <div class="alert alert-danger alert-dismissible">
                            <h4><i class="icon fa fa-ban"></i> Error!</h4>
                            @foreach ($errors->all() as $error)
                                {{ $error }} <br>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Company</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Balance</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->company->name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-muted">
                                        {{ $item->email }}
                                    </td>
                                    <td class="text-muted">
                                        Rp {{ number_format($item->balance) }}
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a href="{{ route('employee.edit', $item->id) }}" class="btn btn-md btn-info">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-edit" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                    </path>
                                                    <path
                                                        d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                    </path>
                                                    <path d="M16 5l3 3"></path>
                                                </svg>
                                            </a>
                                            <form method="POST" action="{{ route('employee.destroy', $item->id) }}">
                                                @csrf @method('DELETE')
                                                <button type="submit" data-url="{{ route('employee.destroy', $item->id) }}"
                                                    class="btn btn-md btn-danger deleteBtn">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-trash" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M4 7l16 0"></path>
                                                        <path d="M10 11l0 6"></path>
                                                        <path d="M14 11l0 6"></path>
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Not Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted">Showing <span>5</span> to <span>{{ $data->total() }}</span>
                        entries</p>
                    <ul class="pagination m-0 ms-auto">
                        {!! $data->links() !!}
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <form class="card" action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
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
                            value="{{ old('name') }}" placeholder="E.G Hai Ojan">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email-Address</label>
                        <input class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" placeholder="your-email@domain.com">
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
                                    name="balance" value="{{ old('balance') }}" placeholder="E.G 50000">
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
                    <button class="btn btn-primary w-100">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal modal-blur" id="modal-simple" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Excell</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('employee.importExcel') }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PATCH')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Select Excell File</label>
                            <input type="file" class="form-control" name="excel">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                    </div>
                </form>
            </div>
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
                url: '{{ route('employee.index') }}',
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
