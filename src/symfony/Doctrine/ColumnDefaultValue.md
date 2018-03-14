## Column default value

	/**
     * @var string
     *
     * @ORM\Column(name="canal_length", columnDefinition="DECIMAL(10,2) DEFAULT 0", options={"default":0})
     */
    private $canalLength;
    
> Symfony form fields override default values set on the Entity class.

- 当表单里面有对应的字段时，表单的字段会覆盖options里面的default。
- 需要借助columnDefinition来设置MySQL中的默认值，（ptions里面的default并不会更新到数据库中）
