## Validation Groups
> https://symfony.com/doc/3.4/validation/groups.html
$form = $this->createFormBuilder($users, array(
    'validation_groups' => array('foobar'),
))->add(...)
- Sequentially Apply Validation Groups
> https://symfony.com/doc/3.4/validation/sequence_provider.html
> https://symfony.com/doc/3.4/form/data_based_validation.html