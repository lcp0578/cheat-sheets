## Doctrine Uuid Type
> https://github.com/ramsey/uuid-doctrine

- config.yml
    ``` yaml
    # app/config/config.yml
    doctrine:
       dbal:
           types:
               uuid:  Ramsey\Uuid\Doctrine\UuidType
    ```
- Usage
Then, in your models, you may annotate properties by setting the @Column type to uuid, and defining a custom generator of Ramsey\Uuid\UuidGenerator. Doctrine will handle the rest.
    ``` php
    use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity
     * @ORM\Table(name="products")
     */
    class Product
    {
        /**
         * @var \Ramsey\Uuid\UuidInterface
         *
         * @ORM\Id
         * @ORM\Column(type="uuid", unique=true)
         * @ORM\GeneratedValue(strategy="CUSTOM")
         * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
         */
        protected $id;

        public function getId()
        {
            return $this->id;
        }
    }
    ```