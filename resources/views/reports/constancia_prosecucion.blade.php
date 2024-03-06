<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style type="text/css">
* {
    font-family: Arial;
}

.gp-title {
    text-align: center;
    font-size: 14pt;
    text-decoration: underline;
    text-transform: uppercase;
}

.gp-sub {
    text-decoration: underline;
    /*border-bottom: 1px solid;*/
}

.gp-sub2:after {
    content: "\00a0\00a0";
}
.gp-sub2:before {
    content: "\00a0\00a0";
}

p.gp-first {
  text-indent: 20px;
  text-align: justify;
  font-size: 12pt;
  margin: 0 30pt;
  line-height: 2.5;
}

.table-container {
    margin: 0 60pt;
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 5px;
}
</style>
</head>
<body>
    @php
        if (\Request::get('id')) {
            $user = \App\Models\Student::find(\Request::get('id'));
        } else {
            $user = \App\Models\Student::find(Session::get('auth_user')->id);
        }
    @endphp
    <img width="750px" src="{{ asset('membrete.png') }}">
    <br><br>

    <h1 class="gp-title">CONSTANCIA DE PROSECUCIÓN</h1>
    <h1 class="gp-title">EN EL NIVEL DE EDUCACIÓN PRIMARIA</h1>
    <br><br>
    <p class="gp-first">
        Quien suscribe <b style="text-transform: uppercase;">Lcdo. Leonardo Escalona</b>,
        titular de la Cédula de Identidad Nº 12.089.276 en su condición de Director (E) del
        <b style="text-transform: uppercase;">{{ config('app.community_name', 'Laravel') }}</b>,
        ubicado en el municipio <span class="gp-sub"></span> de la parroquia <span class="gp-sub"></span>
        adscrito a la Zona Educativa del estado <span class="gp-sub"></span>, hace constar por medio
        de la presente que el niño (a) <span class="gp-sub">{{ $user->nombre . ' ' . $user->apellido ?? '{Nombre Completo}'}}&nbsp;</span>,
        portador de la Cédula Escolar Nº o Pasaporte Nº <span class="gp-sub">{{ ' ' . $user->cedula . ' ' ?? '{Cedula}' }}</span>,
        nacido (a) en <span class="gp-sub"></span> en fecha <span class="gp-sub gp-sub2">{{ $user->fecha_nacimiento }}</span>,
        cursó el <span class="gp-sub">{{ $user->nivel_educacion ?? '{Grado}' }}</span>, correspondiente el literal <span class="gp-sub">{?}</span>,
        durante el periodo escolar <span class="gp-sub gp-sub2">{{ $fecha->year }}-{{ $fecha->year + 1 }}</span>,
        <b>siendo promovido (a) al <span class="gp-sub gp-sub2">{?}</span> Grado del Nivel de Educación Primaria</b>,
        previo cumplimiento de los requisitos exigidos en la normativa legal vigente.
    </p>

    <br><br>

    <p class="gp-first">
        Constancia que se expide en Acarigua a los <span class="gp-sub gp-sub2">{{ $fecha->day }}</span> días del mes de
        <span class="gp-sub gp-sub2">{{ $fecha->monthName }}</span> del <span class="gp-sub gp-sub2">{{ $fecha->year }}</span>.
    </p>

    <br><br>
    <div class="table-container">
    <table>
        <thead>
            <tr>
                <th>PLANTEL PARA VALIDEZ A NIVEL NACIONAL</th>
                <th>ZONA EDUCATIVA PARA VALIDEZ A NIVEL INTERNACIONAL</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>DIRECTOR(A)</td>
                <td>DIRECTOR(A)</td>
            </tr>
            <tr>
                <td>Nombre y Apellido: LEONARDO ESCALONA</td>
                <td>Nombre y Apellido:</td>
            </tr>
            <tr>
                <td>Número de C.I.: 12.089.276</td>
                <td>Número de C.I.:</td>
            </tr>
            <tr>
                <td>Firma y Sello:<br /><br /><br /></td>
                <td>Firma y Sello:<br /><br /><br /></td>
            </tr>
        </tbody>
    </table>
    </div>
</body>
</html>