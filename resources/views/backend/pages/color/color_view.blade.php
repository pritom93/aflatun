@extends('backend.master.masterback')
@section('title')
Category List
@endsection
@push('link')
<link href="{{asset('backend/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet"
    type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush
@section('content')

<div class="col-md-12 col-lg-12 ">
    <div class="d-flex justify-content-between py-2">
        <h2 class="text-center">Color</h2>
{{-- <a href="{{url('admins/color')}}" class="btn btn-primary">
    NEW COLOR</a> --}}
<button type="button" onclick="openNewModal(true)" id="NewAddButtonID" class="btn btn-primary">
    NEW COLOR</button>
</div>

<table id="TableID" class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NAME</th>
                <th scope="col">WONER</th>
                <th scope="col">ACTION</th>
            </tr>
        </thead>

        <tbody>
@foreach ($colors as $index => $value )
<tr id="color-{{$value->id}}">
    <td>{{$value->id}}</td>
                <td>{{$value->color_name}}</td>
                <td>{{$value->color_code}}</td>
                <td>
<button type="button" data-id="{{$value->id}}" class="btn btn-warning mb-2 mr-2 openModal">Edit</button>
                    <a href="{{url('admins/color/delete/'.$value->id)}}" onclick="return confirm('Are you Sure ?')"
                        class="btn btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
<div id="slideupModal" class="modal animated slideInUp custo-slideInUp" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" onclick="openNewModal(false)" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div id="EDITformID" class="form-container">
                    <div class="card-body">
                        <form id="colorFormNEWID">
                            <div class="mb-3">
                                <input type="hidden" class="form-control" id="colorId">
                                <label for="ColorName" class="form-label">Color Name</label>
                                <input type="text" class="form-control" id="colorName" name="ColorIDName">
                            </div>
                            <div class="mb-3">
                                <label for="colorNativeName" class="form-label">NativName</label>
                                <input type="text" class="form-control" id="colorNativeName" name="colorjID">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer md-button">
                <button class="btn" data-dismiss="modal" onclick="openNewModal(false)"><i
                        class="flaticon-cancel-12"></i> Discard</button>
                <button type="button" id="SubmitUpdateColorButton" class="btn btn-primary">UPDATE</button>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('backend_script')
<script>
    $('.openModal').on('click',function(event){
        event.preventDefault();
        let tr = $(this).closest("tr").children();
        let id = tr.first()[0].innerText;
        let name = tr.next()[0].innerText;
        let native_name = tr.next().next()[0].innerText;
        document.getElementById("colorName").value = name;
        document.getElementById("colorNativeName").value = native_name;
        document.getElementById("colorId").value = id;
        $("#slideupModal").modal().show()
    });

    function openNewModal(isTrue){
        document.getElementById("colorName").value = '';
        document.getElementById("colorNativeName").value = '';
        document.getElementById("colorId").value = '';
        const modal = $("#slideupModal").modal();
        isTrue ? modal.show() : modal.hide()
    }
    
    $('#SubmitUpdateColorButton').on('click',function(event){
        event.preventDefault();
        var editColorName = $('#colorName').val();
        var editColorNative = $('#colorNativeName').val();
        var editColorId = $('#colorId').val();

        let editcolor = {
            name: editColorName,
            native_name: editColorNative,
            id: editColorId
        }

        $.ajax({
            url: "{{url('admins/color_update')}}",
            type: 'POST',
            data: editcolor,
            dataType: 'json',
            success: function(response){
                if(response.status == 'success'){
                    const myTr = document.getElementById("color-" + editColorId);
                    if (myTr) {
                        const children = myTr.children;
                        if (children.length >= 3) { 
                            children[0].textContent = editcolor.id;
                            children[1].textContent = editcolor.name;
                            children[2].textContent = editcolor.native_name;
                        }
                        sweetMessage(response)
                    }
                    openNewModal(false)
                }else{
                    alert(response.error);
                }
            },
        });

    });

</script>
<script src="{{asset('form/vendor/jquery/jquery.min.js')}}"></script>
<!-- Vendor JS-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('form/vendor/select2/select2.min.js')}}"></script>
<script src="{{asset('form/vendor/datepicker/moment.min.js')}}"></script>
<script src="{{asset('form/vendor/datepicker/daterangepicker.js')}}"></script>

<!-- Main JS-->
<script src="{{asset('form/js/global.js')}}"></script>
@endpush