<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

    <a href="{{route('school.store')}}" data-target="createSchool-modal" >create school</a>
    <table border="4px">
        <thead>
            <tr>
                <th>sr no.</th>
                <th> teacher name</th>
                <th>teacher student</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schools as $school)
            <tr>
                <td>{{$school->id}}</td>
                <td>{{$school->teacher_name}}</td>
                <td>{{$school->teacher_image}}</td>
                <td>
                    <a href="{{route('school.show',$school)}}"  class="showSchool">show</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>



    {{-- show product modal --}}
    <div class="modal fade" id="show-product-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="show-modal-details">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <span class="showschool_name"></span>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- end show product modal --}}







        {{-- create product modal --}}
        <div class="modal fade" id="create-school-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="show-modal-details">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">create message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('school.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input type="text" name="teacher_name" id="teacher_name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            
                            <input type="file" name="teacher_image" id="teacher_image">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- end show product modal --}}



<script>
    $(document).on('click','.showSchool',function(e){
        e.preventDefault();
        let url = $(this).attr('href');
        $.ajax({
            url:url,
            method:'get',
            success: function(response){
                let school = response.data
                $("#show-product-Modal").modal('show');
                let form  = $("#show-product-Modal .show-modal-details");
                form.find(".showschool_name").html(school.teacher_name)
            }
        })
    })




    $("#createSchool-modal").submit(function(e){

        e.preventDefault();
        let url = $(this).att('action')
        let method = $(this).att('method')
        var formData = new FormData($(this)[0]);
        $.ajax({
            url:url,
            method:'POST',
            data: formData,
            dataType:json,
            success:function(response){
                $("#create-school-Modal").modal('show');

            }

    })

    })












    
</script>
</body>
</html>