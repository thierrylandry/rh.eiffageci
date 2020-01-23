<!DOCTYPE html>
<html>
<head>
    <!-- Fontfaces CSS-->
    <link href="{{  URL::asset("css/font-face.css") }}" rel="stylesheet" media="all">
</head>
<style>

    p, div{padding: 2px; margin: 0;}
    table{background-color:#fff;border-spacing:0;border-collapse:collapse;}
    td,th{padding:8px;}
    table{width:100%;max-width:100%;margin-bottom:20px;vertical-align: bottom}
    h1, h2{font-size:12pt;}
    h4, h3{font-size:18px;}
    h4,h5,h6{margin-top:10px;margin-bottom:10px;}
    table.payload th, table.payload td{
        font-size: 12pt;
    }
    table{font-size: 12pt}
    table.payload tfoot p {
        font-size: inherit;
        font-weight: normal;
    }
    table.payload thead tr.head th {
        font-size: 7pt;
        font-weight: bold;
        text-align: center;
    }
    table.payload td, table.payload th{
        border: 0.3pt solid #000000
    }
    table.payload tbody td {
        font-size: 12pt;
        font-weight: normal;
        color: #333;
    }
    table.payload, table.payload .ssfacture th, table.payload .ssfacture td{
        margin: 0;
        padding: 0 4px 4px 0;
    }
    table.payload .ssfacture td.value{
        text-align: center;
        font-weight: bold;
        border-left: 0.3pt solid #000000;
    }
    table.payload .ssfacture td{
        border-bottom: 0.3pt solid #000000;
    }
    body{
        font-size: 12pt;
    }
    td.fournisseur {
        font-size: 32pt;
        text-align: center;
    }
    table.preambule, table.preambule td{
        font-size: 7pt;
        padding: 2px;
        margin: 0;
        border: 0.3pt solid #000000;
    }
    table.preambule p{
        margin: 5%;
        padding: 5%;

    }
    footer{
        font-size: 7pt;
        position: absolute;
        width: 100%;
        bottom: -1cm;
    }
    footer p {
        padding: 2px;
        margin: 0;
        text-align: center;
    }
    .page{
        page-break-after: auto;
    }
    div.rubrique{
        margin: 0 auto;
        width: 85%;
    }
    div.rubrique p{
        padding: 5px 3px;
        border: 0.3pt solid #000000;
        font-size: 8pt;
        text-align: center;
    }
    table.numero tr, table.numero tr td{
        margin: 3px;
    }
    .lignesEspacees
    {
        border-collapse : separate;
        border-spacing : 10px;
    }
</style>
<body style=" margin-left: 5%; width: 90%; border: 1px solid #ffffff;">
<div class="entete">
    <table style="margin: 0; padding: 0;">
        <tr>
            <td width="50%" valign="center" align="left">
                <img src="{{ asset("images/Eiffage_2400_01_colour_RGB.jpg") }}">
            </td>
        </tr>
    </table>
</div>
<main class="page">
    <div>@yield('content')</div>
</main>
</body>
</html>