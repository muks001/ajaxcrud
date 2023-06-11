<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <table border="2px">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{$product->name}}</td>
                <td>{{ $product->price }}</td>
                <td>-</td>
                <td>
                    <a href="#" class="show-button" data-bs-toggle="modal" data-bs-target="#showProduct" id="{{$product->id}}">show</a>
                    <a href="#" class="edit-button" data-bs-toggle="modal" data-bs-target="#editProduct" id="{{$product->id}}">edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>






{{-- show Product modal start --}}
<div class="modal fade" id="showProduct" tabindex="-1" aria-labelledby="exampleModalLabel"
    data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Show Employee</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">close</button>
            </div>
            {{-- <form action="#" method="POST" id="edit_employee_form" enctype="multipart/form-data">
        @csrf --}}
            <input type="hidden" name="id" id="id">

            <div class="modal-body p-4 bg-light">
                <div class="row">
                    <div class="col-lg">
                        <label for="name">Product Name</label>

                        <input type="text" name="name" id="name" class="form-control" placeholder="Product Name" disabled>
                    </div>
                    <div class="col-lg">
                        <label for="price">Product Price</label>
                        <input type="number" name="price" id="price" class="form-control" placeholder="Product Price" disabled>
                    </div>
                </div>
                <div class="mt-2" id="avatar">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-button" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- show employee modal end --}}













{{-- edit Product modal start --}}
<div class="modal fade" id="editProduct-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">close</button>
            </div>
            <form action="#" method="POST" id="edit_product_form" enctype="multipart/form-data">
        @csrf
            <input type="hidden" name="id" id="id">

            <div class="modal-body p-4 bg-light">
                <div class="row">
                    <div class="col-lg">
                        <label for="name">Product Name</label>

                        <input type="text" name="name" id="name" class="form-control" placeholder="Product Name" >
                    </div>
                    <div class="col-lg">
                        <label for="price">Product Price</label>
                        <input type="number" name="price" id="price" class="form-control" placeholder="Product Price" >
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit">update</button>
                <button type="button" class="btn btn-secondary close-button" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- show employee modal end --}}









<script>

$(document).on('click', '.edit-button', function(e) {
    e.preventDefault();
    let id = $(this).attr('id');
    $.ajax({
        url: '{{route('edit.product')  }}',
        method:'get',
    data: {
        id: id,
        _token: '{{ csrf_token() }}'
    },
    success: function(response) {

        $("#editProduct-modal").modal('show');
        // $("#close-button").modal('hide');
        // $("#avatar").html(
        //   `<img src="storage/images/${response.avatar}" width="100" class="img-fluid img-thumbnail">`);
        $("#id").val(response.id);
        $("#name").val(response.name);
        $("#price").val(response.price);
    
    //    $("#emp_avatar").val(response.avatar);
    }
    });
});






    $(document).on('click', '.show-button', function(e) {
    e.preventDefault();
    let id = $(this).attr('id');
    $.ajax({
    data: {
        id: id,
    },
    success: function(response) {
        $("#showProduct").modal('show');
        // $("#close-button").modal('hide');
        // $("#avatar").html(
        //   `<img src="storage/images/${response.avatar}" width="100" class="img-fluid img-thumbnail">`);
        $("#id").val(response.id);
        $("#name").val(response.name);
        $("#price").val(response.price);
    
    //    $("#emp_avatar").val(response.avatar);
    }
    });
});






$("#edit_product_form").submit(function(e) {
        
    alert('kjhgfdxxfgh');
        e.preventDefault();
        const fd = new FormData(this);

        $("#edit_employee_btn").text('Updating...');
        $.ajax({
        url: '{{ route('update.product') }}',
        method: 'post',
        data: fd,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
            if (response.status == 200) {
                window.location.reload();
                Swal.fire(
                'Updated!',
                'Employee Updated Successfully!',
                'success'
                )
                fetchAllEmployees();
            }
            $("#edit_employee_btn").text('Update Employee');
            $("#edit_employee_form")[0].reset();
            $("#editEmployeeModal").modal('hide');
        }
        });
    });


</script>
</body>
</html>