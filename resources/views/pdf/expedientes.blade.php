<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Reporte de Expedientes</title>
    <style>
        body {
            position: relative;
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .header {
            position: relative;
            border: 2px solid #333;
            padding: 10px 40px;
            margin-bottom: 20px;
            height: 150px;
            box-sizing: border-box;
            text-align: center;
        }

        .logo-left {
            width: 250px;
            height: auto;
            position: absolute;
            bottom: 10px;
            /* 10 píxeles desde abajo */
            left: 1px;
            /* más a la izquierda ahora que no hay margen */
        }

        .logo-right {
            width: 120px;
            /* ajusta si quieres más grande */
            height: auto;
            position: absolute;
            top: 30px;
            right: 50px;
            /* aumenta el espacio a la izquierda */
        }


        h1,
        h2,
        h3 {
            margin: 0;
            padding: 4px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed;
            word-wrap: break-word;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
            white-space: normal;
            overflow-wrap: break-word;
        }

        th {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="{{ public_path('assets/images/escudo.png') }}" class="logo-left">
        <img src="{{ public_path('assets/images/gobierno.png') }}" class="logo-right">
        <h1>Gobierno del Estado de Quintana Roo</h1>
        <h2>
            Reporte de Expedientes
            @if($estadoFiltro)
            @switch($estadoFiltro)
            @case('en_tramite') en trámite @break
            @case('en_concentracion') en concentración @break
            @case('en_historico') en histórico @break
            @endswitch
            @endif
        </h2>
        <h3><strong>Fecha de generación:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</h3>

        @if($fechaInicio || $fechaFin)
        <p><strong>Reporte filtrado por fechas:</strong>
            @if($fechaInicio)
            {{ \Carbon\Carbon::parse($fechaInicio)->format('d/m/Y') }}
            @endif
            @if($fechaInicio && $fechaFin)
            a
            @endif
            @if($fechaFin)
            {{ \Carbon\Carbon::parse($fechaFin)->format('d/m/Y') }}
            @endif
        </p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 10%;">CLAVE DEL EXPEDIENTE</th>
                <th style="width: 18%;">NOMBRE DEL EXPEDIENTE</th>
                <th style="width: 9%;">FECHA APERTURA</th>
                <th style="width: 9%;">FECHA CIERRE</th>
                <th style="width: 8%;">T. DE CONSERVACIÓN</th>
                <th style="width: 6%;">NO. DE LEGAJOS</th>
                <th style="width: 6%;">NO. DE HOJAS</th>
                <th style="width: 6%;">PRESERVACIÓN</th>
                <th style="width: 12%;">UBICACION TOPOGRAFICA</th>
                <th style="width: 6%;">NO. CAJA</th>
                <th style="width: 12%;">CLASIFICACIÓN</th>
                <th style="width: 11%;">CARÁCTER</th>
                <th style="width: 13%;">OBSERVACIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expedientes as $exp)
            <tr>
                <td>{{ $exp->clave }}</td>
                <td>{{ $exp->nombre }}</td>
                <td>{{ \Carbon\Carbon::parse($exp->fecha_apertura)->format('d/m/Y') }}</td>
                <td>{{ $exp->fecha_cierre ? \Carbon\Carbon::parse($exp->fecha_cierre)->format('d/m/Y') : 'N/A' }}</td>
                <td>{{ $exp->tiempo_conservacion }}</td>
                <td>{{ $exp->no_legajos }}</td>
                <td>{{ $exp->no_hojas }}</td>
                <td>{{ $exp->preservacion }}</td>
                <td>{{ $exp->ubicacion_topografica }}</td>
                <td>{{ $exp->no_caja }}</td>
                <td>{{ $exp->clasificacion }}</td>
                <td>{{ $exp->caracter }}</td>
                <td>{{ $exp->observacion }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>