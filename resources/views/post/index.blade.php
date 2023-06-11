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
</head>
<body>
    <table border="2px">
        <a href="#" data-target="#createProduct-modal" data-toggle="modal" >create</a>
        <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
            <tr>
                <td>{{$post->name}}</td>
                <td><img src="{{ $post->image_url }}" alt="" width="150" srcset=""></td>
                <td>
                    <a href="{{ route('post.edit',$post) }}" class="edit">edit</a>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="3">There is no post.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

{{-- edit Product modal start --}}
<div class="modal fade" id="editProduct-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">close</button>
            </div>
            <form action="{{ route('post.update','post_id') }}" method="POST" enctype="multipart/form-data">
            <div class="modal-body p-4 bg-light">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg">
                        <label for="name">Post Name</label>

                        <input type="text" name="name" id="name" class="form-control" placeholder="Product Name" >
                    </div>
                    <div class="col-lg">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">update</button>
                <button type="button" class="btn btn-secondary close-button" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- edit employee modal end --}}







{{-- create Product modal start --}}
<div class="modal fade" id="createProduct-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">create Post</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">close</button>
            </div>
            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            <div class="modal-body p-4 bg-light">
                @csrf
                <div class="row">
                    <div class="col-lg">
                        <label for="name">Post Name</label>

                        <input type="text" name="name" id="name" class="form-control" placeholder="Product Name" >
                    </div>
                    <div class="col-lg">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">save</button>
                <button type="button" class="btn btn-secondary close-button" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- show employee modal end --}}

<script>

$(document).on('click', '.edit', function(e) {
    e.preventDefault();
    let url = $(this).attr('href');
    $.ajax({
        url: url,
        method:'get',
        success: function(response) {
            let post = response.data
            $("#editProduct-modal").modal('show');
            let form = $("#editProduct-modal form");
            let url = form.attr('action')
            url = url.replace('post_id',post.id)
            form.attr('action',url)
            form.find("input[name='name']").val(post.name)
            let html = '<img src="'+post.image_url+'" width="150">';
            form.find("input[name='image']").parent().append(html)   
        }
    });
});

$("#editProduct-modal form, #createProduct-modal form").submit(function(e) {
        $('.error').remove()
        e.preventDefault();
        let url = $(this).attr('action')
        let method = $(this).attr('method')
        var formData = new FormData($(this)[0]);
        $.ajax({
        url: url,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType:'json',
        success: function(response) {
            alert(response.message)
            $("#editProduct-modal").modal('hide');
            window.location.reload();
        },
        error: function (err) {
        if (err.status == 422) { 

            // display errors on each form field
            let errors = JSON.parse(err.responseText);
            $.each(errors.errors, function (i, error) {
                var el = $(document).find('[name="'+i+'"]');
                el.after($('<span class="error text-danger">'+error[0]+'</span>'));
            });
        }
    }
        });
    });


</script>
</body>
</html>