<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 04/04/2018
 * Time: 18:49
 */

namespace App\Entity;

class PostEntity
{
    private $idPost;
    private $created;
    private $modified;
    private $title;
    private $shortText;
    private $content;
    private $idUser;
    private $idStatutPost;
    private $idImage;
    // INFO USER
    private $lastName;
    private $firstName;
    // INFO STATUT
    private $statutPostTitle;
    // INFO IMG
    private $imgName;
    // COMMENTS
    private $comments;


    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            ### transformation camelCase ####
            $spacing = trim(str_replace("_", " ", $key));
            $spacing = ucwords($spacing);
            $spacing = str_replace(" ", "", $spacing);
            $key = lcfirst($spacing);

            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            } //method_exists( $this, $method )
        } //$donnees as $key => $value
    }

    /**
     * @return mixed
     */
    public function getIdPost()
    {
        return $this->idPost;
    }

    /**
     * @param mixed $idPost
     */
    public function setIdPost($idPost): void
    {
        $this->idPost = $idPost;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created): void
    {
        $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param mixed $modified
     */
    public function setModified($modified): void
    {
        $this->modified = $modified;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getShortText()
    {
        return $this->shortText;
    }

    /**
     * @param mixed $shortText
     */
    public function setShortText($shortText): void
    {
        $this->shortText = $shortText;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getIdStatutPost()
    {
        return $this->idStatutPost;
    }

    /**
     * @param mixed $idStatutPost
     */
    public function setIdStatutPost($idStatutPost): void
    {
        $this->idStatutPost = $idStatutPost;
    }

    /**
     * @return mixed
     */
    public function getIdImage()
    {
        return $this->idImage;
    }

    /**
     * @param mixed $idImage
     */
    public function setIdImage($idImage): void
    {
        $this->idImage = $idImage;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getStatutPostTitle()
    {
        return $this->statutPostTitle;
    }

    /**
     * @param mixed $statutPostTitle
     */
    public function setStatutPostTitle($statutPostTitle): void
    {
        $this->statutPostTitle = $statutPostTitle;
    }

    /**
     * @return mixed
     */
    public function getImgName()
    {
        return $this->imgName;
    }

    /**
     * @param mixed $imgName
     */
    public function setImgName($imgName): void
    {
        $this->imgName = $imgName;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments): void
    {
        $this->comments = $comments;
    }
}
