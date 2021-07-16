<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductController extends AbstractController
{

    /**
     * @Route("/products/add", name="add_product")
     */
    public function addProduct(ValidatorInterface $validator): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setName('Piano');
        $product->setAmount(2);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return $this->render("products_info.html.twig", [
            'message' => "A new product has been added to the database",
            'product_id' => $product->getId(),
            'product_name' => $product->getName(),
            'product_amount' => $product->getAmount(),
        ]);
    }


    /**
     * @Route("/products/show/{id}", name="show_product")
     */
    public function showProduct($id): Response
    {

        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find((int)$id);

        if (!$product) {
            return new Response('No product found for id '.$id);

        }
        return $this->render("show_product_data.html.twig", [
            'product_id' => $product->getId(),
            'product_name' => $product->getName(),
            'product_amount' => $product->getAmount(),
        ]);
    }

    /**
     * @Route("/products/available", name="show_available_products")
     */
    public function availableProducts(): Response
    {
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAllGreaterThanPrice(0);

        return $this->render("show_multiple_products.html.twig", [
            'message' => "Following products are available: ",
            'products' => $products
        ]);

    }

    /**
     * @Route("/products/more-than-five", name="show_more_than_five_products")
     */
    public function moreThanFiveProducts(): Response
    {
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAllGreaterThanPrice(5);

        return $this->render("show_multiple_products.html.twig", [
            'message' => "Following products are available: ",
            'products' => $products
        ]);

    }



    /**
     * @Route("/products/delete/{id}", name="delete_product")
     */
    public function deleteProduct($id): Response
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        if (!$product) {
            return new Response('No product found for id '.$id);

        }

        $deleted_product = $product;

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($product);
        $entityManager->flush();

        return $this->render("products_info.html.twig", [
            'message' => "The following product has been removed",
//            'product_id' => $deleted_product->getId(), dlaczego to niedz iałaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
            'product_id' => $id,
            'product_name' => $deleted_product->getName(),
            'product_amount' => $deleted_product->getAmount(),
        ]);
    }

    /**
     * @Route("/products/update/{id}/{amount}", name="update_product")
     */
    public function updateProduct($id, $amount): Response
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        if (!$product) {
            return new Response('No product found for id '.$id);
        }

        $old_amount = $product->getAmount();

        $entityManager = $this->getDoctrine()->getManager();
        $product->setAmount($amount);
        $entityManager->flush();
        //tutaj niby dlaczeg persist nie jest potrzebny??????????????????????????????????
        return $this->render("products_info.html.twig", [
            'message' => "The following product has been updated (old amount: ".$old_amount.")",
            'product_id' => $product->getId(),
            'product_name' => $product->getName(),
            'product_amount' => $product->getAmount(),
        ]);
    }

}

//jak uzywam extra bndle to juz wywala jak nie znajdzie produktu
//dlaczego mi dodaje kolejne id mimo że te na początku usunęłam
