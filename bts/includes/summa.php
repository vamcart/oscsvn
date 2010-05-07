<?php 
/* 
���� ����� ����������� �������� ������������� ����� � ��������� 
�������� ����� ����� 123.45 
� ������� ����� ������ ������� "��� �������� ��� ����� ����� ���� ������" 
������ �������������: 

$iw=new inwords; 
$i=123456.78; 
$s=$iw->get($i); 
print($s); 
������� ��� conweb@mail.ru
*/ 
$iw=new inwords;
$i=$order->info['total'];
$s=$iw->get($i); 
print($s); 

class inwords { 

var $diw=Array(    0 =>    Array(    0  => Array( 0=> "����",    1=>1), 
                1  => Array( 0=> "",        1=>2), 
                2  => Array( 0=> "",        1=>3), 
                3  => Array( 0=> "���",        1=>0), 
                4  => Array( 0=> "������",    1=>0), 
                5  => Array( 0=> "����",    1=>1), 
                6  => Array( 0=> "�����",    1=>1), 
                7  => Array( 0=> "����",    1=>1), 
                8  => Array( 0=> "������",    1=>1), 
                9  => Array( 0=> "������",    1=>1), 
                10 => Array( 0=> "������",    1=>1), 
                11 => Array( 0=> "����������",    1=>1), 
                12 => Array( 0=> "����������",    1=>1), 
                13 => Array( 0=> "����������",    1=>1), 
                14 => Array( 0=> "������������",1=>1), 
                15 => Array( 0=> "����������",    1=>1), 
                16 => Array( 0=> "�����������",    1=>1), 
                17 => Array( 0=> "����������",    1=>1), 
                18 => Array( 0=> "������������",1=>1), 
                19 => Array( 0=> "������������",1=>1) 
            ), 
        1 =>    Array(    2  => Array( 0=> "��������",    1=>1), 
                3  => Array( 0=> "��������",    1=>1), 
                4  => Array( 0=> "�����",    1=>1), 
                5  => Array( 0=> "���������",    1=>1), 
                6  => Array( 0=> "����������",    1=>1), 
                7  => Array( 0=> "���������",    1=>1), 
                8  => Array( 0=> "�����������",    1=>1), 
                9  => Array( 0=> "���������",    1=>1)  
            ), 
        2 =>    Array(    1  => Array( 0=> "���",        1=>1), 
                2  => Array( 0=> "������",    1=>1), 
                3  => Array( 0=> "������",    1=>1), 
                4  => Array( 0=> "���������",    1=>1), 
                5  => Array( 0=> "�������",    1=>1), 
                6  => Array( 0=> "��������",    1=>1), 
                7  => Array( 0=> "�������",    1=>1), 
                8  => Array( 0=> "���������",    1=>1), 
                9  => Array( 0=> "���������",    1=>1) 
            ) 
); 

var $nom=Array(    0 => Array(0=>"�������",  1=>"������",    2=>"���� �������", 3=>"��� �������"), 
        1 => Array(0=>"�����",    1=>"������",    2=>"���� �����",   3=>"��� �����"), 
        2 => Array(0=>"������",   1=>"�����",     2=>"���� ������",  3=>"��� ������"), 
        3 => Array(0=>"��������", 1=>"���������", 2=>"���� �������", 3=>"��� ��������"), 
        4 => Array(0=>"���������",1=>"����������",2=>"���� ��������",3=>"��� ���������"), 
/* :))) */ 
        5 => Array(0=>"���������",1=>"����������",2=>"���� ��������",3=>"��� ���������") 
); 

var $out_rub; 

function get($summ){ 
 if($summ>=1) $this->out_rub=0; 
 else $this->out_rub=1; 
 $summ_rub= doubleval(sprintf("%0.0f",$summ)); 
 if(($summ_rub-$summ)>0) $summ_rub--; 
 $summ_kop= doubleval(sprintf("%0.2f",$summ-$summ_rub))*100; 
 $kop=$this->get_string($summ_kop,0); 
 $retval=""; 
 for($i=1;$i<6&&$summ_rub>=1;$i++): 
  $summ_tmp=$summ_rub/1000; 
  $summ_part=doubleval(sprintf("%0.3f",$summ_tmp-intval($summ_tmp)))*1000; 
  $summ_rub= doubleval(sprintf("%0.0f",$summ_tmp)); 
  if(($summ_rub-$summ_tmp)>0) $summ_rub--; 
  $retval=$this->get_string($summ_part,$i)." ".$retval; 
 endfor; 
 if(($this->out_rub)==0) $retval.=" ������"; 
 return $retval." ".$kop; 
} 

function get_string($summ,$nominal){ 
 $retval=""; 
 $nom=-1; 
 $summ=round($summ); 
 if(($nominal==0&&$summ<100)||($nominal>0&&$nominal<6&&$summ<1000)): 
  $s2=intval($summ/100); 
  if($s2>0): 
   $retval.=" ".$this->diw[2][$s2][0]; 
   $nom=$this->diw[2][$s2][1]; 
  endif; 
  $sx=doubleval(sprintf("%0.0f",$summ-$s2*100)); 
  if(($sx-($summ-$s2*100))>0) $sx--; 
  if(($sx<20&&$sx>0)||($sx==0&&$nominal==0)): 
   $retval.=" ".$this->diw[0][$sx][0]; 
   $nom=$this->diw[0][$sx][1]; 
  else: 
   $s1=doubleval(sprintf("%0.0f",$sx/10)); 
   if(($s1-$sx/10)>0)$s1--; 
   $s0=doubleval($summ-$s2*100-$s1*10); 
   if($s1>0): 
    $retval.=" ".$this->diw[1][$s1][0]; 
    $nom=$this->diw[1][$s1][1]; 
   endif; 
   if($s0>0): 
    $retval.=" ".$this->diw[0][$s0][0]; 
    $nom=$this->diw[0][$s0][1]; 
   endif; 
  endif; 
 endif; 
 if($nom>=0): 
  $retval.=" ".$this->nom[$nominal][$nom]; 
  if($nominal==1) $this->out_rub=1; 
 endif; 
 return trim($retval); 
} 

} 
?>
