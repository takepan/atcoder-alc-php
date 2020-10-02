<?php
class Fenwick {
    var $m, $N;
    function __construct($N) {
        $this->N = $N;
        $this->m = array_fill(1, $N + 1, 0);
    }
    function add($a, $w) {
        for ($x = $a; $x <= $this->N; $x += $x & -$x) {
            $this->m[$x] += $w;
        }
    }
    function sum($a) {
        $ret = 0;
        for ($x = $a; $x > 0; $x -= $x & -$x) $ret += $this->m[$x];
        return $ret;
    }
}

fscanf(STDIN, "%d %d", $N, $Q);
$f = new Fenwick($N);
$a = array_map('intval', explode(' ', trim(fgets(STDIN))));
for ($i = 0; $i < $N; $i++) {
    $f->add($i + 1, $a[$i]);
}
$ans = "";
for ($i = 0; $i < $Q; $i++) {
    fscanf(STDIN, "%d %d %d", $q1, $q2, $q3);
    switch ($q1) {
        case "0":
            $f->add($q2 + 1, $q3);
            break;
        case "1":
            $ans .= sprintf("%d\n", $f->sum($q3) - $f->sum($q2));
            break;
    }
}
echo $ans;
