@extends('back.layout.template')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<style>
    .truncate {
        max-width: 150px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .action-buttons {
        white-space: nowrap;
    }
</style>
@endpush

@section('title','Articles - Admin')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Articles</h1>
    </div>
    <div class="mt-3">
        <a href="{{ route('article.create') }}" class="btn btn-success mb-2">Create Article</a>

        @if ($errors->any())
        <div class="my-3">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        @if (session('success'))
        <div class="my-3">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Content</th>
                        <th>Views</th>
                        <th>Status</th>
                        <th>Publish Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</main>

@include('back.article.delete')

@push('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url()->current() }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'category.name', name: 'category.name' },
                { 
                    data: 'desc', 
                    name: 'desc',
                    render: function(data, type, row) {
                        return '<div class="truncate" title="' + data + '">' + data + '</div>';
                    }
                },
                { data: 'views', name: 'views' },
                { 
                    data: 'status', 
                    name: 'status',
                    render: function(data, type, row) {
                        return data == 1 ? 
                            '<span class="badge bg-danger">Private</span>' : 
                            '<span class="badge bg-success">Public</span>';
                    }
                },
                { data: 'publish_date', name: 'publish_date' },
                { 
                    data: 'button', 
                    name: 'button', 
                    orderable: false, 
                    searchable: false,
                    render: function(data, type, row) {
                        return '<div class="action-buttons">' + data + '</div>';
                    }
                }
            ],
            order: [[0, 'desc']]
        });

        $(document).on('click', '.btn-delete', function() {
            var articleId = $(this).data('id');
            var url = '{{ route("article.destroy", ":id") }}'.replace(':id', articleId);
            $('#modalDelete').modal('show');
            $('#deleteForm').attr('action', url);
        });

        $('#deleteForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#modalDelete').modal('hide');
                    $('#dataTable').DataTable().ajax.reload();
                    alert(response.success);
                }
            });
        });
    });
</script>
@endpush

@endsection