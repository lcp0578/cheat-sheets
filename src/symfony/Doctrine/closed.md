## The EntityManager is closed

		if (!$this->entityManager->isOpen()) {
            $this->entityManager = $this->entityManager->create(
                $this->entityManager->getConnection(),
                $this->entityManager->getConfiguration()
            );
        }
        //reset em
        $em = $this->getDoctrine()->resetManager();