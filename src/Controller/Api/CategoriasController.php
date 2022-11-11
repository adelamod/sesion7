<?php
namespace App\Controller\Api;
use App\Entity\Categorias;
use App\Repository\CategoriasRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use function Sodium\add;
/**
 * @Rest\Route("/categorias")
 */

class CategoriasController extends AbstractFOSRestController
{
    private $catRepository;
    public function __construct(CategoriasRepository $catRepository){
        $this->catRepository = $catRepository;
    }
    /**
     * @Rest\Get(path="/")
     * @Rest\View(serializerGroups={"get_categoria"},    serializerEnableMaxDepthChecks=true)
     */
    public function getCategorias(){
        return $this->catRepository->findAll();
    }
    // Traer una categoria
    /**
     * @Rest\Get (path="/{id}")
     * @Rest\View(serializerGroups={"get_categoria"}, serializerEnableMaxDepthChecks= true)
     */
    public function getCategoria(Request $request){
        $idCategoria = $request->get('id');
        $categoria = $this->categoriaRepository->find($idCategoria);
        if(!$categoria){
            return new JsonResponse('No se ha encontrado categoria', Response::HTTP_NOT_FOUND);
        }
        return $categoria;

    }

    /**
     * @Rest\Post (path="/")
     * @Rest\View (serializerGroups={"post_categoria"}, serializerEnableMaxDepthChecks= true)
     */
    public function createCategoria(Request $request){
        // Formularios -> Es para manejas las peticiones, y validar tipado-> Null, si viene el texto en blanco ...etc
        // Validator -> Null, ->> Maximo 100 de tamaño
        // 1. Creo el objeto vacio
        $cat = new Categorias();
        // 2. Inicializamos el form
        $form = $this->createForm(CategoriaType::class, $cat);
        // 3. Le decimos al formulario que maneje la request
        $form->handleRequest($request);
        // 4. Comprobar si hay error
        if(!$form->isSubmitted() || !$form->isValid() ){
            return $form;
        }
        //5. Todo ok, guardo en BD

        $this->categoriaRepository->add($cat, true);
        return $cat;
    }
}