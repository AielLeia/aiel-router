<?php

namespace Aiel\Route;

use Closure;

class Route
{
    /**
     * -------------------------------------------------------------------------------
     * Méthode d'appel pour la route en court.
     * -------------------------------------------------------------------------------
     * @var string
     * -------------------------------------------------------------------------------
     */
    private $method;

    /**
     * -------------------------------------------------------------------------------
     * Chemin pour lequel reponde cette route.
     * -------------------------------------------------------------------------------
     * @var string
     * -------------------------------------------------------------------------------
     */
    private $path;

    /**
     * -------------------------------------------------------------------------------
     * Cible a éxécuter lorsqu'il y auras un match au niveau de l'URL, une cible
     * peut être une chaine de caractère comme quoi c'est un template html
     * a charger ou une closure donc uen fonction a éxécuter.
     * -------------------------------------------------------------------------------
     * @var string|Closure
     * -------------------------------------------------------------------------------
     */
    private $target;

    /**
     * -------------------------------------------------------------------------------
     * Nom de route.
     * -------------------------------------------------------------------------------
     * @var string|null
     * -------------------------------------------------------------------------------
     */
    private $name = null;

    public function __construct(
        string $method,
        string $path,
        $target,
        string $name = null
    ) {
        $this->method   = $method;
        $this->path     = $path;
        $this->target   = $target;
        $this->name     = $name;
    }

    /**
     * Get 
     *
     * @return  string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Set 
     *
     * @param  string  $method  
     *
     * @return  self
     */
    public function setMethod(string $method): self
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get
     *
     * @return  string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Set
     *
     * @param  string  $path 
     *
     * @return  self
     */
    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get
     *
     * @return  string|Closure
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set
     *
     * @param  string|Closure  $target 
     *
     * @return  self
     */
    public function setTarget($target): self
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Ge
     *
     * @return  string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Se
     *
     * @param  string|null  $name
     *
     * @return  self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
