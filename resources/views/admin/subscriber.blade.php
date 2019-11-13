@extends('layouts.backend.app')
@push('css')
     <!-- JQuery DataTable Css -->
     <link href="{{ asset('assets/backend/plugins/jquery-datatable/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endpush
@section('title', 'All Subscribers')

@section('content')
<div class="container-fluid">
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
               <div class="header">
                <h2>All SUBSCRIBERS <span class="badge bg-blue">{{$subscribers->count()}}</span></h2>
               </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-exportable" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Email</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($subscribers  as $key=>$subscriber)
                                   <tr>
                                        <td>{{ $key + 1}}</td>
                                        <td>{{ $subscriber->email}}</td>
                                        <td>{{$subscriber->created_at->toFormattedDateString()}}</td>
                                        <td>{{$subscriber->updated_at->toFormattedDateString()}}</td>
                                        <td class="text-center">
                                            <button onclick="deleteSubscriber({{ $subscriber->id }})" type="button" class="btn btn-danger waves-effect">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form id="delete-form-{{ $subscriber->id }}" action="{{ route('admin.subscriber.destroy', $subscriber->id)}}" method="post">
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
        function deleteSubscriber(id){
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You want to delete this Subscriber!",
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
                'Subscriber exist still now :)',
                'error'
                )
            }
          })
        }
     </script>
@endpush
