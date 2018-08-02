<?php 

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;

/**
 * @Route("/admin/category")
 */
class CategoryController extends Controller
{
    /**
     * @Route("/{page}", requirements={"page" = "\d+"}, defaults={"page"=1})
     */
    public function index($page)
    {
        $count = 10;
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository(Category::class)->findByPage($page, $count);
        $nbPages = ceil(count($entities) / $count);
        $nbPages = $nbPages == 0? 1: $nbPages;
        if ($nbPages < $page) {

            $t = $this->get('translator');
            $this->addFlash('danger', $t->transChoice('page_error', $nbPages, array('%nbPages%' => $nbPages)));

            return $this->redirectToRoute('app_admin_category_index');
        }
        return $this->render('admin/category/index.html.twig', array(
            'entities' => $entities,
            'nbPages' => (int)$nbPages,
            'page' => $page,
        ));
    }

    /**
     * @Route("/new")
     */
    public function new(Request $request)
    {
        // Nouvelle entité Category
        $category = new Category;
        // Création du formulaire
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $t = $this->get('translator');
            $this->addFlash('success', $t->trans('category.add_success', array('%entity%' => $category->getName())));

            return $this->redirectToRoute('app_admin_category_index');
        }

        return $this->render('admin/category/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/edit/{id}", requirements={"id" = "\d+"})
     */
    public function edit(Request $request, Category $category)
    {
        // Création du formulaire
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $t = $this->get('translator');
            $this->addFlash('success', $t->trans('category.edit_success', array('%entity%' => $category->getName())));

            return $this->redirectToRoute('app_admin_category_index');
        }

        return $this->render('admin/category/edit.html.twig', array(
            'form' => $form->createView(),
            'entity' => $category,
        ));
    }

    /**
     * @Route("/delete/{id}", requirements={"id" = "\d+"})
     */
    public function delete(Request $request, Category $category)
    {
        $formBuilder = $this->createFormBuilder()
            ->setAction($this->generateUrl('app_admin_category_delete', ['id' => $category->getId()]))
            ->setMethod('DELETE');

        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush();

            $t = $this->get('translator');
            $this->addFlash('success', $t->trans('category.delete_success', array('%entity%' => $category->getName())));

            return $this->redirectToRoute('app_admin_category_index');
        }

        return $this->render('admin/category/delete.html.twig', array(
            'form' => $form->createView(),
            'entity' => $category,
        ));
    }
}