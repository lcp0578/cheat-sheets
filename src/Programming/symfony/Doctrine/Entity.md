## An Entity Demo
``` php
<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Menu
 *
 * @ORM\Table(name="menu")
 * * @ORM\Table(
 *          name="menu",
 *          options={"comment": "菜单表"}, 
 *          indexes={
 *          @ORM\Index(name="case_english_name_idx", columns={"english_name"}),
 *          @ORM\Index(name="case_date_idx", columns={"create_at", "update_at"})
 *          })
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\MenuRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(
 *     fields={"name", "itemCode"},
 *     message="{{ value }}已存在"
 * ) //两个值的组合不相同,注意name和itemCode必须都在FormType里面，且不能设置为disabled，可以设置readonly
 * @UniqueEntity(fields = {"itemCode"}, message="itemCode {{ value }}已存在") //itemCode不能相同
 * @UniqueEntity(fields = {"name"}, message="name {{ value }}已存在")
 */
class Menu
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=60，unique=true, options={"comment": "菜单名称"})
     * @Assert\NotBlank(message="名称不能为空")
     * @Assert\Length(
     *      max = 60,
     *      maxMessage = "名称最多60个字符"
     *      )
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="english_name", type="string", length=60，nullable=true, options={"comment": "英文名称"})
     */
    private $englishName;

    /**
     * @var int
     *
     * @ORM\Column(name="level", type="smallint")
     */
    private $level;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="decimal", precision=30, scale=2, options={"comment":"数值"})
     */
    private $number;
    
     /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=11, options={"comment":"联系人手机号"})
     * @Assert\NotBlank(message="联系人手机号不能为空")
     * @Assert\Length(
     *      max = 11,
     *      min = 11,
     *      exactMessage = "联系人手机号应为11位"
     *      )
     */
    private $mobile;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_at", type="datetime")
     */
    private $createAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at", type="datetime")
     */
    private $updateAt;

    /**
     * One menu has Many menus.
     *
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * Many menus have One menu.
     *
     * @ORM\OneToMany(targetEntity="Menu", mappedBy="parent")
     * @ORM\OrderBy({"sort" = "DESC", "id" = "DESC"})
     */
    private $children;


    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Menu
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * format name
     *
     * 美化返回名称
     */
    public function getDropName()
    {
        return str_pad(' ', $this->level) . $this->name;
    }
    
    /**
     * Set englishName
     *
     * @param string $englishName
     *
     * @return Menu
     */
    public function setEnglishName($englishName)
    {
        $this->englishName = $englishName;

        return $this;
    }

    /**
     * Get englishName
     *
     * @return string
     */
    public function getEnglishName()
    {
        return $this->englishName;
    }
    /**
     * Set level
     *
     * @param integer $level
     *
     * @return Menu
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }
    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return Menu
     */
    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     *
     * @return Menu
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * Set parent
     *
     * @param Category $parent
     *
     * @return Category
     */
    public function setParent(Menu $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return Category
     */
    public function getParent()
    {
        return $this->parent;
    }

    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        if($this->getParent() == null){
            $this->setLevel(1);
        }else{
            $this->setLevel($this->getParent()->getLevel()+1);
        }
        if($this->getCreateAt() == null){
            $this->setCreateAt(new \DateTime());
        }
        $this->setUpdateAt(new \DateTime());
    }
    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        if($this->getParent() == null){
            $this->setLevel(1);
        }else{
            $this->setLevel($this->getParent()->getLevel()+1);
        }
        $this->setUpdateAt(new \DateTime());
    }

    /**
     * Add child
     *
     * @param \AdminBundle\Entity\Menu $child
     *
     * @return Menu
     */
    public function addChild(\AdminBundle\Entity\Menu $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \AdminBundle\Entity\Menu $child
     */
    public function removeChild(\AdminBundle\Entity\Menu $child)
    {
        $this->children->removeElement($child);
    }
}
```