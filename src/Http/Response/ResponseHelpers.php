<?php namespace Lift\Framework\Http\Response {

    use Symfony\Component\HttpFoundation\JsonResponse;

    /**
     * Create a new json response
     *
     * @todo Refactor so potentially data gets passed into function
     *
     * @return JsonResponse
     */
    function json(): JsonResponse
    {
        return new JsonResponse();
    }
}