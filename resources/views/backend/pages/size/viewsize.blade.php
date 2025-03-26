@extends('backend.master.masterback')
@section('title')
Size List
@endsection
@push('link')
<link href="{{asset('backend/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet"
    type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush
@section('content')

<div class="col-md-12 col-lg-12 ">
    <div class="d-flex justify-content-between py-2">
        <h2 class="text-center">Size</h2>
{{-- <a href="{{url('admins/color')}}" class="btn btn-primary">
    NEW COLOR</a> --}}
<button type="button" onclick="openNewModal(true)" id="NewAddButtonID" class="btn btn-primary">
    NEW Size</button>
</div>

<table id="TableID" class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NAME</th>
                <th scope="col">Code</th>
                <th scope="col">ACTION</th>
            </tr>
        </thead>

        <tbody>
@foreach ($sizes as $index => $value )
<tr id="color-{{$value->id}}">
    <td>{{$value->id}}</td>
                <td>{{$value->size}}</td>
                <td>{{$value->size_code}}</td>
                <td>
<button type="button" data-id="{{$value->id}}" class="btn btn-warning mb-2 mr-2 openModal">Edit</button>
                    <a href="{{url('admins/size/delete/'.$value->id)}}" onclick="return confirm('Are you Sure ?')"
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
                                <input type="hidden" class="form-control" id="sizesHid">
                                <label for="SizeName" class="form-label">Size Name</label>
                                <input type="text" class="form-control" id="SizeName" name="sizesHidName">
                            </div>
                            <div class="mb-3">
                                <label for="SizesCodes" class="form-label">Size_code</label>
                                <input type="text" class="form-control" id="SizesCodes" name="colorjID">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer md-button">
                <button class="btn" data-dismiss="modal" onclick="openNewModal(false)"><i
                        class="flaticon-cancel-12"></i> Discard</button>
                <button type="button" id="submitUpdateSizebtn" class="btn btn-primary">UPDATE</button>
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
        let SizeCode = tr.next().next()[0].innerText;
        document.getElementById("SizeName").value = name;
        document.getElementById("SizesCodes").value = SizeCode;
        document.getElementById("sizesHid").value = id;
        $("#slideupModal").modal().show()
    });

    function openNewModal(isTrue){
        document.getElementById("SizeName").value = '';
        document.getElementById("SizesCodes").value = '';
        document.getElementById("sizesHid").value = '';
        const modal = $("#slideupModal").modal();
        isTrue ? modal.show() : modal.hide()
    }
    
    $('#submitUpdateSizebtn').on('click',function(event){
        event.preventDefault();
        var editSizeName = $('#SizeName').val();
        var editSizesCode = $('#SizesCodes').val();
        var editsizesHid = $('#sizesHid').val();

        let editSizes = {
            name: editSizeName,
            SizeCode: editSizesCode,
            id: editsizesHid
        }

        $.ajax({
            url: "{{url('admins/size/update')}}",
            type: 'POST',
            data: editSizes,
            dataType: 'json',
            success: function(response){
                if(response.status == 'success'){
                    const myTr = document.getElementById("color-" + editsizesHid);
                    if (myTr) {
                        const children = myTr.children;
                        if (children.length >= 3) { 
                            children[0].textContent = editSizes.id;
                            children[1].textContent = editSizes.name;
                            children[2].textContent = editSizes.SizeCode;
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