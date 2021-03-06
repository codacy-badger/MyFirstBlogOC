<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 08/04/2018
 * Time: 18:00
 */

namespace App\Manager;

use \PDO;
use App\Entity\PictureEntity;

class PictureManager
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param PictureEntity $picture
     * @return bool
     */
    public function create(PictureEntity $picture):bool
    {
        $request = $this->pdo->prepare(
            '	INSERT INTO picture (created, name)
						VALUES(:created, :name)'
        );

        $request->bindValue(':created', $picture->getCreated());
        $request->bindValue(':name', $picture->getName());

        if ($request->execute()) {
            return true;
        }

        return false;
    }

    public function getLastId()
    {
        $sql = "SELECT id_image FROM picture ORDER BY id_image DESC LIMIT 0,1";

        $request = $this->pdo->prepare($sql);
        $request->execute();

        $data = $request->fetch(PDO::FETCH_ASSOC);

        if (empty($data)) {
            return null;
        }

        return $data['id_image'];
    }

    public function read(int $idImg)
    {
        $request = $this->pdo->prepare(
            '	SELECT *
                        FROM picture
						WHERE id_image = :idImg'
        );

        $request->bindValue(':idImg', $idImg, PDO::PARAM_INT);
        $request->execute();

        $data = $request->fetch(PDO::FETCH_ASSOC);

        if (empty($data)) {
            return null;
        }

        $post = new PictureEntity($data);

        return $post;
    }


    /**
     * @param int $idImg
     * @return bool
     */
    public function delete(int $idImg):bool
    {
        $request = $this->pdo->prepare(
            'DELETE FROM picture
					  WHERE id_image = :idImg'
        );

        $request->bindValue(':idImg', $idImg);

        if ($request->execute()) {
            return true;
        }

        return false;
    }
}
