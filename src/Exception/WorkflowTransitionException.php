<?php

namespace Asmodine\CommonBundle\Exception;

use Symfony\Component\Workflow\Exception\TransitionException;
use Symfony\Component\Workflow\Workflow;

/**
 * Class WorkflowTransitionException.
 */
class WorkflowTransitionException extends AbstractTranslateException
{
    /**
     * WorkflowTransitionException constructor.
     *
     * @param Workflow $workflow
     * @param $subject
     * @param string              $transition
     * @param TransitionException $transitionException
     */
    public function __construct(Workflow $workflow, $subject, string $transition, TransitionException $transitionException)
    {
        $marking = $subject->{'get'.ucfirst($workflow->getMarkingStore()->getProperty())}();
        parent::__construct('workflow_transition', [
            '%name%' => $workflow->getName(),
            '%marking%' => \is_array($marking) ? '['.implode(', ', array_keys($marking)).']' : $marking,
            '%transition%' => $transition,
            '%subject%' => (string) $subject,
        ], [], 0, $transitionException);
    }
}
