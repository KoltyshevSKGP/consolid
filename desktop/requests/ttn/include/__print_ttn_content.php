<?php
include($_SERVER["DOCUMENT_ROOT"] . "/core/db/connect.php");
include ($_SERVER["DOCUMENT_ROOT"] . "/core/functions/index.php");
include ("view_content.php");

$request["number"]="";
if($request["id"]<10) $request["number"]="000000".$request["id"];
if($request["id"]>=10 && $request["id"]<100) $request["number"]="00000".$request["id"];
if($request["id"]>=100 && $request["id"]<1000) $request["number"]="0000".$request["id"];
if($request["id"]>=1000 && $request["id"]<10000) $request["number"]="000".$request["id"];
if($request["id"]>=10000 && $request["id"]<100000) $request["number"]="00".$request["id"];
?>

<html><head>
    <meta http-equiv="Content-Type" content="text/html; CHARSET=utf-8">
    <title></title>
    <style type="text/css">
        body { background: #ffffff; margin: 0; font-family: Arial; font-size: 8pt; font-style: normal; }
        tr.R0{ height: 15px; }
        tr.R0 td.R48C1{ text-align: center; vertical-align: middle; border-left: #000000 1px solid; border-top: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #000000 1px solid; }
        tr.R0 td.R48C2{ text-align: center; vertical-align: middle; border-left: #000000 1px solid; border-top: #000000 1px solid; border-bottom: #000000 1px solid; }
        tr.R0 td.R48C3{ text-align: center; vertical-align: middle; border-left: #000000 1px solid; border-top: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #000000 1px solid; }
        tr.R0 td.R48C6{ text-align: center; vertical-align: middle; border-top: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #000000 1px solid; }
        tr.R0 td.R49C5{ font-family: Arial; font-size: 8pt; font-style: normal; text-align: center; vertical-align: middle; border-left: #000000 1px solid; border-top: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #000000 1px solid; }
        tr.R0 td.R50C5{ font-family: Arial; font-size: 8pt; font-style: normal; }
        tr.R0 td.R51C1{ text-align: center; vertical-align: middle; border-left: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #000000 1px solid; }
        tr.R0 td.R51C2{ text-align: center; border-left: #000000 1px solid; border-bottom: #000000 1px solid; }
        tr.R0 td.R51C3{ text-align: center; border-left: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #000000 1px solid; }
        tr.R0 td.R51C6{ font-family: Arial; font-size: 8pt; font-style: normal; text-align: center; border-left: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #000000 1px solid; }
        tr.R0 td.R52C1{ border-left: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #000000 1px solid; }
        tr.R0 td.R52C2{ text-align: right; border-left: #000000 1px solid; border-bottom: #000000 1px solid; }
        tr.R0 td.R52C4{ font-family: Arial; font-size: 8pt; font-style: normal; border-left: #000000 1px solid; border-top: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #ffffff 1px none; }
        tr.R0 td.R52C6{ font-family: Arial; font-size: 8pt; font-style: normal; border-left: #000000 1px solid; border-top: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #000000 1px solid; }
        tr.R0 td.R53C4{ font-family: Arial; font-size: 8pt; font-style: normal; border-left: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #ffffff 1px none; }
        tr.R0 td.R53C6{ font-family: Arial; font-size: 8pt; font-style: normal; border-left: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #000000 1px solid; }
        tr.R0 td.R8C2{ font-family: Arial; font-size: 7pt; font-style: normal; text-align: center; vertical-align: top; }
        tr.R13{ height: 7px; }
        tr.R13 td.R54C3{ font-family: Arial; font-size: 9pt; font-style: normal; }
        tr.R16{ height: 8px; }
        tr.R21{ height: 16px; }
        tr.R21 td.R21C1{ font-family: Arial; font-size: 9pt; font-style: normal; }
        tr.R21 td.R21C23{ text-align: left; }
        tr.R21 td.R21C5{ border-bottom: #000000 1px solid; }
        tr.R21 td.R23C10{ font-family: Arial; font-size: 8pt; font-style: normal; font-weight: bold; border-bottom: #000000 1px solid; }
        tr.R21 td.R23C11{ font-family: Arial; font-size: 8pt; font-style: normal; }
        tr.R21 td.R23C16{ font-family: Arial; font-size: 9pt; font-style: normal; text-align: center; border-bottom: #ffffff 1px none; }
        tr.R21 td.R23C8{ font-family: Arial; font-size: 8pt; font-style: normal; font-weight: bold; text-align: left; border-bottom: #000000 1px solid; }
        tr.R21 td.R23C9{ font-family: Arial; font-size: 9pt; font-style: normal; text-align: center; }
        tr.R21 td.R25C7{ font-family: Arial; font-size: 9pt; font-style: normal; text-align: center; border-bottom: #000000 1px solid; }
        tr.R21 td.R47C1{ font-family: Arial; font-size: 9pt; font-style: normal; font-weight: bold; text-align: center; }
        tr.R27{ height: 9px; }
        tr.R28{ font-family: Arial; font-size: 9pt; font-style: normal; height: 46px; }
        tr.R28 td.R28C11{ font-family: Arial; font-size: 9pt; font-style: normal; border-bottom: #000000 1px solid; }
        tr.R28 td.R28C19{ font-family: Arial; font-size: 8pt; font-style: normal; font-weight: bold; border-bottom: #000000 1px solid; }
        tr.R28 td.R28C3{ font-family: Arial; font-size: 9pt; font-style: normal; border-bottom: #000000 1px solid; }
        tr.R28 td.R28C8{ font-family: Arial; font-size: 9pt; font-style: normal; text-align: center; }
        tr.R29{ font-family: Arial; font-size: 9pt; font-style: normal; height: 12px; }
        tr.R29 td.R29C3{ font-family: Arial; font-size: 7pt; font-style: normal; text-align: center; vertical-align: top; }
        tr.R30{ font-family: Arial; font-size: 9pt; font-style: normal; height: 16px; }
        tr.R30 td.R30C9{ font-family: Arial; font-size: 9pt; font-style: normal; border-bottom: #000000 1px solid; }
        tr.R30 td.R31C9{ font-family: Arial; font-size: 7pt; font-style: normal; text-align: center; vertical-align: top; }
        tr.R30 td.R32C19{ font-family: Arial; font-size: 9pt; font-style: normal; text-align: left; border-bottom: #000000 1px solid; }
        tr.R30 td.R32C6{ font-family: Arial; font-size: 8pt; font-style: normal; font-weight: bold; border-bottom: #000000 1px solid; }
        tr.R30 td.R34C6{ font-family: Arial; font-size: 9pt; font-style: normal; border-bottom: #000000 1px solid; }
        tr.R30 td.R37C11{ border-bottom: #000000 1px solid; }
        tr.R36{ font-family: Arial; font-size: 9pt; font-style: normal; height: 9px; }
        tr.R39{ font-family: Arial; font-size: 8pt; font-style: normal; height: 20px; }
        tr.R39 td.R39C1{ font-family: Arial; font-size: 9pt; font-style: normal; font-weight: bold; text-align: center; }
        tr.R4{ height: 20px; }
        tr.R4 td.R4C1{ font-family: Arial; font-size: 11pt; font-style: normal; font-weight: bold; text-align: center; }
        tr.R40{ font-family: Arial; font-size: 8pt; font-style: normal; height: 43px; }
        tr.R40 td.R40C1{ text-align: center; vertical-align: middle; border-left: #000000 1px solid; border-top: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #000000 1px solid; }
        tr.R41{ font-family: Arial; font-size: 8pt; font-style: normal; height: 16px; }
        tr.R41 td.R41C1{ font-family: Arial; font-size: 9pt; font-style: normal; text-align: center; vertical-align: middle; border-left: #000000 1px solid; border-top: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #000000 1px solid; }
        tr.R41 td.R41C9{ font-family: Arial; font-size: 9pt; font-style: normal; text-align: center; vertical-align: middle; border-top: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #000000 1px solid; }
        tr.R42{ font-family: Arial; font-size: 8pt; font-style: normal; height: 15px; }
        tr.R42 td.R42C1{ text-align: center; vertical-align: top; border-left: #000000 1px solid; border-top: #000000 1px solid; border-bottom: #000000 1px solid; }
        tr.R42 td.R42C2{ vertical-align: top; border-left: #000000 1px solid; border-top: #000000 1px solid; border-bottom: #000000 1px solid; }
        tr.R42 td.R42C3{ text-align: center; vertical-align: top; border-left: #000000 1px solid; border-top: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #000000 1px dotted; }
        tr.R42 td.R42C4{ text-align: right; vertical-align: top; border-left: #000000 1px solid; border-top: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #000000 1px dotted; }
        tr.R42 td.R42C8{ text-align: center; vertical-align: top; border-left: #000000 1px solid; border-top: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #000000 1px dotted; }
        tr.R42 td.R42C9{ text-align: right; vertical-align: top; border-left: #000000 1px solid; border-top: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #000000 1px solid; }
        tr.R43{ font-family: Arial; font-size: 8pt; font-style: normal; height: 15px; }
        tr.R43 td.R43C0{ text-align: right; border-top: #ffffff 0px none; }
        tr.R43 td.R43C1{ text-align: left; vertical-align: middle; border-left: #000000 1px solid; border-top: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #ffffff 1px none; }
        tr.R43 td.R43C2{ text-align: center; vertical-align: middle; border-left: #ffffff 1px none; border-top: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #000000 1px solid; }
        tr.R43 td.R43C3{ text-align: right; vertical-align: middle; border-left: #000000 1px solid; border-top: #000000 1px solid; border-bottom: #000000 1px solid; }
        tr.R43 td.R43C5{ border-left: #000000 1px solid; border-top: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #000000 1px solid; }
        tr.R43 td.R43C6{ text-align: right; vertical-align: middle; border-left: #000000 1px solid; border-top: #000000 1px solid; border-bottom: #000000 1px solid; border-right: #000000 1px solid; }
        tr.R43 td.R45C1{ border-bottom: #000000 1px solid; }
        tr.R43 td.R45C6{ border-bottom: #000000 1px solid; }
        tr.R44{ font-family: Arial; font-size: 8pt; font-style: normal; height: 29px; }
        tr.R44 td.R44C1{ text-align: center; vertical-align: top; }
        tr.R44 td.R44C5{ text-align: center; vertical-align: top; }
        tr.R5{ height: 17px; }
        tr.R5 td.R5C13{ font-family: Arial; font-size: 10pt; font-style: normal; text-decoration: underline ; text-align: center; vertical-align: bottom; border-left: #ffffff 1px none; border-top: #ffffff 1px none; border-bottom: #ffffff 1px none; }
        tr.R5 td.R5C5{ text-align: right; }
        tr.R5 td.R5C8{ font-family: Arial; font-size: 9pt; font-style: normal; text-align: center; vertical-align: middle; border-left: #ffffff 1px none; border-top: #ffffff 1px none; border-bottom: #ffffff 1px none; border-right: #ffffff 1px none; }
        tr.R5 td.R5C9{ font-family: Arial; font-size: 10pt; font-style: normal; text-decoration: underline ; text-align: left; vertical-align: middle; border-left: #ffffff 1px none; border-top: #ffffff 1px none; border-bottom: #ffffff 1px none; }
        tr.R5 td.R9C1{ font-family: Arial; font-size: 9pt; font-style: normal; text-align: left; vertical-align: bottom; }
        tr.R5 td.R9C16{ font-family: Arial; font-size: 9pt; font-style: normal; text-align: right; vertical-align: bottom; border-bottom: #ffffff 1px none; }
        tr.R5 td.R9C18{ font-family: Arial; font-size: 8pt; font-style: normal; vertical-align: bottom; border-bottom: #000000 1px solid; }
        tr.R5 td.R9C2{ font-family: Arial; font-size: 8pt; font-style: normal; }
        tr.R5 td.R9C5{ font-family: Arial; font-size: 8pt; font-style: normal; vertical-align: bottom; border-bottom: #000000 1px solid; }
        tr.R6{ height: 14px; }
        tr.R6 td.R6C0{ border-bottom: #ffffff 1px none; }
        tr.R6 td.R6C1{ font-family: Arial; font-size: 9pt; font-style: normal; text-align: left; vertical-align: bottom; border-bottom: #ffffff 1px none; }
        tr.R6 td.R6C13{ font-family: Arial; font-size: 8pt; font-style: normal; vertical-align: bottom; border-bottom: #ffffff 1px none; }
        tr.R6 td.R6C14{ font-family: Arial; font-size: 8pt; font-style: normal; border-bottom: #ffffff 1px none; }
        tr.R6 td.R6C18{ font-family: Arial; font-size: 9pt; font-style: normal; text-align: right; vertical-align: bottom; overflow: visible;border-bottom: #ffffff 1px none; }
        tr.R6 td.R6C2{ font-family: Arial; font-size: 8pt; font-style: normal; border-left: #ffffff 1px none; border-bottom: #ffffff 1px none; }
        tr.R6 td.R6C9{ font-family: Arial; font-size: 9pt; font-style: normal; text-align: right; vertical-align: bottom; border-bottom: #ffffff 1px none; }
        tr.R7{ height: 29px; }
        tr.R7 td.R14C1{ font-family: Arial; font-size: 9pt; font-style: normal; text-align: left; vertical-align: bottom; }
        tr.R7 td.R14C4{ font-family: Arial; font-size: 8pt; font-style: normal; vertical-align: bottom; border-bottom: #000000 1px solid; }
        tr.R7 td.R7C1{ font-family: Arial; font-size: 9pt; font-style: normal; text-align: left; vertical-align: bottom; border-bottom: #ffffff 0px none; }
        tr.R7 td.R7C13{ font-family: Arial; font-size: 8pt; font-style: normal; vertical-align: bottom; border-bottom: #000000 1px solid; }
        tr.R7 td.R7C14{ font-family: Arial; font-size: 8pt; font-style: normal; }
        tr.R7 td.R7C18{ font-family: Arial; font-size: 9pt; font-style: normal; text-align: right; vertical-align: bottom; overflow: visible;border-bottom: #ffffff 1px none; }
        tr.R7 td.R7C2{ font-family: Arial; font-size: 8pt; font-style: normal; border-left: #ffffff 1px none; border-bottom: #000000 1px solid; }
        tr.R7 td.R7C9{ font-family: Arial; font-size: 9pt; font-style: normal; text-align: right; vertical-align: bottom; border-bottom: #ffffff 1px none; }
        table {table-layout: fixed; padding: 0; padding-left: 2px; vertical-align:bottom; border-collapse:collapse;width: 100%; font-family: Arial; font-size: 8pt; font-style: normal; }
        td { padding: 0; padding-left: 2px; overflow:hidden; vertical-align: bottom;}
    </style>
</head>
<body style="background: #ffffff; margin: 0; font-family: Arial; font-size: 8pt; font-style: normal; ">
<table style="width:100%; height:0px; " cellspacing="0">
    <colgroup><col width="18">
        <col width="76">
        <col width="17">
        <col width="34">
        <col width="34">
        <col width="49">
        <col width="48">
        <col width="57">
        <col width="34">
        <col width="28">
        <col width="35">
        <col width="29">
        <col width="33">
        <col width="72">
        <col width="35">
        <col width="37">
        <col width="16">
        <col width="57">
        <col width="21">
        <col width="49">
        <col width="58">
        <col width="136">
        <col width="67">
        <col width="20">
        <col>
    </colgroup><tbody><tr class="R0">
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td colspan="8"><span style="white-space:nowrap;max-width:0px;">??????????????&nbsp;7</span></td>
        <td></td>
    </tr>
    <tr class="R0">
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td colspan="8"><span style="white-space:nowrap;max-width:0px;">????&nbsp;????????????&nbsp;????????????????????&nbsp;????????????????&nbsp;??????????????????????????</span></td>
        <td></td>
    </tr>
    <tr class="R0">
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td colspan="8"><span style="white-space:nowrap;max-width:0px;">??????????????????????&nbsp;??&nbsp;??????????????</span></td>
        <td></td>
    </tr>
    <tr class="R0">
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td colspan="8"><span style="white-space:nowrap;max-width:0px;">??????????&nbsp;N&nbsp;1-????</span></td>
        <td><div style="width:100%;height:15px;overflow:hidden;"></div></td>
    </tr>
    <tr class="R4">
        <td><span></span></td>
        <td class="R4C1" colspan="22"><span style="white-space:nowrap;max-width:0px;">??????????????-??????????????????????&nbsp;????????????????</span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R5">
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td class="R5C5"><span></span></td>
        <td class="R5C5"><span></span></td>
        <td><span></span></td>
        <td class="R5C8"><span style="white-space:nowrap;max-width:0px;">???</span></td>
        <td class="R5C9" colspan="4"><span style="white-space:nowrap;max-width:0px;"><?php echo $companyDoer["print_code"]."-".$request["number"]?></span></td>
        <td class="R5C13" colspan="4"><span style="white-space:nowrap;max-width:0px;"><?php echo $request["doc_date"]?></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R6">
        <td class="R6C0"><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R6C1"><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R6C2"><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R6C2"><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R6C2"><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R6C0"><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R6C0"><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R6C0"><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R6C9"><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R6C9"><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R6C9"><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R6C9"><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R6C13"><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R6C14"><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R6C14"><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R6C14"><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R6C14"><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R6C18"><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R6C18"><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R6C18"><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R6C13"><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R6C14"><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:14px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="width:100%;height:14px;overflow:hidden;">&nbsp;</div></td>
    </tr>
    <tr class="R7">
        <td><span></span></td>
        <td class="R7C1"><span style="white-space:nowrap;max-width:0px;">????????????????????</span></td>
        <td class="R7C2" colspan="7">DAF,TE 96NCE,????????.????????.-????????.??????????-??,????0000????</td>
        <td class="R7C9" colspan="4">????????????/??????????????????????</td>
        <td class="R7C13" colspan="5">TRAILOR  TX 34CW ,??????.??/????????????-????????????.??,????0000????</td>
        <td class="R7C18" colspan="3"><span style="white-space:nowrap;max-width:0px;">??????&nbsp;????????????????????</span></td>
        <td class="R7C13" colspan="2">???????????????????????????? ??????????????????????</td>
        <td><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R0">
        <td><span></span></td>
        <td><span></span></td>
        <td class="R8C2" colspan="7"><span style="white-space:nowrap;max-width:0px;">(??????????,&nbsp;????????????,&nbsp;??????,&nbsp;??????????????????????????&nbsp;??????????)</span></td>
        <td class="R8C2"><span></span></td>
        <td class="R8C2"><span></span></td>
        <td class="R8C2"><span></span></td>
        <td class="R8C2"><span></span></td>
        <td class="R8C2" colspan="5"><span style="white-space:nowrap;max-width:0px;">(??????????,&nbsp;????????????,&nbsp;??????,&nbsp;??????????????????????????&nbsp;??????????)</span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    </tbody></table>
<table style="width:100%; height:0px; " cellspacing="0">
    <colgroup><col width="18">
        <col width="76">
        <col width="17">
        <col width="34">
        <col width="59">
        <col width="49">
        <col width="48">
        <col width="57">
        <col width="34">
        <col width="28">
        <col width="35">
        <col width="29">
        <col width="33">
        <col width="72">
        <col width="35">
        <col width="30">
        <col width="5">
        <col width="57">
        <col width="21">
        <col width="49">
        <col width="58">
        <col width="136">
        <col width="60">
        <col>
    </colgroup><tbody><tr class="R5">
        <td><span></span></td>
        <td class="R9C1" colspan="4"><span style="white-space:nowrap;max-width:0px;">??????????????????????????&nbsp;????????????????????</span></td>
        <td class="R9C5"><span></span></td>
        <td class="R9C5" colspan="10"><?php echo $companyDoer["full_name"]?></td>
        <td class="R9C16"><span></span></td>
        <td class="R9C16">??????????</td>
        <td class="R9C18" colspan="5"><?php echo $driver["short_name"].", ".$driver["driver_plate"]?></td>
        <td><span></span></td>
        <td></td>
    </tr>
    </tbody></table>
<table style="width:100%; height:0px; " cellspacing="0">
    <colgroup><col width="18">
        <col width="76">
        <col width="17">
        <col width="34">
        <col width="34">
        <col width="49">
        <col width="48">
        <col width="57">
        <col width="34">
        <col width="28">
        <col width="35">
        <col width="29">
        <col width="33">
        <col width="72">
        <col width="35">
        <col width="37">
        <col width="16">
        <col width="57">
        <col width="21">
        <col width="49">
        <col width="58">
        <col width="136">
        <col width="67">
        <col width="20">
        <col>
    </colgroup><tbody><tr class="R0">
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R8C2"><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R8C2" colspan="10"><span style="white-space:nowrap;max-width:0px;">(????????????????????????&nbsp;/&nbsp;??.&nbsp;??.&nbsp;??.)</span></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R8C2" colspan="5"><span style="white-space:nowrap;max-width:0px;">(??.&nbsp;??.&nbsp;??.,&nbsp;??????????&nbsp;??????????????????????&nbsp;??????????)</span></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:15px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="width:100%;height:15px;overflow:hidden;"></div></td>
    </tr>
    <tr class="R5">
        <td><span></span></td>
        <td class="R9C1" colspan="3"><span style="white-space:nowrap;max-width:0px;">????????????????&nbsp;(??????????????)</span></td>
        <td class="R9C5" colspan="19">???????????????? ???????????????????????? "????????????-????????????", ?????? 310736513067, ??????.: (032) 245-94-51, ??/?? UA443005280000026002001303621 ?? ?????????? ?????? ?????? ?? ??.????????, ?????? ???? ???????????? 31073655</td>
        <td><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R0">
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td class="R8C2" colspan="19"><span style="white-space:nowrap;max-width:0px;">(????????????????????????&nbsp;/&nbsp;??.&nbsp;??.&nbsp;??.)</span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R13">
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="width:100%;height:7px;overflow:hidden;">&nbsp;</div></td>
    </tr>
    <tr class="R7">
        <td><span></span></td>
        <td class="R14C1" colspan="3"><span style="white-space:nowrap;max-width:0px;">??????????????????????????????????</span></td>
        <td class="R14C4" colspan="19">???????????????????? ?? ?????????????????? ???????????????????????????????? "???????????????????????? ?????????????? "????????", ?????? 367673613201, ????????????: 80463, ?????????????????? ??????., ???????????????????? ??-??, ??. ???????????? ????????????, ??????. ??????????????????, ?????????????? ??? 1, ??????.: (032) 266-77-17, ??/?? UA943808050000000026005691081 ?? ?????????? ???? "???????????????????? ????????", ?????? ???? ???????????? 36767366</td>
        <td><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R0">
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td class="R8C2" colspan="19"><span style="white-space:nowrap;max-width:0px;">(??????????&nbsp;????????????????????????,&nbsp;????????????????????????????????&nbsp;/&nbsp;??.&nbsp;??.&nbsp;??.,&nbsp;??????????&nbsp;????????????????????)</span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R16">
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:8px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="width:100%;height:8px;overflow:hidden;">&nbsp;</div></td>
    </tr>
    <tr class="R5">
        <td><span></span></td>
        <td class="R9C1" colspan="3"><span style="white-space:nowrap;max-width:0px;">????????????????????????????????</span></td>
        <td class="R9C5" colspan="19">???????????????? ???????????????????????? "????????????-????????????", ?????? 310736513067, ??????.: (032) 245-94-51, ??/?? UA443005280000026002001303621 ?? ?????????? ?????? ?????? ?? ??.????????, ?????? ???? ???????????? 31073655</td>
        <td><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R0">
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td class="R8C2" colspan="19"><span style="white-space:nowrap;max-width:0px;">(??????????&nbsp;????????????????????????,&nbsp;????????????????????????????????&nbsp;/&nbsp;??.&nbsp;??.??.,&nbsp;??????????&nbsp;????????????????????)</span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R7">
        <td><span></span></td>
        <td class="R14C1" colspan="3"><span style="white-space:nowrap;max-width:0px;">??????????&nbsp;????????????????????????</span></td>
        <td class="R7C13" colspan="9">80463, ?????????????????? ??????., ???????????????????? ??-??, ??. ???????????? ????????????, ??????. ??????????????????, ?????????????? ??? 1</td>
        <td class="R7C9" colspan="4">?????????? ??????????????????????????</td>
        <td class="R7C13" colspan="6">??????.????????????????,1, ??.????????????????,?????????????????????????????? ??-??.,?????????????????? ??????.</td>
        <td><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R0">
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td class="R8C2" colspan="9"><span style="white-space:nowrap;max-width:0px;">(????????????????????????????????)</span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td class="R8C2" colspan="6"><span style="white-space:nowrap;max-width:0px;">(????????????????????????????????)</span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R21">
        <td><span></span></td>
        <td class="R21C1" colspan="4"><span style="white-space:nowrap;max-width:0px;">??????????????????????????????&nbsp;??????????????</span></td>
        <td class="R21C5"><span></span></td>
        <td class="R21C5" colspan="17"><span></span></td>
        <td class="R21C23" colspan="2"><span style="white-space:nowrap;max-width:0px;">,</span></td>
        <td></td>
    </tr>
    <tr class="R0">
        <td><span></span></td>
        <td colspan="5"><span></span></td>
        <td class="R8C2" colspan="17"><span style="white-space:nowrap;max-width:0px;">(????????????????????????,&nbsp;????????????????????????????????&nbsp;/&nbsp;??.&nbsp;??.&nbsp;??.,&nbsp;??????????&nbsp;????????????????????&nbsp;????????????&nbsp;??????????????????????????????????;&nbsp;??.&nbsp;??.&nbsp;??.,&nbsp;????????????&nbsp;????&nbsp;????????????&nbsp;????????????????????????????&nbsp;??????????)</span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R21">
        <td><span></span></td>
        <td class="R21C1" colspan="7"><span style="white-space:nowrap;max-width:0px;">??????????????&nbsp;????&nbsp;??????????????????????&nbsp;??????????????????????????????????:&nbsp;??????????</span></td>
        <td class="R23C8"><span></span></td>
        <td class="R23C9"><span style="white-space:nowrap;max-width:0px;">???</span></td>
        <td class="R23C10" colspan="2"><span></span></td>
        <td class="R23C9"><span style="white-space:nowrap;max-width:0px;">??????</span></td>
        <td class="R23C10" colspan="3"><span></span></td>
        <td class="R23C16" colspan="2"><span style="white-space:nowrap;max-width:0px;">??????????????</span></td>
        <td class="R23C10" colspan="5"><span></span></td>
        <td class="R21C23"><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R0">
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td>&nbsp;</td>
    </tr>
    <tr class="R21">
        <td><span></span></td>
        <td class="R21C1" colspan="6"><span style="white-space:nowrap;max-width:0px;">????????????&nbsp;??????????????&nbsp;??????&nbsp;??????????????????????&nbsp;??&nbsp;??????????,????&nbsp;</span></td>
        <td class="R25C7" colspan="3"><span style="white-space:nowrap;max-width:0px;">????????????????????</span></td>
        <td class="R21C1" colspan="13"><span style="white-space:nowrap;max-width:0px;">????????????????&nbsp;????????????????????&nbsp;??????????????????????&nbsp;????????????????,&nbsp;??????????&nbsp;????????????&nbsp;(????&nbsp;??????????????????)&nbsp;____________________________</span></td>
        <td class="R21C23" colspan="2"><span style="white-space:nowrap;max-width:0px;">,</span></td>
        <td></td>
    </tr>
    <tr class="R0">
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td class="R8C2" colspan="3"><span style="white-space:nowrap;max-width:0px;">(????????????????????&nbsp;/&nbsp;????&nbsp;????????????????????)</span></td>
        <td class="R8C2"><span></span></td>
        <td class="R8C2"><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R27">
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="width:100%;height:9px;overflow:hidden;">&nbsp;</div></td>
    </tr>
    <tr class="R28">
        <td><span></span></td>
        <td colspan="2"><span style="white-space:nowrap;max-width:0px;">??????????????????&nbsp;??????????</span></td>
        <td class="R28C3" colspan="5"><span style="white-space:nowrap;max-width:0px;">1</span></td>
        <td class="R28C8" colspan="3"><span style="white-space:nowrap;max-width:0px;">,&nbsp;??????????&nbsp;????????????,&nbsp;??</span></td>
        <td class="R28C11" colspan="3">0,500</td>
        <td colspan="5"><span style="white-space:nowrap;max-width:0px;">,&nbsp;??????????????&nbsp;??????????/????????????????????</span></td>
        <td class="R28C19" colspan="4"><span style="white-space:nowrap;max-width:0px;">?????????????????? ??.??.,&nbsp;??????????</span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R29">
        <td><div style="position:relative; height:12px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:12px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:12px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R29C3" colspan="5"><span style="white-space:nowrap;max-width:0px;">(??????????????)</span></td>
        <td><div style="position:relative; height:12px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:12px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:12px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R29C3" colspan="3"><span style="white-space:nowrap;max-width:0px;">(??????????????)</span></td>
        <td><div style="position:relative; height:12px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:12px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:12px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:12px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:12px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R29C3" colspan="4"><span style="white-space:nowrap;max-width:0px;">(??.&nbsp;??.&nbsp;??.,&nbsp;????????????,&nbsp;????????????)</span></td>
        <td><div style="position:relative; height:12px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:12px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="width:100%;height:12px;overflow:hidden;"></div></td>
    </tr>
    <tr class="R30">
        <td><span></span></td>
        <td colspan="8"><span style="white-space:nowrap;max-width:0px;">??????????????????&nbsp;(??????????????????????????&nbsp;??????????&nbsp;????????????????????????????????????)</span></td>
        <td class="R30C9" colspan="8">?????????????? ??.??.</td>
        <td colspan="3"><span style="white-space:nowrap;max-width:0px;">??????????????&nbsp;????????????????</span></td>
        <td class="R30C9" colspan="3">?????????????? ??.??.</td>
        <td><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R30">
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td class="R31C9" colspan="8"><span style="white-space:nowrap;max-width:0px;">(??.&nbsp;??.&nbsp;??.,&nbsp;????????????,&nbsp;????????????)</span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td class="R31C9" colspan="3"><span style="white-space:nowrap;max-width:0px;">(??.&nbsp;??.&nbsp;??.,&nbsp;????????????,&nbsp;????????????,&nbsp;??????????????)</span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R30">
        <td><span></span></td>
        <td colspan="5"><span style="white-space:nowrap;max-width:0px;">????????????&nbsp;??????????????????&nbsp;????&nbsp;????????????????&nbsp;????????</span></td>
        <td class="R32C6" colspan="11"><span style="white-space:nowrap;max-width:0px;">????????&nbsp;??????????????&nbsp;00&nbsp;??????????????</span></td>
        <td colspan="2"><span style="white-space:nowrap;max-width:0px;">,&nbsp;??&nbsp;??.&nbsp;??.&nbsp;??????</span></td>
        <td class="R32C19" colspan="4">-</td>
        <td><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R30">
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td class="R31C9" colspan="11"><span style="white-space:nowrap;max-width:0px;">(??????????????,&nbsp;??&nbsp;??????????????????????&nbsp;??????)</span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R30">
        <td><span></span></td>
        <td colspan="5"><span style="white-space:nowrap;max-width:0px;">????????????????????&nbsp;??????????????????&nbsp;????&nbsp;????????????</span></td>
        <td class="R34C6" colspan="17"><span style="white-space:nowrap;max-width:0px;"></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R30">
        <td><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td>&nbsp;</td>
    </tr>
    <tr class="R36">
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:9px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="width:100%;height:9px;overflow:hidden;">&nbsp;</div></td>
    </tr>
    <tr class="R30">
        <td><span></span></td>
        <td colspan="10"><span style="white-space:nowrap;max-width:0px;">??????????????????????&nbsp;??????????????,&nbsp;??????&nbsp;??????????????????&nbsp;??????????????????????????&nbsp;????????????????????????:</span></td>
        <td class="R37C11" colspan="12"><span style="white-space:nowrap;max-width:0px;">??????????????????????????????</span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R30">
        <td><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td class="R34C6"><span></span></td>
        <td><span></span></td>
        <td><span></span></td>
        <td>&nbsp;</td>
    </tr>
    </tbody></table>
<table style="width:100%; height:0px; " cellspacing="0">
    <colgroup><col width="7">
        <col width="85">
        <col width="256">
        <col width="112">
        <col width="112">
        <col width="104">
        <col width="134">
        <col width="64">
        <col width="110">
        <col width="36">
        <col width="40">
        <col>
    </colgroup><tbody><tr class="R39">
        <td><div style="position:relative; height:20px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R39C1" colspan="10"><span style="white-space:nowrap;max-width:0px;">??????????????????&nbsp;??????&nbsp;????????????</span></td>
        <td><div style="position:relative; height:20px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="width:100%;height:20px;overflow:hidden;"></div></td>
    </tr>
    </tbody></table>
<table style="width:100%; height:0px; " cellspacing="0">
    <colgroup><col width="18">
        <col width="31">
        <col width="284">
        <col width="71">
        <col width="88">
        <col width="121">
        <col width="130">
        <col width="108">
        <col width="119">
        <col width="89">
        <col>
    </colgroup><tbody><tr class="R40">
        <td><span></span></td>
        <td class="R40C1">??? ??/??</td>
        <td class="R40C1">???????????????????????? ?????????????? (?????????? ????????????????????), ?? ???????? ?????????????????????? ?????????????????????? ????????????????: ???????? ?????????????????????? ??????????????, ???? ?????????? ?????????????????? ????????????</td>
        <td class="R40C1">????????. ????????????</td>
        <td class="R40C1">?????????????????? ??????????</td>
        <td class="R40C1">???????? ?????? ?????? ???? ??????????????, ??????</td>
        <td class="R40C1">???????????????? ???????? ?? ??????, ??????</td>
        <td class="R40C1">?????? ??????????????????</td>
        <td class="R40C1">?????????????????? ?? ????????????????</td>
        <td class="R40C1">???????? ????????????, ??</td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R41">
        <td><span></span></td>
        <td class="R41C1"><span style="white-space:nowrap;max-width:0px;">1</span></td>
        <td class="R41C1"><span style="white-space:nowrap;max-width:0px;">2</span></td>
        <td class="R41C1"><span style="white-space:nowrap;max-width:0px;">3</span></td>
        <td class="R41C1"><span style="white-space:nowrap;max-width:0px;">4</span></td>
        <td class="R41C1"><span style="white-space:nowrap;max-width:0px;">5</span></td>
        <td class="R41C1"><span style="white-space:nowrap;max-width:0px;">6</span></td>
        <td class="R41C1"><span style="white-space:nowrap;max-width:0px;">7</span></td>
        <td class="R41C1"><span style="white-space:nowrap;max-width:0px;">8</span></td>
        <td class="R41C9"><span style="white-space:nowrap;max-width:0px;">9</span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R42">
        <td><span></span></td>
        <td class="R42C1">1</td>
        <td class="R42C2">??.??. ??? 0001 ?????? 02.11.2022</td>
        <td class="R42C3"><span style="white-space:nowrap;max-width:0px;">??????</span></td>
        <td class="R42C4"><span style="white-space:nowrap;max-width:0px;">1</span></td>
        <td class="R42C4"><span></span></td>
        <td class="R42C4"><span></span></td>
        <td class="R42C3"><span style="white-space:nowrap;max-width:0px;">??????</span></td>
        <td class="R42C8"><span></span></td>
        <td class="R42C9"><span style="white-space:nowrap;max-width:0px;">0,500</span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R43">
        <td class="R43C0"><span></span></td>
        <td class="R43C1" colspan="2"><span style="white-space:nowrap;max-width:0px;">????????????:</span></td>
        <td class="R43C3"><span></span></td>
        <td class="R43C3"><span style="white-space:nowrap;max-width:0px;">1</span></td>
        <td class="R43C5"><span></span></td>
        <td class="R43C6"><span></span></td>
        <td class="R43C6"><span></span></td>
        <td class="R43C6"><span></span></td>
        <td class="R43C6"><span style="white-space:nowrap;max-width:0px;">0,500</span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    </tbody></table>
<table style="width:100%; height:0px; " cellspacing="0">
    <colgroup><col width="24">
        <col width="58">
        <col width="58">
        <col width="58">
        <col width="58">
        <col width="32">
        <col width="58">
        <col width="58">
        <col width="58">
        <col width="58">
        <col width="33">
        <col width="58">
        <col width="58">
        <col width="58">
        <col width="58">
        <col width="35">
        <col width="58">
        <col width="58">
        <col width="58">
        <col width="58">
        <col>
    </colgroup><tbody><tr class="R44">
        <td><span></span></td>
        <td class="R44C1" colspan="4">???????? (?????????????????????????? ?????????? ????????????????????????????????????)</td>
        <td class="R44C5"><span></span></td>
        <td class="R44C5" colspan="4"><span style="white-space:nowrap;max-width:0px;">??????????????&nbsp;??????????/????????????????????</span></td>
        <td class="R44C5"><span></span></td>
        <td class="R44C5" colspan="4"><span style="white-space:nowrap;max-width:0px;">????????&nbsp;??????????/????????????????????</span></td>
        <td class="R44C5"><span></span></td>
        <td class="R44C1" colspan="4">?????????????? (?????????????????????????? ?????????? ??????????????????????????????????)</td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R43">
        <td><span></span></td>
        <td class="R45C1" colspan="4">?????????????? ??.??.</td>
        <td><span></span></td>
        <td class="R45C6" colspan="4"><span style="white-space:nowrap;max-width:0px;">?????????????????? ??.??.,&nbsp;??????????</span></td>
        <td><span></span></td>
        <td class="R45C6" colspan="4"><span style="white-space:nowrap;max-width:0px;">?????????????????? ??.??.,&nbsp;??????????</span></td>
        <td><span></span></td>
        <td class="R45C6" colspan="4"><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R30">
        <td><div style="position:relative; height:16px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R31C9" colspan="4"><span style="white-space:nowrap;max-width:0px;">(??.&nbsp;??.&nbsp;??.,&nbsp;????????????,&nbsp;????????????,&nbsp;??????????????)</span></td>
        <td><div style="position:relative; height:16px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R31C9" colspan="4"><span style="white-space:nowrap;max-width:0px;">(??.&nbsp;??.&nbsp;??.,&nbsp;????????????,&nbsp;????????????)</span></td>
        <td><div style="position:relative; height:16px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R31C9" colspan="4"><span style="white-space:nowrap;max-width:0px;">(??.&nbsp;??.&nbsp;??.,&nbsp;????????????,&nbsp;????????????)</span></td>
        <td><div style="position:relative; height:16px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R31C9" colspan="4"><span style="white-space:nowrap;max-width:0px;">(??.&nbsp;??.&nbsp;??.,&nbsp;????????????,&nbsp;????????????,&nbsp;??????????????)</span></td>
        <td><div style="position:relative; height:16px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="width:100%;height:16px;overflow:hidden;"></div></td>
    </tr>
    </tbody></table>
<table style="width:100%; height:0px; " cellspacing="0">
    <colgroup><col width="17">
        <col width="166">
        <col width="166">
        <col width="166">
        <col width="166">
        <col width="166">
        <col width="212">
        <col>
    </colgroup><tbody><tr class="R21">
        <td><span></span></td>
        <td class="R47C1" colspan="6"><span style="white-space:nowrap;max-width:0px;">????????????????-????????????????????????????????&nbsp;????????????????</span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R0">
        <td><span></span></td>
        <td class="R48C1" rowspan="3">????????????????</td>
        <td class="R48C2" rowspan="3">???????? ????????????, ??</td>
        <td class="R48C3" colspan="3"><span style="white-space:nowrap;max-width:0px;">??????&nbsp;(??????.,&nbsp;????.)</span></td>
        <td class="R48C6" rowspan="3">???????????? ???????????????????????????? ??????????</td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R0">
        <td rowspan="2"><span></span></td>
        <td class="R48C1" rowspan="2">????????????????</td>
        <td class="R48C3" rowspan="2"><span style="white-space:nowrap;max-width:0px;">??????????????</span></td>
        <td class="R49C5" rowspan="2"><span style="white-space:nowrap;max-width:0px;">??????????????</span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R0">
        <td><span></span></td>
        <td>&nbsp;</td>
    </tr>
    <tr class="R0">
        <td><span></span></td>
        <td class="R51C1">10</td>
        <td class="R51C2"><span style="white-space:nowrap;max-width:0px;">11</span></td>
        <td class="R51C3"><span style="white-space:nowrap;max-width:0px;">12</span></td>
        <td class="R51C3"><span style="white-space:nowrap;max-width:0px;">13</span></td>
        <td class="R51C3"><span style="white-space:nowrap;max-width:0px;">14</span></td>
        <td class="R51C6"><span style="white-space:nowrap;max-width:0px;">15</span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R0">
        <td><span></span></td>
        <td class="R52C1"><span style="white-space:nowrap;max-width:0px;">????????????????????????</span></td>
        <td class="R52C2"><span style="white-space:nowrap;max-width:0px;">0,500</span></td>
        <td class="R52C1"><span></span></td>
        <td class="R52C4"><span></span></td>
        <td class="R52C4"><span></span></td>
        <td class="R52C6"><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    <tr class="R0">
        <td><span></span></td>
        <td class="R52C1"><span style="white-space:nowrap;max-width:0px;">??????????????????????????</span></td>
        <td class="R52C2"><span style="white-space:nowrap;max-width:0px;">0,500</span></td>
        <td class="R52C1"><span></span></td>
        <td class="R53C4"><span></span></td>
        <td class="R53C4"><span></span></td>
        <td class="R53C6"><span></span></td>
        <td><span></span></td>
        <td></td>
    </tr>
    </tbody></table>
<table style="width:100%; height:0px; " cellspacing="0">
    <colgroup><col width="18">
        <col width="76">
        <col width="17">
        <col width="34">
        <col width="34">
        <col width="49">
        <col width="48">
        <col width="57">
        <col width="34">
        <col width="28">
        <col width="35">
        <col width="29">
        <col width="33">
        <col width="72">
        <col width="35">
        <col width="37">
        <col width="16">
        <col width="57">
        <col width="21">
        <col width="49">
        <col width="58">
        <col width="136">
        <col width="67">
        <col width="20">
        <col>
    </colgroup><tbody><tr class="R13">
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td class="R54C3"><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="position:relative; height:7px;width: 100%; overflow:hidden;"><span></span></div></td>
        <td><div style="width:100%;height:7px;overflow:hidden;">&nbsp;</div></td>
    </tr>
    </tbody></table>


</body></html>