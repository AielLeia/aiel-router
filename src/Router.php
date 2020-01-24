<?php

namespace Aiel;

use Aiel\Exception\RouterException;
use Aiel\Route\Route;
use Closure;

class Router
{
    /**
     * -------------------------------------------------------------------------------
     * Different méthode prise en compte la class.
     * -------------------------------------------------------------------------------
     * @var string[]
     * -------------------------------------------------------------------------------
     */
    const METHOD = [
        "GET", "POST"
    ];

    /**
     * -------------------------------------------------------------------------------
     * Tableau des routes de la classe.
     * -------------------------------------------------------------------------------
     * @var Route[]
     * -------------------------------------------------------------------------------
     */
    private $routes = [];

    /**
     * -------------------------------------------------------------------------------
     * Liste des routes qui ont des noms.
     * -------------------------------------------------------------------------------
     * @var string[]
     * -------------------------------------------------------------------------------
     */
    private $nameRoutes = [];

    /**
     * -------------------------------------------------------------------------------
     * Ajoute une route.
     * -------------------------------------------------------------------------------
     * @param string            $method
     * @param string            $path
     * @param string|Closure    $target
     * @param string            $name
     * -------------------------------------------------------------------------------
     * @return self
     * -------------------------------------------------------------------------------
     * @throws RouterException
     * -------------------------------------------------------------------------------
     */
    public function add(
        string $method,
        string $path,
        $target,
        string $name = null
    ): self {
        if (!in_array(strtoupper($method), self::METHOD))
            throw new RouterException("Méthode inconue: '{$method}'");

        $method = strtoupper($method);

        if (array_key_exists($path, $this->routes))
            throw new RouterException("La route '{$path}' déja présente dans la liste des route");

        if ($name !== null) {
            if (in_array($name, $this->nameRoutes))
                throw new RouterException("Le nom '{$name}' est déja utiliser");
            $this->nameRoutes[] = $name;
        }

        $this->routes[$path] = new Route($method, $path, $target, $name);

        return $this;
    }

    /**
     * -------------------------------------------------------------------------------
     * Récupération de tout les routes definie par l'utilissateur.
     * -------------------------------------------------------------------------------
     * @param void
     * -------------------------------------------------------------------------------
     * @return Route[]
     * -------------------------------------------------------------------------------
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * -------------------------------------------------------------------------------
     * Récupère une route à partir de son nom.
     * -------------------------------------------------------------------------------
     * @param string $name
     * -------------------------------------------------------------------------------
     * @return Route
     * -------------------------------------------------------------------------------
     * @throws RouterException
     * -------------------------------------------------------------------------------
     */
    public function getRoute(string $name): Route
    {
        if (!in_array($name, $this->nameRoutes)) {
            throw new RouterException("Le nom '{$name}' n'existe pas.");
        }

        $route = null;
        foreach ($this->routes as $r)
            if ($r->getName() === $name) {
                $route = $r;
                break;
            }

        return $route;
    }
}
