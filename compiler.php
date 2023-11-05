<?php
$language=strtolower($_POST['language']);
$code=$_POST['code'];

$random=substr(md5(mt_rand()), 0, 7);
if($language=="java"){
    $filePath="";
    $word="public class";
    $loc=strpos($code, $word)+strlen($word)+1;
    while(ord($code[$loc])>48 && ord($code[$loc])<58 || ord($code[$loc])>64 && ord($code[$loc])<91 || ord($code[$loc])>96 && ord($code[$loc])<123 || ord($code[$loc])==95){
        $filePath.=$code[$loc];
        $loc++;
    }
    $random=$filePath;
    $filePath="temp/".$filePath.".".$language;
}
else{
    $filePath="temp/".$random.".".$language;
}
$programFile=fopen($filePath,"w");
fwrite($programFile, $code);
fclose($programFile);

if($language=="php"){
    $output=shell_exec("php.exe $filePath 2>&1");
    echo $output;
    unlink($filePath);
}
if($language=="py"){
    $output=shell_exec("python $filePath 2>&1");
    echo $output;
    unlink($filePath);
}
if($language=="js"){
    $output=shell_exec("node $filePath 2>&1");
    echo $output;
    df($filePath);
}
if($language=="c"){
    $out=$random.".exe";
    echo system("gcc $filePath");
    //echo "gcc $filePath -o $out";
    sleep(1);
    $output=shell_exec("a.exe");
    echo $output;
    //df($filePath);
}
if($language=="cpp"){
    $out=$random.".exe";
    $output=shell_exec("cd temp && $out");
    sleep(1);
    shell_exec("gcc $filePath -o $out");
    echo "gcc $filePath -o $out";
    echo $output;
    sleep(1);
    df("temp/".$out);
    df($filePath);
}
if($language=="java"){;
    $out=$random;
    shell_exec("cd temp && javac $random.java");
    sleep(1);
    echo shell_exec("cd temp && java $out");
    shell_exec("cd ../");
    df("temp/".$out.".class");
    df($filePath);
}

function df($a){
    unlink($a);
}
?>