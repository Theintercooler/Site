<?php

namespace Graphox\Neo4jBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class GraphoxNeo4jBundle extends Bundle
{

    public function getParent()
    {
        return 'KwattroNeo4jBundle';
    }

}
