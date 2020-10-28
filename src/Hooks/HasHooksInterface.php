<?php


namespace Kira\Hooks;


interface HasHooksInterface
{
    /**
     * @param string $hookName
     * @return mixed
     */
    public function when(string $hookName);

    /**
     * @param \Closure $closure
     * @param callable $callback
     * @return mixed
     */
    public function fire(\Closure $closure, callable $callback);
}