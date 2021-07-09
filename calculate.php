<?php
require 'connection.php';

$jk=$_POST['jk'];
$sr=$_POST['sr'];
$status=$_POST['status'];
$jt=$_POST['jt'];
$profesi=$_POST['profesi'];
$ppt=$_POST['ppt'];

$data_train =[];
$sql_train = mysqli_query($conn,"SELECT * FROM data_train");
while($row=mysqli_fetch_row($sql_train)){
    $temp = array(
        'jk'=>$row[1],
        'sr'=>$row[2],
        'status'=>$row[3],
        'jt'=>$row[4],
        'profesi'=>$row[5],
        'ppt'=>$row[6],
        'kk'=>$row[7]
    );
    array_push($data_train,$temp);
}

//Jumlah Class
$p_classic=searching("kk","Classic",$data_train);
$p_gold=searching("kk","Gold",$data_train);
$p_platinum=searching("kk","Platinum",$data_train);
$p_tidak=searching("kk","Tidak Diterima",$data_train);

//kasus dengan class yang sama
//jenis kelamin
$p_jk_classic=searching("jk",$jk,$p_classic);
$p_jk_gold=searching("jk",$jk,$p_gold);
$p_jk_platinum=searching("jk",$jk,$p_platinum);
$p_jk_tidak=searching("jk",$jk,$p_tidak);
//status rumah
$p_sr_classic=searching("sr",$sr,$p_classic);
$p_sr_gold=searching("sr",$sr,$p_gold);
$p_sr_platinum=searching("sr",$sr,$p_platinum);
$p_sr_tidak=searching("sr",$sr,$p_tidak);
//status
$p_status_classic=searching("status",$status,$p_classic);
$p_status_gold=searching("status",$status,$p_gold);
$p_status_platinum=searching("status",$status,$p_platinum);
$p_status_tidak=searching("status",$status,$p_tidak);
//jumlah tanggungan
$p_jt_classic=searching("jt",$jt,$p_classic);
$p_jt_gold=searching("jt",$jt,$p_gold);
$p_jt_platinum=searching("jt",$jt,$p_platinum);
$p_jt_tidak=searching("jt",$jt,$p_tidak);
//profesi
$p_profesi_classic=searching("profesi",$profesi,$p_classic);
$p_profesi_gold=searching("profesi",$profesi,$p_gold);
$p_profesi_platinum=searching("profesi",$profesi,$p_platinum);
$p_profesi_tidak=searching("profesi",$profesi,$p_tidak);
//penghasilan per tahun
$p_ppt_classic=searching("ppt",$ppt,$p_classic);
$p_ppt_gold=searching("ppt",$ppt,$p_gold);
$p_ppt_platinum=searching("ppt",$ppt,$p_platinum);
$p_ppt_tidak=searching("ppt",$ppt,$p_tidak);

