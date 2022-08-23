<html>
<head>
  <title>Programando Ando</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">

<div class="cargando row">       
  <div class="d-flex justify-content-center">
    <div class="spinner-border text-primary" role="status">
      <span class="visually-hidden">Cargando...</span>
    </div>
  </div>
</div>

  <div class="formulario row">
  <!-- INICIA LA COLUMNA -->
    <div class="col-md-4 offset-md-4">
      <center><h1>PROPIETARIO</h1></center>

      <form>
        <!--Campo Documento-->
        <div class="mb-3">
          <label for="doc">Documento</label>
          <input type="text" name="doc" class="form-control" id="doc" onblur="buscar_datos();">
        </div>
        <!--Campo Nombre-->
        <div class="mb-3">
            <label for="nombre">Nombre </label>
            <input type="text" name="nombre" class="form-control" id="nombre">
        </div>
        <!--Campo Dirección-->
        <div class="mb-3">
            <label for="dir">Dirección </label>
            <input type="text" name="dir" class="form-control" id="dir">
        </div>
        <!--Campo Teléfono-->
        <div class="mb-3">
            <label for="tel">Teléfono </label>
            <input type="text" name="tel" class="form-control" id="tel">
        </div>
        <!--Botones-->
        <center>
          <input type="button" value="ENVIAR" class="btn btn-success" name="btn_enviar" onclick="guardar();">
          <input type="button" value="CANCELAR" class="btn btn-danger" name="btn_cancelar" onclick="limpiar();">
        </center>
      </form>
      <div class="resultados"></div>
    </div>
  </div>
</div>
</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){
        $('.cargando').hide();
      });  

  function buscar_datos()
  {
    doc = $("#doc").val();
    
    
    var parametros = 
    {
      "buscar": "1",
      "doc" : doc
    };
    $.ajax(
    {
      data:  parametros,
      dataType: 'json',
      url:   'codigos_php.php',
      type:  'post',
      beforeSend: function() 
      {
        $('.formulario').hide();
        $('.cargando').show();
        
      }, 
      error: function()
      {alert("Error");},
      complete: function() 
      {
        $('.formulario').show();
        $('.cargando').hide();
       
      },
      success:  function (valores) 
      {
        if(valores.existe=="1") //Aqui usamos la variable que NO use en el vídeo
        {
          $("#nombre").val(valores.nombre);
          $("#dir").val(valores.direccion);
          $("#tel").val(valores.telefono);
        }
        else
        {
          alert("El propietario no existe, ¡Crealo!")
        }

      }
    }) 
  }

  function limpiar()
  {
    $("#doc").val("");
    $("#nombre").val("");
    $("#dir").val("");
    $("#tel").val("");
  }

  function guardar()
  {
    var parametros = 
    {
      "guardar": "1",
      "doc" : $("#doc").val(),
      "nombre" : $("#nombre").val(),
      "tel" : $("#tel").val(),
      "dir" : $("#dir").val()
    };
    $.ajax(
    {
      data:  parametros,
      url:   'codigos_php.php',
      type:  'post',
      beforeSend: function() 
      {
        $('.formulario').hide();
        $('.cargando').show();
        
      }, 
      error: function()
      {alert("Error");},
      complete: function() 
      {
        $('.formulario').show();
        $('.cargando').hide();
       
      },
      success:  function (mensaje) 
      {$('.resultados').html(mensaje);}
    }) 
    limpiar();
  }
</script>