<?
namespace App\Core;

class Router {
    private array $routes = [];
    private array $namedRoutes = [];
    private ?array $middleware = null;

public function get($path, $handler) {
    return $this->addRoute('GET', $path, $handler);     
}

public function post($path, $handler) {
    return $this->addRoute('POST', $path, $handler);
}

public function addRoute(string $method, string $uri, string $action) {
    $this->routes[$method][$uri] =[ 
        'action' => $action,
         'name' => null,
         'middleware' => $this->middleware ?? []
    ];  
    $this->middleware = null;

    return new class($this, $method, $uri, $action, $middleware ){
        private Router $router;
        private string $method;
        private string $uri;
        private string $action;
        private array $middleware;

        public function __construct(Router $router, string $method, string $uri, string $action, array $middleware) {
            $this->router = $router;
            $this->method = $method;
            $this->uri = $uri;
            $this->action = $action;
            $this->middleware = $middleware;
        }

        public function name(string $name) {
            $this->router->routes[$this->method][$this->uri]['name'] = $name;
            $this->router->namedRoutes[$name] = $this->router->routes[$this->method][$this->uri];
            return $this;
    }
    };

}
public function middleware(array $middleware) {
    $this->router->routes[$this->method][$this->uri]['middleware'] = $middleware;
    return $this;
}

public function route(string $name): string {
    return $this->namedRoutes[$name]['uri'] ?? throw new \Exception("No route found with name $name");
}
    
public function dispatch() {
    $method = $_SERVER['REQUEST_METHOD'];
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if(!isset($this->routes[$method][$path])) {
        http_response_code(404);
        throw new \Exception("No route defined for $method $path");
    }

    $handler = $this->routes[$method][$path];
    $action = $handler['action'];

    foreach($handler['middleware'] as $middlewareClass) {
        if(!class_exists($middlewareClass)) {
            throw new \Exception("Middleware class $middlewareClass not found");
        }
        $middleware = new $middlewareClass();
        $middleware->handle();
    }

    [$controllerClass, $method] = explode('@', $handler);

    if(!class_exists($controllerClass)) {
        throw new \Exception("Controller class $controllerClass not found");
    }
    $controller = new $controllerClass();
    call_user_func([$controller, $method]);
}


}