<?php
$namespace$
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
$useFullyQualifiedModelName$

class $className$Controller extends ControllerBase
{
    public function initialize()
    {
        $this->view->viewName = "input view name";
    }

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for $plural$
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, '$fullyQualifiedModelName$', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "$pk$";

        $pluralVar$ = $className$::find($parameters);
        if (count($pluralVar$) == 0) {
            $this->flash->notice("The search did not find any $plural$");

            $this->dispatcher->forward([
                "controller" => $this->router->getControllerName(),
                "action" => "index"
            ]);

            return;
        }

        // if NOT load all data at once, use this
        $paginator = new Paginator([
            'data' => $pluralVar$,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();

        // if load all data at once, use this
        // $this->view->pageitems = $pluralVar$;
    }

    /**
     * Searches for $singular$
     */
    public function apisearchAction()
    {
        $this->view->disable();
        /*
        if (!$this->request->isPost()) {
            return $this->http405();
        }
        */

        /* // Check parameters
        if (isset($_POST["CHECK"]) == false || isset($_POST["PARAMETERS"]) == false)
        {
            $resp = new \Phalcon\Http\Response();
            $resp->setHeader("Content-Type", "application/json");
            $resp->setHeader("Access-Control-Allow-Origin", "*");
            $resp->setHeader('Access-Control-Allow-Headers', 'X-Requested-With');
            $resp->sendHeaders();
            $resp->setStatusCode(400, "Bad Request");
            $resp->setContent(json_encode(["message"=> "Parameter missing"]));
            return $resp;
        }
        */

        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, '$fullyQualifiedModelName$', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $query = Criteria::fromInput($this->di, '$fullyQualifiedModelName$', $_GET);
            $this->persistent->parameters = $query->getParams();
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "$pk$";
        // $parameters["columns"] = "Input, Your, Columns";
        $parameters["hydration"] = \Phalcon\Mvc\Model\Resultset::HYDRATE_ARRAYS; // comment out this if you do not need the result as Model[]

        $users = Users::find($parameters);
        if (count($users) == 0) {
            return $this->http404('search');
        }

        $resp = new \Phalcon\Http\Response();
        $resp->setStatusCode(200, "OK");
        $resp->setHeader("Content-Type", "application/json");
        $resp->setHeader("Access-Control-Allow-Origin", "*");
        $resp->setHeader('Access-Control-Allow-Headers', 'X-Requested-With');
        $resp->sendHeaders();
        $resp->setContent(json_encode($pluralVar$->toArray(), JSON_NUMERIC_CHECK));
        $resp->send();
        return;
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a $singular$
     *
     * @param string $pkVar$
     */
    public function editAction($pkVar$)
    {
        if (!$this->request->isPost()) {

            $singularVar$ = $className$::findFirstBy$pk$($pkVar$);
            if (!$singularVar$) {
                $this->flash->error("$singular$ was not found");

                $this->dispatcher->forward([
                    'controller' => $this->router->getControllerName(),
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->$pk$ = $singularVar$->$pkGet$;

            $assignTagDefaults$
        }
    }

    /**
     * Creates a new $singular$
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => $this->router->getControllerName(),
                'action' => 'index'
            ]);

            return;
        }

        $singularVar$ = new $className$();
        $assignInputFromRequestCreate$

        if (!$singularVar$->save()) {
            foreach ($singularVar$->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => $this->router->getControllerName(),
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("$singular$ was created successfully");

        $this->dispatcher->forward([
            'controller' => $this->router->getControllerName(),
            'action' => 'index'
        ]);
    }

    /**
     * Creates a new $singular$
     */
    public function apicreateAction()
    {
        $this->view->disable();
        if (!$this->request->isPost()) {
            return $this->http405();
        }

        /* // Check parameters
        if (isset($_POST["CHECK"]) == false || isset($_POST["PARAMETERS"]) == false)
        {
            $resp = new \Phalcon\Http\Response();
            $resp->setHeader("Content-Type", "application/json");
            $resp->setHeader("Access-Control-Allow-Origin", "*");
            $resp->setHeader('Access-Control-Allow-Headers', 'X-Requested-With');
            $resp->sendHeaders();
            $resp->setStatusCode(400, "Bad Request");
            $resp->setContent(json_encode(["message"=> "Parameter missing"]));
            return $resp;
        }
        */
        $pkVar$ = $this->request->getPost("$pk$");
        $singularVar$ = $className$::findFirstBy$pk$($pkVar$);
        if (!$singularVar$)
        {
            $singularVar$ = new $className$();
        }

        $assignInputFromRequestCreate$

        if (!$singularVar$->save()) {
            return $this->http500('{"message": "create fail"}');
        }

        return $this->http200('create');
    }

    /**
     * Saves a $singular$ edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => $this->router->getControllerName(),
                'action' => 'index'
            ]);

            return;
        }

        $pkVar$ = $this->request->getPost("$pk$");
        $singularVar$ = $className$::findFirstBy$pk$($pkVar$);

        if (!$singularVar$) {
            $this->flash->error("$singular$ does not exist " . $pkVar$);

            $this->dispatcher->forward([
                'controller' => $this->router->getControllerName(),
                'action' => 'index'
            ]);

            return;
        }

        $assignInputFromRequestUpdate$

        if (!$singularVar$->save()) {

            foreach ($singularVar$->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => $this->router->getControllerName(),
                'action' => 'edit',
                'params' => [$singularVar$->$pkGet$]
            ]);

            return;
        }

        $this->flash->success("$singular$ was updated successfully");

        $this->dispatcher->forward([
            'controller' => $this->router->getControllerName(),
            'action' => 'index'
        ]);
    }

    /**
     * Saves a $singular$ edited
     *
     */
    public function apisaveAction()
    {
        $this->view->disable();
        if (!$this->request->isPost()) {
            return $this->http405();
        }

        /* // Check parameters
        if (isset($_POST["CHECK"]) == false || isset($_POST["PARAMETERS"]) == false)
        {
            $resp = new \Phalcon\Http\Response();
            $resp->setHeader("Content-Type", "application/json");
            $resp->setHeader("Access-Control-Allow-Origin", "*");
            $resp->setHeader('Access-Control-Allow-Headers', 'X-Requested-With');
            $resp->sendHeaders();
            $resp->setStatusCode(400, "Bad Request");
            $resp->setContent(json_encode(["message"=> "Parameter missing"]));
            return $resp;
        }
        */

        $pkVar$ = $this->request->getPost("$pk$");
        $singularVar$ = $className$::findFirstBy$pk$($pkVar$);

        if (!$singularVar$) {
            $this->http404('updating item');
        }

        $assignInputFromRequestUpdate$

        if (!$singularVar$->save()) {
            return $this->http500('{"message": "update fail"}');
        }

        return $this->http200('update');
    }

    /**
     * Deletes a $singular$
     *
     * @param string $pkVar$
     */
    public function deleteAction($pkVar$)
    {
        $singularVar$ = $className$::findFirstBy$pk$($pkVar$);
        if (!$singularVar$) {
            $this->flash->error("$singular$ was not found");

            $this->dispatcher->forward([
                'controller' => $this->router->getControllerName(),
                'action' => 'index'
            ]);

            return;
        }

        if (!$singularVar$->delete()) {

            foreach ($singularVar$->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => $this->router->getControllerName(),
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("$singular$ was deleted successfully");

        $this->dispatcher->forward([
            'controller' => $this->router->getControllerName(),
            'action' => "index"
        ]);
    }

    /**
     * Deletes a $singular$
     *
     * @param string $pkVar$
     */
    public function apideleteAction($pkVar$)
    {
        $this->view->disable();

        if (!$this->request->isPost()) {
            return $this->http405();
        }

        /* // Check parameters
        if (isset($_POST["CHECK"]) == false || isset($_POST["PARAMETERS"]) == false)
        {
            $resp = new \Phalcon\Http\Response();
            $resp->setHeader("Content-Type", "application/json");
            $resp->setHeader("Access-Control-Allow-Origin", "*");
            $resp->setHeader('Access-Control-Allow-Headers', 'X-Requested-With');
            $resp->sendHeaders();
            $resp->setStatusCode(400, "Bad Request");
            $resp->setContent(json_encode(["message"=> "Parameter missing"]));
            return $resp;
        }
        */

        $singularVar$ = $className$::findFirstBy$pk$($pkVar$);
        if (!$singularVar$) {
            return $this->http404('delete target');
        }

        if (!$singularVar$->delete()) {
            return $this->http500('{"message": "delete fail"}');
        }

        return $this->http200('delete');
    }

    public function http405()
    {
        $resp = new \Phalcon\Http\Response();
        $resp->setStatusCode(405, "Method Not Allowed");
        $resp->setHeader("Content-Type", "application/json");
        $resp->setHeader("Access-Control-Allow-Origin", "*");
        $resp->setHeader('Access-Control-Allow-Headers', 'X-Requested-With');
        $resp->sendHeaders();
        $resp->setContent('{"message": "Not Valid Request"}');
        $resp->send();
        return;
    }

    public function http200($functionname)
    {
        $resp = new \Phalcon\Http\Response();
        $resp->setStatusCode(200, "OK");
        $resp->setHeader("Content-Type", "application/json");
        $resp->setHeader("Access-Control-Allow-Origin", "*");
        $resp->setHeader('Access-Control-Allow-Headers', 'X-Requested-With');
        $resp->sendHeaders();
        if (!$functionname == false)
        {
            $resp->setContent('{"message": "' . $functionname . ' success"}');
        }
        else
        {
            $resp->setContent('{"message": "success"}');
        }
        $resp->send();
        return;
    }

    public function http400($message)
    {
        $resp = new \Phalcon\Http\Response();
        $resp->setHeader("Content-Type", "application/json");
        $resp->setHeader("Access-Control-Allow-Origin", "*");
        $resp->setHeader('Access-Control-Allow-Headers', 'X-Requested-With');
        $resp->sendHeaders();
        $resp->setStatusCode(400, "Bad Request");
        $resp->setContent(json_encode(["message"=> $message]));
        return $resp;
    }

    public function http404($functionname)
    {
        $resp = new \Phalcon\Http\Response();
        $resp->setStatusCode(404, "Not Found");
        $resp->setHeader("Content-Type", "application/json");
        $resp->setHeader("Access-Control-Allow-Origin", "*");
        $resp->setHeader('Access-Control-Allow-Headers', 'X-Requested-With');
        $resp->sendHeaders();
        if (!$functionname == false)
        {
            $resp->setContent('{"message": "' . $functionname . ' not found"}');
        }
        else
        {
            $resp->setContent('{"message": "not found"}');
        }
        $resp->send();
        return;
    }

    public function http500($message)
    {
        $resp = new \Phalcon\Http\Response();
        $resp->setStatusCode(500, "Internal Server Error");
        $resp->setHeader("Content-Type", "application/json");
        $resp->setHeader("Access-Control-Allow-Origin", "*");
        $resp->setHeader('Access-Control-Allow-Headers', 'X-Requested-With');
        $resp->sendHeaders();
        $resp->setContent($message);
        $resp->send();

        return;
    }

}
