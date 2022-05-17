<?php
$fornitore = DB::SELECT('SELECT * FROM CF WHERE Cd_CF = \''.$id_dotes->Cd_CF.'\'')[0];
$contatto = DB::SELECT('SELECT * FROM CFContatto WHERE Cd_CF = \''.$id_dotes->Cd_CF.'\'')[0];
$dorig = DB::SELECT('SELECT * FROM DORIG WHERE Id_DOTes = \''.$id_dotes->Id_DoTes.'\'');
$date = date('Y/m/d',strtotime($id_dotes->DataDoc)) ;
$pagamento =  DB::SELECT('SELECT * FROM PG WHERE Cd_PG = \''.$id_dotes->Cd_PG.'\'')[0];
$dototali = DB::SELECT('SELECT * FROM DOTotali WHERE Id_DoTes = \''.$id_dotes->Id_DoTes.'\'')[0];
$html = '<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .container {
            position: relative;
            text-align: center;
        }
        body{
            width: 21cm;
            height: 29.7cm;
       }
    </style>
</head>
<body>

<div class="container">
    <img src="';$html.= URL::asset('img/ciao.jpg');$html .= '"alt="DDT" style="width:100%;z-index:1">
    <label style="position: absolute;top: 300px;left: 35px;z-index:10;font-size:10px">'.$id_dotes->Cd_CF.'</label>
    <label style="position: absolute;top: 300px;left: 85px;z-index:10;font-size:10px">'.$fornitore->PartitaIva.'</label>
    <label style="position: absolute;top: 300px;left: 180px;z-index:10;font-size:10px">'.$fornitore->CodiceFiscale.'</label>
    <label style="position: absolute;top: 300px;left: 590px;z-index:10;font-size:10px">'.$id_dotes->NumeroDoc.'</label>
    <label style="position: absolute;top: 300px;left: 300px;z-index:10;font-size:10px">'; $html .= ($contatto->Telefono) ? $contatto->Telefono:''; $html.='</label>
    <label style="position: absolute;top: 300px;left: 650px;z-index:10;font-size:10px">'.$date.'</label>
    <label style="position: absolute;top: 335px;left: 35px;z-index:10;font-size:10px">'.$pagamento->Descrizione.'</label>
    <label style="position: absolute;top: 945px;left: 610px;z-index:10;font-size:10px">'.$dototali->TotDocumentoV.'</label>
    <label style="position: absolute;top: 335px;left: 300px;z-index:10;font-size:10px">'; $html .= ($id_dotes->Cd_CGConto_Banca) ? $id_dotes->Cd_CGConto_Banca:''; $html.='</label>
    <div style="text-align:left;position: absolute;top: 390px;left: 35px;z-index:10;font-size:10px">';
foreach ($dorig as $d){
    $html.= '<label>'.$d->Cd_AR.'</label><br><br><br>';
}
$html .='
    </div>
        <div style="text-align:left;position: absolute;top: 390px;left: 160px;z-index:10;font-size:10px">';
foreach ($dorig as $d){
    DB::SELECT('SELECT * FROM AR WHERE Cd_AR = \''.$d->Cd_AR.'\'')[0];
    $html.= '<label>'.$d->Descrizione.'</label><br><br><br>';
}
$html .='
    </div>
        <div style="text-align:left;position: absolute;top: 390px;left: 465px;z-index:10;font-size:10px">';
foreach ($dorig as $d){
    $html.= '<label>'.$d->Cd_ARMisura.'</label><br><br><br>';
}
$html .='
    </div>
        <div style="text-align:left;position: absolute;top: 390px;left: 485px;z-index:10;font-size:10px">';
foreach ($dorig as $d){
    $html.= '<label>'.$d->Qta.'</label><br><br><br>';
}
$html .='
    </div>
        <div style="text-align:left;position: absolute;top: 390px;left: 550px;z-index:10;font-size:10px">';
foreach ($dorig as $d){
    $html.= '<label>'.$d->PrezzoUnitarioV.'</label><br><br><br>';
}
$html .='
    </div>
        <div style="text-align:left;position: absolute;top: 390px;left: 625px;z-index:10;font-size:10px">';
foreach ($dorig as $d){
    if($d->ScontoRiga != '')
        $html.= '<label>'.$d->ScontoRiga.'</label><br><br><br>';
}
$html .='
    </div>
        <div style="text-align:left;position: absolute;top: 390px;left: 665px;z-index:10;font-size:10px">';
foreach ($dorig as $d){
    $html.= '<label>'.$d->PrezzoTotaleV.'</label><br><br><br>';
}
$html .='
    </div>
        <div style="text-align:left;position: absolute;top: 390px;left: 740px;z-index:10;font-size:10px">';
foreach ($dorig as $d){
    if($d->Cd_Aliquota != '')
    $html.= '<label>'.$d->Cd_Aliquota.'</label><br><br><br>';
}
$html .='
    </div>


    <br>
</div>

</body>
</html>';
echo $html;exit();

?>
