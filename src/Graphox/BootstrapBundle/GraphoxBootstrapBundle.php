<?php

namespace Graphox\BootstrapBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GraphoxBootstrapBundle extends Bundle
{

    public function getParent()
    {
        return 'BcBootstrapBundle';
    }

}
