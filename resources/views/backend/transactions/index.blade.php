@extends('layouts.backend.master')

@section('title')
    Transaction Balance All
@endsection

@section('content')
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Company</th>
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
                                    <td>{{ $item->company->name }}</td>
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
                                    <td colspan="8" class="text-center">Not Found</td>
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
    </div>
@endsection
