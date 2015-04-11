<?php
	session_start();
	if (isset($_SESSION['authenticate']) == false)
			header('location:login.php');
?>

<?php
require ("php/dbconn.php");
$conn=dbconnect();
//tabella Requisiti Funzionali (codice, descrizione, fonti)
$qry="SELECT r.NomeReq, r.Descrizione, f.NomeFonte FROM Requisiti r NATURAL JOIN ReqFonti rf NATURAL JOIN Fonti f WHERE r.Tipo='F' ORDER BY r.NomeReq;";
$trf = mysqli_query($conn,$qry);
$tabella1="\bgroup
\def\arraystretch{1.8}
\begin{longtable}{|l|p{7cm}|p{1.7cm}|} \hline
\\textbf{Requisito} & \\textbf{Descrizione} & \\textbf{Fonti}";
$c="";
while ($a = mysqli_fetch_row($trf)){
	if($a[0]!=$v){
		$tabella1.="\\\\\\hline \n";
		$tabella1.="$a[0] & $a[1] & $a[2]"; 
		$v=$a[0];
	}else{
		$tabella1.=" ".$a[2];
	}
}
$tabella1.="\\\\\\hline
\caption{Requisiti funzionali}
\\end{longtable}
\\egroup";
mysqli_free_result($trf);

//tabella Requisiti Qualità (codice, descrizione, fonti)
$qry="SELECT r.NomeReq, r.Descrizione, f.NomeFonte FROM Requisiti r NATURAL JOIN ReqFonti rf NATURAL JOIN Fonti f WHERE r.Tipo='Q'  ORDER BY r.NomeReq;";
$trq=mysqli_query($conn,$qry);
$tabella2="\bgroup
\def\arraystretch{1.8}
\begin{longtable}{|l|p{7cm}|p{1.7cm}|} \hline
\\textbf{Requisito} & \\textbf{Descrizione} & \\textbf{Fonti}";
$c="";
while ($a = mysqli_fetch_row($trq)){
	if($a[0]!=$v){
		$tabella2.="\\\\\\hline \n";
		$tabella2.="$a[0] & $a[1] & $a[2]"; 
		$v=$a[0];
	}else{
		$tabella2.=" ".$a[2];
	}
}
$tabella2.="\\\\\\hline
\caption{Requisiti di qualità}
\\end{longtable}
\\egroup";
mysqli_free_result($trq);

//tabella Requisiti Vincolo (codice, descrizione, fonti)
$qry="SELECT r.NomeReq, r.Descrizione, f.NomeFonte FROM Requisiti r NATURAL JOIN ReqFonti rf NATURAL JOIN Fonti f WHERE r.Tipo='V'  ORDER BY r.NomeReq;";
$trv=mysqli_query($conn,$qry);
$tabella3="\bgroup 
\def\arraystretch{1.8}
\begin{longtable}{|l|p{7cm}|p{1.7cm}|} \hline
\\textbf{Requisito} & \\textbf{Descrizione} & \\textbf{Fonti}";
$c="";
while ($a = mysqli_fetch_row($trv)){
	if($a[0]!=$v){
		$tabella3.="\\\\\\hline \n";
		$tabella3.="$a[0] & $a[1] & $a[2]"; 
		$v=$a[0];
	}else{
		$tabella3.=" ".$a[2];
	}
}
$tabella3.="\\\\\\hline
\caption{Requisiti di vincolo}
\\end{longtable}
\\egroup";
mysqli_free_result($trv);

//Tracciamento requisito-fonti
$qry="SELECT r.NomeReq, f.NomeFonte FROM Requisiti r NATURAL JOIN ReqFonti rf NATURAL JOIN Fonti f  ORDER BY r.NomeReq;";
$trf=mysqli_query($conn,$qry);
$tabella4="\bgroup
\def\arraystretch{1.8}
\begin{longtable}{|p{5cm}|p{5cm}|} \hline
\\textbf{Requisiti} & \\textbf{Fonti}";
$c="";
while ($a = mysqli_fetch_row($trf)) {
	if($a[0]!=$v){
		$tabella4.="\\\\\\hline \n";
		$tabella4.="$a[0] & $a[1] "; 
		$v=$a[0];
	}else{
		$tabella4.=" ".$a[1];
	}
}
$tabella4.="\\\\\\hline
\caption{Tracciamento requisiti-fonti}
\\end{longtable}
\\egroup";
mysqli_free_result($trf);

