<?php

namespace Axtiva\FlexibleGraphql\Federation\Generator\Config\Foundation\Psr4;

use Axtiva\FlexibleGraphql\Federation\Generator\Config\FederationRepresentationResolverGeneratorConfigInterface;
use Axtiva\FlexibleGraphql\Generator\Config\CodeGeneratorConfigInterface;
use GraphQL\Type\Definition\Type;

class FederationRepresentationResolverGeneratorConfig implements FederationRepresentationResolverGeneratorConfigInterface
{
    private CodeGeneratorConfigInterface $config;

    public function __construct(CodeGeneratorConfigInterface $config)
    {
        $this->config = $config;
    }

    public function getModelNamespace(Type $type): ?string
    {
        return $this->config->getCodeNamespace() . '\\Representation';
    }

    public function getModelClassName(Type $type): string
    {
        return $type->toString() . 'Representation';
    }

    public function getModelFullClassName(Type $type): string
    {
        return $this->getModelNamespace($type)
            ? $this->getModelNamespace($type) . '\\' . $this->getModelClassName($type)
            : $this->getModelClassName($type);
    }

    public function getModelClassFileName(Type $type): string
    {
        return $this->getModelDirPath($type) . '/' . $this->getModelClassName($type) . '.php';
    }

    public function getModelDirPath(Type $type): string
    {
        return $this->config->getCodeDirPath() . '/Representation';
    }
}