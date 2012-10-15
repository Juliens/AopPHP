--TEST--
Kind around
--FILE--
<?php

require_once("./src/aop/Aop.php");
require_once("./src/aop/advice/IAdvice.php");

use aop\Advice\IAdvice;
use aop\Aop;

class KindBefore implements IAdvice {
    public function getKindOfAdvice() {
        return AOP_KIND_AROUND;
    }

    public function __invoke (AopJoinpoint $aop) {
        echo "before";
        $aop->process();
        echo "after";
    }
}

$aop = new Aop ();

$aop->add("foo::bar()", new KindBefore());

class Foo {
    public function bar () {
        echo "bar";
    }
}

$foo = new Foo ();
$foo->bar();

?>
--EXPECT--
beforebarafter
