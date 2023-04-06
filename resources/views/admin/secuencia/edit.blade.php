<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form id="form-edicion" action="{{ route('secuencias.update', $secuencia->idsecuencia) }}" method="post">
        @csrf
        @method('PUT')
        <label for='nombre'>nombre</label>
        <input type="text" name="nombre" id="nombre" value="{{ $secuencia->nombre }}">
        <input type="submit" onclick="return confirm('¿Quiere actualizar el registro?')" value="Enviar">

    </form>
</body>

</html>
