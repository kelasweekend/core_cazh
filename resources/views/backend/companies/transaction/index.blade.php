@extends('layouts.backend.master')

@section('title')
    Transaction Balance | {{ $company->name }} Company
@endsection

@section('button-header')
    <div class="btn-list">
        <a href="{{ route('companies.detail', $company->id) }}" class="btn btn-primary d-none d-sm-inline-block">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M9 14l-4 -4l4 -4"></path>
                <path d="M5 10h11a4 4 0 1 1 0 8h-1"></path>
            </svg>
            Back To Company
        </a>
        <a href="{{ route('companies.detail', $company->id) }}" class="btn btn-primary d-sm-none btn-icon">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M9 14l-4 -4l4 -4"></path>
                <path d="M5 10h11a4 4 0 1 1 0 8h-1"></path>
            </svg>
        </a>
    </div>
@endsection

@section('content')
    <div class="row row-cards">
        <div class="col-md-8">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Employee</th>
                                <th>Balance</th>
                                <th>Start Company</th>
                                <th>Last Company</th>
                                <th>Start Employee</th>
                                <th>last Employee</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->employee->name }}</td>
                                    <td class="text-muted">
                                        Rp {{ number_format($item->balance) }}
                                    </td>
                                    <td class="text-muted">
                                        Rp {{ number_format($item->company_start_balance) }}
                                    </td>
                                    <td class="text-muted">
                                        Rp {{ number_format($item->company_last_balance) }}
                                    </td>
                                    <td class="text-muted">
                                        Rp {{ number_format($item->employee_start_balance) }}
                                    </td>
                                    <td class="text-muted">
                                        Rp {{ number_format($item->employee_last_balance) }}
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Not Found</td>
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
            <form class="card" action="{{ route('companies.transaction.store', $company->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <h3 class="card-title">Add Balance</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-label">Select Employee</div>
                        <select class="form-select @error('employee') is-invalid @enderror" name="employee" id="employee">
                        </select>
                        @error('employee')
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
@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $('#employee').select2({
            theme: 'bootstrap-5',
            placeholder: 'Select Employee',
            ajax: {
                url: '{{ route('companies.transaction', $company->id) }}',
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
    </script>
@endsection
