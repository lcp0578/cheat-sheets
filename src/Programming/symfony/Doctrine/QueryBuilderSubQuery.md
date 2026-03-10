## Query Builder SubQuery

``` php
public function getPageQuerySub($groups = [])
{
    $qb = $this->createQueryBuilder('a');
    $qbSub = $this->createQueryBuilder('sub');
    $qbSub->select('MAX(sub.id)');
    $qbSub->where('sub.status != 6');
    $qbSub->where('sub.status != 8');
    if (! empty($groups)) {
        $qbSub->andWhere($qbSub->expr()
            ->in('sub.groupCode', ':group_code'));
        $qb->setParameter('group_code', $groups);
    }
    $qbSub->groupBy('sub.uuid');

    $qb->leftJoin(Approval::class, 'n', 'WITH', 'n.uuid = a.uuid')
    ->leftJoin(WebUser::class, 'c', 'WITH', 'c.id = n.userId')
    ->select('n.id,n.title,n.itemName,n.mobile,a.uuid, a.status,a.nodeName,a.createAt,a.updateAt,a.remainDay,c.truename');
    $qb->where($qb->expr()
        ->in('a.id', $qbSub->getDQL()));
    return $qb->orderBy('a.id', 'DESC')->getQuery();
}
public function getPageQuerySubQuery($items, $groups, $city, $district, $where_city = '', $where_district = '', $truename = '', $status = '')
{
    $qb = $this->createQueryBuilder('a');
    $qbMain = $this->createQueryBuilder('ap');
    $qb->select('MAX(a.id)');
    $qb->andWhere($qb->expr()
        ->in('a.itemCode', ':item_code'));
    $qbMain->setParameter('item_code', $items);

    $qb->andWhere($qb->expr()
        ->in('a.groupCode', ':group_code'));
    $qbMain->setParameter('group_code', $groups);

    if (! empty($city)) {
        $qb->andWhere($qb->expr()
            ->in('a.city', ':city'));
        $qbMain->setParameter('city', $city);
    } else {
        if (! empty($district)) {
            $qb->andWhere($qb->expr()
                ->in('a.district', ':district'));
            $qbMain->setParameter('district', $district);
        }
    }
    if (! empty($where_city)) {
        if ($where_city == 1) {
            $where_city = 0;
        }
        $qb->andWhere('a.city=:city');
        $qbMain->setParameter('city', $where_city);
    }
    if (! empty($where_district)) {
        $qb->andWhere('a.district = :district');
        $qbMain->setParameter('district', $where_district);
    }
    if (! empty($status)) {
        $qb->andWhere('a.status = :status');
        $qbMain->setParameter('status', $status);
    }
    $qb->andWhere('a.status != 6');
    $qb->andWhere('a.status != 8');
    $qb->groupBy('a.uuid');

    $qbMain->leftJoin(Approval::class, 'n', 'WITH', 'n.uuid = ap.uuid');
    $qbMain->leftJoin(WebUser::class, 'c', 'WITH', 'c.id = n.userId');
    $qbMain->select('n.id,n.title,n.itemName,n.mobile,ap.uuid, ap.status,ap.nodeName,ap.createAt,ap.updateAt,ap.remainDay,c.truename');
    $qbMain->where($qbMain->expr()
        ->in('ap.id', $qb->getDQL()));
    if (! empty($truename)) {
        $qbMain->andWhere('c.truename like :truename');
        $qbMain->setParameter('truename', "%" . $truename . "%");
    }
    return $qbMain->orderBy('ap.id', 'DESC')->getQuery();
}
```