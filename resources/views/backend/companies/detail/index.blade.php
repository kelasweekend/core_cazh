@extends('layouts.backend.master')

@section('title')
    Company {{ $data['company']->name }}
@endsection

@section('button-header')
    <div class="btn-list">
        <a href="{{ route('companies.transaction', $data['company']->id) }}" class="btn btn-primary d-none d-sm-inline-block">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
            </svg>
            Add Transaction
        </a>
        <a href="{{ route('companies.transaction', $data['company']->id) }}" class="btn btn-primary d-sm-none btn-icon">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
            </svg>
        </a>
    </div>
@endsection

@section('content')
    <div class="row row-cards">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-4">
                        <h3>List Employee</h3>
                        <div class="tombol">
                            <a href="{{ route('companies.exportPDF', $data['company']->id) }}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pdf"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10 8v8h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-2z"></path>
                                    <path d="M3 12h2a2 2 0 1 0 0 -4h-2v8"></path>
                                    <path d="M17 12h3"></path>
                                    <path d="M21 8h-4v8"></path>
                                </svg>
                                Export PDF
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['employee'] as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td class="text-muted">
                                            {{ $item->email }}
                                        </td>
                                        <td class="text-muted">
                                            Rp {{ number_format($item->balance) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Not Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted">Showing <span>5</span> to <span>{{ $data['employee']->total() }}</span>
                        entries</p>
                    <ul class="pagination m-0 ms-auto">
                        {!! $data['employee']->links() !!}
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <form class="card" action="{{ route('companies.update', $data['company']->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf @method('PATCH')
                <div class="card-header">
                    <h3 class="card-title">Update Company</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-auto">
                                <img src="{{ url('storage/app/company/' . $data['company']->logo) }}" width="80"
                                    height="80" alt="" class="shadow-sm" id="blah">
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Upload Logo</label>
                                    <input class="form-control @error('image') is-invalid @enderror" name="image"
                                        type="file" id="imgInp">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ $data['company']->name }}" placeholder="E.G Hai Ojan">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email-Address</label>
                        <input class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ $data['company']->email }}" placeholder="your-email@domain.com">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Balance</label>
                                <input type="number" class="form-control @error('balance') is-invalid @enderror"
                                    name="balance" value="{{ $data['company']->balance }}" placeholder="E.G 50000">
                                @error('balance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Website</label>
                                <input type="text" class="form-control @error('website') is-invalid @enderror"
                                    name="website" value="{{ $data['company']->website }}" placeholder="E.G google.com">
                                @error('website')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary w-100">Update Company</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
