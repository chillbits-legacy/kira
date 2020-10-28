<?php


namespace Kira\Hooks;

use Closure;
use function Roots\add_actions;

trait InteractsWithHooks
{
    /**
     * @var string
     */
    protected $action;

    /**
     * @var Closure
     */
    protected $handler;

    /**
     * @var callable
     */
    protected $callback;

    /**
     * @param string $action
     * @return InteractsWithHooks
     */
    public function when(string $action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * @param Closure  $closure
     * @param callable $callback
     * @return InteractsWithHooks
     */
    public function fire(Closure $closure, callable $callback = null)
    {
        $callback      = $callback ?? $this->callback;
        $this->handler = $closure;
        add_actions([$this->action], $callback, 5);

        return $this;
    }

    /**
     * @param callable $callback
     * @return InteractsWithHooks
     */
    public function useCallback(callable $callback)
    {
        $this->callback = $callback;
        $this->fire(function(){}, $callback);

        return $this;
    }
}