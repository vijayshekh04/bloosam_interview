<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Employee</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <script src="http://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
  <style>
    .error-label-message{
        display:none;
    }
    </style>
</head>
<body>

<div class="container">
  <h2>Add Employee</h2>
  <form action="javascript:void(0)" id="add_form">
    @csrf
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
      <label class="text-danger text-bold error-label-message" id="name_error"></label>
    </div>

    <div class="form-group">
      <label for="phone">Mobile Mumber:</label>
      <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone">
      <label class="text-danger text-bold error-label-message" id="phone_error"></label>
    </div>

    <div class="form-group">
      <label for="city_name">City Name:</label>
      <input type="text" class="form-control" id="city_name" placeholder="Enter City Name" name="city_name">
      <label class="text-danger text-bold error-label-message" id="city_name_error"></label>
    </div>

    <div class="form-group">
      <label for="state_name">State Name:</label>
      <input type="text" class="form-control" id="state_name" placeholder="Enter State Name" name="state_name">
      <label class="text-danger text-bold error-label-message" id="state_name_error"></label>
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

<script>
        $(document).ready(function () {
        
            $(document).on('submit','#add_form',function () {
                $(".error-label-message").html('');
                $(".error-label-message").hide();
                var formData = new FormData(this);
                $('.error_msg').text('');
                $.ajax({
                    url:"{{route('employee.store')}}",
                    method:'post',
                    data:formData,
                    processData: false,
                    contentType: false,
                    dataType:'json',
                    cache:false,
                    success:function(response){
                        // console.log(response);
                        window.location.href = "{{url('employee')}}";
                    },
                    error:function(error){
                        if(error.status===422){
                            $(".error-label-message").show();
                            $.each(error.responseJSON.errors,function(key,value){
                                $('#'+key+'_error').text(value[0]);
                            });
                        }

                        if(error.responseJSON.message!==undefined){
                            // show_message('error',error.responseJSON.message);
                        }
                    }
                });
            });
        })
    </script>
</body>
</html>
