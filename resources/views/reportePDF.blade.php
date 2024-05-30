<!DOCTYPE html>
<html>
<head>
    <title>Reporte</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-top: 20px;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px; /* Tamaño de fuente más pequeño */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .sub-employees {
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <h1>Reporte de Actividades Empleados </h1>
    @foreach($registros as $fecha => $empleados)
        <h2>Fecha: {{ $fecha }}</h2>
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
                            <td>{{ $registro->empleado->nombre}} {{$registro->empleado->apellido }}</td>
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