//Tracciamento fonti-requisiti
$qry="SELECT f.NomeFonte, r.NomeReq FROM Requisiti r NATURAL JOIN ReqFonti rf NATURAL JOIN Fonti f  ORDER BY f.Nomefonte;";
$tfr=mysqli_query($conn,$qry);
$tabella5="\bgroup
\def\arraystretch{1.8}
\begin{longtable}{|p{5cm}|p{5cm}|} \hline
\\textbf{Requisiti} & \\textbf{Fonti}";
$c="";
while ($a = mysqli_fetch_row($tfr)) {
	if($a[0]!=$v){
		$tabella5.="\\\\\\hline \n";
		$tabella5.="$a[0] & $a[1] "; 
		$v=$a[0];
	}else{
		$tabella5.=" \\newline ".$a[1];
	}
}
$tabella5.="\\\\\\hline
\caption{Tracciamento requisiti-fonti}
\\end{longtable}
\\egroup";
mysqli_free_result($tfr);

//tabella di riepilogo
$tabella6="\bgroup
\def\arraystretch{1.8}
\begin{longtable}{|l|l|l|l|} \hline
\\textbf{Categoria} & \\textbf{Obbligatorio} & \\textbf{Opzionale} & \\textbf{Desiderabile} \\\\\\hline\n";

$qry="SELECT r.Importanza, count(*) FROM Requisiti r WHERE r.Tipo='F' GROUP BY r.Importanza";
$rr=mysqli_query($conn,$qry);
$obbligatorio="0"; $opzionale="0"; $desiderabile="0";
while ($a = mysqli_fetch_row($rr)) {
	if ($a[0]=="0") $obbligatorio=$a[1];
	if ($a[0]=="1") $opzionale=$a[1];
	if ($a[0]=="2") $desiderabile=$a[1];
}
$tabella6.="Funzionale & $obbligatorio & $opzionale & $desiderabile \\\\\\hline \n";

$qry="SELECT r.Importanza, count(*) FROM Requisiti r WHERE r.Tipo='P' GROUP BY r.Importanza";
$rr=mysqli_query($conn,$qry);
$obbligatorio="0"; $opzionale="0"; $desiderabile="0";
while ($a = mysqli_fetch_row($rr)) {
	if ($a[0]=="0") $obbligatorio=$a[1];
	if ($a[0]=="1") $opzionale=$a[1];
	if ($a[0]=="2") $desiderabile=$a[1];
}
$tabella6.="Prestazionale & $obbligatorio & $opzionale & $desiderabile \\\\\\hline \n";

$qry="SELECT r.Importanza, count(*) FROM Requisiti r WHERE r.Tipo='Q' GROUP BY r.Importanza";
$rr=mysqli_query($conn,$qry);
$obbligatorio="0"; $opzionale="0"; $desiderabile="0";
while ($a = mysqli_fetch_row($rr)) {
	if ($a[0]=="0") $obbligatorio=$a[1];
	if ($a[0]=="1") $opzionale=$a[1];
	if ($a[0]=="2") $desiderabile=$a[1];
}
$tabella6.="Qualitativo & $obbligatorio & $opzionale & $desiderabile \\\\\\hline \n";

$qry="SELECT r.Importanza, count(*) FROM Requisiti r WHERE r.Tipo='V' GROUP BY r.Importanza";
$rr=mysqli_query($conn,$qry);
$obbligatorio="0"; $opzionale="0"; $desiderabile="0";
while ($a = mysqli_fetch_row($rr)) {
	if ($a[0]=="0") $obbligatorio=$a[1];
	if ($a[0]=="1") $opzionale=$a[1];
	if ($a[0]=="2") $desiderabile=$a[1];
}
$tabella6.="Vincolo & $obbligatorio & $opzionale & $desiderabile \\\\\\hline \n";

$tabella6.="\caption{Riepilogo requisiti}
\\end{longtable}
\\egroup";
mysqli_free_result($rr);
mysqli_close($conn);


header('Content-Type: application/x-tex; charset=utf-8');
header('Content-Disposition: attachment; filename="tables.tex"');
print <<<EOF
\documentclass[12pt, a4paper]{article}
\usepackage{longtable}
\usepackage[italian]{babel}
\usepackage[utf8]{inputenc}
\\title{Tabelle requisiti}
\author{AlpenTrack generator}
\begin{document}
\maketitle
\section{Tabelle}
\subsection{Requisiti funzionali}
\begin{center}
$tabella1
\\end{center}

\subsection{Requisiti di qualità}
\begin{center}
$tabella2
\\end{center}

\subsection{Requisiti di vincolo}
\begin{center}
$tabella3
\\end{center}

\subsection{Tracciamento requisiti-fonti}
\begin{center}
$tabella4
\\end{center}

\subsection{Tracciamento fonti-requisiti}
\begin{center}
$tabella5
\\end{center}

\subsection{Riepilogo}
\begin{center}
$tabella6
\\end{center}

\\end{document}

EOF;

?>
