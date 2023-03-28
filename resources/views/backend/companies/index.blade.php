@extends('layouts.backend.master')

@section('title')
    Management Company
@endsection

@section('content')
    <div class="row row-cards">
        <div class="col-md-8">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-vcenter table-mobile-md card-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Info</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td data-label="Name">
                                        <div class="d-flex py-1 align-items-center">
                                            <span class="avatar me-2"
                                                style="background-image: url({{ url('storage/app/company/' . $item->logo) }})"></span>
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ $item->name }}</div>
                                                <div class="text-muted"><a href="#"
                                                        class="text-reset">{{ $item->email }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Title">
                                        <div>Balance Rp {{ number_format($item->balance) }}</div>
                                        <div class="text-muted">{{ $item->website }}</div>
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a href="{{ route('companies.detail', $item->id) }}" class="btn btn-info">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-list" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M9 6l11 0"></path>
                                                    <path d="M9 12l11 0"></path>
                                                    <path d="M9 18l11 0"></path>
                                                    <path d="M5 6l0 .01"></path>
                                                    <path d="M5 12l0 .01"></path>
                                                    <path d="M5 18l0 .01"></path>
                                                </svg> Detail
                                            </a>
                                            <form method="POST" action="{{ route('companies.destroy', $item->id) }}">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    data-url="{{ route('companies.destroy', $item->id) }}"
                                                    class="btn btn-danger deleteBtn">
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
                                                    </svg> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Data Not Found</td>
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
            <form class="card" action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <h3 class="card-title">Add New</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-auto">
                                {{-- <span class="avatar avatar-md"
                                    style="background-image: url(./)"></span> --}}
                                <img src="https://sipr.mojokertokab.go.id/images/avatar/no-image.jpg" width="80"
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
                        <div class="col-6">
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
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Website</label>
                                <input type="text" class="form-control @error('website') is-invalid @enderror"
                                    name="website" value="{{ old('website') }}" placeholder="E.G google.com">
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
                    <button class="btn btn-primary w-100">Submit</button>
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
