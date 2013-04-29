<?php

namespace Graphox\Neo4jBundle\GraphManager;

use Kwattro\Neo4jBundle\GraphManager\GraphManager as BaseGraphManager;
use Symfony\Component\HttpKernel\Kernel;

class GraphManager extends BaseGraphManager
{

    private $bundleRegistry = array(
            );
    private $repositoryNameCache = array(
            );

    public function __construct($host, $port, $proxy_dir, Kernel $kernel,
            $username = null, $password = null)
    {
        parent::__construct($host, $port, $proxy_dir, $username, $password);

        foreach ($kernel->getBundles() as $bundle)
        {
            $this->bundleRegistry[$bundle->getName() . ':'] = $bundle->getNamespace() . '\Entity\\';
        }
    }

    public function getRepository($class)
    {
        if (!isset($this->repositoryNameCache[$class]))
        {
            $this->repositoryNameCache[$class] = str_replace(array_keys($this->bundleRegistry),
                    array_values($this->bundleRegistry), $class);
        }

        return parent::getRepository($this->repositoryNameCache[$class]);
    }

}
