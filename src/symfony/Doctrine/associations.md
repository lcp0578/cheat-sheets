## associations
> http://symfony.com/doc/current/doctrine/associations.html  
> What is the ArrayCollection Stuff?
The code inside __construct() is important: The $products property must be a collection object that implements Doctrine's Collection interface. In this case, an ArrayCollection object is used. This looks and acts almost exactly like an array, but has some added flexibility. Just imagine that it's an array and you'll be in good shape.