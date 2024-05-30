<!DOCTYPE html>
<html>
<head>
    <title>Reporte</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: black; /* Color del texto */
        }

        h1 {
            text-align: center;
            color: black; /* Color del texto */
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 24px; /* Tamaño del título */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 14px; /* Tamaño de fuente */
        }

        th, td {
            border: 1px solid #000; /* Borde de las celdas */
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #000; /* Color de fondo del encabezado */
            color: white; /* Color del texto del encabezado */
        }

        tr:nth-child(even) {
            background-color: #f2f2f2; /* Color de fondo de filas pares */
        }

        tr:hover {
            background-color: #ddd; /* Color de fondo al pasar el ratón por encima */
        }

        .sub-employees {
            padding-left: 20px; /* Sangría para empleados secundarios */
        }
    </style>
</head>
<body>
    <h1>Reporte de Actividades Empleados</h1>
    @foreach($registros as $fecha => $empleados)
        <h2 style="margin-top: 0; font-size: 20px;">Fecha: {{ $fecha }}</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre empleado</th>
                    <th>Lote</th>
                    <th>Actividad</th>
                    <th>Sub-actividad</th>
                    <th>Rendimiento</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($empleados as $empleado => $datos)
                    <tr>
                        @foreach($datos as $registro)
                            <td>{{ $registro->empleado->nombre }}</td>
                            <td>{{ $registro->lote->nombreLote }}</td>
                            <td>{{ $registro->actividad->nombreActividad }}</td>
                            <td>{{ $registro->subActividad->nombreActividad }}</td>
                            <td>{{ $registro->rendimiento->tipo_rendimiento }}</td>
                            <td>{{ $registro->observaciones }}</td>
                        </tr>
                        <tr>
                    @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>
</html>
