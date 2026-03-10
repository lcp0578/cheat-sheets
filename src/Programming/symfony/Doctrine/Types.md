## Doctrine filed types
- decimal

        /**
         * @var int
         *
         * @ORM\Column(name="longitude", type="decimal", precision=8, scale=4, options={"comment":"经度"})
         */
        private $longitude;
- [官方文档](https://www.doctrine-project.org/projects/doctrine-dbal/en/2.6/reference/types.html)