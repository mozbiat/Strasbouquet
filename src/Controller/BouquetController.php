<?php

namespace App\Controller;

use App\Model\BouquetManager;

class BouquetController extends AbstractController
{
    public function index()
    {
        $bouquetManager = new BouquetManager();
        $bouquets = $bouquetManager->selectAll();

        return $this->twig->render('Bouquet/index.html.twig', ['bouquets' => $bouquets]);
    }
    /**
     * Display item creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bouquetManager = new BouquetManager();
            $bouquet = [
                'nom' => $_POST['nom'],
                'prix' => $_POST['prix'],
                'description' => $_POST['description'],
                'saisonnier' =>$_POST['saisonnier'],
            ];
            $id = $bouquetManager->insert($bouquet);
            header('Location:/bouquet/show/' . $id);
        }
        return $this->twig->render('Bouquet/add.html.twig');
    }

    public function show(int $id)
    {
        $bouquetManager = new BouquetManager();
        $bouquet = $bouquetManager->selectOneById($id);

        return $this->twig->render('Bouquet/show.html.twig', ['bouquet' => $bouquet]);
    }
    /**
     * Handle item deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $bouquetManager = new BouquetManager();
        $bouquetManager->delete($id);
        header('Location:/bouquet/index');
    }
}