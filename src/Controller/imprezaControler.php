<?php
namespace App\Controller;

use App\Exception\NotFoundException;
use App\Model\impreza;
use App\Service\Router;
use App\Service\Templating;

class imprezaControler
{
    public function indexAction(Templating $templating, Router $router): ?string
    {
        $imprezy = impreza::findAll();
        $html = $templating->render('impreza/index.html.php', [
            'imprezy' => $imprezy,
            'router' => $router,
        ]);
        return $html;
    }

    public function createAction(?array $requestEvent, Templating $templating, Router $router): ?string
    {
        if ($requestEvent) {
            $impreza = impreza::fromArray($requestEvent);
            // @todo missing validation
            $impreza->save();

            $path = $router->generatePath('impreza-index');
            $router->redirect($path);
            return null;
        } else {
            $impreza = new impreza();
        }

        $html = $templating->render('impreza/create.html.php', [
            'impreza' => $impreza,
            'router' => $router,
        ]);
        return $html;
    }

    public function editAction(int $eventId, ?array $requestEvent, Templating $templating, Router $router): ?string
    {
        $impreza = impreza::find($eventId);
        if (! $impreza) {
            throw new NotFoundException("Brak imprezy o id $eventId");
        }

        if ($requestEvent) {
            $impreza->fill($requestEvent);
            // @todo missing validation
            $impreza->save();

            $path = $router->generatePath('impreza-index');
            $router->redirect($path);
            return null;
        }

        $html = $templating->render('impreza/edit.html.php', [
            'impreza' => $impreza,
            'router' => $router,
        ]);
        return $html;
    }

    public function showAction(int $eventId, Templating $templating, Router $router): ?string
    {
        $impreza = impreza::find($eventId);
        if (! $impreza) {
            throw new NotFoundException("Brak imprezy o id $eventId");
        }

        $html = $templating->render('impreza/show.html.php', [
            'impreza' => $impreza,
            'router' => $router,
        ]);
        return $html;
    }

    public function deleteAction(int $eventId, Router $router): ?string
    {
        $impreza = impreza::find($eventId);
        if (! $impreza) {
            throw new NotFoundException("Brak imprezy o id $eventId");
        }

        $impreza->delete();
        $path = $router->generatePath('impreza-index');
        $router->redirect($path);
        return null;
    }
}
