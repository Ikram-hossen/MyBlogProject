@extends('layouts.backend.app')
@push('css')
     <!-- JQuery DataTable Css -->
     <link href="{{ asset('assets/backend/plugins/jquery-datatable/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endpush

@section('title', 'All Categories')
    
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <div class="bloak-header">
            <a class="btn btn-primary waves-effect" href="{{ route('admin.category.create')}}">
               <i class="material-icons">add</i>
               <span> Add New Category</span>
            </a>
        </div>
    </div>
   
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
               <div class="header">
                <h2>All CATEGORIES <span class="badge bg-blue">{{$categories->count()}}</span></h2>
               </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-exportable" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Category Name</th>
                                    <th>Post Count</th>
                                    <th>Slug</th>
                                    {{-- <th>Created at</th>
                                    <th>Updated at</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($categories  as $key=>$category)
                                   <tr>
                                        <td>{{ $key + 1}}</td>
                                        <td>{{ $category->name}}</td>
                                        <td>{{ $category->posts->count()}}</td>
                                        <td>{{ $category->slug}}</td>
                                        {{-- <td>{{ $category->created_at}}</td>
                                        <td>{{ $category->updated_at}}</td> --}}
                                        <td class="text-center">
                                            <a href="{{ route('admin.category.edit', $category->id)}}" class="btn btn-info waves-effect" style="margin-bottom:5px;">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <button onclick="deleteCategory({{ $category->id }})" type="button" class="btn btn-danger waves-effect" style="margin-bottom:5px;">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form id="delete-form-{{ $category->id }}" action="{{ route('admin.category.destroy', $category->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                   </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->
</div>
@endsection

@push('js')
     <!-- Jquery DataTable Plugin Js -->
     <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
     <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
     <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
     <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
     <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
     <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
     <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.j') }}s"></script>
     <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
     <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
     <script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>
     {{-- DataTable plugin js --}}
     <script type="text/javascript" src="{{ asset('assets/backend/plugins/jquery-datatable/js/jquery.dataTables.min.js') }}"></script>
     <script type="text/javascript" src="{{ asset('assets/backend/plugins/jquery-datatable/js/dataTables.bootstrap.min.js') }}"></script>
     <script type="text/javascript">$('#sampleTable').DataTable();</script>
     
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
     <script type="text/javascript">
        function deleteCategory(id){
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You want to delete this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
               event.preventDefault();
               document.getElementById('delete-form-' + id).submit();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your Data is safe :)',
                'error'
                )
            }
          })
        }
     </script>
@endpush