//menghitung HMAP (Hypothesis Maximum Appropri Probability)
    //classic
    $result['Classic']=count($p_jk_classic)/count($p_classic)*count($p_sr_classic)/count($p_classic)*count($p_status_classic)/count($p_classic)*count($p_jt_classic)/count($p_classic)*count($p_profesi_classic)/count($p_classic)*count($p_ppt_classic)/count($p_classic)*count($p_classic)/count($data_train);
    $result['Classic']=number_format( $result['Classic'],10,".","");
    $string['Classic']="\( = "."{ ".count($p_jk_classic)."\over  ".count($p_classic)."} \\times ".
                    "{ ".count($p_sr_classic)."\over  ".count($p_classic)." } \\times ".
                    "{ ".count($p_status_classic)."\over ".count($p_classic)." } \\times ".
                    "{ ".count($p_jt_classic)."\over ".count($p_classic)." } \\times ".
                    "{ ".count($p_profesi_classic)."\over ".count($p_classic)." } \\times ".
                    "{ ".count($p_ppt_classic)."\over ".count($p_classic)." } \\times ".
                    "{ ".count($p_classic)."\over ".count($data_train)." } = ".$result['Classic']." \)";
    //gold
    $result['Gold']=count($p_jk_gold)/count($p_gold)*count($p_sr_gold)/count($p_gold)*count($p_status_gold)/count($p_gold)*count($p_jt_gold)/count($p_gold)*count($p_profesi_gold)/count($p_gold)*count($p_ppt_gold)/count($p_gold)*count($p_gold)/count($data_train);
    $result['Gold']=number_format( $result['Gold'],10,".","");
    $string['Gold']="\( = "."{ ".count($p_jk_gold)."\over  ".count($p_gold)."} \\times ".
                    "{ ".count($p_sr_gold)."\over  ".count($p_gold)." } \\times ".
                    "{ ".count($p_status_gold)."\over ".count($p_gold)." } \\times ".
                    "{ ".count($p_jt_gold)."\over ".count($p_gold)." } \\times ".
                    "{ ".count($p_profesi_gold)."\over ".count($p_gold)." } \\times ".
                    "{ ".count($p_ppt_gold)."\over ".count($p_gold)." } \\times ".
                    "{ ".count($p_gold)."\over ".count($data_train)." } = ".$result['Gold']." \)";
    //platinum
    $result['Platinum']=count($p_jk_platinum)/count($p_platinum)*count($p_sr_platinum)/count($p_platinum)*count($p_status_platinum)/count($p_platinum)*count($p_jt_platinum)/count($p_platinum)*count($p_profesi_platinum)/count($p_platinum)*count($p_ppt_platinum)/count($p_platinum)*count($p_platinum)/count($data_train);
    $result['Platinum']=number_format( $result['Platinum'],10,".","");
    $string['Platinum']="\( = "."{ ".count($p_jk_platinum)."\over  ".count($p_platinum)."} \\times ".
                    "{ ".count($p_sr_platinum)."\over  ".count($p_platinum)." } \\times ".
                    "{ ".count($p_status_platinum)."\over ".count($p_platinum)." } \\times ".
                    "{ ".count($p_jt_platinum)."\over ".count($p_platinum)." } \\times ".
                    "{ ".count($p_profesi_platinum)."\over ".count($p_platinum)." } \\times ".
                    "{ ".count($p_ppt_platinum)."\over ".count($p_platinum)." } \\times ".
                    "{ ".count($p_platinum)."\over ".count($data_train)." } = ".$result['Platinum']." \)";//tidak diterima
    $result['Tidak Diterima']=count($p_jk_tidak)/count($p_tidak)*count($p_sr_tidak)/count($p_tidak)*count($p_status_tidak)/count($p_tidak)*count($p_jt_tidak)/count($p_tidak)*count($p_profesi_tidak)/count($p_tidak)*count($p_ppt_tidak)/count($p_tidak)*count($p_tidak)/count($data_train);
    $result['Tidak Diterima']=number_format( $result['Tidak Diterima'],10,".","");
    $string['Tidak Diterima']="\( = "."{ ".count($p_jk_tidak)."\over  ".count($p_tidak)."} \\times ".
                    "{ ".count($p_sr_tidak)."\over  ".count($p_tidak)." } \\times ".
                    "{ ".count($p_status_tidak)."\over ".count($p_tidak)." } \\times ".
                    "{ ".count($p_jt_tidak)."\over ".count($p_tidak)." } \\times ".
                    "{ ".count($p_profesi_tidak)."\over ".count($p_tidak)." } \\times ".
                    "{ ".count($p_ppt_tidak)."\over ".count($p_tidak)." } \\times ".
                    "{ ".count($p_tidak)."\over ".count($data_train)." } = ".$result['Tidak Diterima']." \)";

