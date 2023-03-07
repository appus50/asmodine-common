<?php

namespace Asmodine\CommonBundle\Util;

/**
 * Class FormHelper.
 */
class FormHelper
{
    /**
     * @param string $prefixTrans
     * @param array  $choices
     * @param bool   $expanded
     * @param bool   $multiple
     *
     * @return array
     */
    public static function getChoices(string $prefixTrans, array $choices, bool $expanded = false, bool $multiple = false): array
    {
        $newChoices = [];
        for ($i = 0; $i < \count($choices); ++$i) {
            $newChoices[$prefixTrans.$choices[$i]] = $choices[$i];
        }

        return ['choices' => $newChoices, 'expanded' => $expanded, 'multiple' => $multiple];
    }
}
