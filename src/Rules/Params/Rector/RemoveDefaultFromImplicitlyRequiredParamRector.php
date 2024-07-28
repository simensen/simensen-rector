<?php

declare(strict_types=1);

namespace Simensen\Rector\Rules\Params\Rector;

use PhpParser\Node;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class RemoveDefaultFromImplicitlyRequiredParamRector extends AbstractRector
{
    private const DEFAULT_NONE = 'none';
    private const DEFAULT_NULL = 'null';
    private const DEFAULT_CONST = 'const';
    private const DEFAULT_SCALAR = 'scalar';
    private const DEFAULT_OTHER = 'other';

    public function getRuleDefinition(): RuleDefinition
    {
        // TODO: Implement getRuleDefinition() method.
    }

    public function getNodeTypes(): array
    {
        return [
            Node\Stmt\ClassMethod::class,
            Node\Stmt\Function_::class,
        ];
    }

    public function refactor(Node $node)
    {
        $changes = false;

        $foundParamWithDefaultValue = false;
        $foundParamWithoutDefaultValue = false;

        $foundRequiredParameterAfterOptionalParameter = false;

        $allParams = [];
        $paramsSegment = [];

        /** @var Node\Stmt\ClassMethod|Node\Stmt\Function_ $node */
        foreach ($node->params as $param) {
            $paramName = $this->getName($param);

            if ($param->type instanceof Node\UnionType) {
                // echo sprintf("%s (%s:UNION)\n", $this->getName($param), get_class($param->type));

                $nullable = count(array_filter(
                    $param->type->types,
                    fn ($node) => $this->getName($node) === 'null'
                )) > 0;

                foreach ($param->type->types as $type) {
                    // echo sprintf("    %s:%s\n", $this->getName($type), get_class($type));
                }
            } elseif ($param->type instanceof Node\NullableType) {
                $nullable = true;
            // echo sprintf("%s (%s:?%s)\n", $this->getName($param), get_class($param->type->type), $this->getName($param->type->type));
            } else {
                $nullable = false;
                // echo sprintf("%s (%s:%s)\n", $this->getName($param), get_class($param->type), $this->getName($param->type));
            }

            if ($param->default) {
                if (
                    $param->default instanceof Node\Expr\ConstFetch
                    && 'null' === $this->getName($param->default)
                ) {
                    $default = self::DEFAULT_NULL;
                // echo sprintf("    DEFAULT NULL\n");
                } elseif ($param->default instanceof Node\Expr\ConstFetch) {
                    $default = self::DEFAULT_CONST;
                // echo sprintf("    DEFAULT CONST (%s)\n", $this->getName($param->default));
                } elseif ($param->default instanceof Node\Scalar) {
                    $default = self::DEFAULT_SCALAR;
                // echo sprintf("    DEFAULT SCALAR (%s:%s)\n", $param->default->value, get_class($param->default));
                } else {
                    $default = self::DEFAULT_OTHER;
                }

                $foundParamWithDefaultValue = true;
            } else {
                $default = self::DEFAULT_NONE;

                if ($foundParamWithDefaultValue) {
                    $foundRequiredParameterAfterOptionalParameter = true;
                }

                $foundParamWithoutDefaultValue = true;
            }

            $paramsSegment[] = [
                'param' => $param,
                'nullable' => $nullable,
                'default' => $default,
            ];

            if ($foundRequiredParameterAfterOptionalParameter) {
                [
                    'changed' => $changed,
                    'params' => $params,
                ] = self::processParamsSegment($paramsSegment, true);

                if ($changed) {
                    $changes = true;
                }

                $allParams += $params;

                $foundRequiredParameterAfterOptionalParameter = false;
                $foundParamWithoutDefaultValue = false;
                $foundParamWithDefaultValue = false;
                $paramsSegment = [];
            }
        }

        [
            'changed' => $changed,
            'params' => $params,
        ] = self::processParamsSegment($paramsSegment);

        if ($changed) {
            $changes = true;
        }

        $allParams += $params;

        return $changes ? $node : null;
    }

    /**
     * @return Node\Param[]
     */
    private static function processParamsSegment(array $paramsSegment, bool $foundRequiredParameterAfterOptionalParameter = false): array
    {
        /** @var Node\Param[] $params */
        $params = [];

        $changed = false;

        foreach ($paramsSegment as $paramInfo) {
            $param = $paramInfo['param'];

            if ($paramInfo['default'] === self::DEFAULT_NULL && !$paramInfo['nullable']) {
                if ($param->type instanceof Node\UnionType) {
                    $param->type->types[] = new Node\Identifier('null');
                    $changed = true;
                } elseif (!$param->type instanceof Node\NullableType) {
                    $param->type = new Node\NullableType($param->type);
                    $changed = true;
                }
            }

            if ($foundRequiredParameterAfterOptionalParameter) {
                switch ($paramInfo['default']) {
                    case self::DEFAULT_NULL:
                    case self::DEFAULT_CONST:
                    case self::DEFAULT_SCALAR:
                    case self::DEFAULT_OTHER:
                        $param->default = null;
                        $changed = true;

                        break;
                }
            }

            $params[] = $param;
        }

        return [
            'params' => $params,
            'changed' => $changed,
        ];
    }
}