if($_GET['laplace']==1){
    //classic
    $result['Classic']=(count($p_jk_classic)+1)/(count($p_classic)+2)*(count($p_sr_classic)+1)/(count($p_classic)+3)*(count($p_status_classic)+1)/(count($p_classic)+2)*(count($p_jt_classic)+1)/(count($p_classic)+3)*(count($p_profesi_classic)+1)/(count($p_classic)+3)*(count($p_ppt_classic)+1)/(count($p_classic)+4)*count($p_classic)/count($data_train);
    $result['Classic']=number_format( $result['Classic'],10,".","");
    $string['Classic']="\( = "."{ ".(count($p_jk_classic)+1)."\over  ".(count($p_classic)+2)." } \\times ".
                    "{ ".(count($p_sr_classic)+1)."\over  ".(count($p_classic)+3)." } \\times ".
                    "{ ".(count($p_status_classic)+1)."\over ".(count($p_classic)+2)." } \\times ".
                    "{ ".(count($p_jt_classic)+1)."\over ".(count($p_classic)+3)." } \\times ".
                    "{ ".(count($p_profesi_classic)+1)."\over ".(count($p_classic)+3)." } \\times ".
                    "{ ".(count($p_ppt_classic)+1)."\over ".(count($p_classic)+4)." } \\times ".
                    "{ ".count($p_classic)."\over ".count($data_train)." } = ".$result['Classic']." \)";
    
    //gold
    $result['Gold']=(count($p_jk_gold)+1)/(count($p_gold)+2)*(count($p_sr_gold)+1)/(count($p_gold)+3)*(count($p_status_gold)+1)/(count($p_gold)+2)*(count($p_jt_gold)+1)/(count($p_gold)+4)*(count($p_profesi_gold)+1)/(count($p_gold)+3)*(count($p_ppt_gold)+1)/(count($p_gold)+4)*count($p_gold)/count($data_train);
    $result['Gold']=number_format( $result['Gold'],10,".","");
    $string['Gold']="\( = "."{ ".(count($p_jk_gold)+1)."\over  ".(count($p_gold)+2)."} \\times ".
                    "{ ".(count($p_sr_gold)+1)."\over  ".(count($p_gold)+3)." } \\times ".
                    "{ ".(count($p_status_gold)+1)."\over ".(count($p_gold)+2)." } \\times ".
                    "{ ".(count($p_jt_gold)+1)."\over ".(count($p_gold)+3)." } \\times ".
                    "{ ".(count($p_profesi_gold)+1)."\over ".(count($p_gold)+3)." } \\times ".
                    "{ ".(count($p_ppt_gold)+1)."\over ".(count($p_gold)+4)." } \\times ".
                    "{ ".count($p_gold)."\over ".count($data_train)." } = ".$result['Gold']." \)";
    
    
    //platinum
    $result['Platinum']=(count($p_jk_platinum)+1)/(count($p_platinum)+2)*(count($p_sr_platinum)+1)/(count($p_platinum)+3)*(count($p_status_platinum)+1)/(count($p_platinum)+2)*(count($p_jt_platinum)+1)/(count($p_platinum)+3)*(count($p_profesi_platinum)+1)/(count($p_platinum)+3)*(count($p_ppt_platinum)+1)/(count($p_platinum)+4)*count($p_platinum)/count($data_train);
    $result['Platinum']=number_format( $result['Classic'],10,".","");
    $string['Platinum']="\( = "."{ ".(count($p_jk_platinum)+1)."\over  ".(count($p_platinum)+2)."} \\times ".
                    "{ ".(count($p_sr_platinum)+1)."\over  ".(count($p_platinum)+3)." } \\times ".
                    "{ ".(count($p_status_platinum)+1)."\over ".(count($p_platinum)+2)." } \\times ".
                    "{ ".(count($p_jt_platinum)+1)."\over ".(count($p_platinum)+3)." } \\times ".
                    "{ ".(count($p_profesi_platinum)+1)."\over ".(count($p_platinum)+3)." } \\times ".
                    "{ ".(count($p_ppt_platinum)+1)."\over ".(count($p_platinum)+4)." } \\times ".
                    "{ ".count($p_platinum)."\over ".count($data_train)." } = ".$result['Platinum']." \)";
    
    //tidak diterima
    $result['Tidak Diterima']=(count($p_jk_tidak)+1)/(count($p_tidak)+2)*(count($p_sr_tidak)+1)/(count($p_tidak)+3)*(count($p_status_tidak)+1)/(count($p_tidak)+2)*(count($p_jt_tidak)+1)/(count($p_tidak)+4)*(count($p_profesi_tidak)+1)/(count($p_tidak)+3)*(count($p_ppt_tidak)+1)/(count($p_tidak)+3)*count($p_tidak)/count($data_train);
    $result['Tidak Diterima']=number_format( $result['Tidak Diterima'],10,".","");
    $string['Tidak Diterima']="\( = "."{ ".(count($p_jk_tidak)+1)."\over  ".(count($p_tidak)+2)."} \\times ".
                    "{ ".(count($p_sr_tidak)+1)."\over  ".(count($p_tidak)+3)." } \\times ".
                    "{ ".(count($p_status_tidak)+1)."\over ".(count($p_tidak)+2)." } \\times ".
                    "{ ".(count($p_jt_tidak)+1)."\over ".(count($p_tidak)+3)." } \\times ".
                    "{ ".(count($p_profesi_tidak)+1)."\over ".(count($p_tidak)+3)." } \\times ".
                    "{ ".(count($p_ppt_tidak)+1)."\over ".(count($p_tidak)+4)." } \\times ".
                    "{ ".count($p_tidak)."\over ".count($data_train)." } = ".$result['Tidak Diterima']." \)";
    
}
//Result Akhir
$return = array($result,$string);
echo json_encode($return);
function searching($col,$val,$data_train){
    $n=0;
    $temp=[];
    foreach($data_train as $key=>$data){
        if($data[$col]==$val){
            array_push($temp,$data_train[$key]);
        };
    }
    return $temp;
}
?>