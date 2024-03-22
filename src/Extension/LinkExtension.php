<?php

namespace TreptowKolleg\Tictactoe\Extension;

use ReflectionClass;
use ReflectionException;
use TreptowKolleg\Tictactoe\Controller\AbstractController;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class LinkExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('route', [$this, 'generateUrlFromString']),
            new TwigFunction('link', [$this, 'generateLink']),
        ];
    }

    public function generateUrlFromString(string $class, string $method, array $mandatory = null, $anchor = null): string
    {
        $path = "";
        $reflectionClass = null;
        $class = 'TreptowKolleg\Tictactoe\Controller\\' . $class;
        try {
            if(new $class instanceof AbstractController) {
                $reflectionClass = new ReflectionClass($class);
            }


            if (method_exists($class, $method)) {
                $className = strtolower(str_replace("Controller", "", $reflectionClass->getShortName()));

                $path .= "?controller=$className&action=$method";

                if ($mandatory) {
                    foreach ($mandatory as $name => $value) {
                        $path .= "&$name=$value";
                    }
                }
                if ($anchor) {
                    $path .= "#$anchor";
                }
            } else {
                echo "Methode $method existiert nicht in $class.";
            }

            return $this->getProtocol() . $_SERVER['HTTP_HOST'] . $path;
        } catch (ReflectionException $e) {
            die("Klasse existiert nicht");
        }
    }

    public function generateLink(string $target = null): string
    {
        return $this->getProtocol() . $_SERVER['HTTP_HOST'] . '/' . $target;
    }

    private function getProtocol(): string
    {
        return (! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    }

}