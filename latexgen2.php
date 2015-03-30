<?php
	/*session_start();
	if (isset($_SESSION['authenticate']) == false)
			header('location:login.php');*/
?>

<?php
require ("php/dbconn.php");
$conn=dbconnect();
//tabella tracciamento requisito - classi
$qry="SELECT r.NomeReq, c.NomeComp FROM Requisiti r NATURAL JOIN ReqComp rc NATURAL JOIN Componenti c" ;
$trc = mysqli_query($conn,$qry);
$tabella1="\bgroup
\def\arraystretch{1.8}
\begin{longtable}{|l|p{7cm}|} \hline
\\textbf{Requisito} & \\textbf{Classe}";
$c="";
while ($a = mysqli_fetch_row($trc)){
	if($a[0]!=$v){
		$tabella1.="\\\\\\hline \n";
		$tabella1.="$a[0] & $a[1]"; 
		$v=$a[0];
	}else{
		$tabella1.=" ".$a[1];
	}
}
$tabella1.="\\\\\\hline
\caption{Tracciamento requisiti-classi}
\\end{longtable}
\\egroup";
mysqli_free_result($trc);

//tabella tracciamento requisito - classi
$qry="SELECT c.NomeComp, r.NomeReq FROM Requisiti r NATURAL JOIN ReqComp rc NATURAL JOIN Componenti c" ;
$tcr = mysqli_query($conn,$qry);
$tabella2="\bgroup
\def\arraystretch{1.8}
\begin{longtable}{|l|p{7cm}|} \hline
\\textbf{Requisito} & \\textbf{Classe}";
$c="";
while ($a = mysqli_fetch_row($tcr)){
	if($a[0]!=$v){
		$tabella2.="\\\\\\hline \n";
		$tabella2.="$a[0] & $a[1]"; 
		$v=$a[0];
	}else{
		$tabella2.=" ".$a[1];
	}
}
$tabella2.="\\\\\\hline
\caption{Tracciamento classi-requisiti}
\\end{longtable}
\\egroup";
mysqli_free_result($tcr);

//tracciamento metodo - test
$qry="SELECT m.NomeMod, t.CodTest FROM Moduli m NATURAL JOIN Tests t" ;
$tct = mysqli_query($conn,$qry);
$tabella3="\bgroup
\def\arraystretch{1.8}
\begin{longtable}{|l|p{7cm}|} \hline
\\textbf{Metodo} & \\textbf{Test}";
$c="";
while ($a = mysqli_fetch_row($tct)){
	if($a[0]!=$v){
		$tabella3.="\\\\\\hline \n";
		$tabella3.="$a[0] & $a[1]"; 
		$v=$a[0];
	}else{
		$tabella3.=" ".$a[1];
	}
}
$tabella3.="\\\\\\hline
\caption{Tracciamento metodo-tests}
\\end{longtable}
\\egroup";
mysqli_free_result($tcr);

mysqli_close($conn);


header('Content-Type: application/x-tex; charset=utf-8');
header('Content-Disposition: attachment; filename="tables.tex"');
print <<<EOF
\documentclass[12pt, a4paper]{article}
\usepackage{longtable}
\\title{Tabelle requisiti}
\author{AlpenTrack generator}
\begin{document}
\maketitle
\section{Tracciamento}
\subsection{Tracciamento requisiti-classi}
\begin{center}
$tabella1
\\end{center}
\subsection{Tracciamento classi-requisiti}
\begin{center}
$tabella2
\\end{center}
\subsection{Tracciamento metodo-tests}
\begin{center}
$tabella3
\\end{center}
\\end{document}

EOF;

?>