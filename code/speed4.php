<?php
$begin = time();
$i = 0;
while($i++ < 10000)
{
  $j = 0;
  while($j++ < 10000)
    ;
  ;
}
$end = time();

$time = $end - $begin ;
echo "运行时间".$time."秒\n";

