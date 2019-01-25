@if(env("CLAVE")==null)
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<div class="card col-md-6 offset-md-3">
    <div class="card-header">
        REGISTRAR MODULO
    </div>
    <div class="card-body form-group">
        <label>Nombre</label>
        <input class="form-control" id="nombre" placeholder="Nombre unico del modulo" type="text"/>
        <br>
        <input class="btn btn-default" id="singin" value="entrar" type="submit">
    </div>
</div>
<script>
    /**
      * 1. Al dar click en el botón Entrar obtiene los datos de "nombre" y lo asigna a un arreglo llamado data
      * 2. Envía el arreglo a la ruta fge-tok/regmod en formato json para registrar el modulo en nuestra BD.
      * 3. Si fue correcto nos envía a la vista fge_tok/regmod2 con un parametro (mensaje).
      * 4. Si no manda una alerta con el mensaje del error.
      */    

    document.getElementById("singin").onclick=()=>{
        const data={name:document.getElementById("nombre").value};
        fetch('{{env('URL_FGE-NUC')}}'+'/fge-tok/regmod',{
            method:'post',
            headers: {
               'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(function(response) {
            if(response.ok){
                response.json()
                .then(function(json) {            
                    window.location.href = '{{env('URL_FGE-NUC')}}'+'/fge_tok/regmod2/'+json.message;
                });
            }else{
                response.json()
                .then(function(json){
                    alert(json.message)
                });
            }
        })
        .catch(function(data){
             console.log(data);
        });
    };
</script>
@endif