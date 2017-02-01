@extends('layouts.pdf')

@section('title')
REPORTE DE REGISTRO DE DELIMITACIÓN INTERDEPARTAMENTAL DE UNIDADES TERRITORIALES - SIOT
@endsection

@section('content')
<table style="width:100%;" class="content">
    <tr>
        <th colspan="2">
            I. DATOS GENERALES DEL SOLICITANTE
        </th>
        <th colspan="2">
            <span class="code">{{ $etapaInicio->codigo }}</span>
        </th>
    </tr>

    <tr>
        <th style="width:25%;">NOMBRE SOLICITANTE</th>
        <th style="width:25%;">GOBERNADOR DEPARTAMENTO</th>
        <th style="width:25%;">FECHA INGRESO</th>
        <th style="width:25%;">FECHA EXPEDIDO</th>
    </tr>

    <tr>
        <td style="width:25%;">{{ $etapaInicio->solicitud->nombre_solicitante }}</td>
        <td style="width:25%;">{{ $etapaInicio->solicitud->municipios[0]->provincia->departamento->nombre }}</td>
        <td style="width:25%;">{{ $etapaInicio->solicitud->created_at }}</td>
        <td style="width:25%;">{{ $etapaInicio->created_at }}</td>
    </tr>
</table>

<table style="width:100%;" class="content">
    <tr>
        <th colspan="12">
            II. DESCRIPCIÓN DE LA UNIDAD TERRITORIAL SOLICITANTE Y COLINDANTE POR LÍMITE O TRAMO
        </th>
    </tr>

    <tr>
        <th colspan="6" style="width:50%;">UNIDAD TERRITORIAL SOLICITANTE</th>
        <th colspan="6" style="width:50%;">UNIDAD TERRITORIAL COLINDANTE</th>
    </tr>

    <tr>
        <td colspan="12">A)</td>
    </tr>

    <tr>
        <th>COD_D</th>
        <th>DEPARTA<br/>MENTO</th>
        <th>COD_P</th>
        <th>PROVIN<br/>CIA</th>
        <th>COD_M</th>
        <th>MUNICI<br/>PIO</th>
        <th>COD_D</th>
        <th>DEPARTA<br/>MENTO</th>
        <th>COD_P</th>
        <th>PROVIN<br/>CIA</th>
        <th>COD_M</th>
        <th>MUNICI<br/>PIO</th>
    </tr>

    @foreach($etapaInicio->solicitud->municipios as $municipio)
    <tr>
        <td>{{ $municipio->provincia->departamento->codigo }}</td>
        <td>{{ $municipio->provincia->departamento->nombre }}</td>
        <td>{{ $municipio->provincia->codigo }}</td>
        <td>{{ $municipio->provincia->nombre }}</td>
        <td>{{ $municipio->codigo }}</td>
        <td>{{ $municipio->nombre }}</td>

        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    @endforeach

    <tr>
        <td colspan="12">B)</td>
    </tr>

    <tr>
        <th colspan="4">LÍMITE O TRAMO PRESENTADO</th>
        <th colspan="4">DISTANCIA (KM)</th>
        <th colspan="4">VÉRTICES</th>
    </tr>

    <tr>
        <td colspan="4">TRAMOS</td>
        <td colspan="4"></td>
        <td colspan="4"></td>
    </tr>

    <tr>
        <td colspan="4">TOTAL LÍMITE-TRAMO</td>
        <td colspan="4"></td>
        <td colspan="4"></td>
    </tr>
</table>

<table style="width:100%;" class="content">
    <tr>
        <th colspan="6">
            III. PARÁMETROS GEODÉDICOS
        </th>
    </tr>

    <tr>
        <th colspan="3">INFOMRACIÓN DIGITAL</th>
        <th style="width:10%;">PROYECCIÓN UTM</th>
        <th style="width:10%;">DATUM WSG-84</th>
        <th style="width:10%;">ZONA 19, 20, 21</th>
    </tr>

    <tr>
        <td style="width:5%;">A</td>
        <td colspan="2" style="width:65%;">MAPA DE COBERTURA DIGITAL</td>
        <td style="width:10%;"></td>
        <td style="width:10%;"></td>
        <td style="width:10%;"></td>
    </tr>

    <tr>
        <td style="width:5%;">B</td>
        <td colspan="2" style="width:65%;">LISTADO DE COORDENADAS DE LA PROPUESTA</td>
        <td style="width:10%;"></td>
        <td style="width:10%;"></td>
        <td style="width:10%;"></td>
    </tr>

    <tr>
        <td style="width:5%;">C</td>
        <td colspan="2" style="width:65%;">LISTADO DE COORDENADAS DE COMUNIDADES LOCALIDADES Y POBLACIONES</td>
        <td style="width:10%;"></td>
        <td style="width:10%;"></td>
        <td style="width:10%;"></td>
    </tr>
</table>

<table style="width:100%;" class="content">
    <tr>
        <th>
            REGISTRADO: Con las siguientes observaciones:
        </th>
    </tr>

    <tr>
        <td></td>
    </tr>
</table>

<h5>
    EL PRESENTE REPORTE ES EL REGISTRO DE LA SOLICITUD EN EL SIOT, EN CUMPLIMIENTO DEL ARTICULO 33 DEL D.S. NRO. 1560 REGLAMENTO DE LA LEY NRO. 339
</h5>
@endsection
