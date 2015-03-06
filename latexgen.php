<?php
require ("php/dbconn.php");
$conn=dbconnect($qry);
//tabella Requisiti Funzionali (codice, descrizione, fonti)
$qry="SELECT r.NomeReq, r.Descrizione, f.NomeFonte FROM Requisiti r NATURAL JOIN ReqFonti rf NATURAL JOIN Fonti f WHERE r.Tipo='F';";
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
$qry="SELECT r.NomeReq, r.Descrizione, f.NomeFonte FROM Requisiti r NATURAL JOIN ReqFonti rf NATURAL JOIN Fonti f WHERE r.Tipo='Q';";
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
$qry="SELECT r.NomeReq, r.Descrizione, f.NomeFonte FROM Requisiti r NATURAL JOIN ReqFonti rf NATURAL JOIN Fonti f WHERE r.Tipo='V';";
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
$qry="SELECT r.NomeReq, f.NomeFonte FROM Requisiti r NATURAL JOIN ReqFonti rf NATURAL JOIN Fonti f;";
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
$qry="SELECT f.NomeFonte, r.NomeReq FROM Requisiti r NATURAL JOIN ReqFonti rf NATURAL JOIN Fonti f;";
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
		$tabella5.=" ".$a[1];
	}
}
$tabella5.="\\\\\\hline
\caption{Tracciamento requisiti-fonti}
\\end{longtable}
\\egroup";
mysqli_free_result($tfr);
mysqli_close($conn);


header('Content-Type: application/x-tex');
header('Content-Disposition: attachment; filename="tables.tex"');
print <<<EOF
\documentclass[12pt, a4paper]{article}
\usepackage{longtable}
\\title{Risolutore di puzzle – Parte 1}
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

\\end{document}

EOF;

?>