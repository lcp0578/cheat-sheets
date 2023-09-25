## DateTimeImmutable vs DateTime
- DateTime示例

		$date = new DateTime();
		$tomorrow = $date->modify('+1 day');
		echo $date->format('Y-m-d');
		echo $tomorrow->format('Y-m-d');	
	- This will output:

			2021-05-15
			2021-05-15
	- What happened here is that the `modify` returned the same instance of the `DateTime` object. The variable `$tomorrow` doesn't contain a different object, it contains a reference to the original one.
- DateTimeImmutable示例

		$date = new DateTimeImmutable();
		$tomorrow = $date->modify('+1 day');
		echo $date->format('Y-m-d');
		echo $tomorrow->format('Y-m-d');	
	- This will output:

			2021-05-14
			2021-05-15
	- Because in `DateTimeImmutable`, the modification methods don't return the same instance, they give you a fresh one (also immutable). 