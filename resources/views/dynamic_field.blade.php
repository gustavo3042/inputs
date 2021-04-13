

<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Insertando datos del Profesional</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>
 <body>
  <div class="container">
     <br />
     <h3 align="center">Datos del Profesional</h3>
     <br />
   <div class="table-responsive">
                <form method="post" id="dynamic_form">
                 <span id="result"></span>
                 <table class="table table-bordered table-striped" id="user_table">
               <thead>
                <tr>
                    <th width="35%">Nombre</th>
                    <th width="35%">Apellido</th>
                    <th width="35%">Sueldo</th>
                    <th width="30%">Action</th>
                </tr>
               </thead>
               <tbody>

               </tbody>
               <tfoot>
                <tr>
                                <td colspan="2" align="right">&nbsp;</td>
                                <td>
                                  <td>
                  @csrf
                  <input type="submit" name="save" id="save" class="btn btn-primary" value="Save" />
                 </td>
                </tr>
               </tfoot>
           </table>
                </form>
   </div>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th >id</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Sueldo</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($mostrar as $filas)


    <tr>
      <td>{{$loop->iteration}}</td>
          <td>{{$filas->id}}</td>
        <td>{{$filas->first_name}}</td>
          <td>{{$filas->last_name}}</td>
            <td>{{$filas->sueldo}}</td>
    </tr>

  @endforeach
  </tbody>
</table>

  </div>
 </body>
</html>

<script>
$(document).ready(function(){

 var count = 1;

 dynamic_field(count);

 function dynamic_field(number)
 {
  html = '<tr>';
        html += '<td><input type="text" name="first_name[]" class="form-control" /></td>';
        html += '<td><input type="text" name="last_name[]" class="form-control" /></td>';
          html += '<td><input type="text" name="sueldo[]" class="form-control" /></td>';
        if(number > 1)
        {
            html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
            $('tbody').append(html);
        }
        else
        {
            html += '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
            $('tbody').html(html);
        }
 }

 $(document).on('click', '#add', function(){
  count++;
  dynamic_field(count);
 });

 $(document).on('click', '.remove', function(){
  count--;
  $(this).closest("tr").remove();
 });

 $('#dynamic_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic_field.insert") }}',
            method:'post',
            data:$(this).serialize(),
            dataType:'json',
            beforeSend:function(){
                $('#save').attr('disabled','disabled');
            },
            success:function(data)
            {
                if(data.error)
                {
                    var error_html = '';
                    for(var count = 0; count < data.error.length; count++)
                    {
                        error_html += '<p>'+data.error[count]+'</p>';
                    }
                    $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                }
                else
                {
                    dynamic_field(1);
                    $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
                }
                $('#save').attr('disabled', false);
            }
        })
 });

});
</script>
