$(document).ready(function(){

	var url = "/users";
    //var url = "/ajax-crud/public/users";

    //display modal form for user editing
    $('.open-modal').click(function(){
        var user_id = $(this).val();

        $.get(url + '/' + user_id, function (data) {
            //success data
            console.log(data);
            $('#user_id').val(data.uuid);
            $('#username').val(data.nama);
            $('#alamat').val(data.alamat);
            $('#btn-save').val("update");

            $('#myModal').modal('show');
        }) 
    });

    //display modal form for creating new user
    $('#btn-add').click(function(){
        $('#btn-save').val("add");
        $('#frmUsers').trigger("reset");
        $('#myModal').modal('show');
    });

    //delete user and remove it from list
    $('.delete-user').click(function(){
        var user_id = $(this).val();

        $.ajax({

            type: "DELETE",
            url: url + '/' + user_id,
            success: function (data) {
                console.log(data);

                $("#username" + user_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    //create new user / update existing user
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault(); 

        var formData = {
            nama: $('#username').val(),
            alamat: $('#alamat').val(),
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();

        var type = "POST"; //for creating new resource
        var user_id = $('#user_id').val();;
        var my_url = url;

        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + user_id;
        }

        console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);

                var user = '<tr id="user' + data.uuid + '"><td>' + data.uuid + '</td><td>' + data.nama + '</td><td>' + data.alamat + '</td><td>' + data.created_at + '</td>';
                user += '<td><button class="btn btn-warning btn-xs btn-detail open-modal" value="' + data.uuid + '">Edit</button>';
                user += '<button class="btn btn-danger btn-xs btn-delete delete-user" value="' + data.uuid + '">Delete</button></td></tr>';

                if (state == "add"){ //if user added a new record
                    $('#users-list').append(user);
                }else{ //if user updated an existing record

                    $("#username" + user_id).replaceWith( user );
                }

                $('#frmusers').trigger("reset");

                $('#myModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});