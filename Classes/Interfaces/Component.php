<?php

namespace lightframe\Interfaces;

interface Component
{
    public function __construct(\lightframe\ViewBuilder $viewBuilder);
    public function render() : ?string;
}