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
    margin: auto 20px;
    padding: auto 10pt;
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
  text-indent: 40px;
  text-align: justify;
  font-size: 12pt;
  margin: 0 30pt;
  line-height: 2.5;
}
</style>
</head>
<body>
    @php
        $user = \App\Models\Worker::find(\Request::get('id'));
    @endphp
    <!--
    <img width="750px" src="{{ asset('membrete.png') }}">
    <br><br>
    -->

    <h1 class="gp-title">CONSTANCIA DE TRABAJO</h1>
    <br><br>
    <p class="gp-first">
        Quien suscribe Lcdo. Leonardo Escalona, Director (E) del <b>{{ config('app.community_name', 'Laravel') }}</b>,
        con número de RIF J-40912864-4, ubicado en la calle 30, entre Avenidas 21 y Rómulo Gallegos del Barrio Campo Lindo de la Ciudad de Acarigua
        Edo. Portuguesa, por medio de la presente se hace constar que {{ $user->sexo ? 'la ciudadana' : 'el ciudadano' }}:
        <span class="gp-sub gp-sub2">{{ $user->nombre . ' ' . $user->apellido ?? '{Nombre Completo}'}}&nbsp;</span>
        titular de la Cédula de Identidad Nº <span class="gp-sub gp-sub2">{{ ' ' . $user->cedulaCompleto() . ' ' ?? '{Cedula}' }}</span>
        labora en esta institución como <span class="gp-sub gp-sub2">{{ ' ' . $user->cargo . ' ' ?? '{Cargo}' }}</span>
        en el Nivel Media General, con una carga horaria de 40 horas semanales, en el turno {{ $user->turno }}
        de lunes a viernes en el horario comprendido de {{ $user->horario() }}.
    </p>

    <br><br><br>

    <p class="gp-first">
        Constancia que se realiza en la ciudad de Acarigua a solicitud de la parte interesada a los <span class="gp-sub">{{ $fecha->day }}</span> días del mes de
        <span class="gp-sub gp-sub2">{{ $fecha->monthName }}</span> del <span class="gp-sub gp-sub2">{{ $fecha->year }}</span>.
    </p>

    <br><br><br>

    <p style="text-align: center;">ATENTAMENTE</p>

    <br><br>

    <div style="border-bottom: 1px solid; width: 230px; margin: 0 auto;"></div>
    <p style="text-align: center; font-size: 11pt;">
        <b>Lcdo. Leonardo Escalona</b><br>
        C.I: 12.089.276<br>
        Director (E)<br>
        {{ config('app.community_name', 'Laravel') }}<br>
        Rif: J409128644
    </p>
</body>
</html>